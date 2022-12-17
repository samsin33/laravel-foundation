<?php

namespace Samsin33\Foundation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public mixed $object;
    public string $email_view;
    public array $from_user;
    public array $data;
    public $subject;
    public array $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($object, string $email_view, array $from_user, string $email_subject, array $data, array $attach = [], array $reply_to = [])
    {
        $this->email_view = $email_view;
        $this->from_user = $from_user;
        $this->data['object'] = $object;
        $this->data['other_data'] = $data;
        $this->subject = $email_subject;
        $this->attach = $attach;
        $this->replyTo = $reply_to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $mail = $this->view('Emails.'.$this->email_view)->from($this->from_user)->subject($this->subject);
        if (!empty($this->replyTo)) {
            $mail = $mail->replyTo($this->replyTo['address'], $this->replyTo['name']);
        }
        foreach ($this->attach as $attach) {
            $mail = $mail->attach($attach);
        }
        return $mail;
    }
}
