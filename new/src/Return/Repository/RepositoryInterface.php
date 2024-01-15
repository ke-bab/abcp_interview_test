<?php

namespace App\Return\Repository;

interface RepositoryInterface
{
    public function findClient(int $id): ?Client;
    public function findCreator(int $id): ?Creator;
    public function findSeller(int $id): ?Reseller;
    public function findExpert(int $id): ?Expert;
}