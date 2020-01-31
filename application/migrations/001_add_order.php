<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('order');
    }

    public function down()
    {
        $this->dbforge->drop_table('order');
    }
}
