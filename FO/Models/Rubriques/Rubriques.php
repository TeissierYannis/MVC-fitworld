<?php

namespace TeissierYannis\Rubriques\Rubriques;

use TeissierYannis\Database\Database_Rubriques;

class Rubriques{

    /**
     * Instance de class
     * @var null
     */
    private static $_instance = null;

    private function __construct(){}

    /**
     * Retourne les rubriques
     * @param $id
     * @return arrays
     */
    public function displayRubrique($id) {
        return Database_Rubriques::getInstance()->getRubrique($id);
    }

    /**
     * Retourne les sous-rubriques
     * @param $id
     * @return array
     */
    public function displaySousRubrique($id) {
        return Database_Rubriques::getInstance()->getSousRubrique($id);
    }

    /**
     * Singleton Rubriques
     * @return Rubriques|null
     */
    public static function getInstance(): Rubriques {
        self::$_instance = is_null(self::$_instance) ? new Rubriques() : self::$_instance;
        return self::$_instance;
    }
}