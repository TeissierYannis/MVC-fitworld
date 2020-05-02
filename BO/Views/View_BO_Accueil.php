<?php

namespace TeissierYannis\Views\BO;

class View_BO_Accueil implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private array $transactions;
    private int $userCount;
    private int $subscribeCount;

    private function __construct($datas){

        $this->transactions = $datas['transactions'];
        $this->userCount = $datas['users'][0];
        $this->subscribeCount = $datas['subscriptions'][0];
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {

        return include '../public/templates/accueil.php';
    }

    /**
     * Singleton View_BO_Accueil
     * @return View_BO_Accueil|null
     */
    public static function getInstance($datas): View_BO_Accueil{

        self::$_instance = is_null(self::$_instance) ? new View_BO_Accueil($datas) : self::$_instance;
        return self::$_instance;
    }
}