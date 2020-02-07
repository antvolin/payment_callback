<?php

namespace Lib\Factory;

use CI_DB_query_builder;
use Lib\Repository\QueryBuilderRepository;
use Lib\Repository\RepositoryInterface;

class QueryBuilderRepositoryFactory implements RepositoryFactoryInterface
{
    public function createRepository(): RepositoryInterface
    {
        $queryBuilder = $this->createQueryBuilder();
        $orderFactory = $this->createOrderFactory();

        return new QueryBuilderRepository($queryBuilder, $orderFactory);
    }

    private function createQueryBuilder(): CI_DB_query_builder
    {
        $CI =& get_instance();

        return $CI->db;
    }

    private function createOrderFactory(): OrderFactory
    {
        return new OrderFactory();
    }
}
