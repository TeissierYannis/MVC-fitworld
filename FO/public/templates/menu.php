<?php

use TeissierYannis\Utils\Utils\Session;

?>

<!-- Page Preloder -->


<nav style="background-color:rgba(0,0,0,0.3) !important; color:white !important; position: fixed !important; z-index: 20 !important; height: 100px !important; width: 100% !important;"
     class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand p-0" style="color: white !important;" href="index.php">FitWorld</a>
    <button style="color:white !important;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span style="" class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown p-10">
                <a style="color:white !important;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    NewsLetter
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a style="color:black !important;" class="dropdown-item"
                       href="index.php?cas=FO_Newsletter&action=subscribe">Inscription</a>
                    <a style="color:black !important;" class="dropdown-item"
                       href="index.php?cas=FO_Newsletter&action=unsubscribe">Désinscription</a>
                </div>
            </li>

            <?php


            foreach ($rubriques as $element) {


            if (sizeof($element) == 1){
                echo '
                                <li class="nav-item">
                                    <a style="color:white !important;" class="nav-link" href="index.php?cas=FO_Rubriques&action=visualiser&idRubrique=' . $element[0]["idRubrique"] . '">' . $element[0]["titre"] . '</a>
                                </li>';

            }else{
            echo '
                                <li class="nav-item dropdown">
                                    <a style="color:white !important;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . $element[0]["titre"] . '
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
            for ($i = 1; $i < sizeof($element); $i++) {
                echo '
                                        <a style="color:black !important;" class="dropdown-item" href="index.php?cas=FO_Rubriques&action=visualiser&idSousRubrique=' . $element[$i]["idSousRubrique"] . '">
                                            ' . $element[$i]["titre"] . '
                                        </a>';
            } ?>

    </div>
    </li>

    <?php

    }
    } ?>

    </ul>
    <ul class="navbar-nav mr-auto">
        <?php


        if (Session::isLogged()) { ?>

            <li class="nav-item">
                <a style="color:white !important;" class="nav-link" href="index.php?cas=FO_UsersActions&action=logout">
                    Deconnexion
                </a>
            </li>
            <li class="nav-item">
                <a style="color:white !important;" class="nav-link"
                   href="index.php?cas=FO_UsersActions&action=editProfile">Profil</a>
            </li>

            <?php
            if (Session::getUserType() == 1 || Session::getUserType() == 3) { ?>

                <li class="nav-item">

                    <form method="post" action="../../BO/public/">

                        <input type="hidden" name="id" value="<?=bin2hex(Session::getUserID())?>">
                        <input type="hidden" name="type" value="<?=bin2hex(Session::getUserType())?>">

                        <button class="btn-link" style="background: rgba(0,0,0,0) !important; border: 0; margin-top: 7px; color:white !important;" class="nav-link" name="adminAccess">Administrateur</button>
                    </form>
                </li>

                <?php
            }
        } else {

            ?>

            <li class="nav-item">
                <a style="color:white !important;" class="nav-link" href="index.php?cas=FO_UsersActions&action=login">Connexion</a>
            </li>
            <li class="nav-item">
                <a style="color:white !important;" class="nav-link"
                   href="index.php?cas=FO_UsersActions&action=register">S'inscrire</a>
            </li>

            <?php
        } ?>

    </ul>
    </div>
</nav>