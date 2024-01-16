<?php

namespace App\Return\Repository\Model;

class Client implements ContractorInterface
{
    use FullNameTrait;

    public function getId(): int
    {
        // TODO: Implement getId() method.
    }

    public function getType(): int
    {
        // TODO: Implement getType() method.
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    // метод чисто для того что бы код работал и не выдавал ошибок. считаем что он выдает связь селлера (очень условно).
    public function seller(): ContractorInterface
    {
        return new Reseller();
    }
}