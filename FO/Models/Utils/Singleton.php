<?php


namespace TeissierYannis\Utils\Utils;


class Singleton{

    public static $_instance = null;

    public function __construct(){}

    /**
     * Singleton Singleton
     * @return Singleton|null
     */
    public static function getInstance(): Singleton {

        self::$_instance = is_null(self::$_instance) ? new Singleton() : self::$_instance;
        return self::$_instance;
    }

}