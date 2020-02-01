<?php

namespace Lib\Repository;

use CI_DB_query_builder;
use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Factory\OrderFactory;
use Lib\Factory\OrderFactoryInterface;

class QueryBuilderOrderRepository implements OrderRepositoryInterface
{
    private const TABLE_NAME = 'order';
    private const ID_FIELD_NAME = 'id';
    private const STATUS_FIELD_NAME = 'status';

    private CI_DB_query_builder $db;
    private OrderFactoryInterface $orderFactory;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->database();
        $this->db = $CI->db;
        $this->orderFactory = new OrderFactory();
    }

    /**
     * @inheritDoc
     */
    public function getById(OrderId $orderId): Order
    {
        $this->db->select(self::STATUS_FIELD_NAME);
        $this->db->where(self::ID_FIELD_NAME, $orderId->getValue());
        $query = $this->db->get(self::TABLE_NAME);

        return $this->orderFactory->create([$query->result()]);
    }

    /**
     * @inheritDoc
     */
    public function add(Order $order): OrderId
    {
        $orderId = $order->getId();
        $data = $order->toArray();

        if ($orderId->getValue()) {
            $this->db->update(self::TABLE_NAME, $data);
        } else {
            $this->db->insert(self::TABLE_NAME, $data);
            $orderId = new OrderId($this->db->insert_id());
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
