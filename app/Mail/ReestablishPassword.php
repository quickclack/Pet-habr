<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReestablishPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected string $password
    ){
    }

    public function build(): self
    {
        return $this->view('emails.reestablish')->with([
            'password' => $this->password
        ]);
    }
}
