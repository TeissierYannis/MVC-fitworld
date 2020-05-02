<?php

use TeissierYannis\Views\BO\View_BO_Transactions;
use \TeissierYannis\Transactions\BO\Transactions;

require '../vendor/autoload.php';

$view->body = View_BO_Transactions::getInstance(Transactions::getInstance()->getTransactions(), Transactions::getInstance()->getPseudos());