<?php

namespace Lib\Services;

use Exception;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyTransactionInformationException;
use Lib\Factory\OrderFactory;
use Lib\Factory\TransactionFactory;
use Lib\Repository\QueryBuilderOrderRepository;

class TransactionHandlerService
{
    use Logger;

    private array $request;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        if (!isset($this->request['transaction'])) {
            $exception = new EmptyTransactionInformationException();

            $this->logError($exception->getMessage());
        }

        if (!isset($this->request['order']) || !$this->request['order']) {
            $exception = new EmptyOrderInformationException();

            $this->logError($exception->getMessage());
        }

        $orderFactory = new OrderFactory();
        try {
            $order = $orderFactory->create($this->request['order']);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }

        $repository = new QueryBuilderOrderRepository();
        $orderService = new OrderService($repository, $order);

        $transactionFactory = new TransactionFactory();
        try {
            $transaction = $transactionFactory->create($this->request['transaction']);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }

        if ('fail' === $transaction->getStatus()) {
            $strategy = new FailRedirectStrategy($transaction);
        } else {
            $strategy = new SuccessRedirectStrategy();
        }

        try {
            $orderService->updateOrder();
        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }

        $strategy->redirect();
    }
}
