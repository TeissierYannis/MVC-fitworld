<?php

use TeissierYannis\Database\Database_UsersActions;
use TeissierYannis\UsersActions\UsersActions\UsersActions;
use TeissierYannis\Utils\Utils\Session;
use TeissierYannis\Views\View_FO_UsersActions;

require '../vendor/autoload.php';

## Lorsque l'on est deco cela ne redirige pas
if((Session::isLogged() && !($_REQUEST['action'] == 'logout' || $_REQUEST['action'] == 'editProfile' || $_REQUEST['action'] == 'transactionSuccess' || $_REQUEST['action'] == 'buy'))) header('Location: ./index.php');

if ($_REQUEST['action'] == 'logout') UsersActions::getInstance()->logout();

if(isset($_REQUEST['action'])):

    switch($_REQUEST['action']):
        case 'transactionSuccess':
            UsersActions::getInstance()->setNewSubscription($_REQUEST);
            break;
        case 'buy':
        case 'register':
        case 'login':
            $view->body = View_FO_UsersActions::getInstance($_REQUEST['action']);
            break;
        case 'editProfile':

            $view->body = View_FO_UsersActions::getInstance($_REQUEST['action'],
                Database_UsersActions::getInstance()->getUser(Session::getUserID(), 'id', 'array'),
                Database_UsersActions::getInstance()->getAllSubscription(Session::getUserID()));
            break;
        default:
            $view->body = View_FO_UsersActions::getInstance('login');
            break;
    endswitch;

endif;

if(isset($_REQUEST['validerInfos'])) UsersActions::getInstance()->updateEmail($_REQUEST);
if(isset($_REQUEST['validerInfosPassword'])) UsersActions::getInstance()->updatePassword($_REQUEST);
if(isset($_REQUEST['supprimerCompte'])) UsersActions::getInstance()->deleteUser($_REQUEST);
if(isset($_REQUEST['annulerAbonnement'])) UsersActions::getInstance()->cancelSubscription();

if (isset($_REQUEST['connexion'])) UsersActions::getInstance()->login($_REQUEST);

if (isset($_REQUEST['inscription'])) UsersActions::getInstance()->register($_REQUEST);