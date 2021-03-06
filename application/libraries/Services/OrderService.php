<?php

namespace Lib\Services;

use Lib\Entity\Order\Order;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Repository\OrderRepositoryInterface;

class OrderService
{
    private OrderRepositoryInterface $repository;
    private Order $order;

    /**
     * @param OrderRepositoryInterface $repository
     * @param Order $order
     */
    public function __construct(OrderRepositoryInterface $repository, Order $order)
    {
        $this->repository = $repository;
        $this->order = $order;
    }

    /**
     * @throws OrderIdFieldSizeException
     */
    public function updateOrder(): void
    {
        $this->repository->add($this->order);
    }
}
