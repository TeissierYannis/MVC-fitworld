<?php

use \TeissierYannis\Views\BO\View_BO_Newsletter;
use \TeissierYannis\Newsletter\BO\Newsletter;

require '../vendor/autoload.php';

$_REQUEST['action'] = !isset($_REQUEST['action']) ? "" : $_REQUEST['action'];

$view->body = View_BO_Newsletter::getInstance($_REQUEST['action'], Newsletter::getInstance()->getSubscribers());

if(isset($_REQUEST['deleteSubscriber'])) Newsletter::getInstance()->deleteSubscriber($_REQUEST['id']);

if(isset($_REQUEST['sendNewsletter'])) Newsletter::getInstance()->sendNewsletter($_REQUEST['to'], $_REQUEST['content']);