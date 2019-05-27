<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentDone extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $service;
    protected $email_subject;
    protected $params;

    public function __construct($user, $service, $params, $email_subject)
    {
        $this->user = $user;
        $this->service = $service;
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
            ->view('email.payment_done_template')
            ->with([
                'user' => $this->user,
                'params' => $this->params,
                'service' => $this->service
            ]);
        if (isset($params['certificate_image']) && !empty($params['certificate_image'])) {
            $mail = $mail->attach(url('/'). '/storage/app/' . $params['certificate_image']);
        }
        return $mail;
    }
}
