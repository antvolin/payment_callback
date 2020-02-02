<?php

namespace Lib\Repository;

use CI_DB_query_builder;
use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Factory\OrderFactoryInterface;

class QueryBuilderOrderRepository implements OrderRepositoryInterface
{
    private const TABLE_NAME = 'order';
    private const ID_FIELD_NAME = 'id';
    private const STATUS_FIELD_NAME = 'status';

    private CI_DB_query_builder $db;
    private OrderFactoryInterface $orderFactory;

    /**
     * @param CI_DB_query_builder $queryBuilder
     * @param OrderFactoryInterface $orderFactory
     */
    public function __construct(CI_DB_query_builder $queryBuilder, OrderFactoryInterface $orderFactory)
    {
        $this->db = $queryBuilder;
        $this->orderFactory = $orderFactory;
    }

    /**
     * @inheritDoc
     */
    public function getById(OrderId $orderId): ?Order
    {
        $select = sprintf('%s,%s', self::ID_FIELD_NAME, self::STATUS_FIELD_NAME);

        $this->db->select($select);
        $this->db->where(self::ID_FIELD_NAME, $orderId->getValue());
        $query = $this->db->get(self::TABLE_NAME);
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
     * @inheritDoc
     */
    public function add(Order $order): OrderId
    {
        $orderId = $order->getId();
        $data = $order->toArray();

        if (!$orderId || !$orderId->getValue()) {
            $id = uniqid('id_', false);
            $data = array_merge($data, ['id' => $id]);
            $this->db->insert(self::TABLE_NAME, $data);
            $orderId = new OrderId($id);
        } else {
            $this->db->update(self::TABLE_NAME, $data);
        }

        return $orderId;
    }

    /**
     * @inheritDoc
     */
    public function remove(OrderId $orderId): void
    {
        $data = [self::ID_FIELD_NAME => $orderId->getValue()];
        $this->db->delete(self::TABLE_NAME, $data);
    }
}
