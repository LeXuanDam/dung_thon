<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email_subject;
    protected $data;

    public function __construct($data, $email_subject)
    {
        $this->email_subject = $email_subject;
        $this->data = $data;
    }

    /*
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('mail.mail_from');
        $from_name = config('mail.mail_from_name');
        $mail = $this->subject($this->email_subject)
            ->from($from, $from_name)
            ->with([
                'data' => $this->data
            ])
            ->view('email.forgotpassword_template');
        return $mail;
    }
}
