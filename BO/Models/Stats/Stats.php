<?php


namespace TeissierYannis\Stats\BO;


use TeissierYannis\Database\BO\Database_Stats;

class Stats{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    private function __construct(){}

    /**
     * Défini les valeurs pour les statistiques
     * @return array
     */
    public function setStatsValues(): array{

        return array (
            "transactions" => Database_Stats::getInstance()->getTransactionsByCurrentYear(),
            "subscriptions" => Database_Stats::getInstance()->countSubsriptions(),
            "users" => Database_Stats::getInstance()->countUsers()
        );
    }

    /**
     * Singleton Stats
     * @return Stats|null
     */
    public static function getInstance(): Stats {
        self::$_instance = is_null(self::$_instance) ? new Stats() : self::$_instance;
        return self::$_instance;
    }
}