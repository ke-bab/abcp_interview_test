<?php

namespace App\Return\Repository\Model;

class Client implements ContractorInterface
{
    use FullNameTrait;

    public function getId(): int
    {
        return 123;
    }

    public function getType(): int
    {
        return ContractorInterface::TYPE_CUSTOMER;
    }

    public function getName(): string
    {
        return "Mike";
    }

    // метод чисто для того что бы код работал и не выдавал ошибок. считаем что он выдает связь селлера (очень условно).
    public function seller(): ContractorInterface
    {
        return new Reseller();
    }
}