<?php

namespace App\Controllers;

use App\Libraries\karszMenu;
use App\Libraries\okoska;
use App\Models\karModell;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Csoportos extends AlapController
{
	public function __construct()
	{
		$benchmark = Services::timer();
		$benchmark->getTimers(6);
		$benchmark->start('render view');
	}

	/**
	 * Csoportos beléptetés lehetővé tévő dolgok összesége
	 *
	 * @return null
	 */
	public function index()
	{
		$model = new karModell();
		$menu = new karszMenu();
		$okos = new okoska();
		$data = [
			'menu' => $menu->show_menu(3),
			'csoplist' => $model->csoplist(),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'jsoldal' => 'csoport',
		];
		echo view('sablonok/header.php', $data);
		echo view('sablonok/logo.php', $data);
		echo view('/csoportos/csoport', $data);
		echo view('sablonok/footer.php', $data);
	}

	/**
	 * Csoport lista változásakor
	 * Feltölti a lista elemeit. a
	 * csoport szonosítójából a nevekkel
	 * @param number POST('csid)
	 * @return string JSON fromázott válasz
	 *         jQuery<-keres.js
	 */
	public function csopval()
	{
		$model = new karModell();
		$request = Services::request();
		$nev = $request->getPost('csid'); // a csid a csoport azonosító amit megkaptunk a keres.js fileból.
		$res = $model->csopresz($nev);
		if (count($res) > 0) {
			return json_encode($res);
		}
	}

	/**
	 * Csoport belépés frissítése a kiválasztott checkboxok alapján.
	 * @param Response POST('fellepo') a csportszámhoz tartozó fellépők
	 * @return RedirectResponse
	 */
	public function csopupdt()
	{
		$model = new karModell();
		$request = Services::request();
		$fellepo = $request->getPost('fellepo');
		$model->csoptagbelep($fellepo);
		return redirect()->to('/csoportos/');
	}

	/**
	 * A megadott csoportot belépteti
	 * @param number $num a belépő csoport száma
	 * @return RedirectResponse
	 * Visszairányít az érkező oldalara
	 */
	public function csopbel($num)
	{
		$model = new karModell();
		$res = $model->csopbelepes($num);
		if ($res == true) {
			return redirect()->to('/csoportos/');
		}
	}
}
