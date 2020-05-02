<?php

use TeissierYannis\Comments\Comments\Comment;
use TeissierYannis\Views\View_FO_Accueil;

require '../vendor/autoload.php';

$view->body = View_FO_Accueil::getInstance(Comment::getInstance()->getComments());

if(isset($_REQUEST['ajouterCommentaire'])) Comment::getInstance()->addComment($_REQUEST);