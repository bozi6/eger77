<?php

namespace App\Controllers;

use App\Libraries\karszMenu;
use App\Libraries\okoska;
use App\Models\kikModell;
use Config\Services;


/**
 * Class Belepve
 * @package App\Controllers
 * A belépett emberkéket mutatja
 */
class Belepve extends AlapController
{
	public function __construct()
	{
		$benchmark = Services::timer();
		$benchmark->getTimers(6);
		$benchmark->start('render view');
	}

	public function index()
	{
		/**
		 * Eddig belépett emberkék listázása
		 *
		 * @return null
		 */
		$model = new kikModell();
		$menu = new karszMenu();
		$okos = new okoska();
		$data = [
			'menu' => $menu->show_menu(2),
			'kik' => $model->paginate(10, 'gr1'), // a paginationhoz hogy betöltődjön a saját template meg kell adni egy groupot
			'mennyi' => $model->getBelCount(),
			'pager' => $model->pager,
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'jsoldal' => 'kiaz',
		];
		echo view('sablonok/header.php', $data);
		echo view('sablonok/logo.php', $data);
		echo view('/belepve/kiaz', $data);
		echo view('sablonok/footer.php', $data);
	}

	/**
	 * eddig.php ben az eddig belépett tagok listázása
	 */
	public function getEddig()
	{
		$request = Services::request();
		$model = new kikModell();
		$nev = $request->getVar('nev');
		$result = $model->get_belepok($nev);
		if (count($result) > 0) {
			$i = 1;
			foreach ($result as $row) {
				$arr_result[] = array(
					'id' => $row->Id,
					'nev' => $row->nev,
					'ceg' => $row->ceg,
					'belepett' => $row->miko,
					'megjegyzes' => $row->megjegyzes
				);
				$i++;
			}
			echo json_encode($arr_result);
		}
	}
}
