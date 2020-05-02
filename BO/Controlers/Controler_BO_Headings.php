<?php

use TeissierYannis\Headings\BO\Headings;
use TeissierYannis\Views\BO\View_BO_Headings;

require '../vendor/autoload.php';

$_REQUEST['action'] = !isset($_REQUEST['action']) ? "" : $_REQUEST['action'];

switch($_REQUEST['action']){

    /*
     * Partie Rubrique
     */
    case 'ViewHeading':
    case 'addHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], Headings::getInstance()->getHeadings());
    break;
    case 'editHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], Headings::getInstance()->getHeading($_REQUEST['idRubrique']));
    break;
    case 'detailsHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], Headings::getInstance()->getHeadings('uniq', $_REQUEST['id']), Headings::getInstance()->getSubHeadings($_REQUEST['id']));
    break;
    /*
     * Partie sous-rubrique
     */
    case 'addSubHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], Headings::getInstance()->getHeadings());
        break;
    case 'ViewSubHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], null, Headings::getInstance()->getSubHeading($_REQUEST['idSubHeading']));
        break;
    case 'editSubHeading':
        $view->body = View_BO_Headings::getInstance($_REQUEST['action'], null, Headings::getInstance()->getSubHeading($_REQUEST['idSubHeading']));
        break;
    default:
        $view->body = View_BO_Headings::getInstance('ViewHeading', Headings::getInstance()->getHeadings());
    break;
}

if(isset($_REQUEST['deleteHeading'])) Headings::getInstance()->deleteHeading($_REQUEST['id']);

if(isset($_REQUEST['addNewHeading'])) Headings::getInstance()->addHeading($_REQUEST);

if(isset($_REQUEST['editCurrentHeading'])) Headings::getInstance()->editHeading($_REQUEST);

if(isset($_REQUEST['editCurrentSubHeading'])) Headings::getInstance()->editSubHeading($_REQUEST);

if(isset($_REQUEST['addNewSubHeading'])) Headings::getInstance()->addSubHeading($_REQUEST);

if(isset($_REQUEST['deleteSubHeading'])) Headings::getInstance()->deleteSubHeading($_REQUEST['id']);