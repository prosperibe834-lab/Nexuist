<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ForgotPasswordFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_complete_password_recovery_with_otp(): void
    {
        $user = User::factory()->create([
            'email' => 'recovery@example.com',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status');
        $this->assertEquals($user->email, session('password_reset_email'));
        $this->assertNotNull(session('password_reset_otp'));

        $response = $this->post('/forgot-password/otp/verify', [
            'email' => $user->email,
            'otp' => session('password_reset_otp'),
        ]);

        $response->assertRedirect('/forgot-password/reset');

        $response = $this->post('/forgot-password/reset', [
            'email' => $user->email,
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertRedirect('/login');

        $user->refresh();
        $this->assertTrue(Hash::check('NewPassword123!', $user->password));
    }
}
