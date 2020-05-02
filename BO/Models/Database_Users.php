<?php


namespace TeissierYannis\Database\BO;


use \PDO;

class Database_Users extends Database {

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
     * Database_Users constructor.
     */
    private function __construct(){
        $this->pdo = parent::getInstance()->getPDO();
    }

    /**
     * Recupere tous les utilisateurs depuis la base de données
     * @return array
     */
    public function getallUsers(){
        $req = $this->pdo->prepare('SELECT * FROM utilisateurs');
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSubscribers(){
        $req = $this->pdo->prepare('SELECT *
        FROM ((abonnement AS abonnement
            INNER JOIN utilisateurs AS utilisateurs ON ( abonnement.idUtilisateur  = utilisateurs.id  ))
                 INNER JOIN transaction AS transaction ON ( transaction.idUser  = utilisateurs.id  ))
        WHERE monthlyPayment IN (
            SELECT MAX(monthlyPayment)
            FROM transaction
            GROUP BY idUser
        ) GROUP BY idAbonnement');
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ajoute un utilisateur
     * @param string $pseudo
     * @param string $password
     * @param int $accountType
     * @return bool
     */
    public function addNewUser(string $pseudo, string $password, int $accountType): bool{
        $req = $this->pdo->prepare('INSERT INTO `utilisateurs` (`pseudo`, `password`, `accountType`) VALUES (:pseudo, :password, :accountType)');
        $req->bindParam('pseudo', $pseudo);
        $req->bindParam('password', $password);
        $req->bindParam('accountType', $accountType);
        return $req->execute();
    }

    /**
     * Retourne un boolean si le pseudo existe $args 'bool'
     * Retourne le mot de passe $args = 'array'
     * @param string $value Correspond à la valeur à tester
     * @param string $type Correspond à id ou pseudo
     * @param string ...$args
     * @return bool
     */
    public function getUser(string $value, string $type = 'pseudo', string ...$args) {

        $req = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE {$type} = :{$type}");

        $req->bindParam($type, $value);
        $req->execute();
        $ar = $req->fetch();
        return func_get_arg(1) == 'bool'?
            ((empty($ar)) ? false : true) : $ar;
    }

    /**
     * Suppression d'un utilisateur
     * @param $id
     * @return bool
     */
    public function deleteAccount(int $id): bool{
        if($this->getAbonnementByIDUsers($id)){
            $req = $this->pdo->prepare('DELETE FROM abonnement WHERE idUtilisateur = :id');
            $req->bindParam('id', $id);
            $req->execute();
        }
        $req = $this->pdo->prepare('DELETE FROM utilisateurs WHERE id = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Recupere l'abonnement en fonction de l'id utilisateur
     * @param int $id
     * @return array
     */
    private function getAbonnementByIDUsers(int $id): array{
        $req = $this->pdo->prepare('SELECT * FROM abonnement WHERE idUtilisateur = :id');
        $req->bindParam('id', $id);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupere le nombre d'administrateur
     * @return array
     */
    public function getAllAdminUsers(): array{
        $req = $this->pdo->prepare('SELECT COUNT(*) FROM utilisateurs WHERE accountType = 1');
        $req->execute();
        return $req->fetch();
    }

    /**
     * Edition du mail de l'utilisateur avec l'id $id
     * @param string $mail
     * @param int $id
     * @return bool
     */
    public function editEmail(string $mail, int $id): bool{
        $req = $this->pdo->prepare('UPDATE utilisateurs SET email = :email WHERE id = :id');
        $req->bindParam('email', $mail);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Edition du mot de passe de l'utilsiateur avec l'id $id
     * @param string $password
     * @param int $id
     * @return bool
     */
    public function editPassword(string $password, int $id): bool {
        $req = $this->pdo->prepare('UPDATE utilisateurs SET password = :password WHERE id = :id');
        $req->bindParam('password', $password);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Edition du type de l'utilisateur
     * @param int $accountType
     * @param int $id
     * @return bool
     */
    public function editType(int $accountType, int $id){
        $req = $this->pdo->prepare('UPDATE utilisateurs SET accountType = :accountType WHERE id = :id');
        $req->bindParam('accountType', $accountType);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Recupere le type de l'utilisateur
     * @param int $id
     * @return mixed
     */
    public function getUserTypeByID(int $id){
        $req = $this->pdo->prepare('SELECT accountType FROM utilisateurs WHERE id = :id');
        $req->bindParam('id', $id);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Singleton Database_Users
     * @return Database_Users|null
     */
    public static function getInstance(): Database_Users {

        self::$_instance = is_null(self::$_instance) ? new Database_Users() : self::$_instance;
        return self::$_instance;
    }

}