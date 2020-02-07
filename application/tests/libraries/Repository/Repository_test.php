<?php

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Factory\OrderFactory;
use Lib\Repository\Repository;
use Lib\Repository\RepositoryInterface;

class Repository_test extends TestCase
{
    private RepositoryInterface $repository;
    private Order $order;

    /**
     * @throws EmptyOrderInformationException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     */
    protected function setUp(): void
    {
        $orderFactory = new OrderFactory();
        $data = [
            'order_id' => '',
            'status' => '1234567890',
        ];

        $this->order = $orderFactory->create($data);
        $this->repository = Repository::getInstance();
    }

    /**
     * @test
     */
    public function shouldBeConstructable(): void
    {
        $this->assertInstanceOf(RepositoryInterface::class, $this->repository);
    }

    /**
     * @test
     */
    public function orderShouldBeAddable(): void
    {
        $id = $this->repository->add($this->order);
        $order = $this->repository->getById($id);
        $this->repository->remove($id);

        $this->assertEquals($id, $order->getId());
    }

    /**
     * @test
     */
    public function orderShouldBeRemovable(): void
    {
        $id = $this->repository->add($this->order);
        $this->repository->remove($id);
        $order = $this->repository->getById($id);

        $this->assertNull($order);
    }
}
