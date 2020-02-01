<?php

namespace Lib\Entity\Order;

use Lib\Exception\EmptyOrderIdException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;

class Order
{
    private OrderId $id;
    private OrderStatus $status;

    /**
     * @param array $data
     *
     * @throws EmptyOrderIdException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     */
    public function __construct(array $data)
    {
        if (!isset($data['order_id'])) {
            throw new NotFoundOrderIdException();
        }

        if (!isset($data['status'])) {
            throw new NotFoundOrderStatusException();
        }

        $this->id = new OrderId($data['order_id']);
        $this->status = new OrderStatus($data['status']);
    }

    /**
     * @return OrderStatus
     */
    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    /**
     * @return OrderId
     */
    public function getId(): OrderId
    {
        return $this->id;
    }
}
