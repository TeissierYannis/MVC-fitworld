<?php

namespace TeissierYannis\Views;

class View_FO_Footer implements Views_interface{

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

        return include '../public/templates/footer.php';
    }

    /**
     * Singleton View_FO_Footer
     * @return View_FO_Footer|null
     */
    public static function getInstance(): View_FO_Footer {

        self::$_instance = is_null(self::$_instance) ? new View_FO_Footer() : self::$_instance;
        return self::$_instance;
    }
}