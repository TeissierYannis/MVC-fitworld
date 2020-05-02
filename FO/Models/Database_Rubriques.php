<?php

namespace TeissierYannis\Database;

class Database_Rubriques extends Database {

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
     * Database_Newsletter constructor.
     */
    private function __construct(){
        $this->pdo = parent::getInstance()->getPDO();
    }

    /**
 * Recupere une rubrique en fonction de son id
 * @param $id
 * @return array
 */
    public function getRubrique($id){

        $req =  $this->pdo->prepare('SELECT * FROM rubrique WHERE idRubrique = :id');
        $req->bindParam("id", $id);
        $result = $req->execute();
        $ar = $req->fetch();
        return (empty($ar)) ? header('Location: ./index.php') : $ar;
    }

    /**
     * Recupere une sous-rubrique en fonction de son id
     * @param $id
     * @return array
     */
    public function getSousRubrique($id): array{
        $req =  $this->pdo->prepare('SELECT * FROM sousRubrique WHERE idSousRubrique = :id');
        $req->bindParam("id", $id);
        $result = $req->execute();
        $ar = $req->fetch();
        return (empty($ar)) ? header('Location: ./index.php') : $ar;
    }

    /**
     * Singleton Database_Rubriques
     * @return Database_Rubriques|null
     */
    public static function getInstance(): Database_Rubriques {
        self::$_instance = is_null(self::$_instance) ? new Database_Rubriques() : self::$_instance;
        return self::$_instance;
    }
}