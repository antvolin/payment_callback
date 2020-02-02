<?php

namespace Lib\Entity\Order;

class Order
{
    private ?OrderId $id;
    private OrderStatus $status;

    /**
     * @param OrderId|null $orderId
     * @param OrderStatus $orderStatus
     */
    public function __construct(?OrderId $orderId, OrderStatus $orderStatus)
    {
        $this->id = $orderId;
        $this->status = $orderStatus;
    }

    /**
     * @return OrderId|null
     */
    public function getId(): ?OrderId
    {
        return $this->id;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id ? $this->id->getValue() : null,
            'status' => $this->status->getValue(),
        ];
    }
}
