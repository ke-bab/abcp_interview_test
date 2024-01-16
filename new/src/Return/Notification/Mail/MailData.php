<?php

namespace App\Return\Notification\Mail;

class MailData
{
    public string $from;
    public string $to;
    public string $sub;
    public string $body;

    public function __construct(
        string $from,
        string $to,
        string $sub,
        string $body,
    )
    {
        $this->from = $from;
        $this->to = $to;
        $this->sub = $sub;
        $this->body = $body;
    }
}