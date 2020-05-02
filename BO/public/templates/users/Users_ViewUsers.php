<?php

use TeissierYannis\Utils\BO\Session;

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gestion des utilisateurs inscrit</h1>
    <br>

    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>


    <button data-toggle="modal" data-target="#modalAjouterCompte" class="btn btn-outline-secondary">Ajouter un compte
    </button>
    <br><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Utilisateurs inscrit</h6>
            <br>
            <div class="form-check-inline col-sm-10">
                <input class="form-control col-smfa-rotate-180" id="search"
                       value="<?= (isset($_REQUEST['search'])) ? $_REQUEST['search'] : ''?>"
                       type="text" placeholder="Rechercher..">
                <div class="dropdown col-sm-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filtre
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="filter-item dropdown-item" name="admin" href="#">Administrateur</a></li>
                        <li><a class="filter-item dropdown-item" name="modérateur" href="#">Modérateur</a></li>
                        <li><a class="filter-item dropdown-item" name="utilisateur" href="#">Utilisateurs</a></li>
                        <li><a class="filter-item dropdown-item" name="" href="#">Tous</a></li>
                    </ul>
                </div>
            </div>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Type de compte</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Type de compte</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                    foreach($this->datas as $user){

                    echo '
                    <tr class="search-item">
                        <th scope="row">' .
                            $user["id"] .
                            '
                        </th>
                        <td>'.
                            $user["pseudo"] .
                            '
                        </td>
                        <td>'.
                            $user["email"] .
                            '
                        </td>
                        <td>';

                            if($user["accountType"] == 1)
                            echo "Admin";
                            else if($user["accountType"] == 2)
                            echo "Utilisateur";
                            else
                            echo "Modérateur";
                            ?>

                        </td>
                        <td>

                            <?php
                            if(Session::getUserType() == 3 && $user["accountType"] == 1) {
                            }else{
                            echo '
                            <button data-toggle="modal" id="modifier" data-target="#modalModifierCompte"
                                    class="btn btn-primary d-inline-block" onclick="$(function() {
                            let email = document.querySelector(\'#idUserForFormEmail\');
                            let password = document.querySelector(\'#idUserForFormPassword\');
                            let type = document.querySelector(\'#idUserForFormType\');
                            email.value = '.$user["id"].';
                            password.value = '.$user["id"].';
                            type.value = '.$user["id"].';
                            })">Modifier</button>
                            <form class="d-inline-block" method="GET" action="">
                                <br>
                                <input type="hidden" name="cas" value="BO_Users">
                                <input type="hidden" name="action" value="ViewUsers">
                                <input type="hidden" name="idInscrit" value="'. $user["id"] .'">
                                <input type="hidden" name="accountType" value="'. $user["accountType"] .'">
                                <input type="submit" name="deleteAccount" class="btn btn-danger" value="Supprimer">
                            </form>

                        </td>
                    </tr>
                    ';
                    }
                    }

                ?>

                    </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Espace modale -->

<!-- AJOUTER UN COMPTE -->
<div id="modalAjouterCompte" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="hidden" name="cas" value="BO_Users">
                        <input type="hidden" name="action" value="ViewUsers">
                        <small><label for="pseudo">Pseudo</label></small>
                        <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Jino" required>
                    </div>
                    <div class="form-group">
                        <small><label for="password">Mot de passe</label></small>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <small><label for="passwordRepeat">Vérification du mot de passe</label></small>
                        <input name="passwordRepeat" type="password" class="form-control" id="passwordRepeat" required>
                    </div>
                    <div class="form-group">
                        <small><label for="choixPermissions">Type de compte</label></small>
                        <select name="typeAccount" class="form-control" id="choixPermissions" required>';

                            <?php
                            if(Session::getUserType() == 1){
                            echo '
                            <option>Admin</option>
                            ';
                            }
                            ?>

                            <option>Modérateur</option>
                            <option>Utilisateur</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="addUserAccount" value="Ajouter un compte">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN AJOUTER UN COMPTE -->

<div id="modalModifierCompte" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="get">
                    <div class="form-group">
                        <input type="hidden" name="idUser" id="idUserForFormEmail">
                        <input type="hidden" name="cas" value="BO_Users">
                        <input type="hidden" name="action" value="ViewUsers">
                        <small><label for="email">Email</label></small>
                        <input type="email" name="email" class="form-control" id="email" placeholder="email@email.fr"
                               required>
                    </div>
                    <input type="submit" class="btn btn-primary" onclick="" name="modifierAccountUser"
                           value="Modifier email">
                </form>
                <form action="" method="get">
                    <div class="form-group">
                        <input type="hidden" name="idUser" id="idUserForFormPassword">
                        <input type="hidden" name="cas" value="BO_Users">
                        <input type="hidden" name="action" value="ViewUsers">
                        <small><label for="password">Mot de passe</label></small>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <small><label for="passwordRepeat">Vérification du mot de passe</label></small>
                        <input name="passwordRepeat" type="password" class="form-control" id="passwordRepeat" required>
                    </div>
                    <input type="submit" class="btn btn-primary" name="modifierAccountUser"
                           value="Modifier mot de passe">
                </form>
                <form action="" method="get">
                    <div class="form-group">
                        <input type="hidden" id="idUserForFormType" name="idUser">
                        <input type="hidden" name="cas" value="BO_Users">
                        <input type="hidden" name="action" value="ViewUsers">
                        <small><label for="choixPermissions">Type de compte</label></small>
                        <select name="typeAccount" class="form-control" id="choixPermissions" required>';

                            <?php


                            if(Session::getUserType() == 1) {

                                echo '<option>Admin</option>';
                            }
                            ?>
                            <option>Modérateur</option>
                            <option>Utilisateur</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="modifierAccountUser" value="Modifier type">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
    <!-- FIN MODIFIER UTILISATEUR -->

    <!-- DEBUT FILTRE -->

    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                let value = $(this).val().toLowerCase();
                $("#table .search-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            let value = $("#search").val().toLowerCase();
            if (value) {
                $("#table .search-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            }
        });

        $(document).ready(function () {
            $(".filter-item").on("click", function () {
                let value = $(this).attr("name").toLowerCase();
                $("#table .search-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- FIN FILTRE -->