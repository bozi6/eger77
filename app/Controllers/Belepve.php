<?php
declare(strict_types=1);

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
        $fomenu = new karszMenu();
        $jotanacs = new okoska();
        $adatok = [
            'menu' => $fomenu->show_menu(2),
            'kik' => $model->paginate(10, 'gr1'), // a paginationhoz hogy betöltődjön a saját template meg kell adni egy groupot
            'mennyi' => $model->getBelCount(),
            'pager' => $model->pager,
            'nyelv' => $_SESSION['site_lang'],
            'okos' => $jotanacs->okos(),
            'jsoldal' => 'kiaz',
        ];
        echo view('sablonok/header.php', $adatok);
        echo view('sablonok/logo.php', $adatok);
        echo view('/belepve/kiaz', $adatok);
        echo view('sablonok/footer.php', $adatok);
    }

	/**
	 * eddig.php ben az eddig belépett tagok listázása
	 */
	public function getEddig()
    {
        $request = Services::request();
        $model = new kikModell();
        $belepettnev = $request->getVar('nev');
        $result = $model->getBelepok($belepettnev);
        if (count($result) > 0) {
            $szamlalo = 1;
            foreach ($result as $adatok) {
                $arr_result[] = array(
                    'id' => $adatok->Id,
                    'nev' => $adatok->nev,
                    'ceg' => $adatok->ceg,
                    'belepett' => $adatok->miko,
                    'megjegyzes' => $adatok->megjegyzes
                );
                $szamlalo++;
            }
            echo json_encode($arr_result);
		}
	}
}
