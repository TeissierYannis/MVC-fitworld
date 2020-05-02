<?php
session_start();

# Dispatcher
require '../vendor/autoload.php';

$page = isset($_GET['action']) ? $_GET['action'] : 'default';

$view = \TeissierYannis\Views\View::getInstance();

$cas = isset($_GET['cas']) ? $_GET['cas'] : 'FO_Accueil';

if(!(@include '../Controlers/Controler_'.$cas.'.php'))  header('Location: ./index.php');

echo \TeissierYannis\Views\View::getInstance()->getContent();
