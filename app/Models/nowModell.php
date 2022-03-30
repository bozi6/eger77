<?php namespace App\Models;

use CodeIgniter\Model;


class nowModell extends Model
{

	/**
	 * @param $belepoNev
	 * @param $belepoTarsulat
	 * @param $megjegyzes
	 * @throws \Exception
	 */
	public function hozzaad($data)
	{
		$builder = $this->db->table('karszalagok')
			->insertBatch($data);
	}
}
