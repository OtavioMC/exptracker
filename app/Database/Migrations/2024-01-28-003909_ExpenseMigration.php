<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExpenseMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'usigned'        => TRUE,
                'auto_increment' => TRUE
            ],
        
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 200
            ],
        
            'operationDate' => [
                'type' => 'DATETIME'
            ],
        
            'value' => [
                'type' => 'DOUBLE'
            ]
        ]);
        
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('expense');
    }

    public function down()
    {
        $this->forge->dropTable("expense", true);
    }
}
