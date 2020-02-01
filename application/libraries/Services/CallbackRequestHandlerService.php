<?php

namespace Lib\Services;

use Exception;
use JsonException;
use Lib\Entity\Transaction\Transaction;
use Lib\Exception\EmptyRequestDataException;
use Lib\Exception\EncodingRequestDataException;
use Lib\Exception\NotFoundOrderInformationException;
use Lib\Exception\NotFoundTransactionInformationException;
use Lib\Factory\OrderFactory;
use Lib\Factory\TransactionFactory;
use Lib\Repository\QueryBuilderOrderRepository;

class CallbackRequestHandlerService
{
    use Logger;

    private string $requestData;

    /**
     * @param string $requestData
     */
    public function __construct(string $requestData)
    {
        $this->requestData = $requestData;
    }

    public function handle(): void
    {
        $requestData = $this->getRequestData();
        $this->validateRequestDataParams($requestData);
        $this->updateOrder($requestData);

        $transaction = $this->createTransaction($requestData);
        if ('fail' === $transaction->getStatus()->getValue()) {
            $strategy = new FailPayStrategy($transaction);
        } else {
            $strategy = new SuccessPayStrategy();
        }

        $strategy->process();
    }

    /**
     * @return array
     */
    private function getRequestData(): array
    {
        $request = [];

        if (!$this->requestData) {
            $this->logError(new EmptyRequestDataException());
        }

        try {
            /* if the response from the gateway will change in the future,
            then it is necessary to encapsulate the request in a separate object */
            $request = json_decode($this->requestData, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $this->logError(new EncodingRequestDataException($e->getMessage()));
        }

        return $request;
    }

    /**
     * @param array $request
     */
    private function validateRequestDataParams(array $request): void
    {
        if (!isset($request['transaction'])) {
            $this->logError(new NotFoundTransactionInformationException());
        }
        if (!isset($request['order'])) {
            $this->logError(new NotFoundOrderInformationException());
        }
    }

    /**
     * @param array $requestData
     */
    private function updateOrder(array $requestData): void
    {
        try {
            $this->createOrderService($requestData)->updateOrder();
        } catch (Exception $e) {
            $this->logError($e);
        }
    }

    /**
     * @param array $request
     *
     * @return OrderService
     */
    private function createOrderService(array $request): OrderService
    {
        $order = null;

        try {
            $order = (new OrderFactory())->create($request['order']);
        } catch (Exception $e) {
            $this->logError($e);
        }

        return new OrderService(new QueryBuilderOrderRepository(), $order);
    }

    /**
     * @param array $request
     *
     * @return Transaction
     */
    private function createTransaction(array $request): Transaction
    {
        $transaction = null;

        try {
            $transaction = (new TransactionFactory())->create($request['transaction']);
        } catch (Exception $e) {
            $this->logError($e);
        }

        return $transaction;
    }
}
