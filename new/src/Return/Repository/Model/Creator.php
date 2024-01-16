<?php

namespace App\Return\Repository\Model;

class Creator implements ContractorInterface
{
    use FullNameTrait;

    public function getId(): int
    {
        return 111;
    }

    public function getType(): int
    {
        return 2;
    }

    public function getName(): string
    {
        return "John";
    }
}