<?php

namespace App\Return\Repository;

trait FullNameTrait
{
    public function getFullName(): string
    {
        return $this->getName() . ' ' . $this->getId();
    }
}