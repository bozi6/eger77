<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ceglista extends Migration
{
    public function up()
    {
    $this->forge->addField(
        [
            'sorszam'   =>  [
                'type'  => 'INT',
                'constraint'    => 11,
                'auto_increment' => true,
            ],
            'cegnev' => [
                'type' => 'VARCHAR',
                'constraint' => 254,
                'collate' => 'utf8_hungarian_ci',
                'comment' => 'Társulatok listája',
            ],
        ]
    );
    }

    public function down()
    {
    $this->forge->dropTable('ceglista');
    }
}
