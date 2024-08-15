<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($o)
    {
        $this->o = $o;
    }

    public function build()
    {
        return $this->view('auth.otp')->with([
            'o' => $this->o
        ]);
    }
}

