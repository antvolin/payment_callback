<?php

namespace Lib\Factory;

use Lib\Entity\Transaction\Transaction;
use Lib\Exception\EmptyTransactionIdException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;

interface TransactionFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Transaction
     *
     * @throws EmptyTransactionIdException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     */
    public function create(array $data): Transaction;
}
