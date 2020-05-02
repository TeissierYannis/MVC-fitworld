<?php

use TeissierYannis\Utils\BO\Session;
use TeissierYannis\Views\BO\View;

session_start();

require '../vendor/autoload.php';

if(isset($_POST['adminAccess'])){
    Session::setUserType(hex2bin($_POST['type']));
    Session::setUserID(hex2bin($_POST['id']));
}

if(!(Session::getUserType() == "1" || Session::getUserType() == "3")) header('Location: ../../FO/public/');

$page = isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'default';

$view = View::getInstance();

$cas = isset($_GET['cas']) && !empty($_GET['cas']) ? $_GET['cas'] : 'BO_Accueil';


if(!(@include '../Controlers/Controler_'.$cas.'.php'))  header('Location: ./index.php');

echo View::getInstance()->getContent();
