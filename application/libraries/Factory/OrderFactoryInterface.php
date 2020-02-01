<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderIdException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;

interface OrderFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Order
     *
     * @throws EmptyOrderIdException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     */
    public function create(array $data): Order;
}
