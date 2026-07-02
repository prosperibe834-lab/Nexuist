<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetOtpMail extends Mailable
{
    use SerializesModels;

    public User $user;
    public string $otp;

    public function __construct(User $user, string $otp)
    {
        $this->user = $user;
        $this->otp = $otp;

        \Illuminate\Support\Facades\Log::info('PasswordResetOtpMail constructor received OTP', [
            'email' => $user->email,
            'otp' => $otp,
        ]);
    }

    public function build()
    {
        return $this->subject('Your Nexuist Password Recovery Code')
            ->view('emails.password_reset_otp')
            ->with([
                'user' => $this->user,
                'otp' => $this->otp,
            ]);
    }
}
