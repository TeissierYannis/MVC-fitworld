<?php


namespace TeissierYannis\Database;


class Database_UsersActions extends Database {

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
     * Retourne un boolean si le pseudo existe $args 'bool'
     * Retourne le mot de passe $args = 'array'
     * @param string $value Correspond à la valeur à tester
     * @param string $type Correspond à id ou pseudo
     * @param string ...$args Corressp
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
     * Recupere l'id d'un utilisateur par rapport à son pseudo : Retourne un tableau ou redirige vers le menu en cas d'erreur
     * @param string $pseudo
     * @return array
     */
    public function selectUserId(string $pseudo): array {
        $req = $this->pdo->prepare('SELECT id FROM utilisateurs WHERE pseudo = :pseudo');
        $req->bindParam('pseudo', $pseudo);
        $req->execute();
        $ar = $req->fetch();
        return empty($ar) ? header('Location: ./index.php') : $ar;
    }

    /**
     * Ajoute un utilisateur
     * @param string $pseudo
     * @param string $password
     * @return bool
     */
    public function addNewUser(string $pseudo, string $password): bool{
        $req = $this->pdo->prepare('INSERT INTO `utilisateurs` (`pseudo`, `password`) VALUES (:pseudo, :password)');
        $req->bindParam('pseudo', $pseudo);
        $req->bindParam('password', $password);
        return $req->execute();
    }

    /**
     * Récupere les abonnements des utilisateurs
     * @param int $id
     * @return array
     */
    public function getAllSubscription($id) {
        $req = $this->pdo->prepare("SELECT a.*, t.* FROM abonnement a, utilisateurs u, transaction t WHERE u.id = t.idUser AND u.id = a.idUtilisateur AND a.idUtilisateur = :id ORDER BY monthlyPayment DESC");
        $req->bindParam('id', $id);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Update un champ
     * @param string $fieldToUpdate
     * @param string $value
     * @param int $id
     * @return bool
     */
    public function update(string $fieldToUpdate,string $value, int $id): bool{
        $req = $this->pdo->prepare("UPDATE utilisateurs SET {$fieldToUpdate} = :{$fieldToUpdate} WHERE id = :id");

        $req->bindParam($fieldToUpdate, $value);
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Ajoute une transaction
     * @param string $transactionId
     * @param string $paymentStatus
     * @param string $typeAchat
     * @param string $idUser
     * @param string $monthlyPayment
     * @return bool
     */
    public function setNewTransaction(string $transactionId, string $paymentStatus, string $typeAchat, string $idUser, string $monthlyPayment): bool{
        $req = $this->pdo->prepare('INSERT INTO transaction (`transactionId`, `paymentStatus`, `typeAchat`, `idUser`, `monthlyPayment`)  
        VALUES (:transactionId, :paymentStatus, :typeAchat, :idUtilisateur, :monthlyPayment)');

        $req->bindParam('transactionId', $transactionId);
        $req->bindParam('paymentStatus', $paymentStatus);
        $req->bindParam('typeAchat', $typeAchat);
        $req->bindParam('idUtilisateur', $idUser);
        $req->bindParam('monthlyPayment', $monthlyPayment);

        return $req->execute();
    }

    public function setNewSubscription($dateAchat, $dateFin, int $idUtilisateur): bool{
        $req = $this->pdo->prepare('INSERT INTO abonnement (`dateAchat`, `dateFin`, `idUtilisateur`) VALUES (:dateAchat, :dateFin, :idUtilisateur)');

        $req->bindParam('dateAchat', $dateAchat);
        $req->bindParam('dateFin', $dateFin);
        $req->bindParam('idUtilisateur', $idUtilisateur);

        return $req->execute();
    }

    /**
     * Retourne le nombre d'administrateur
     * @return array
     */
    public function getAdmins():array {
        $req = $this->pdo->prepare('SELECT COUNT(*) FROM utilisateurs WHERE accountType = 1');
        $req->execute();
        return $req->fetch();
    }

    /**
     * Supprime un utilisateur
     * @param int $id
     * @return bool
     */
    public function deleteAccount(int $id): bool{

        $req = $this->pdo->prepare('DELETE FROM abonnement WHERE idUtilisateur = :id');
        $req->bindParam('id', $id);
        $req->execute();

        $req = $this->pdo->prepare('DELETE FROM commentaires WHERE redacteurCommentaire = :pseudo');
        $req->bindParam('pseudo', $this->getUser($id, 'id')['pseudo']);
        $req->execute();

        $req = $this->pdo->prepare('DELETE FROM utilisateurs WHERE id = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Supprime un abonnement
     * @param $id
     * @return bool
     */
    public function deleteSubscription($id): bool{
        $req =  $this->pdo->prepare('DELETE FROM `abonnement` where `idUtilisateur` = :id');
        $req->bindParam('id', $id);
        return $req->execute();
    }

    /**
     * Singleton Database_UsersActions
     * @return Database_UsersActions|null
     */
    public static function getInstance(): Database_UsersActions {
        self::$_instance = is_null(self::$_instance) ? new Database_UsersActions() : self::$_instance;
        return self::$_instance;
    }

}