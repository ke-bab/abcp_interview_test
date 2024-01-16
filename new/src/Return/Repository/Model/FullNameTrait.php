<?php

namespace App\Return\Repository\Model;

trait FullNameTrait
{
    public function getFullName(): string
    {
        return $this->getName() . ' ' . $this->getId();
    }
}