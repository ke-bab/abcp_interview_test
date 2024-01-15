<?php

namespace App\Return\Notification;

interface NotificatorInterface
{
    public function send(TemplateData $data): Result;
}