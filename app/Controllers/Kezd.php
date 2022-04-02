<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\karModell;
use App\Models\kikModell;
use App\Libraries\karszMenu;
use App\Libraries\okoska;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

/**
 *  A kezdő oldali controller
 * ami mindennek a kezete.
 */
class Kezd extends AlapController
{

	/**
	 * A Kezd Controller konstructora
	 * Ellenőrzi a session nyelv változót ha nincs akkor magyar lesz az oldal.
	 *
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
		$fomenu = new karszMenu();
		$jotanacs = new okoska();
		$adatok = [
			'menu' => $fomenu->show_menu(1),
			'stat' => $model->getbelCount(),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $jotanacs->okos(),
			'jsoldal' => 'karszalag'
		];
		echo view('sablonok/header.php', $adatok);
		echo view('sablonok/logo.php', $adatok);
		echo view('/kezd/karszalag', $adatok);
		echo view('sablonok/footer.php', $adatok);
	}

	/**
	 * Nyelv választás változtató fv.
	 * Átírja a session változóban a kiválasztott nyelvet
	 * ennyi.
	 *
	 * @return null redirect
	 * @var string $mi nyelvet választotta a paraszt.
	 *
	public function nyelvvalszt($mi)
	{
		$_SESSION['site_lang'] = $mi;
		$honnan = $this->request->getServer('HTTP_REFERER');
		return redirect()->to($honnan);
	}
*/
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
				foreach ($result as $egysor) {
					if ($egysor['belepett'] == 1) {
						$egysor = array_replace($egysor, ['belepett' => 'Belépett: ' . $egysor['miko']]);
					} else {
						$egysor = array_replace($egysor, ['belepett' => 'Nincs belépve']);
						//$igen = 'Nincs beléptetve.';
					}
					$arr_result[] = $egysor;
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
		$beleptet = $this->request->getPost('belepett');
		if ($beleptet === 'Nincs belépve') {
			$model = new karModell();
			$sorsz = $this->request->getPost('sorsz');
			$befiz = $this->request->getPost('befiz');
			$gybefiz = $this->request->getPost('gybefiz');
			$megjegy = $this->request->getPost('megjegy');
			$eredmeny = $model->belepett($sorsz, $befiz, $gybefiz, $megjegy);
			if ($eredmeny == true) {
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
