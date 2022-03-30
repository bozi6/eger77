<?php

namespace App\Controllers;

use App\Libraries\karszMenu;
use App\Libraries\okoska;
use App\Models\statModell;
use Config\Services;

/**
 * Class Stat
 * @package App\Controllers
 */
class Stat extends AlapController
{
	/**
	 * Különböző statisztikák összegyűjtése,
	 * hogy az Egér is boldog legyen.
	 *
	 * @return null
	 */
	public function __construct()
	{
		$benchmark = Services::timer();
		$benchmark->getTimers(6);
		$benchmark->start('render view');
	}

	public function index()
	{
		$model = new statModell();
		$menu = new karszMenu();
		$okos = new okoska();
		$data = [
			'menu' => $menu->show_menu(4),
			'belepettek' => $model->getbelCount(),
			'mindenki' => $model->mindCount(),
			//'dupla' => $model->dupla(),
			'dupla' => $model->duplareszlet(),
			'nyelv' => $_SESSION['site_lang'],
			'okos' => $okos->okos(),
			'nembe' => $model->mindCount() - $model->getbelCount(),
			'jsoldal' => 'stat',
		];
		echo view('sablonok/header.php', $data);
		echo view('sablonok/logo.php', $data);
		echo view('/stat/stat.html', $data);
		echo view('sablonok/footer.php', $data);
	}


}
