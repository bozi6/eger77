<?php
declare(strict_types=1);

namespace App\Controllers;


/**
 * Nyelvek átváltása
 */
class Langsw extends AlapController
{
    /**
     * @param string A bejövő nyelv kódja (hu,en,de,ar)
     * @return \CodeIgniter\HTTP\RedirectResponse Visszairányít a küldő oldalra.
     */
    function switchlang($lang)
    {
        $session = \Config\Services::Session();
        //$lang = ($lang != "") ? $lang : "hu";
        $session->set('site_lang', $lang);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}
