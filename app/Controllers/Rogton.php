<?php
declare(strict_types=1);

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
        $fomenu = new karszMenu();
        $jotanacs = new okoska();
        $adatok = [
            'csoplist' => $csopmod->csoplist(),
            'menu' => $fomenu->show_menu(5),
            'nyelv' => $_SESSION['site_lang'],
            'okos' => $jotanacs->okos(),
            'jsoldal' => 'rogton',
            'kesz' => '&nbsp;',
        ];

        echo view('sablonok/header.php', $adatok);
        echo view('sablonok/logo.php', $adatok);
        echo view('/rogton/rogton', $adatok);
        echo view('sablonok/footer.php', $adatok);
    }

	public function belepes()
    {
        $csopmod = new karModell();
        $model = new nowModell();
        $jotanacs = new okoska();
        $fomenu = new karszMenu(5);
        $belepnev = $this->request->getPost('nev');
        $karsznum = $this->request->getPost('karsznum');
        $gykarsznum = $this->request->getPost('karszgynum');
        $tarsulat = $this->request->getPost('csoportok');
        $megjegy = $this->request->getPost('megjegy');
        if ($belepnev === "") {
            $belepnev = 'Ismeretlen Szereplő';
        }
        if ($karsznum === "") {
            $karsznum = 1;
        }
        if ($tarsulat === "") {
            $tarsulat = 1000;
        }
        $beadatok = [];
        $beadatok[0] = [
            'cegnev' => $tarsulat,
            'nev' => $belepnev,
            'megjegyzes' => $megjegy,
            'belepett' => 1,
            'miko' => date('Y-m-d H:i:s'),
            'szdarab' => $karsznum,
            'gyszdarab' => $gykarsznum,
        ];
        //d($data);
        $oldaladatok = [
            'csoplist' => $csopmod->csoplist(),
            'menu' => $fomenu->show_menu(5),
            'nyelv' => $_SESSION['site_lang'],
            'okos' => $jotanacs->okos(),
            'jsoldal' => 'rogton',
        ];
        if ($model->hozzaad($beadatok) === null) {
            $oldaladatok['kesz'] = 'Sikerült a belépés!';
        } else
            $oldaladatok['kesz'] = 'Gebaßierung van!';
        echo view('sablonok/header.php', $oldaladatok);
        echo view('sablonok/logo.php', $oldaladatok);
        echo view('/rogton/rogton', $oldaladatok);
        echo view('sablonok/footer.php', $oldaladatok);
    }
}
