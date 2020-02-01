<?php

namespace Lib\Entity\Order;

class Order
{
    private OrderId $id;
    private OrderStatus $status;

    /**
     * @param OrderId $orderId
     * @param OrderStatus $orderStatus
     */
    public function __construct(OrderId $orderId, OrderStatus $orderStatus)
    {
        $this->id = $orderId;
        $this->status = $orderStatus;
    }

    /**
     * @return OrderId
     */
    public function getId(): OrderId
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'status' => $this->status->getValue(),
        ];
    }
}
