<?php


namespace TeissierYannis\Views\BO;


class View_BO_Headings{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Correspond à la template à charger
     * @var string
     */
    private string $state;

    /**
     * Correspond aux rubriques
     * @var array
     */
    private ?array $headings;

    /**
     * Correspond aux sous-rubriques
     * @var array
     */
    private ?array $subHeadings;

    /**
     * View_BO_Headings constructor.
     * @param $state
     * @param array|null $headings
     * @param array|null $subHeadings
     */
    private function __construct($state, ?array $headings, ?array $subHeadings){
        $this->state = $state;
        $this->headings = (!is_null($headings)) ? $headings : null;
        $this->subHeadings = (!is_null($subHeadings)) ? $subHeadings : null;
    }

    /**
     * Retourne une page html
     * @return string
     */
    public function getPageContent(): string{
        return (@include_once "../public/templates/headings/Headings_{$this->state}.php") ?
            include_once "../public/templates/headings/Headings_{$this->state}.php" :
            include_once "../public/templates/headings/Headings_ViewHeading.php";
    }

    /**
     * Singleton View_BO_Headings
     * @param string $state
     * @param array $headings
     * @param mixed|null $subHeadings
     * @return View_BO_Headings|null
     */
    public static function getInstance(string $state, ?array $headings, ?array $subHeadings = null): View_BO_Headings{
        self::$_instance = is_null(self::$_instance) ? new View_BO_Headings($state, $headings, $subHeadings) : self::$_instance;
        return self::$_instance;
    }

}