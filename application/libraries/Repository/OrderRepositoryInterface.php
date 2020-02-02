<?php

namespace Lib\Repository;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;

interface OrderRepositoryInterface
{
    /**
     * @param OrderId $orderId
     *
     * @return Order|null
     *
     * @throws EmptyOrderInformationException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     */
    public function getById(OrderId $orderId): ?Order;

    /**
     * @param Order $order
     *
     * @return OrderId
     *
     * @throws OrderIdFieldSizeException
     */
    public function add(Order $order): OrderId;

    /**
     * @param OrderId $orderId
     */
    public function remove(OrderId $orderId): void;
}
