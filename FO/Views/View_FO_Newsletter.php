<?php

namespace TeissierYannis\Views;

class View_FO_Newsletter implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Correspond à subscribe ou unsubscribe
     * @var string
     */
    private string $state;

    private function __construct(string $state){
        $this->state = $state;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {

        return include "../public/templates/newsletter_{$this->state}.php";
    }

    /**
     * Singleton View_FO_Newsletter
     * @param $state
     * @return View_FO_Newsletter|null
     */
    public static function getInstance($state): View_FO_Newsletter{

        self::$_instance = is_null(self::$_instance) ? new View_FO_Newsletter($state) : self::$_instance;
        return self::$_instance;
    }
}