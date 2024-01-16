<?php

namespace App\Return\Repository\Model;

class Expert implements ContractorInterface
{
    use FullNameTrait;

    public function getId(): int
    {
        return 122;
    }

    public function getType(): int
    {
        return 3;
    }

    public function getName(): string
    {
        return "Олег";
    }
}