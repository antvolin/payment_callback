<?php

namespace Lib\Entity\Transaction;

use Lib\Exception\EmptyTransactionStatusException;

class TransactionStatus
{
    private string $value;

    /**
     * @param string $value
     *
     * @throws EmptyTransactionStatusException
     */
    public function __construct(string $value)
    {
        if (!$value) {
            throw new EmptyTransactionStatusException();
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
