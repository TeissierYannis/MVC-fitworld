<?php

use TeissierYannis\Users\BO\Users;
use TeissierYannis\Views\BO\View_BO_Users;

require '../vendor/autoload.php';

$_REQUEST['action'] = !isset($_REQUEST['action']) ? "ViewUsers" : $_REQUEST['action'];

switch($_REQUEST['action']):


    case 'ViewUsers':
        $view->body = View_BO_Users::getInstance($_REQUEST['action'], Users::getInstance()->getAllUsers());
    break;

    case 'ViewSubscribers':
        $view->body = View_BO_Users::getInstance($_REQUEST['action'], Users::getInstance()->getAllSubscribers());
        break;
    case 'ViewAll':
        $view->body = View_BO_Users::getInstance($_REQUEST['action'], Array(
            "users" => Users::getInstance()->getAllUsers(),
            "subscribers" => Users::getInstance()->getAllSubscribers()
        ));
        break;
    default:
        header('Location: ./index.php?cas=BO_Users&action=ViewUsers');
endswitch;

if(isset($_REQUEST['addUserAccount'])) Users::getInstance()->addNewUser($_REQUEST);
if(isset($_REQUEST['deleteAccount'])) Users::getInstance()->removeUser($_REQUEST);

if(isset($_REQUEST['modifierAccountUser'])) Users::getInstance()->editUser($_REQUEST);

