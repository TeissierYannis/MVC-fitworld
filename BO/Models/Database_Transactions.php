<?php

namespace TeissierYannis\Database\BO;

use PDO;

class Database_Transactions extends Database{

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
     * Database constructor.
     */
    private function __construct(){
        $this->pdo = parent::getInstance()->getPDO();
    }

    /**
     * Retourne les transactions
     * @return array
     */
    public function getTransactions(): array {
        $req = $this->pdo->prepare('SELECT * FROM transaction t');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retoune les pseudos des utilisateurs
     * @return array
     */
    public function getPseudos(): array {
        $req = $this->pdo->prepare('SELECT pseudo, id FROM utilisateurs');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Singleton Database_Transactions
     * @return Database_Transactions|null
     */
    public static function getInstance(): Database_Transactions {

        self::$_instance = is_null(self::$_instance) ? new Database_Transactions() : self::$_instance;
        return self::$_instance;
    }

}