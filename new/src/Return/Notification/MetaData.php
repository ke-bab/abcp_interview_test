<?php

namespace App\Return\Notification;

class MetaData
{
    public int $resellerId;
    public int $clientId;
    public string $event;
    public ?int $diffTo;
}