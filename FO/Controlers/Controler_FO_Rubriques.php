<?php

use TeissierYannis\Rubriques\Rubriques\Rubriques;

require '../vendor/autoload.php';

if(isset($_GET['idRubrique'])){

    $view->body = \TeissierYannis\Views\View_FO_Rubriques::getInstance(Rubriques::getInstance()->displayRubrique($_GET['idRubrique']));

}else if(isset($_GET['idSousRubrique'])){

    $view->body = \TeissierYannis\Views\View_FO_Rubriques::getInstance(Rubriques::getInstance()->displaySousRubrique($_GET['idSousRubrique']));

}else{

    header('Location: ./index.php');
}
