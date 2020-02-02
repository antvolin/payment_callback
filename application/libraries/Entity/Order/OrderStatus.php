<?php

namespace Lib\Entity\Order;

use Lib\Exception\OrderStatusFieldSizeException;

class OrderStatus
{
    public const STATUS_DB_FIELD_SIZE = 10;
    private string $value;

    /**
     * @param string $value
     *
     * @throws OrderStatusFieldSizeException
     */
    public function __construct(string $value)
    {
        if (self::STATUS_DB_FIELD_SIZE !== strlen($value)) {
            throw new OrderStatusFieldSizeException();
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
