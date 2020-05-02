<?php


namespace TeissierYannis\UsersActions\UsersActions;

use TeissierYannis\Database\Database_UsersActions;
use TeissierYannis\Utils\Utils\Session;

class UsersActions
{

    /**
     * Contient les erreurs
     * @var string
     */
    private string $errors;

    /**
     * Instance de class
     * @var null
     */
    private static $_instance = null;

    private function __construct()
    {
    }

    /**
     * Connecte l'utilisateur
     * @param array $datas
     */
    public function login(array $datas)
    {

        if (isset($datas['pseudo']) && isset($datas['password']) && !empty($datas['pseudo']) && !empty($datas['password'])) {

            if (Database_UsersActions::getInstance()->getUser($datas['pseudo'], 'pseudo', 'bool')) {
                // VERIFICATION MDP == MDP BDD EN FONCTION DU PSEUDO
                $password = Database_UsersActions::getInstance()->getUser($datas['pseudo'], 'pseudo', 'array');

                if (password_verify($datas['password'], $password['password'])) {

                    // CONNECTE
                    $id = Database_UsersActions::getInstance()->selectUserId($datas['pseudo'])['id'];
                    Session::setUserID($id);
                    Session::setUserType(Database_UsersActions::getInstance()->getUser($datas['pseudo'], 'pseudo', 'array')['accountType']);

                    header('Location: index.php');
                } else {
                    $this->errors = "Le mot de passe ne correspond pas...";
                }
            } else {
                $this->errors = "Le pseudo n'existe pas.";
            }
        } else {
            $this->errors = "Tous les champs doivent être remplis.";
        }
        if (isset($this->errors)) header("Location: ./index.php?cas=FO_UsersActions&action=login&error={$this->errors}");
    }

    /**
     * Enregistre l'utilisateur
     * @param array $datas
     */
    public function register(array $datas)
    {

        if (isset($datas['pseudo']) && isset($datas['password']) && isset($datas['passwordRepeat']) && !empty($datas['pseudo']) && !empty($datas['password']) && !empty($datas['passwordRepeat'])) {
            if (preg_match("/^[a-zA-Z]+$/", $datas['pseudo'])) {

                // OK -> Vérification dans la BDD pour savoir s'il est unique
                if (Database_UsersActions::getInstance()->getUser($datas['pseudo'], 'pseudo', 'bool')) {
                    $this->errors = "Le pseudo existe déjà, veuillez en choisir un autre.";
                } else {
                    if (strlen($datas['password']) >= 8) {
                        // HASH
                        $password = password_hash($datas['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                        if (password_verify($_POST['passwordRepeat'], $password)) {
                            if (Database_UsersActions::getInstance()->addNewUser($datas['pseudo'], $password)) {
                                $this->login($datas);
                            } else {
                                $this->errors = "Une erreur est survenue...";
                            }
                        } else {
                            $this->errors = "Le mot de passe est différent de la confirmation.";
                        }
                    } else {
                        $this->errors = "Le mot de passe est invalide, il doit contenir minimum 8 caractères.";
                    }
                }
            } else {
                $this->errors = "Le pseudo est invalide, il doit contenir uniquement des lettres.";
            }
        } else {
            $this->errors = "Tous les champs doivent être remplis.";
        }

        if (isset($this->errors)) header("Location: ./index.php?cas=FO_UsersActions&action=register&error={$this->errors}");
    }

    /**
     * Deconnecte l'utilisateur
     */
    public function logout()
    {
        Session::removeUser();
    }

    /**
     * Permet de mettre à jour l'adresse mail
     * @param array $datas
     */
    public function updateEmail(array $datas)
    {

        if (isset($datas['email']) && isset($datas['password']) && !empty($datas['email']) && !empty($datas['password'])) {

            if (password_verify($datas['password'], Database_UsersActions::getInstance()->getUser(Session::getUserID(), 'id', 'array')['password'])) {

                if (Database_UsersActions::getInstance()->update('email', $datas['email'], Session::getUserID()))
                    $this->errors = "Profil modifié";
            } else
                $this->errors = "Mot de passe incorrect";
        } else
            $this->errors = "Tous les champs doivent être remplis.";

        header("Location: ./index.php?cas=FO_UsersActions&action=editProfile&error={$this->errors}");
    }

    /**
     * Permet de mettre à jour le mot de passe
     * @param array $datas
     */
    public function updatePassword(array $datas)
    {
        if (isset($datas['passwordActuel']) && isset($datas['passwordNouveau']) && isset($datas['passwordNouveauRepeat']) && !empty($datas['passwordActuel']) && !empty($datas['passwordNouveau']) && !empty($datas['passwordNouveauRepeat'])) {
            if (strlen($datas['passwordNouveau']) >= 8) {

                if ($datas['passwordNouveau'] == $datas['passwordNouveauRepeat']) {

                    if (password_verify($datas['passwordActuel'], Database_UsersActions::getInstance()->getUser(Session::getUserID(), 'id', 'array')['password'])) {

                        $password = password_hash($datas['passwordNouveau'], PASSWORD_DEFAULT, ['cost' => 12]);

                        if (Database_UsersActions::getInstance()->update('password', $password, Session::getUserID()))
                            $this->errors = "Mot de passe changé !";
                    } else
                        $this->errors = "Mot de passe actuel incorect";
                } else
                    $this->errors = "Le mot de passe est différent de la confirmation.";
            } else
                $this->errors = "Le mot de passe est invalide, il doit contenir minimum 8 caractères.";
        } else
            $this->errors = "Tous les champs doivent être remplis.";
        header("Location: ./index.php?cas=FO_UsersActions&action=editProfile&error={$this->errors}");
    }

    /**
     * Permet de mettre a jour les transactions
     * @param array $datas
     */
    private function setTransaction(array $datas){
        $date = explode('T', $datas['date']);
        $transaction = [
            'transactionId' => $datas['transactionID'],
            'paymentStatus' => $datas['paymentStatus'],
            'typeAchat' => $datas['element'],
            'idUser' => Session::getUserID(),
            'monthlyPayment' => explode("-",$date[0])[0] . "-" . (intval(explode("-",$date[0])[1]) + 1) . "-" . explode("-",$date[0])[2]
        ];

        if(Database_UsersActions::getInstance()->setNewTransaction($transaction['transactionId'], $transaction['paymentStatus'], $transaction['typeAchat'], $transaction['idUser'], $transaction['monthlyPayment'])){
            header('Location:index.php?cas=FO_UsersActions&action=editProfile');
        }else header('Location:index.php?cas=FO_UsersActions&action=Editprofile');
    }

    public function setNewSubscription(array $datas){

        if(empty(Database_UsersActions::getInstance()->getAllSubscription(Session::getUserID()))){
            if(!Database_UsersActions::getInstance()->setNewSubscription((new \DateTime())->format('Y-m-d'), (new \DateTime())->modify("+1 year")->format('Y-m-d'), Session::getUserID())){

                $this->errors = "Une erreur avec la demande d'abonnement est survenue... Contactez un administrateur";
            }
        }

        if($this->setTransaction($datas)){
            $this->errors = "Vous êtes maintenant abonné";
        }else{
            $this->errors = "Une erreur avec la transaction est survenue... Contactez un administrateur";
        }


    }

    /**
     * Supprime le compte de l'utilisateur connecté
     */
    public function deleteUser(){

        if(Session::getUserType() == 1 && Database_UsersActions::getInstance()->getAdmins()[0] == 1){
            $this->errors = "Impossible de supprimer le dernier compte admin.";
        }else{
            $this->errors = "Suppression";

                if(Database_UsersActions::getInstance()->deleteAccount(Session::getUserID())){
                    Session::removeUser();
                }else $this->errors = "Une erreur est survenue lors de la suppression...";
            }

        header("Location: ./index.php");
    }
    
    public function cancelSubscription(){
            if(Database_UsersActions::getInstance()->deleteSubscription(Session::getUserID())){
                $this->errors = "Abonnement supprimé";
            }else $this->errors = "Erreur lors de la suppression";
        header("Location: ./index.php?cas=FO_UsersActions&action=editProfile&error={$this->errors}");
    }
    
    /**
     * Singleton Rubriques
     * @return UsersActions|null
     */
    public static function getInstance(): UsersActions
    {
        self::$_instance = is_null(self::$_instance) ? new UsersActions() : self::$_instance;
        return self::$_instance;
    }


}