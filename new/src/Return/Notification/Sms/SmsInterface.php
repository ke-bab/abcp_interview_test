<?php

namespace App\Return\Notification\Sms;

use App\Return\Notification\Dto\MetaData;
use App\Return\Notification\Dto\TemplateData;

interface SmsInterface
{
    public function send(string $mobile, TemplateData $data, MetaData $metadata);
}