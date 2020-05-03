<?php

namespace TeissierYannis\Database;

use PDO;

class Database{

    /**
     * Objet  PDO
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Database host
     * @var string
     */
    private string $dbhost = "";
    /**
     * Database name
     * @var string
     */
    private string $dbname = "";
    /**
     * Database username
     * @var string
     */
    private string $username = "";
    /**
     * Database password
     * @var string
     */
    private string $password = "";

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Genere un nouvel objet PDO
     * Database constructor.
     */
    private function __construct(){
        try {
            $this->pdo = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname};", $this->username, $this->password);
        }catch (\Exception $e){
            die('Erreur : Impossible de créer l\'objet PDO');
        }
    }

    /**
     * Retourne l'objet PDO
     * @return PDO
     */
    public function getPDO(){

        return $this->pdo;
    }

    /**
     * Singleton Database
     * @return Database|null
     */
    public static function getInstance(): Database {

        self::$_instance = is_null(self::$_instance) ? new Database() : self::$_instance;
        return self::$_instance;
    }

}
