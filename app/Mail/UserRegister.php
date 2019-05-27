<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email_subject;
    protected $params;

    public function __construct( $params, $email_subject)
    {
        $this->email_subject = $email_subject;
        $this->params = $params;
    }

    /**
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
            ->view('email.register_user_template')->with([
                'info_data' => $this->params
            ]);

        if (isset($params['certificate_image']) && !empty($params['certificate_image'])) {
            $mail = $mail->attach(url('/') . '/storage/app/' . $params['certificate_image']);
        }
        return $mail;
    }
}
