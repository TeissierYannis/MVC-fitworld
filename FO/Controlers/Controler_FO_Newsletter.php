<?php

require '../vendor/autoload.php';

$view->body = (isset($_REQUEST['action'])) ?
    (($_GET['action'] == 'subscribe') || ($_REQUEST['action'] == 'unsubscribe') ?
        \TeissierYannis\Views\View_FO_Newsletter::getInstance($_REQUEST['action']) :
        \TeissierYannis\Views\View_FO_Newsletter::getInstance('subscribe')) :
    \TeissierYannis\Views\View_FO_Newsletter::getInstance('subscribe');

if(isset($_REQUEST['subscribe'])) \TeissierYannis\Newsletter\Newsletter\Newsletter::getInstance()->subscribe($_REQUEST['mail']);

if(isset($_REQUEST['unsubscribe'])) \TeissierYannis\Newsletter\Newsletter\Newsletter::getInstance()->unsubscribe($_REQUEST['mail']);