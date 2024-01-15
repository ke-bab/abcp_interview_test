<?php

namespace App\Return\Notification;

use App\Return\Notification\Mail\MailInterface;
use App\Return\Notification\Sms\SmsInterface;
use App\Return\Request;

class Notificator implements NotificatorInterface
{
    private MailInterface $mail;
    private SmsInterface $sms;

    public function __construct(MailInterface $mail, SmsInterface $sms)
    {
        $this->mail = $mail;
        $this->sms = $sms;
    }

    public function send(TemplateData $data): Result
    {
        // шлем от селлера сотрудникам
        $this->mail->send()
    }

}