<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email_subject;
    protected $params;

    public function __construct($params, $email_subject)
    {
        $this->email_subject = $email_subject;
        $this->params = $params;
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
                'params' => $this->params
            ]);;
        if ($this->params['is_admin'] == false) {
            $mail = $mail->view('email.contact_user_template');
        } else {
            $mail = $mail->view('email.contact_template');
        }
        return $mail;
    }
}
