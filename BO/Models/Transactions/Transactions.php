<?php


namespace TeissierYannis\Transactions\BO;

use TeissierYannis\Database\BO\Database_Transactions;

class Transactions{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private function __construct(){}

    /**
     * Retourne les transactions
     * @return array
     */
    public function getTransactions(): array {
        return Database_Transactions::getInstance()->getTransactions();
    }

    /**
     * Retoune les pseudos des utilisateurs
     * @return array
     */
    public function getPseudos(): array {
        return Database_Transactions::getInstance()->getPseudos();
    }

    /**
     * Singleton Transactions
     * @return Transactions|null
     */
    public static function getInstance(): Transactions {
        self::$_instance = is_null(self::$_instance) ? new Transactions() : self::$_instance;
        return self::$_instance;
    }
}