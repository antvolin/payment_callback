<?php

namespace Lib\Repository;

use CI_DB_query_builder;
use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Factory\OrderFactoryInterface;

class QueryBuilderRepository extends Repository
{
    private const TABLE_NAME = 'order';
    private const ID_FIELD_NAME = 'id';
    private const STATUS_FIELD_NAME = 'status';

    private CI_DB_query_builder $queryBuilder;
    private OrderFactoryInterface $orderFactory;

    public function __construct(
        CI_DB_query_builder $queryBuilder,
        OrderFactoryInterface $orderFactory
    )
    {
        $this->queryBuilder = $queryBuilder;
        $this->orderFactory = $orderFactory;
    }

    /**
     * @param OrderId $orderId
     *
     * @return Order|null
     *
     * @throws EmptyOrderInformationException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     * @throws OrderIdFieldSizeException
     */
    public function getById(OrderId $orderId): ?Order
    {
        $select = sprintf('%s,%s', self::ID_FIELD_NAME, self::STATUS_FIELD_NAME);
        $this->queryBuilder->select($select);
        $this->queryBuilder->where(self::ID_FIELD_NAME, $orderId->getValue());
        $query = $this->queryBuilder->get(self::TABLE_NAME);
        $result = $query->first_row();

        if (!$result) {
            return null;
        }

        $orderData = [
            'order_id' => $result->id,
            'status' => $result->status,
        ];

        return $this->orderFactory->create($orderData);
    }

    /**
     * @param Order $order
     *
     * @return OrderId
     *
     * @throws OrderIdFieldSizeException
     */
    public function add(Order $order): OrderId
    {
        $orderId = $order->getId();
        $data = $order->toArray();

        if (!$orderId) {
            $id = $this->generateId();
            $data = array_merge($data, ['id' => $id]);
            $this->queryBuilder->insert(self::TABLE_NAME, $data);
            $orderId = new OrderId($id);
        } else {
            $this->queryBuilder->where('id', $orderId->getValue());
            $this->queryBuilder->update(self::TABLE_NAME, $data);
        }

        return $orderId;
    }

    public function remove(OrderId $orderId): void
    {
        $data = [self::ID_FIELD_NAME => $orderId->getValue()];
        $this->queryBuilder->delete(self::TABLE_NAME, $data);
    }
}
