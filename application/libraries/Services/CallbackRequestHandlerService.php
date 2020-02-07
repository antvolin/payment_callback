<?php

namespace Lib\Services;

use Exception;
use Lib\Entity\Transaction\Transaction;
use Lib\Exception\NotFoundOrderInformationException;
use Lib\Exception\NotFoundRequestDataException;
use Lib\Exception\NotFoundTransactionInformationException;
use Lib\Factory\OrderFactory;
use Lib\Factory\TransactionFactory;
use Lib\Repository\RepositoryInterface;

class CallbackRequestHandlerService
{
    use Logger;

    private array $requestData;
    private RepositoryInterface $repository;

    /**
     * @param array|null $requestData
     * @param RepositoryInterface $repository
     */
    public function __construct(
        ?array $requestData,
        RepositoryInterface $repository
    )
    {
        if (!$requestData) {
            $this->logError(new NotFoundRequestDataException());
        }

        $this->requestData = reset($requestData);
        $this->repository = $repository;
    }

    public function handle(): void
    {
        $this->validateRequestDataParams();
        $this->updateOrder();
        $transaction = $this->createTransaction();
        $this->processingTransaction($transaction);
    }

    private function validateRequestDataParams(): void
    {
        if (!isset($this->requestData['transaction'])) {
            $this->logError(new NotFoundTransactionInformationException());
        }
        if (!isset($this->requestData['order'])) {
            $this->logError(new NotFoundOrderInformationException());
        }
    }

    private function updateOrder(): void
    {
        try {
            $this->createOrderService()->updateOrder();
        } catch (Exception $e) {
            $this->logError($e);
        }
    }

    /**
     * @return OrderService
     */
    private function createOrderService(): OrderService
    {
        $order = null;
        $orderFactory = new OrderFactory();

        try {
            $order = $orderFactory->create($this->requestData['order']);
        } catch (Exception $e) {
            $this->logError($e);
        }

        return new OrderService($this->repository, $order);
    }

    /**
     * @return Transaction
     */
    private function createTransaction(): Transaction
    {
        $transaction = null;

        try {
            $factory = new TransactionFactory();
            $transaction = $factory->create($this->requestData['transaction']);
        } catch (Exception $e) {
            $this->logError($e);
        }

        return $transaction;
    }

    /**
     * @param Transaction $transaction
     */
    private function processingTransaction(Transaction $transaction): void
    {
        if ('fail' === $transaction->getStatus()->getValue()) {
            $strategy = new FailPayStrategy($transaction);
        } else {
            $strategy = new SuccessPayStrategy();
        }

        $strategy->process();
    }
}
