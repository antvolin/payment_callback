<?php

namespace Lib\Entity\Transaction;

use Lib\Exception\EmptyTransactionIdException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;

class Transaction
{
    private TransactionId $id;
    private TransactionOperation $operation;
    private TransactionStatus $status;

    /**
     * @param array $requestData
     *
     * @throws EmptyTransactionIdException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     */
    public function __construct(array $requestData)
    {
        $this->id = new TransactionId($requestData['id']);
        $this->operation = new TransactionOperation($requestData['operation']);
        $this->status = new TransactionStatus($requestData['status']);
    }

    /**
     * @return TransactionId
     */
    public function getId(): TransactionId
    {
        return $this->id;
    }

    /**
     * @return TransactionOperation
     */
    public function getOperation(): TransactionOperation
    {
        return $this->operation;
    }

    /**
     * @return TransactionStatus
     */
    public function getStatus(): TransactionStatus
    {
        return $this->status;
    }
}
