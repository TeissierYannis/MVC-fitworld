<?php


namespace TeissierYannis\Comments\Comments;

use TeissierYannis\Database\Database_Comments;
use TeissierYannis\Utils\Utils\Session;

class Comment{


    /**
     * Instance de class
     * @var null
     */
    private static $_instance = null;

    /**
     * Contient les erreurs
     * @var string
     */
    private string $errors;

    /**
     * Comment constructor.
     */
    private function __construct(){}

    /**
     * Retourne les commentaires
     * @return array
     */
    public function getComments(): array {
        return Database_Comments::getInstance()->getComments();
    }

    /**
     * Ajoute un commentaire
     * @param array $datas
     */
    public function addComment(array $datas){

        if(Session::isLogged()) {
            if (isset($datas['commentaire']) && strlen($datas['commentaire']) >= 20 && strlen($datas['commentaire']) <= 300)
                if (Database_Comments::getInstance()->addNewComment($datas['commentaire'])) $this->errors = "Le commentaire à été ajouté";
                else $this->errors = "La zone de commentaire ne peux pas être vide et doit dépasser le 50 caractères et ne doit pas dépasser 300 caractères.";
        }
    }
    /**
     * Singleton Comment
     * @return Comment|null
     */
    public static function getInstance(): Comment {
        self::$_instance = is_null(self::$_instance) ? new Comment() : self::$_instance;
        return self::$_instance;
    }
}