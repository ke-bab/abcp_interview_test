<?php

namespace App\Return\Repository\Model;

class Reseller implements ContractorInterface
{
    use FullNameTrait;

    public function getId(): int
    {
        return 124;
    }

    public function getType(): int
    {
        return 4;
    }

    public function getName(): string
    {
        return "Rachel";
    }
}