<?php

namespace App\Return\Notification\Dto;

class MetaData
{
    public int $resellerId;
    public int $clientId;
    public string $event;
    public ?int $statusTo;

    public function __construct(
        int    $resellerId,
        int    $clientId,
        string $event,
        ?int   $statusTo,
    )
    {
        $this->resellerId = $resellerId;
        $this->clientId = $clientId;
        $this->event = $event;
        $this->statusTo = $statusTo;
    }
}