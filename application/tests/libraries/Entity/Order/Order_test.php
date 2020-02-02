<?php

namespace Tests\libraries\Entity\Order;

use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Entity\Order\OrderStatus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class Order_test extends TestCase
{
    private MockObject $orderId;
    private MockObject $orderStatus;

    protected function setUp(): void
    {
        $this->orderId = $this->createMock(OrderId::class);
        $this->orderId->method('getValue')->willReturn('123');

        $this->orderStatus = $this->createMock(OrderStatus::class);
        $this->orderStatus->method('getValue')->willReturn('ok');
    }

    /**
     * @test
     */
    public function shouldBeConstructable(): void
    {
        $order = new Order($this->orderId, $this->orderStatus);

        $this->assertSame($this->orderId, $order->getId());
    }

    /**
     * @test
     */
    public function shouldBeConvertedToArray(): void
    {
        $order = new Order($this->orderId, $this->orderStatus);
        $array = [
            'id' => $this->orderId->getValue(),
            'status' => $this->orderStatus->getValue(),
        ];

        $this->assertSame($array, $order->toArray());
    }
}
