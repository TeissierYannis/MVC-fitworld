<?php

namespace TeissierYannis\Views\BO;

class View_BO_Footer implements Views_interface{

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

        return include '../public/templates/main/footer.php';
    }

    /**
     * Singleton View_FO_Footer
     * @return View_BO_Footer|null
     */
    public static function getInstance(): View_BO_Footer {

        self::$_instance = is_null(self::$_instance) ? new View_BO_Footer() : self::$_instance;
        return self::$_instance;
    }
}