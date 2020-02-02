<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;

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
     * @throws EmptyOrderStatusException
     * @throws OrderIdFieldSizeException
     */
    public function create(array $data): Order;
}
