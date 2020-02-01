<?php

namespace Lib\Repository;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Exception\EmptyOrderIdException;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;

interface OrderRepositoryInterface
{
    /**
     * @param OrderId $orderId
     *
     * @return Order
     *
     * @throws EmptyOrderIdException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws EmptyOrderInformationException
     */
    public function getById(OrderId $orderId): Order;

    /**
     * @param Order $order
     *
     * @return OrderId
     *
     * @throws EmptyOrderIdException
     */
    public function add(Order $order): OrderId;

    /**
     * @param OrderId $orderId
     */
    public function remove(OrderId $orderId): void;
}
