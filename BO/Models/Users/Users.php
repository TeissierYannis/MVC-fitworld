<?php


namespace TeissierYannis\Users\BO;


use TeissierYannis\Database\BO\Database_Users;

class Users{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private array $datas;
    /**
     * @var string
     */
    private string $errors;

    /**
     * Users constructor.
     */
    private function __construct(){}

    /**
     * Recupere tous les utilisateurs
     * @return array
     */
    public function getAllUsers(){
        return Database_Users::getInstance()->getallUsers();
    }

    public function getAllSubscribers(){
        return Database_Users::getInstance()->getAllSubscribers();
    }

    /**
     * Traitement des nouveaux utilisateurs
     * @param array $datas
     */
    public function addNewUser(array $datas){

            if(isset($datas['pseudo']) && isset($datas['password']) && isset($datas['passwordRepeat']) && isset($datas['typeAccount']) && !empty($datas['pseudo']) && !empty($datas['password']) && !empty($datas['passwordRepeat']) && !empty($datas['typeAccount'])){
                if($datas['typeAccount'] == "Admin")
                    $accountType = 1;
                else if($datas['typeAccount'] == "Utilisateur")
                    $accountType = 2;
                else
                    $accountType = 3;

                if (preg_match("/^[a-zA-Z]+$/", $datas['pseudo'])) {
                    $pseudo = $datas['pseudo'];
                    // OK -> Vérification dans la BDD pour savoir s'il est unique
                    
                    if (Database_Users::getInstance()->getUser($pseudo, 'pseudo', 'bool')) {
                        $this->errors = "<small>Le pseudo existe déjà, veuillez en choisir un autre.</small>";
                    } else {
                        if (strlen($datas['password']) >= 8) {
                            // HASH
                            $password = password_hash($datas['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                            if (password_verify($datas['passwordRepeat'], $password)) {

                                if (Database_Users::getInstance()->addNewUser($pseudo, $password, $accountType)) {
                                    $this->errors = '<small>Ajout du compte réussie</small>';
                                } else {
                                    $this->errors = "<small>Une erreur est survenue...</small>";
                                }
                            } else {
                                $this->errors = "<small>Le mot de passe est différent de la confirmation.</small>";
                            }
                        } else {
                            $this->errors = "<small>Le mot de passe est invalide, il doit contenir minimum 8 caractères.</small>";
                        }
                    }
                } else {
                    $this->errors = "<small>Le pseudo est invalide, il doit contenir uniquement des lettres.</small>";
                }
            }else $this->errors = "<small>Tous les champs doivent être remplis..</small>";

        return header("Location: index.php?cas=BO_Users&action=ViewUsers&error={$this->errors}");
    }

    /**
     * Traitement des suppressions d'utilisateurs
     * @param array $datas
     */
    public function removeUser(array $datas){
            if(isset($datas['idInscrit']) && isset($datas['accountType']) && !empty($datas['idInscrit']) && !empty($datas['accountType'])){

                if($datas['accountType'] == 1 && Database_Users::getInstance()->getAllAdminUsers()[0] == 1){
                    $this->errors = '<small>Impossible de supprimer le compte administrateur lorsqu\'il en existe un seul..</small>';
                }else{ //SUPPRESSION

                    if(Database_Users::getInstance()->deleteAccount($datas['idInscrit'])){
                        $this->errors = '<small>Suppression du compte réussie</small>';

                    }else $this->errors = '<small>Une erreur est survenue</small>';
                }
            }else{
                $this->errors = '<small>Tous les champs doivent être remplis...</small>';
            }
        return header("Location: index.php?cas=BO_Users&action=ViewUsers&error={$this->errors}");
    }

    /**
     * Traitement de l'édition des utilisateurs
     * @param array $datas
     */
    public function editUser(array $datas){

        switch($datas['modifierAccountUser']){
            case 'Modifier email':
                    $this->editEmail($datas);
                break;
            case 'Modifier mot de passe':
                    $this->editPassword($datas);
                break;
            case 'Modifier type':
                $this->editType($datas);
                break;
        }

        return header("Location: index.php?cas=BO_Users&action=ViewUsers&error={$this->errors}");
    }

    /**
     * Permet d'éditer le mail de l'utilisateur
     * @param array $datas
     * @return string
     */
    private function editEmail(array $datas): string{
        if(isset($datas['idUser']) && isset($datas['email']) && !empty($datas['idUser']) && !empty($datas['email'])){

            if(Database_Users::getInstance()->editEmail($datas['email'], $datas['idUser'])){
                $this->errors = '<small>Modification de l\'email réussie</small>';
            }else
                $this->errors = "<small>Une erreur est survenue...</small>";
        }else
            $this->errors = "<small>Tous les champs doivent être remplis</small>";
        return $this->errors;
    }

    /**
     * Permet d'éditer le mot de passe de l'utilisateur
     * @param array $datas
     * @return string
     */
    private function editPassword(array $datas): string{
        if(isset($datas['idUser']) && isset($datas['password']) && isset($datas['passwordRepeat'])  && !empty($datas['idUser']) && !empty($datas['password']) && !empty($datas['passwordRepeat'])){
            if (strlen($datas['password']) >= 8) {
                $password = password_hash($datas['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                if (password_verify($datas['passwordRepeat'], $password)) {
                    if (Database_Users::getInstance()->editPassword($password, $datas['idUser']))
                        $this->errors = '<small>Modification du mot de passe réussie</small>';
                    else
                        $this->errors = "<small>Une erreur est survenue...</small>";
                } else
                    $this->errors = "<small>Le mot de passe est différent de la confirmation.</small>";
            } else
                $this->errors = "<small>Le mot de passe est invalide, il doit contenir minimum 8 caractères.</small>";
        }
        return $this->errors;
    }

    /**
     * Permet d'éditer le type de l'utilisateur
     * @param array $datas
     * @return string
     */
    private function editType(array $datas): string{
        if(isset($datas['idUser']) && isset($datas['typeAccount']) && !empty($datas['idUser']) && !empty($datas['typeAccount'])){

            if($datas['typeAccount'] == "Admin")
                $typeAccount = 1;
            else if($datas['typeAccount'] == "Utilisateur")
                $typeAccount = 2;
            else $typeAccount = 3;
            if(isset($typeAccount)){
                if(Database_Users::getInstance()->getUserTypeByID($datas['idUser']['0']) == 1 && Database_Users::getInstance()->getAllAdminUsers()[0] == 1){
                    $this->errors = '<small>Impossible de supprimer le compte administrateur lorsqu\'il en existe un seul..</small>';
                }else{
                    if(Database_Users::getInstance()->editType($typeAccount, $datas['idUser'])){
                        $this->errors = '<small>Modification du compte réussie</small>';
                            }else
                        $this->errors = "<small>Une erreur est survenue...</small>";
                }
            }else $this->errors = "<small>Une erreur est survenue...</small>";
        }else $this->errors = "<small>Tous les champs doivent être remplis</small>";
        return $this->errors;
    }

    /**
     * Singleton Users
     * @return Users|null
     */
    public static function getInstance(): Users {
        self::$_instance = is_null(self::$_instance) ? new Users() : self::$_instance;
        return self::$_instance;
    }
}