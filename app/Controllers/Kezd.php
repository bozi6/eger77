<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\karModell;
use App\Models\kikModell;
use App\Libraries\karszMenu;
use App\Libraries\okoska;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Kezd extends AlapController
{

	/**
	 * A Kezd Controller konstructora
	 * Ellenőrzi a session nyelv változót ha nincs akkor magyar lesz az oldal.
	 *
	 * @param
	 *            null
	 * @return string
	 */
	public function __construct()
	{
		$benchmark = Services::timer();
		$benchmark->getTimers(6);
		$benchmark->start('render view');
		return null;
	}

	/**
	 *
	 * Kezdőoldal megjelenítése + ha nyelvet választunk akkor az is.
	 *
	 * @return null
	 */
	public function index()
	{
		$model = new kikModell();
		$menu = new karszMenu();
		$okos = new okoska();
		$data = [
			'menu' => $menu->show_menu(1),
			'stat' => $model->getbelCount(),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'jsoldal' => 'karszalag'
		];
		echo view('sablonok/header.php', $data);
		echo view('sablonok/logo.php', $data);
		echo view('/kezd/karszalag', $data);
		echo view('sablonok/footer.php', $data);
	}

	/**
	 * Nyelv választás változtató fv.
	 * Átírja a session változóban a kiválasztott nyelvet
	 * ennyi.
	 *
	 * @return null redirect
	 * @var $mi string nyelvet választotta a paraszt.
	 */
	public function ls($mi)
	{
		$_SESSION['site_lang'] = $mi;
		$honnan = $this->request->getServer('HTTP_REFERER');
		return redirect()->to($honnan);
	}

	/**
	 *
	 * @return void formázott lekérdezés MySQLből
	 *
	 *         Ha beírunk valakit akkor ez hívodik meg a kitöltésre.
	 *         A keres.js fileból hivatkozunk rá.
	 */
	public function getAutocomplete()
	{
		$model = new karModell();
		if (isset($_GET['term'])) {
			$result = $model->kereses($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row) {
					if ($row['belepett'] == 1) {
						$row = array_replace($row, ['belepett' => 'Belépett: ' . $row['miko']]);
					} else {
						$row = array_replace($row, ['belepett' => 'Nincs belépve']);
						//$igen = 'Nincs beléptetve.';
					}
					$arr_result[] = $row;
				}
				echo json_encode($arr_result);
				// itt küldtük vissza a cuccokat JSONként
			}
		}
	}

	/**
	 * A belépés gomb a kezdőoldalon.
	 *
	 * @param number POST('sorsz') A belépő sorszáma
	 * @param number POST('befiz') Vett felnőttjegy száma
	 * @param number POST('gybefiz') Vett gyerekjegy száma
	 * @param number POST('megjegy') Megjegyzés
	 * @return RedirectResponse
	 */
	public function belepes()
	{
		helper('url');
		$bel = $this->request->getPost('belepett');
		if ($bel === 'Nincs belépve') {
			$model = new karModell();
			$sorsz = $this->request->getPost('sorsz');
			$befiz = $this->request->getPost('befiz');
			$gybefiz = $this->request->getPost('gybefiz');
			$megjegy = $this->request->getPost('megjegy');
			$res = $model->belepett($sorsz, $befiz, $gybefiz, $megjegy);
			if ($res == true) {
				return redirect()->to('/');
				// Visszairányít a kezdőoldalra, minden egyéb info nélkül.
			} else
				die('Nem sikerült a belépés...');
		} else {
			die('Már belépett.');
		}
	}
	// --------------------------------------------------------------------
}
