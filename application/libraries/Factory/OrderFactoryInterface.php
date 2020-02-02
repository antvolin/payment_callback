<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Exception\OrderStatusFieldSizeException;

interface OrderFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Order
     *
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     * @throws OrderStatusFieldSizeException
     */
    public function create(array $data): Order;
}
