<?php /** @noinspection ALL */

namespace App\Libraries;
/**
 * Class karszMenu
 * @package App\Libraries
 */
class karszMenu
{
    /**
     * @param string $hol
     * @return string
     */
	public function show_menu($hol = 'kezd')
	{
		$nyelv = $_SESSION['site_lang'];
		$gomb = '<a class ="btn btn-success mr-2"';
		$gombdis = '<a class ="btn btn-success mr-2 disabled" ';
		$menu = [
            'kezd' => '<div class="row d-print-none" id="mymenu"><div class="col-sm-12 text-center p-3">',
            '1' => $gomb . ' href="' . base_url() . '"><span class="fas fa-home"> ' . lang('Menu.menuKezd', [], $nyelv) . '</span></a>',
            '2' => $gomb . ' href="' . base_url('belepve/') . '"><span class="fas fa-sign-in-alt"> ' . lang('Menu.menuBelep', [], $nyelv) . '</span></a>',
            '3' => $gomb . ' href="' . base_url('csoportos/') . '"><span class="fas fa-users"> ' . lang('Menu.menuCsop', [], $nyelv) . '</span></a>',
            '4' => $gomb . ' href="' . base_url('stat/') . '"><span class="fas fa-globe-europe"> ' . lang('Menu.menuOssz', [], $nyelv) . '</span></a>',
            '5' => $gomb . ' href="' . base_url('rogton/') . '"><span class="fas fa-ticket-alt"> ' . lang('Menu.menuNow', [], $nyelv) . '</span></a>',
            'veg' => '</div></div>',
        ];
		$menu[$hol] = ltrim($menu[$hol], '<a ' . $gomb);
		$menu[$hol] = $gombdis . $menu[$hol];
		return implode("\n", $menu);
	}
}
