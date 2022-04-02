<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CeglistaSeeder extends Seeder
{
public function run()
{
    $data = [
        'sorsz' => '1000',
        'cegnev' => 'Jegyet Izibe Társaság',
    ];
    $this->db->table('karszalagok')->insert($data);
}
}
