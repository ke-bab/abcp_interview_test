<?php

namespace NW\WebService\References\Operations\Return;

class ReturnRequest
{
    public int $resellerId;
    public int $creatorId;
    public int $clientId;
    public int $expertId;
    public int $notificationType;
    public array $statusChange;

    public static function new(array $request): ReturnRequest
    {
        return new ReturnRequest();
    }

}