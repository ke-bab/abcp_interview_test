<?php

namespace App\Return\Repository;


/**
 * ContractorRepository хранит клиентов, креаторов, экспертов и селлеров.
 * В реальности мы бы создали 4 репозитория, но для простоты сделаем 1 и будем считать что у нас 4.
 */
class ContractorRepository implements RepositoryInterface
{
    public function findClient(int $id): ?ContractorInterface
    {
        return new Client();
    }

    public function findCreator(int $id): ?ContractorInterface
    {
        return new Creator();
    }

    public function findSeller(int $id): ?ContractorInterface
    {
        return new Reseller();
    }

    public function findExpert(int $id): ?ContractorInterface
    {
        return new Expert();
    }
}