<?php

use Lib\Entity\Order\Order;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Exception\OrderStatusFieldSizeException;
use Lib\Factory\OrderFactory;
use Lib\Repository\OrderRepositoryInterface;
use Lib\Repository\QueryBuilderOrderRepository;

class QueryBuilderOrderRepository_test extends TestCase
{
    private OrderRepositoryInterface $repository;
    private Order $order;

    /**
     * @throws EmptyOrderInformationException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     * @throws OrderStatusFieldSizeException
     */
    protected function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->database();

        $orderFactory = new OrderFactory();
        $data = [
            'order_id' => '',
            'status' => '1234567890',
        ];
        $this->order = $orderFactory->create($data);

        $this->repository = new QueryBuilderOrderRepository($this->CI->db, new OrderFactory());
    }

    /**
     * @test
     */
    public function shouldBeConstructable(): void
    {
        $this->assertObjectHasAttribute('queryBuilder', $this->repository);
        $this->assertObjectHasAttribute('orderFactory', $this->repository);
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
    public function orderShouldBeAddable(): void
    {
        $id = $this->repository->add($this->order);
        $orderFromRepository = $this->repository->getById($id);
        $this->repository->remove($id);

        $this->assertEquals($id, $orderFromRepository->getId());
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
    public function orderShouldBeRemovable(): void
    {
        $id = $this->repository->add($this->order);
        $this->repository->remove($id);
        $order = $this->repository->getById($id);

        $this->assertNull($order);
    }
}
