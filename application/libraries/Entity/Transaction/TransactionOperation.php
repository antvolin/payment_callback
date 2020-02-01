<?php

namespace Lib\Entity\Transaction;

use Lib\Exception\EmptyTransactionOperationException;

class TransactionOperation
{
    private string $value;

    /**
     * @param string $value
     *
     * @throws EmptyTransactionOperationException
     */
    public function __construct(string $value)
    {
        if (!$value) {
            throw new EmptyTransactionOperationException();
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
