<?php

namespace TeissierYannis\Database;

use PDO;
use TeissierYannis\Utils\Utils\Session;

class Database_Comments extends Database {


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
     * Recupere les commentaires
     * @return array
     */
    public function getComments(): array {
        $req = $this->pdo->query('SELECT * FROM commentaires ORDER BY dateCommentaire DESC');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewComment(string $content): bool{

        $date = date("Y-m-d");
        $req = $this->pdo->prepare('INSERT INTO `commentaires` (`redacteurCommentaire`, `contenuCommentaire`,`dateCommentaire`) VALUES (:author, :content, :date)');

        $req->bindParam('author', Database_UsersActions::getInstance()->getUser(Session::getUserID(), 'id')['pseudo']);
        $req->bindParam('content', $content);
        $req->bindParam('date', $date);

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