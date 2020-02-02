<?php

namespace Lib\Entity\Order;

use Lib\Exception\OrderIdFieldSizeException;

class OrderId
{
    public const ID_DB_FIELD_SIZE = 16;
    private string $value;

    /**
     * @param string $value
     *
     * @throws OrderIdFieldSizeException
     */
    public function __construct(string $value)
    {
        if (self::ID_DB_FIELD_SIZE !== strlen($value)) {
            throw new OrderIdFieldSizeException();
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
