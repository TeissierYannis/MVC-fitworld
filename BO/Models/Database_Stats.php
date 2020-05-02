<?php

namespace TeissierYannis\Database\BO;

use PDO;

class Database_Stats extends Database {

    /**
     * PDO
     * @var \PDO
     */
    private \PDO $pdo;

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
     * Récupere les transactions faite dans l'année courante
     * @return array
     */
    public function getTransactionsByCurrentYear(): array{
        $currentYear = date('Y');
        $req = $this->pdo->prepare('SELECT * FROM transaction WHERE YEAR(`monthlyPayment`) = :currentYear');
        $req->bindParam('currentYear', $currentYear);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre d'abonnés
     * @return array
     */
    public function countSubsriptions(): array {
        $req = $this->pdo->prepare('SELECT COUNT(*) FROM abonnement');
        $req->execute();
        return $req->fetch();
    }

    /**
     * Compte le nombre d'utilisateur
     * @return array
     */
    public function countUsers(): array {
        $req = $this->pdo->prepare('SELECT COUNT(*) FROM `utilisateurs`');
        $req->execute();
        return $req->fetch();
    }

    /**
     * Singleton Database_Stats
     * @return Database_Stats|null
     */
    public static function getInstance(): Database_Stats {

        self::$_instance = is_null(self::$_instance) ? new Database_Stats() : self::$_instance;
        return self::$_instance;
    }

}