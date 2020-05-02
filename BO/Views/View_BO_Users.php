<?php

namespace TeissierYannis\Views\BO;

class View_BO_Users implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Correspond à la page à afficher
     * @var string
     */
    private string $state;

    private array $datas;

    private function __construct($state, $datas){
        $this->state = $state;
        $this->datas = $datas;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {
        return (@include_once "../public/templates/users/Users_{$this->state}.php") ?
            include_once "../public/templates/users/Users_{$this->state}.php" :
            include_once "../public/templates/users/Users_ViewAll.php";
    }

    /**
     * Singleton View_BO_Users
     * @param string $state
     * @param array $datas
     * @return View_BO_Users|null
     */
    public static function getInstance(string $state, array $datas): View_BO_Users{

        self::$_instance = is_null(self::$_instance) ? new View_BO_Users($state, $datas) : self::$_instance;
        return self::$_instance;
    }
}