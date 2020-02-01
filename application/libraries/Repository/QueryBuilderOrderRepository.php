<?php

namespace Lib\Repository;

use CI_DB_query_builder;
use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Factory\OrderFactory;
use Lib\Factory\OrderFactoryInterface;

class QueryBuilderOrderRepository implements OrderRepositoryInterface
{
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
        $this->db->select('status');
        $this->db->where('id', $orderId->getValue());
        $query = $this->db->get('order');

        return $this->orderFactory->create([$query->result()]);
    }

    /**
     * @inheritDoc
     */
    public function add(Order $order): OrderId
    {
        $orderId = $order->getId();

        $data = [
            'id' => $orderId->getValue(),
            'status'  => $order->getStatus()->getValue(),
        ];

        if ($orderId->getValue()) {
            $this->db->replace('order', $data);
        } else {
            $this->db->insert('order', $data);
            $orderId = new OrderId($this->db->insert_id());
        }

        return $orderId;
    }

    /**
     * @inheritDoc
     */
    public function remove(OrderId $orderId): void
    {
        $this->db->delete('order', ['id' => $orderId->getValue()]);
    }
}
