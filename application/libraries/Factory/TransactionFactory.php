<?php

namespace Lib\Factory;

use Lib\Entity\Transaction\Transaction;
use Lib\Entity\Transaction\TransactionId;
use Lib\Entity\Transaction\TransactionOperation;
use Lib\Entity\Transaction\TransactionStatus;
use Lib\Exception\EmptyTransactionIdException;
use Lib\Exception\EmptyTransactionInformationException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;

class TransactionFactory
{
    /**
     * @param array $requestData
     *
     * @return Transaction
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionIdException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     */
    public function create(array $requestData): Transaction
    {
        if (!$requestData) {
            throw new EmptyTransactionInformationException();
        }

        $id = new TransactionId($requestData['id']);
        $operation = new TransactionOperation($requestData['operation']);
        $status = new TransactionStatus($requestData['status']);

        return new Transaction($id, $operation, $status);
    }
}
