<?php

use \TeissierYannis\Comments\BO\Comments;
use \TeissierYannis\Views\BO\View_BO_Comments;
require '../vendor/autoload.php';

$view->body = View_BO_Comments::getInstance(Comments::getInstance()->getComments());

if(isset($_REQUEST['deleteComment'])) Comments::getInstance()->deleteComment($_REQUEST['id']);
