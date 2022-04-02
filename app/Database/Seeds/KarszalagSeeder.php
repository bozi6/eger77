<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KarszalagSeeder extends Seeder
{
public function run()
{
    $data = [
        'sorsz' => 'NULL',
        'cegnev' => '1000',
        'nev' => 'Kis Pista',
        'szul_datum' => '1986-01-23',
        'besorolas' => 'Fellépő',
        'programresz' => 'Tánctanítás',
        'megjegyzes' => 'Teszt seeding adat.',
        'belepett' => '1',
    ];
    $this->db->table('karszalagok')->insert($data);
}
}
