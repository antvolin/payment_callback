<?php

namespace Lib\Entity\Order;

use Lib\Exception\EmptyOrderIdException;

class OrderId
{
    public const ID_DB_FIELD_SIZE = 16;
    private string $value;

    /**
     * @param string $value
     *
     * @throws EmptyOrderIdException
     */
    public function __construct(string $value)
    {
        if (!$value) {
            throw new EmptyOrderIdException();
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
