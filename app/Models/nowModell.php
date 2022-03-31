<?php
declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


/**
 * Az azonnali hozzáadások modellje
 */
class nowModell extends Model
{

    /**
     * @param $data : hozzáadott emberke adatai
     * @return void: semmit nem adunk vissza
     */
    public function hozzaad($data)
    {
        $this->db->table('karszalagok')
            ->insertBatch($data);
    }
}
