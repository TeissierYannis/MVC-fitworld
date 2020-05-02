<?php


namespace TeissierYannis\Database\BO;

use PDO;

class Database_Headings extends Database {

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
     * Recupere les rubriques dans la bdd
     * @return array
     */
    public function getAllHeadings(): array {
        $req =  $this->pdo->prepare('SELECT * FROM rubrique');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupere les sous-rubriques d'une rubrique
     * @param int $id correspond à l'id d'une rubrique
     * @return array
     */
    public function getSubHeadings(int $id): array {
        $req = $this->pdo->prepare('SELECT * FROM sousRubrique WHERE idRubrique = :id');
        $req->bindParam('id', $id);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupere une sous-rubrique
     * @param int $id
     * @return array
     */
    public function getSubHeading(int $id): array {
        $req = $this->pdo->prepare('SELECT * FROM sousRubrique WHERE idSousRubrique = :id');
        $req->bindParam('id', $id);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime une rubrique de la bdd
     * @param $id
     * @return bool
     */
    public function deleteHeading(int $id){
        $req =  $this->pdo->prepare('DELETE FROM rubrique where idRubrique = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Ajoute une rubrique
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function addHeading(string $title, string $content){
        $req = "INSERT INTO rubrique (titre, texteHtml) VALUES (:title, :content)";
        $req = $this->pdo->prepare($req);
        $req->bindparam('title', $title);
        $req->bindparam('content', $content);
        return $req->execute();
    }

    /**
     *
     * @param int $id
     * @return mixed
     */
    public function getHeadingByID(int $id): array {
        $req = "SELECT * FROM rubrique WHERE idRubrique = :id";
        $req =  $this->pdo->prepare($req);
        $req->bindparam('id', $id);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Permet de modifier une rubrique
     * @param string $title
     * @param string $content
     * @param int $id
     * @return bool
     */
    public function editHeading(string $title, string $content, int $id): bool{
        $req = "UPDATE rubrique SET titre = :title, texteHtml = :content WHERE idRubrique = :id";
        $req = $this->pdo->prepare($req);
        $req->bindParam('title', $title);
        $req->bindParam('content', $content);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Permet d'éditer une sous-rubrique
     * @param string $title
     * @param string $content
     * @param int $id
     * @return bool
     */
    public function editSubHeading(string $title, string $content, int $id): bool{
        $req = "UPDATE sousRubrique SET titre = :title, texteHtml = :content WHERE idSousRubrique = :id";
        $req = $this->pdo->prepare($req);
        $req->bindParam('title', $title);
        $req->bindParam('content', $content);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Ajoute une sous-rubrique
     * @param int $id
     * @param string $title
     * @param string $content
     * @return mixed
     */
    public function addSubHeading(int $id, string $title, string $content){
        $req = "INSERT INTO sousRubrique (idRubrique, titre, texteHtml) VALUES (:id, :title, :content)";
        $req = $this->pdo->prepare($req);
        $req->bindparam('id', $id);
        $req->bindparam('title', $title);
        $req->bindparam('content', $content);
        return $req->execute();
    }

    /**
     * Supprime une sous-rubrique de la bdd
     * @param $id
     * @return bool
     */
    public function deleteSubHeading(int $id){
        $req =  $this->pdo->prepare('DELETE FROM sousRubrique where idSousRubrique = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Singleton Database_Stats
     * @return Database_Headings|null
     */
    public static function getInstance(): Database_Headings {

        self::$_instance = is_null(self::$_instance) ? new Database_Headings() : self::$_instance;
        return self::$_instance;
    }

}