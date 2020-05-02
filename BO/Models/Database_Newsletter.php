<?php


namespace TeissierYannis\Database\BO;

use \PDO;

class Database_Newsletter extends Database{

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
     * Recupere toutes les personnes inscrite à la newsletter
     * @return array
     */
    public function getSubscribers(): array{
        $req =  $this->pdo->query('SELECT * FROM mvc_inscrit');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un utilisateur inscrit à la newsletter de la base de donnée
     * @param int $id
     * @return bool
     */
    public function deleteSubscriber(int $id): bool{
        $req =  $this->pdo->prepare('DELETE FROM mvc_inscrit where idInscrit = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Singleton Database_Newsletter
     * @return Database_Newsletter|null
     */
    public static function getInstance(): Database_Newsletter {

        self::$_instance = is_null(self::$_instance) ? new Database_Newsletter() : self::$_instance;
        return self::$_instance;
    }
}