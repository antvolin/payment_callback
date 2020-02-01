<?php

namespace Lib\Factory;

use Lib\Entity\Transaction\Transaction;

class TransactionFactory implements TransactionFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Transaction
    {
        return new Transaction($data);
    }
}
