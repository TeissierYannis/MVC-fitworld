<?php


namespace TeissierYannis\Comments\BO;


use TeissierYannis\Database\BO\Database_Comments;

class Comments{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Contient les erreurs
     * @var string
     */
    private string $errors;

    private function __construct(){}
    
    /**
     * Retourne tous les commentaires
     * @return array
     */
    public function getComments(): array {
        return Database_Comments::getInstance()->getComments();
    }

    /**
     * Supprime les commentaires
     * @param int $id
     * @return void
     */
    public function deleteComment(int $id){
        if(Database_Comments::getInstance()->deleteComment($id))
            $this->errors = "Suppression réussie";
        else $this->errors = "Erreur lors de la suppression";
        header("Location: index.php?cas=BO_Comments&error={$this->errors}");
    }

    /**
     * Singleton Comments
     * @return Comments|null
     */
    public static function getInstance(): Comments {
        self::$_instance = is_null(self::$_instance) ? new Comments() : self::$_instance;
        return self::$_instance;
    }
}