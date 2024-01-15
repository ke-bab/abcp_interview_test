<?php

namespace App\Return\Repository;

interface ContractorInterface
{
    const TYPE_CUSTOMER = 0;

    public function getId(): int;
    public function getType(): int;
    public function getName(): string;
    public function getFullName(): string;
    // метод чисто для того что бы код работал и не выдавал ошибок. считаем что он выдает связь селлера (очень условно).
    public function seller(): ContractorInterface;
}