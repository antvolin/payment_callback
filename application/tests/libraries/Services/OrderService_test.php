<?php

namespace Tests\libraries\Services;

use Lib\Entity\Order\Order;
use Lib\Repository\QueryBuilderRepository;
use Lib\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderService_test extends TestCase
{
    /**
     * @test
     */
    public function workShouldBeDelegatedToRepository(): void
    {
        $order = $this->createMock(Order::class);
        $repository = $this->getMockBuilder(QueryBuilderRepository::class)
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
