<?php

namespace App\Return\Notification;

class Result implements \JsonSerializable
{
    private NotifyResult $notificationEmployeeByEmail;
    private NotifyResult $notificationClientByEmail;
    private NotifyResult $notificationClientBySms;

    public function jsonSerialize(): array
    {
        return [
            'notificationEmployeeByEmail' => $this->notificationEmployeeByEmail,
            'notificationClientByEmail' => $this->notificationClientByEmail,
            'notificationClientBySms' => $this->notificationClientBySms,
        ];
    }
}
