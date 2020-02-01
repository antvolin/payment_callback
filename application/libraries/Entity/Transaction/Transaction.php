<?php

namespace Lib\Entity\Transaction;

class Transaction
{
    private TransactionId $id;
    private TransactionOperation $operation;
    private TransactionStatus $status;

    /**
     * @param TransactionId $transactionId
     * @param TransactionOperation $transactionOperation
     * @param TransactionStatus $transactionStatus
     */
    public function __construct(
        TransactionId $transactionId,
        TransactionOperation $transactionOperation,
        TransactionStatus $transactionStatus
    )
    {
        $this->id = $transactionId;
        $this->operation = $transactionOperation;
        $this->status = $transactionStatus;
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
