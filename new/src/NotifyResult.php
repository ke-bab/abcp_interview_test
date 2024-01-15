<?php

namespace NW\WebService\References\Operations\Return;

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