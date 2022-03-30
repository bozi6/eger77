<?php namespace App\Models;

use CodeIgniter\Model;


/**
 * Class statModell
 * @package App\Models
 */
class statModell extends Model
{

	/**
	 * @return number A belépett táblában lévő emberkék számát adja meg.
	 */
	public function getBelCount()
	{
		return $this->db->table('belepett')->countAllResults();
	}

	/**
	 * @return mixed statisztikak visszaadása
	 */
	public function mindCount()
	{
		return $this->db->table('mindenki')->countAll();
	}

	/**
     * Dupla bejegyzések megjelenítése
     *
     * @param null bemenet nincs
     * @return array a duplikált bejegyzések listája
     */
    /**    public function dupla()
     * {
     * // ide a duplikált táblának ezt kéne tartalmaznia:
     * // select count(*) db, nev from karszalagok group by nev having db > 1 order by db;
     * // és 168 az eredmény.
     * //    $this->table = 'duplikalt';
     * $bldr = $this->db->table('duplikalt')->get();
     * return $bldr->getResult();
     * }
     */
    /**
	 * @return array|mixed
	 */
	public function duplareszlet()
	{
		/*$bldr = $this->db->table('karszalagok')
			->select('karszalagok.sorsz,karszalagok.nev,karszalagok.szul_datum,karszalagok.programresz')
			->join('duplikalt', 'duplikalt.nev = karszalagok.nev')
			->orderBy('karszalagok.nev', 'ASC')
			->get();
		return $bldr->getResult();*/
		$bldr = $this->db->table('azonos_nevuek')->get();
		return $bldr->getResult();
	}
}
