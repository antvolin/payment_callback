<?php

namespace Lib\Entity\Order;

use Lib\Exception\EmptyOrderStatusException;

class OrderStatus
{
    public const STATUS_DB_FIELD_SIZE = 10;
    private string $value;

    /**
     * @param string $value
     *
     * @throws EmptyOrderStatusException
     */
    public function __construct(string $value)
    {
        if (!$value) {
            throw new EmptyOrderStatusException();
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
