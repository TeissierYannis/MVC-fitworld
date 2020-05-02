<?php


namespace TeissierYannis\Database;

use PDO;

class Database_Newsletter extends Database {

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
     * Database_Newsletter constructor.
     */
    private function __construct(){
        $this->pdo = parent::getInstance()->getPDO();
    }

    /**
     * Vérifie si un email est déjà inscrit à la newsletter
     * Retourne un booleen ou un tableau en fonction des args
     * @param string $value
     * @param string ...$args "bool" ou "array"
     * @return bool|array
     */
    public function isAlreadyIn(string $value, string ...$args){

        $req =  $this->pdo->prepare("SELECT idInscrit FROM mvc_inscrit WHERE mail = :mail");
        $req->bindParam('mail', $value);
        $req->execute();

        return func_get_arg(1) == "bool" ? (empty($req->fetchAll()) ? false : true) : $req->fetch();
    }

    /**
     * Ajoute un utilisateur à la newsletter
     * @param $mail
     * @return bool
     */
    function insertUser(string $mail){
        $req =  $this->pdo->prepare('INSERT INTO mvc_inscrit (idInscrit, mail) VALUES (NULL, :mail);');
        $req->bindParam('mail',$mail);
        return $req->execute();
    }

    /**
     * Supprimer un utilisateur de la newsletter
     * @param int $id
     * @return mixed
     */
    function removeUser(int $id){
        $req =  $this->pdo->prepare('DELETE FROM mvc_inscrit where idInscrit = :id');
        $req->bindParam('id',$id);
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