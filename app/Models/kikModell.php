<?php namespace App\Models;

use CodeIgniter\Model;


class KikModell extends Model
{
	protected $table = 'belepett';

	/**
	 * @return \CodeIgniter\Database\ResultInterface belepett emberkek
	 * A belepett embereket listázza ki.
	 */
	public function getKik()
	{
		return $this->get();
	}

	/**
	 * @return number A belépett táblában lévő emberkék számát adja meg.
	 */
	public function getBelCount()
	{
		return $this->countAllResults();
	}

	/**
	 * a már belépettek között keresgél név szerint
	 *
	 * @param string $mi a belepo neve
	 * @return  array Visszaadja a belepett nepeket
	 */
	public function get_belepok($mi)
	{
		$builder = $this->db->table($this->table)
			->like('nev', $mi)
			->orderBy('nev')
			->limit(10);
		$query = $builder->get();
		return $query->getResult();
	}

}
