<?php

namespace Lib\Entity\Order;

use Lib\Exception\EmptyOrderIdException;

class OrderId
{
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
