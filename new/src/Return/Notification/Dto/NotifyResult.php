<?php

namespace App\Return\Notification\Dto;

class NotifyResult implements \JsonSerializable
{
    private bool $isSent = false;
    private ?string $error = null;

    public function setSuccess(): void
    {
        $this->isSent = true;
        $this->error = null;
    }

    public function setFailure(string $error): void
    {
        $this->isSent = false;
        $this->error = $error;
    }

    public function jsonSerialize(): array
    {
        return [
            'isSent' => $this->isSent,
            'error' => $this->error,
        ];
    }
}