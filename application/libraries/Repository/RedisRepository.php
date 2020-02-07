<?php

namespace Lib\Repository;

use CI_Cache_redis;
use Lib\Entity\Order\Order;
use Lib\Entity\Order\OrderId;
use Lib\Exception\EmptyOrderInformationException;
use Lib\Exception\EmptyOrderStatusException;
use Lib\Exception\NotFoundOrderIdException;
use Lib\Exception\NotFoundOrderStatusException;
use Lib\Exception\OrderIdFieldSizeException;
use Lib\Factory\OrderFactoryInterface;

class RedisRepository extends Repository
{
    private CI_Cache_redis $redis;
    private OrderFactoryInterface $orderFactory;

    public function __construct(
        OrderFactoryInterface $orderFactory
    )
    {
        $CI =& get_instance();
        $CI->load->driver('cache');

        $this->redis = $CI->cache->redis;
        $this->orderFactory = $orderFactory;
    }

    /**
     * @param OrderId $orderId
     *
     * @return Order|null
     *
     * @throws OrderIdFieldSizeException
     * @throws EmptyOrderInformationException
     * @throws EmptyOrderStatusException
     * @throws NotFoundOrderIdException
     * @throws NotFoundOrderStatusException
     */
    public function getById(OrderId $orderId): ?Order
    {
        $data = $this->redis->get($orderId->getValue());

        if (!$data) {
            return null;
        }

        $orderData = [
            'order_id' => $data['id'],
            'status' => $data['status'],
        ];

        $this->orderFactory->create($orderData);

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
            $this->redis->save($id, $data);
            $orderId = new OrderId($id);
        } else {
            $this->redis->save($orderId->getValue(), $data);
        }

        return $orderId;
    }

    public function remove(OrderId $orderId): void
    {
        @$this->redis->delete($orderId->getValue());
    }
}
