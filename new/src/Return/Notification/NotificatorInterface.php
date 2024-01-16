<?php

namespace App\Return\Notification;

use App\Return\Notification\Dto\Result;
use App\Return\Notification\Dto\TemplateData;
use App\Return\Repository\Model\Client;
use App\Return\Repository\Model\Reseller;

interface NotificatorInterface
{
    public const TYPE_NEW    = 1;
    public const TYPE_CHANGE = 2;

    public function send(
        TemplateData $templateData,
        Reseller     $reseller,
        Client       $client,
        string       $event,
        ?int         $statusTo
    ): Result;
}