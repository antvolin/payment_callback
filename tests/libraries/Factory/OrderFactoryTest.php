<?php

namespace Tests\libraries\Factory;

use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Exception\OrderStatusFieldSizeException;
use Lib\Factory\OrderFactory;
use PHPUnit\Framework\TestCase;

class OrderFactoryTest extends TestCase
{
    /**
     * @test
     *
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     * @throws OrderStatusFieldSizeException
     */
    public function shouldBeCreatableOrder(): void
    {
        $factory = new OrderFactory();
        $data = [
            'order_id' => '1234567890123456',
            'status' => '1234567890'
        ];
        $order = $factory->create($data);

        $this->assertObjectHasAttribute('id', $order);
        $this->assertObjectHasAttribute('status', $order);
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
    public function shouldBeNotCreatableOrderWithEmptyData(): void
    {
        $this->expectException(EmptyOrderInformationException::class);

        $factory = new OrderFactory();
        $data = [];
        $factory->create($data);
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
    public function shouldBeNotCreatableOrderWithEmptyOrderId(): void
    {
        $this->expectException(NotFoundOrderIdException::class);

        $factory = new OrderFactory();
        $data = ['asd'];
        $factory->create($data);
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
    public function shouldBeNotCreatableOrderWithEmptyOrderStatus(): void
    {
        $this->expectException(NotFoundOrderStatusException::class);

        $factory = new OrderFactory();
        $data = ['order_id' => 'asd'];
        $factory->create($data);
    }
}
