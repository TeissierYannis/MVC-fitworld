<?php

namespace TeissierYannis\Views;

class View_FO_UsersActions implements Views_interface {

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Correspond à login ou register
     * @var string
     */
    private string $state;

    /**
     * Contient les infos utilisateur
     * @var
     */
    private $infos;

    /**
     * Contient les transactions de l'utilisateur
     * @var
     */
    private $subscription;

    /**
     * View_FO_UsersActions constructor.
     * @param string $state
     * @param null $infos
     * @param null $subscription
     */
    private function __construct(string $state, $infos, $subscription){
        $this->state = $state;
        if(!is_null($infos)) $this->infos = $infos;
        if(!is_null($subscription)) $this->subscription = $subscription;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {
        return include "../public/templates/UsersActions_{$this->state}.php";
    }

    /**
     * Singleton View_FO_UsersActions
     * @param string $state
     * @param array|null $infos
     * @param null $subscription
     * @return View_FO_UsersActions|null
     */
    public static function getInstance(string $state, $infos = null, $subscription = null): View_FO_UsersActions{
        self::$_instance = is_null(self::$_instance) ? new View_FO_UsersActions($state, $infos, $subscription) : self::$_instance;
        return self::$_instance;
    }
}