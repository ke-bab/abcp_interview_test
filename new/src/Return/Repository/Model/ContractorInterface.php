<?php

namespace App\Return\Repository\Model;

interface ContractorInterface
{
    const TYPE_CUSTOMER = 0;

    public function getId(): int;
    public function getType(): int;
    public function getName(): string;
    public function getFullName(): string;
}