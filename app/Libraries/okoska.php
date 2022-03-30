<?php

namespace App\Libraries;
class okoska
{
	/**
	 * Random bölcsességek kimeríthetelen tárháza.
	 * :-)
	 *
	 * @return string A fileból egy véletlen sort add vissza.
	 */
	public function okos()
	{
		$f_contents = file('./assets/fortune.txt');
		return $f_contents[array_rand($f_contents)];
	}
}
