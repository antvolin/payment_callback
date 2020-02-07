<?php

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Entity\Order\OrderStatus;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Repository\Repository;
use Lib\Repository\RepositoryInterface;

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
     */
    public function callbackMethodShouldBeProcessedTheRequestIfOrderStatusSuccess(): void
    {
        $repository = $this->getRepository();
        $repository->add($this->orderFail);

        $this->request('POST', '/api/callback', [$this->buildSuccessRequestParam()]);
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
     */
    public function callbackMethodShouldBeProcessedTheRequestIfOrderStatusFail(): void
    {
        $repository = $this->getRepository();
        $repository->add($this->orderSuccess);

        $this->request('POST', '/api/callback', [$this->buildFailRequestParam()]);
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
     * @return RepositoryInterface
     */
    private function getRepository(): RepositoryInterface
    {
        return Repository::getInstance();
    }

    /**
     * @return array
     */
    private function buildSuccessRequestParam(): array
    {
        return [
            'transaction' => [
                'id' => $this->orderId->getValue(),
                'operation' => 'pay',
                'status' => $this->statusSuccess->getValue(),
            ],
            'order' => [
                'order_id' => $this->orderId->getValue(),
                'status' => $this->statusSuccess->getValue(),
            ],
        ];
    }

    /**
     * @return array
     */
    private function buildFailRequestParam(): array
    {
        return [
            'transaction' => [
                'id' => $this->orderId->getValue(),
                'operation' => 'pay',
                'status' => $this->statusFail->getValue(),
            ],
            'order' => [
                'order_id' => $this->orderId->getValue(),
                'status' => $this->statusFail->getValue(),
            ],
        ];
    }
}
