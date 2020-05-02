<?php

namespace TeissierYannis\Views;

class View_FO_Accueil implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private array $comments;

    private function __construct(array $comments){
        $this->comments = $comments;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {

        return include '../public/templates/accueil.php';
    }

    /**
     * Singleton View_FO_Footer
     * @param array $comments
     * @return View_FO_Accueil|null
     */
    public static function getInstance(array $comments): View_FO_Accueil{

        self::$_instance = is_null(self::$_instance) ? new View_FO_Accueil($comments) : self::$_instance;
        return self::$_instance;
    }
}