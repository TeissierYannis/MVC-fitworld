<?php

namespace TeissierYannis\Views\BO;

class View_BO_Menu implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private function __construct(){}

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string{

        return include '../public/templates/main/menu.php';
    }

    /**
     * Singleton View_BO_Menu
     * @return View_BO_Menu|null
     */
    public static function getInstance(): View_BO_Menu {

        self::$_instance = is_null(self::$_instance) ? new View_BO_Menu() : self::$_instance;
        return self::$_instance;
    }
}