<?php

namespace TeissierYannis\Views\BO;

class View_BO_Transactions implements Views_interface{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Contient les transactions PayPal
     * @var array
     */
    private array $transactions;

    /**
     * Contient les pseudos des utilisateurs
     * @var array
     */
    private array $pseudos;

    private function __construct(array $transactions, array $pseudos){
        $this->transactions = $transactions;
        $this->pseudos = $pseudos;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string {
        return include '../public/templates/transactions/transactions.php';
    }

    /**
     * Singleton View_BO_Transactions
     * @param array $transactions
     * @param array $pseudos
     * @return View_BO_Transactions|null
     */
    public static function getInstance(array $transactions, array $pseudos): View_BO_Transactions{
        self::$_instance = is_null(self::$_instance) ? new View_BO_Transactions($transactions, $pseudos) : self::$_instance;
        return self::$_instance;
    }
}