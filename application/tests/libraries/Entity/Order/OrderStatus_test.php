<?php

namespace Tests\libraries\Entity\Order;

use Lib\Entity\Order\OrderStatus;
use Lib\Exception\EmptyOrderStatusException;
use PHPUnit\Framework\TestCase;

class OrderStatus_test extends TestCase
{
    /**
     * @test
     *
     * @throws EmptyOrderStatusException
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
     * @throws EmptyOrderStatusException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(EmptyOrderStatusException::class);

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
            [false],
        ];
    }
}
