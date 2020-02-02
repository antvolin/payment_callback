<?php

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Entity\Order\OrderStatus;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Exception\OrderStatusFieldSizeException;
use Lib\Factory\OrderFactory;
use Lib\Repository\QueryBuilderOrderRepository;

class Api_test extends TestCase
{
    private OrderId $orderId;
    private OrderStatus $statusFail;
    private OrderStatus $statusSuccess;
    private Order $orderFail;
    private Order $orderSuccess;

    /**
     * @throws EmptyOrderStatusException
     * @throws OrderIdFieldSizeException
     */
    protected function setUp(): void
    {
        $this->orderId = new OrderId('1234567890123456');
        $this->statusFail = new OrderStatus('fail');
        $this->statusSuccess = new OrderStatus('success');
        $this->orderFail = new Order($this->orderId, $this->statusFail);
        $this->orderSuccess = new Order($this->orderId, $this->statusSuccess);
    }

    /**
     * @test
     *
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     * @throws OrderStatusFieldSizeException
     */
    public function callbackMethodShouldBeProcessedTheRequestIfOrderStatusSuccess(): void
    {
        $repository = $this->getRepository();
        $repository->add($this->orderFail);

        $this->request('POST', '/api/callback', ['requestData' => $this->buildSuccessRequestParam()]);
        $status = $this->request->getStatus();

        $this->assertEquals(302, $status['code']);
        $this->assertEquals('Redirect to /index.php/page/thank_you', $status['redirect']);

        $repository = $this->getRepository();
        $order = $repository->getById($this->orderId);

        $this->assertEquals($this->orderId->getValue(), $order->getId()->getValue());
        $this->assertEquals($this->statusSuccess->getValue(), $order->getStatus()->getValue());

        $output = $this->request('GET', '/page/thank_you');

        $this->assertStringContainsString('<h1>Congratulation, the transaction success!</h1>', $output);
        $this->assertStringContainsString('<p>Operation completed successfully!</p>', $output);
    }

    /**
     * @test
     *
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     * @throws OrderStatusFieldSizeException
     */
    public function callbackMethodShouldBeProcessedTheRequestIfOrderStatusFail(): void
    {
        $repository = $this->getRepository();
        $repository->add($this->orderSuccess);

        $this->request('POST', '/api/callback', ['requestData' => $this->buildFailRequestParam()]);
        $status = $this->request->getStatus();

        $this->assertEquals(302, $status['code']);
        $this->assertEquals('Redirect to /index.php/page/sorry', $status['redirect']);

        $repository = $this->getRepository();
        $order = $repository->getById($this->orderId);

        $this->assertEquals($this->orderId->getValue(), $order->getId()->getValue());
        $this->assertEquals($this->statusFail->getValue(), $order->getStatus()->getValue());

        $output = $this->request('GET', '/page/sorry');

        $this->assertStringContainsString('<p>Transaction #:'.$this->orderId->getValue().'</p>', $output);
        $this->assertStringContainsString('<p>Transaction status:'.$this->statusFail->getValue().'</p>', $output);
    }

    /**
     * @return QueryBuilderOrderRepository
     */
    private function getRepository(): QueryBuilderOrderRepository
    {
        $this->resetInstance();
        $queryBuilder = $this->CI->db;

        return new QueryBuilderOrderRepository($queryBuilder, new OrderFactory());
    }

    /**
     * @return string
     */
    private function buildSuccessRequestParam(): string
    {
        return sprintf(
            '{"transaction":{"id":"%s","operation":"pay","status":"%s"},"order":{"order_id":"%s","status":"%s"}}',
            $this->orderId->getValue(),
            $this->statusSuccess->getValue(),
            $this->orderId->getValue(),
            $this->statusSuccess->getValue()
        );
    }

    /**
     * @return string
     */
    private function buildFailRequestParam(): string
    {
        return sprintf(
            '{"transaction":{"id":"%s","operation":"pay","status":"%s"},"order":{"order_id":"%s","status":"%s"}}',
            $this->orderId->getValue(),
            $this->statusFail->getValue(),
            $this->orderId->getValue(),
            $this->statusFail->getValue()
        );
    }
}
