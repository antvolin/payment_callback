<?php

namespace Tests\libraries\Entity\Order;

use Lib\Entity\Order\OrderId;
use Lib\Exception\OrderIdFieldSizeException;
use PHPUnit\Framework\TestCase;

class OrderId_test extends TestCase
{
    /**
     * @test
     *
     * @throws OrderIdFieldSizeException
     */
    public function shouldBeConstructable(): void
    {
        $value = '1234567890123456';
        $orderId = new OrderId($value);

        $this->assertEquals($value, $orderId->getValue());
    }

    /**
     * @test
     *
     * @dataProvider notValidOrderIdValue
     *
     * @param $value
     *
     * @throws OrderIdFieldSizeException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(OrderIdFieldSizeException::class);

        new OrderId($value);
    }

    /**
     * @return array
     */
    public function notValidOrderIdValue(): array
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
