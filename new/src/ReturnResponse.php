<?php

namespace NW\WebService\References\Operations\Return;

class ReturnResponse implements \JsonSerializable
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
