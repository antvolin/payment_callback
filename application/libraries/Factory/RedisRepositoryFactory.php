<?php

namespace Lib\Factory;

use Lib\Repository\RedisRepository;
use Lib\Repository\RepositoryInterface;

class RedisRepositoryFactory implements RepositoryFactoryInterface
{
    public function createRepository(): RepositoryInterface
    {
        return new RedisRepository($this->getOrderFactory());
    }

    private function getOrderFactory(): OrderFactoryInterface
    {
        return new OrderFactory();
    }
}
