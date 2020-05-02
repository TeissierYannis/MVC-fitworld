<?php

namespace TeissierYannis\Views;

class View{

    /**
     * Correspond au contenu du corps
     * @var string
     */
    public $body;

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private function __construct(){}

    /**
     * Permet d'afficher le contenu d'une page
     * @return string
     */
    public function getContent(): string{

        $str = include 'header_html.php';

        $str .= \TeissierYannis\Views\View_FO_Menu::getInstance()->getPageContent();
        $str .= isset($this->body) ? $this->body->getPageContent() : '';
        $str .= \TeissierYannis\Views\View_FO_Footer::getInstance()->getPageContent();

        $str .= include 'footer_html.php';

        return $str;
    }

    /**
     * Singleton Database
     * @return View|null
     */
    public static function getInstance(): View {
        self::$_instance = is_null(self::$_instance) ? new View() : self::$_instance;
        return self::$_instance;
    }
}