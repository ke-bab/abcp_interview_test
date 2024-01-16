<?php

namespace App\Return;

class Status
{
    public const COMPLETED = 'Completed';
    public const PENDING = 'Pending';
    public const REJECTED = 'Rejected';

    public const MAP = [
        0 => self::COMPLETED,
        1 => self::PENDING,
        2 => self::REJECTED,
    ];
}