<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderIdException;
use Lib\Exception\EmptyOrderInformationException;
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
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws EmptyOrderIdException
     * @throws EmptyOrderStatusException
     */
    public function create(array $data): Order;
}
