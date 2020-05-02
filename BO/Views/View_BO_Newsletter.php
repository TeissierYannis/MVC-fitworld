<?php


namespace TeissierYannis\Views\BO;


class View_BO_Newsletter implements Views_interface
{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Correspond à la page que l'on doit afficher
     * @var string
     */
    private string $state;

    /**
     * Correspond à la liste des personnes inscrite à la newsletter
     * @var array|null
     */
    private ?array $subscribers;

    /**
     * View_BO_Newsletter constructor.
     * Défini state
     * @param string $state
     * @param array|null $subscribers
     */
    private function __construct(string $state, ?array $subscribers){
        $this->state = $state;
        $this->subscribers = $subscribers;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string{
        return (@include_once "../public/templates/newsletter/Newsletter_{$this->state}.php") ?
            include_once "../public/templates/newsletter/Newsletter_{$this->state}.php" :
            include_once "../public/templates/newsletter/Newsletter_ViewSubscribers.php";
    }

    /**
     * Singleton View_BO_Newsletter
     * @param string $state
     * @param array|null $subscribers
     * @return View_BO_Newsletter|null
     */
    public static function getInstance(string $state, ?array $subscribers = null): View_BO_Newsletter {
        self::$_instance = is_null(self::$_instance) ? new View_BO_Newsletter($state, $subscribers) : self::$_instance;
        return self::$_instance;
    }
}