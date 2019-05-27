<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterService extends Mailable
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
    protected $from_name;

    public function __construct($user, $service, $email_subject, $from_name)
    {
        $this->user = $user;
        $this->service = $service;
        $this->email_subject = $email_subject;
        $this->from_name = $from_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->email_subject)
            ->from('lexuandam96@gmail.com', $this->from_name)
            ->view('email.register_services_template')
            ->with([
                'info_user' => $this->user,
                'info_services' => $this->service
            ]);
    }
}
