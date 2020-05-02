<?php

namespace TeissierYannis\Database\BO;

use PDO;

class Database_Comments extends Database{

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
     * Retourne tous les commentaires de la base de donnée
     * @return array
     */
    public function getComments(){
        $req = $this->pdo->prepare('SELECT * FROM commentaires ORDER BY dateCommentaire DESC');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un commentaire de la bdd
     * @param int $id
     * @return bool
     */
    public function deleteComment(int $id): bool {
        $req =  $this->pdo->prepare('DELETE FROM commentaires where idCommentaire = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Singleton Database_Comments
     * @return Database_Comments|null
     */
    public static function getInstance(): Database_Comments {

        self::$_instance = is_null(self::$_instance) ? new Database_Comments() : self::$_instance;
        return self::$_instance;
    }

}