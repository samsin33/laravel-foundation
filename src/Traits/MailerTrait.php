<?php

namespace Samsin33\Foundation\Traits;

use Samsin33\Foundation\Mail\SendMail;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

trait MailerTrait
{
    protected static array $email_from_user = [];

    /**
     * @return void
     */
    public static function bootMailerTrait(): void
    {
        self::$email_from_user = ['address' => config('mail.from.address'), 'name' => config('mail.from.name')];
    }

    /**
     * @param string $email
     * @param string $name
     * @return void
     */
    public function setEmailFromUser(string $email, string $name): void
    {
        self::$email_from_user = ['address' => $email, 'name' => $name];
    }

    /**
     * @return void
     */
    public function resetEmailFromUser(): void
    {
        self::$email_from_user = ['address' => config('mail.from.address'), 'name' => config('mail.from.name')];
    }

    /**
     * @param $email_to
     * @param string $view
     * @param string $subject
     * @param array $data
     * @param array $cc
     * @param array $bcc
     * @param int $reset_email_from
     * @param array $attach
     * @param array $reply_to
     * @return bool|Model
     */
    public function sendMail($email_to, string $view, string $subject = '', array $data = [], array $cc = [], array $bcc = [], int $reset_email_from = 0, array $attach = [], array $reply_to = []): bool|Model
    {
        $object = $this;
        try {
            Mail::to($email_to)->cc($cc)->bcc($bcc)->send(new SendMail($object, $view, self::$email_from_user, $subject, $data, $attach, $reply_to));
            if ($reset_email_from == 1) {
                $this->resetEmailFromUser();
            }
        } catch (Exception $exception) {
            return false;
        }
        return $this;
    }

    /**
     * @param mixed $exception
     * @param string $exception_view
     * @param string $subject
     * @return void
     */
    public function sendExceptionEmail(mixed $exception, string $exception_view, string $subject = ''): void
    {
        $subject = empty($subject) ? 'Error in '.config('app.name').' Application' : $subject;
        $this->sendMail(config('mail.exception_email'), $exception_view, $subject, $exception);
    }
}
