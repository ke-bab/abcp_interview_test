<?php

namespace App\Return\Template;

class Template
{
    /**
     * Просто заглушка что бы код работал
     */
    public static function __(string $name, ?array $data, int $resellerId): string
    {
        return 'email or sms template';
    }
}