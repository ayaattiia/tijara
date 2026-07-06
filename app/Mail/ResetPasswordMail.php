<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;
    public string $username;

    public function __construct(string $token, string $username)
    {
        $this->token = $token;
        $this->username = $username;
    }

    public function build()
    {
        return $this->subject('Reinitialisation de votre mot de passe - Tijara')
            ->view('emails.reset-password')
            ->with([
                'token' => $this->token,
                'username' => $this->username,
            ]);
    }
}