<?php

namespace App\Return\Repository;

use App\Return\Repository\Model\Client;
use App\Return\Repository\Model\Creator;
use App\Return\Repository\Model\Expert;
use App\Return\Repository\Model\Reseller;

/**
 * Подразумевается что репозиторий также можно мокнуть в тестах и подменить, но у нас и стандартная
 * имплементация возвращает заглушки так что можнои  не мокать.
 */
interface RepositoryInterface
{
    public function findClient(int $id): ?Client;
    public function findCreator(int $id): ?Creator;
    public function findSeller(int $id): ?Reseller;
    public function findExpert(int $id): ?Expert;
}