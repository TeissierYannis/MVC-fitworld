<?php

use TeissierYannis\Stats\BO\Stats;
use TeissierYannis\Views\BO\View_BO_Accueil;

require '../vendor/autoload.php';

$view->body = View_BO_Accueil::getInstance(Stats::getInstance()->setStatsValues());
