<?php


namespace TeissierYannis\Database;

use PDO;

class Database_Menu extends Database{

    /**
     * PDO
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Database_Menu constructor.
     */
    private function __construct(){
        $this->pdo = parent::getInstance()->getPDO();
    }

    /**
     * Recupération des rubriques
     * @return array
     */
    public function getAllRubriques(): array{
        $req =  $this->pdo->query("SELECT * FROM rubrique");
        return $req->fetchAll();
    }

    /**
     * Recupération des sous-rubriques
     * @return array
     */
    public function getAllSousRubriques(): array{
        $req =  $this->pdo->query('SELECT * FROM sousRubrique');
        return $req->fetchAll();
    }

    /**
     * Singleton Database_Menu
     * @return Database_Menu|null
     */
    public static function getInstance(): Database_Menu {
        self::$_instance = is_null(self::$_instance) ? new Database_Menu() : self::$_instance;
        return self::$_instance;
    }

}