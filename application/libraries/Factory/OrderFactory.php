<?php

namespace Lib\Factory;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Entity\Order\OrderStatus;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;

class OrderFactory implements OrderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Order
    {
        if (!$data) {
            throw new EmptyOrderInformationException();
        }
        if (!isset($data['order_id'])) {
            throw new NotFoundOrderIdException();
        }
        if (!isset($data['status'])) {
            throw new NotFoundOrderStatusException();
        }

        $id = $data['order_id'];
        $orderId = $id ? new OrderId($id) : null;
        $orderStatus = new OrderStatus($data['status']);

        return new Order($orderId, $orderStatus);
    }
}
