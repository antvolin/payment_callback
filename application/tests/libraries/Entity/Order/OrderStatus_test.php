<?php

namespace Tests\libraries\Entity\Order;

use Lib\Entity\Order\OrderStatus;
use Lib\Exception\OrderStatusFieldSizeException;
use PHPUnit\Framework\TestCase;

class OrderStatus_test extends TestCase
{
    /**
     * @test
     *
     * @throws OrderStatusFieldSizeException
     */
    public function shouldBeConstructable(): void
    {
        $value = '1234567890';
        $orderStatus = new OrderStatus($value);

        $this->assertEquals($value, $orderStatus->getValue());
    }

    /**
     * @test
     *
     * @dataProvider notValidOrderStatusValue
     *
     * @param $value
     *
     * @throws OrderStatusFieldSizeException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(OrderStatusFieldSizeException::class);

        new OrderStatus($value);
    }

    /**
     * @return array
     */
    public function notValidOrderStatusValue(): array
    {
        return [
            [0],
            [''],
            ['dsa'],
            ['dsadnmklqwenldsadnm-123njk123m,.asd'],
            [111],
            [true],
            [false],
        ];
    }
}
