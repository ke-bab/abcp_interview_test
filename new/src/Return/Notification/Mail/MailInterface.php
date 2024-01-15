<?php

namespace App\Return\Notification\Mail;

use App\Return\Notification\MetaData;

interface MailInterface
{
    public function send(MailData $data, MetaData $metadata);
}