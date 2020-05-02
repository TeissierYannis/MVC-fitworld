<?php


namespace TeissierYannis\Views\BO;


class View_BO_Comments implements Views_interface
{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Contient les commentaires
     * @var array
     */
    private array $comments;

    /**
     * View_BO_Comments constructor.
     * Défini les commentaires
     * @param array $comments
     */
    private function __construct(array $comments){
        $this->comments = $comments;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string{

        return include '../public/templates/comments/comments.php';
    }

    /**
     * Singleton View_BO_Comments
     * @param array $comments
     * @return View_BO_Comments|null
     */
    public static function getInstance(array $comments): View_BO_Comments {
        self::$_instance = is_null(self::$_instance) ? new View_BO_Comments($comments) : self::$_instance;
        return self::$_instance;
    }
}