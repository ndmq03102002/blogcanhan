<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('auth.otp')->with([
            'token' => $this->token
        ]);
    }
}

