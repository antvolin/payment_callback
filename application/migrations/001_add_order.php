<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Entity\Order\OrderId;
use Lib\Entity\Order\OrderStatus;

class Migration_Add_order extends CI_Migration
{
    public function up(): void
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => OrderId::ID_DB_FIELD_SIZE,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => OrderStatus::STATUS_DB_FIELD_SIZE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('order');
    }

    public function down(): void
    {
        $this->dbforge->drop_table('order');
    }
}
