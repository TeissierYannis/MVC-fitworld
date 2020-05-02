<?php


namespace TeissierYannis\Views;


class View_FO_Rubriques implements Views_interface {

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;


    /**
     * Contient une rubrique ou une sous-rubrique
     * @var array
     */
    private array $rubrique;

    private function __construct(array $rubrique){
        $this->rubrique = $rubrique;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {

        return include "../public/templates/rubrique.php";
    }

    /**
     * Singleton View_FO_Rubriques
     * @param array $rubrique
     * @return View_FO_Rubriques|null
     */
    public static function getInstance(array $rubrique): View_FO_Rubriques{

        self::$_instance = is_null(self::$_instance) ? new View_FO_Rubriques($rubrique) : self::$_instance;
        return self::$_instance;
    }
}