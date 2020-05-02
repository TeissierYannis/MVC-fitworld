<?php

namespace TeissierYannis\Views;

use TeissierYannis\Database\Database_Menu;

class View_FO_Menu implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private array $datas = [];

    private function __construct(){

        $menu = Database_Menu::getInstance();
        $this->datas['rubriques'] = $menu->getAllRubriques();
        $this->datas['sousRubriques'] = $menu->getAllSousRubriques();
    }
    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string{

        $rubriques = $this->mixRubriques($this->datas['rubriques'], $this->datas['sousRubriques']);

        return include '../public/templates/menu.php';
    }

    /**
     * Fusionne les rubriques et les sous-rubriques
     * @param array $rubriques
     * @param array $sousRubriques
     * @return array
     */
    private function mixRubriques(array $rubriques, array $sousRubriques): array {
        $i = 0;
        while($i < sizeof($rubriques)){

            $array[$i][0] = $rubriques[$i];

            for($j = 0; $j < sizeof($sousRubriques); $j++){

                if($sousRubriques[$j]["idRubrique"] == $array[$i][0]["idRubrique"])
                    array_push($array[$i], $sousRubriques[$j]);
            }

            $i++;
        }

        return $array;
    }

    /**
     * Singleton View_FO_Menu
     * @return View_FO_Menu|null
     */
    public static function getInstance(): View_FO_Menu {

        self::$_instance = is_null(self::$_instance) ? new View_FO_Menu() : self::$_instance;
        return self::$_instance;
    }
}