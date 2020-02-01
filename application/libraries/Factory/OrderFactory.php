<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;

class OrderFactory implements OrderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Order
    {
        return new Order($data);
    }
}
