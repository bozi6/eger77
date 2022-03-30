<?php

namespace App\Controllers;

use App\Libraries\karszMenu;
use App\Libraries\okoska;
use App\Models\nowModell;
use App\Models\karModell;
use Config\Services;

/**
 * Class Rogton
 * @package App\Controllers
 * Azonnali karszalagkéréseknek tesz eleget.
 */
class Rogton extends AlapController
{
	public function __construct()
	{
		$benchmark = Services::timer();
		$benchmark->getTimers(6);
		$benchmark->start('render view');
	}

	/**
	 * Ha hirtelen kell sok jegy, mert a főnök azt mondja akkor ez jön be.
	 *
	 */
	public function index()
	{
		$csopmod = new karModell();
		$menu = new karszMenu();
		$okos = new okoska();
		$data = [
			'csoplist' => $csopmod->csoplist(),
			'menu' => $menu->show_menu(5),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'jsoldal' => 'rogton',
			'kesz' => '&nbsp;',
		];

		echo view('sablonok/header.php', $data);
		echo view('sablonok/logo.php', $data);
		echo view('/rogton/rogton', $data);
		echo view('sablonok/footer.php', $data);
	}

	public function belepes()
	{
		$csopmod = new karModell();
		$model = new nowModell();
		$okos = new okoska();
		$menu = new karszMenu(5);
		$nev = $this->request->getPost('nev');
		$karsznum = $this->request->getPost('karsznum');
		$tarsulat = $this->request->getPost('csoportok');
		$megjegy = $this->request->getPost('megjegy');
		if ($nev === "") {
			$nev = 'Ismeretlen Szereplő';
		}
		if ($karsznum === "") {
			$karsznum = 1;
		}
		if ($tarsulat === "") {
			$tarsulat = 1000;
		}
		$data = [];
		for ($i = 1; $i <= $karsznum; $i++) {
			$data[$i] = [
				'cegnev' => $tarsulat,
				'nev' => $nev,
				'megjegyzes' => $megjegy,
				'belepett' => 1,
				'miko' => date('Y-m-d H:i:s'),
			];
		}
		//d($data);
		$adatok = [
			'csoplist' => $csopmod->csoplist(),
			'menu' => $menu->show_menu(5),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'jsoldal' => 'rogton',
		];
		if ($model->hozzaad($data) === null)
		{
			$adatok['kesz'] = 'Sikerült a belépés!';
		}
		else
			$adatok['kesz'] = 'Gebaßierung van!';
		echo view('sablonok/header.php', $adatok);
		echo view('sablonok/logo.php', $adatok);
		echo view('/rogton/rogton', $adatok);
		echo view('sablonok/footer.php', $adatok);
	}
}
