<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Libraries\karszMenu;
use App\Libraries\okoska;
use App\Models\karModell;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

/**
 * Csopoprtok kezelése
 */
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
        $fomenu = new karszMenu();
        $jotanacs = new okoska();
        $adatok = [
            'menu' => $fomenu->show_menu(3),
            'csoplist' => $model->csoplist(),
            'nyelv' => $_SESSION['site_lang'],
            'okos' => $jotanacs->okos(),
            'jsoldal' => 'csoport',
        ];
        echo view('sablonok/header.php', $adatok);
        echo view('sablonok/logo.php', $adatok);
        echo view('/csoportos/csoport', $adatok);
        echo view('sablonok/footer.php', $adatok);
    }

    /**
     * Csoport lista változásakor
     * Feltölti a lista elemeit. a
     * csoport szonosítójából a nevekkel
     * @param number POST('csid)
     * @return string JSON fromázott válasz
     *         jQuery<-keres.js
     */
    public function csopval(): string
    {
        $model = new karModell();
        $request = Services::request();
        $beleponev = $request->getPost('csid'); // a csid a csoport azonosító amit megkaptunk a keres.js fileból.
        $eredmeny = $model->csopresz($beleponev);
        if (count($eredmeny) > 0) {
            return json_encode($eredmeny);
        }
    }

    /**
     * Csoport belépés frissítése a kiválasztott checkboxok alapján.
     * @return RedirectResponse
     */
    public function csopupdt(): RedirectResponse
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
        $eredmeny = $model->csopbelepes($num);
        if ($eredmeny == true) {
            return redirect()->to('/csoportos/');
        }
    }
}
