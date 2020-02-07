<?php

namespace Lib\Services;

use Lib\Entity\Order\Order;
use Lib\Repository\RepositoryInterface;

class OrderService
{
    private RepositoryInterface $repository;
    private Order $order;

    public function __construct(RepositoryInterface $repository, Order $order)
    {
        $this->repository = $repository;
        $this->order = $order;
    }

    public function updateOrder(): void
    {
        $this->repository->add($this->order);
    }
}
