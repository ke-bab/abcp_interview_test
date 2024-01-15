<?php

namespace App\Return\Notification\Sms;

use App\Return\Notification\MetaData;

interface SmsInterface
{
    public function send(SmsData $data, MetaData $metadata);
}