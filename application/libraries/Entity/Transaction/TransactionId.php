<?php

namespace Lib\Entity\Transaction;

use Lib\Exception\TransactionIdFieldSizeException;

class TransactionId
{
    private const ID_DB_FIELD_SIZE = 16;
    private string $value;

    /**
     * @param string $value
     *
     * @throws TransactionIdFieldSizeException
     */
    public function __construct(string $value)
    {
        if (self::ID_DB_FIELD_SIZE !== strlen($value)) {
            throw new TransactionIdFieldSizeException();
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
