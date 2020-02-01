<?php

namespace Model;

use CI_Model;

class OrderModel extends CI_Model
{
    public string $status;

    /**
     * @param int $id
     */
    public function getOrderById(int $id): void
    {
        return $this->db->get('order', array('id' => $id));
    }

    public function updateOrder(array $data, int $id): void
    {
        $this->status = $data['status'];

        $this->db->update('order', $this, array('id' => $id));
    }
}
