<?php

namespace App\Return\Notification;

class NotifyResult implements \JsonSerializable
{
    private bool $isSent = false;
    private ?string $error = null;

    public function jsonSerialize(): array
    {
        return [
            'isSent' => $this->isSent,
            'error' => $this->error,
        ];
    }
}