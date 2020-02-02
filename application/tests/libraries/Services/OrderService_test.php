<?php

namespace Tests\libraries\Services;

use Lib\Entity\Order\Order;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Repository\QueryBuilderOrderRepository;
use Lib\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderService_test extends TestCase
{
    /**
     * @test
     *
     * @throws OrderIdFieldSizeException
     */
    public function workShouldBeDelegatedToRepository(): void
    {
        $order = $this->createMock(Order::class);
        $repository = $this->getMockBuilder(QueryBuilderOrderRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['add'])
            ->getMock();
        $repository->expects($this->once())
            ->method('add')
            ->with($this->equalTo($order));

        $orderService = new OrderService($repository, $order);
        $orderService->updateOrder();
    }
}
