<?php

namespace Lib\Factory;

use Lib\Entity\Transaction\Transaction;
use Lib\Entity\Transaction\TransactionId;
use Lib\Entity\Transaction\TransactionOperation;
use Lib\Entity\Transaction\TransactionStatus;
use Lib\Exception\EmptyTransactionInformationException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;
use Lib\Exception\NotFoundTransactionIdException;
use Lib\Exception\NotFoundTransactionOperationException;
use Lib\Exception\NotFoundTransactionStatusException;
use Lib\Exception\TransactionIdFieldSizeException;

class TransactionFactory
{
    /**
     * @param array $requestData
     *
     * @return Transaction
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function create(array $requestData): Transaction
    {
        if (!$requestData) {
            throw new EmptyTransactionInformationException();
        }
        if (!isset($requestData['id'])) {
            throw new NotFoundTransactionIdException();
        }
        if (!isset($requestData['status'])) {
            throw new NotFoundTransactionStatusException();
        }
        if (!isset($requestData['operation'])) {
            throw new NotFoundTransactionOperationException();
        }

        $id = new TransactionId($requestData['id']);
        $operation = new TransactionOperation($requestData['operation']);
        $status = new TransactionStatus($requestData['status']);

        return new Transaction($id, $operation, $status);
    }
}
