<?php


namespace TeissierYannis\Newsletter\Newsletter;

use TeissierYannis\Database\Database_Newsletter;

class Newsletter{

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

    /**
     * Newsletter constructor.
     */
    private function __construct(){}

    /**
     * Permet de filtrer l'email, et de faire les test pour savoir si l'email est bonne, redirige vers une erreur
     * @param $mail
     */
    public function subscribe($mail) {

        if(isset($mail)) {
            if($mail != "" && filter_var($mail, FILTER_VALIDATE_EMAIL)){
                if(!Database_Newsletter::getInstance()->isAlreadyIn($mail, "bool")){
                    if(Database_Newsletter::getInstance()->insertUser($mail))
                        $this->errors = 'Inscription réussie';
                    else
                        $this->errors = 'Erreur';
                }else{
                    $this->errors = 'Vous êtes déjà inscrit !';
                }
            }else $this->errors = "Le champ ne peut pas être vide";
        } else{
            $this->errors = 'Mail non saisi';
        }
        header("Location: index.php?cas=FO_Newsletter&action=subscribe&error={$this->errors}");
    }

    /**
     * Permet vérifier si le mail est valide et désinscription, redirige vers une erreur
     * @param $mail
     */
    public function unsubscribe($mail) {

        if(isset($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {

            $id = Database_Newsletter::getInstance()->isAlreadyIn($mail, "array");

            if($id){
                if(Database_Newsletter::getInstance()->removeUser($id['idInscrit']))
                    $this->errors = "Désinscription réussie";
                else
                    $this->errors = "Erreur";
            }else{
                $this->errors = "Impossible de trouver l'adresse email";
            }
        }else{
            $this->errors = "Mail non saisi";
        }
        header("Location: index.php?cas=FO_Newsletter&action=unsubscribe&error={$this->errors}");
    }

    /**
     * Retourne les erreurs
     * @return string
     */
    public function getErrors(){
        return $this->errors;
    }

    /**
     * Singleton Newsletter
     * @return Newsletter|null
     */
    public static function getInstance(): Newsletter {
        self::$_instance = is_null(self::$_instance) ? new Newsletter() : self::$_instance;
        return self::$_instance;
    }
}