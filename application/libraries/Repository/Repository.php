<?php

namespace Lib\Repository;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Factory\RepositoryFactoryInterface;
use Symfony\Component\Dotenv\Dotenv;

abstract class Repository implements RepositoryInterface
{
    public static function getInstance(): RepositoryInterface
    {
        return self::getRepositoryFactory()->createRepository();
    }

    private static function getRepositoryFactory(): RepositoryFactoryInterface
    {
        (new Dotenv())->load(__DIR__.'/../../../.env');
        $factoryName = 'Lib\\Factory\\'.$_ENV['REPOSITORY_TYPE'].'RepositoryFactory';

        return new $factoryName();
    }

    protected function generateId(): string
    {
        return uniqid('id_', false);
    }

    abstract public function getById(OrderId $orderId): ?Order;

    abstract public function add(Order $order): OrderId;

    abstract public function remove(OrderId $orderId): void;
}
