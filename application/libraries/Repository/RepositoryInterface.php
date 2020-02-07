<?php

namespace Lib\Repository;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;

interface RepositoryInterface
{
    public function getById(OrderId $orderId): ?Order;

    public function add(Order $order): OrderId;

    public function remove(OrderId $orderId): void;
}
