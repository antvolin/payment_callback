<?php

namespace Lib\Entity\Transaction;

use Lib\Exception\EmptyTransactionIdException;

class TransactionId
{
    private string $value;

    /**
     * @param string $value
     *
     * @throws EmptyTransactionIdException
     */
    public function __construct(string $value)
    {
        if (!$value) {
            throw new EmptyTransactionIdException();
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
