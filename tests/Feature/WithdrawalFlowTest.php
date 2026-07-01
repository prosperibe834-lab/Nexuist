<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserNotification;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WithdrawalFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_withdrawal_request_creates_a_separate_pending_record(): void
    {
        $user = User::factory()->create([
            'balance' => 500.00,
            'name' => 'Test User',
        ]);

        $this->actingAs($user);

        $firstResponse = $this->get(route('withdrawal.index'));
        $firstResponse->assertStatus(200);

        $firstWithdrawal = $user->withdrawals()->where('status', 'pending')->latest()->first();
        $this->assertNotNull($firstWithdrawal);

        $this->post(route('withdrawal.store'), [
            'transaction_id' => $firstWithdrawal->transaction_id,
            'amount' => 100.00,
            'method' => 'bank_transfer',
            'wallet_address' => 'bank-account-001',
        ]);

        $this->get(route('withdrawal.index'));

        $secondWithdrawal = $user->withdrawals()->where('status', 'pending')->latest()->first();

        $this->assertNotNull($secondWithdrawal);
        $this->assertNotSame($firstWithdrawal->id, $secondWithdrawal->id);
        $this->assertSame(0.0, (float) $secondWithdrawal->amount);
    }

    public function test_user_can_submit_withdrawal_and_admin_can_approve_it(): void
    {
        $user = User::factory()->create([
            'balance' => 500.00,
            'name' => 'Test User',
        ]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'transaction_id' => Withdrawal::generateTransactionId(),
            'status' => 'pending',
            'amount' => 0,
            'method' => 'bank_transfer',
            'wallet_address' => '',
        ]);

        $this->actingAs($user);

        $user->forceFill([
            'username' => 'testuser',
            'phone' => '1234567890',
            'country' => 'US',
        ])->save();

        $response = $this->post(route('withdrawal.store'), [
            'transaction_id' => $withdrawal->transaction_id,
            'amount' => 100.00,
            'method' => 'bank_transfer',
            'wallet_address' => 'bank-account-001',
        ]);

        $response->assertRedirect(route('accountstatement'));
        $this->assertDatabaseHas('withdrawals', [
            'id' => $withdrawal->id,
            'status' => 'pending',
            'amount' => 100.00,
        ]);

        $this->assertDatabaseHas('user_notifications', [
            'user_id' => $user->id,
            'type' => 'withdrawal_submitted',
        ]);

        $response = $this->postJson(route('admin.withdrawals.approve', $withdrawal->id));

        $response->assertJsonPath('success', true);
        $user->refresh();
        $this->assertSame(400.00, (float) $user->balance);
        $this->assertDatabaseHas('withdrawals', [
            'id' => $withdrawal->id,
            'status' => 'approved',
        ]);
        $this->assertTrue(UserNotification::where('user_id', $user->id)->where('type', 'withdrawal')->exists());
    }
}
