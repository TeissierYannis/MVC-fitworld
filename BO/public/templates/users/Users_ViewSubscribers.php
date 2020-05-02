
<?php

use TeissierYannis\Utils\BO\Session; ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gestion des utilisateurs abonné</h1>
    <br>

    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>

    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Utilisateurs abonné</h6>
            <br>
            <div class="form-check-inline col-sm-10">
                <input class="form-control col-smfa-rotate-180" id="search" value="<?= (isset($_REQUEST['search'])) ? $_REQUEST['search'] : '' ?>"type="text" placeholder="Rechercher..">
                <div class="dropdown col-sm-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filtre
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="filter-item dropdown-item" name="Valide" href="#">Abonnement valide</a></li>
                        <li><a class="filter-item dropdown-item" name="Terminé" href="#">Abonnement fini</a></li>
                        <li><a class="filter-item dropdown-item" name="EN ATTENTE" href="#">Payment en attente</a></li>
                        <li><a class="filter-item dropdown-item" name="PAYE" href="#">Payé</a></li>
                        <li><a class="filter-item dropdown-item" name="" href="#">Tous</a></li>

                    </ul>
                </div>
            </div>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pseudo</th>
                        <th>Statut abonnement</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut paiment</th>

                        <?php


                        if(!Session::getUserType() == 3) {
                         echo '<th scope="col">Actions</th>';
                        }
                        ?>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Pseudo</th>
                        <th>Statut abonnement</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut paiment</th>

                        <?php
                        if(!Session::getUserType() == 3) {
                        echo '<th scope="col">Actions</th>';
                        }
                        ?>

                    </tr>
                    </tfoot>
                    <tbody>

                    <?php
                    foreach ($this->datas as $abo) {
                        echo '<tr class="search-item">
                        <th scope="row">' .
                            $abo["idAbonnement"]  .
                            '</th>
                        <td>'.
                            $abo["pseudo"] .
                            '</td>
                        <td>';


                            if((new DateTime())->format('Y-m-d') < (new DateTime($abo['dateFin']))->format('Y-m-d')) {
                             echo  'Valide';
                            } else {
                            echo 'Contrat terminé le ' . (new DateTime($abo["dateFin"]))->format('d/m/Y');
                            }

                            echo '
                        </td>
                        <td>'.
                            $abo['dateAchat']
                            .'</td>
                        <td>'.
                            $abo['dateFin']
                            .'</td>
                        <td>';

                            if ((new DateTime($abo['monthlyPayment']))->format('Y-m-d') > (new DateTime())->format('Y-m-d')) {
                             echo 'PAYE';
                            } else {
                             echo 'EN ATTENTE';
                            }

                            echo '
                        </td><td>';

                            if(!Session::getUserType() == 3) {
                            echo  '
                            <form method="GET" action="">
                                <input type="hidden" name="cas" value="BO_Utilisateurs">
                                <input type="hidden" name="action" value="visualiserUtilisateursAbonne">
                                <input type="hidden" name="idInscrit" value="'. $abo["id"] .'">
                                <input type="submit" name="supprimerAbonnement" class="btn btn-danger" value="Suspendre">
                            </form>

                        </td>
                    </tr>';
                    }
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- DEBUT FILTRE -->

<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function(){
        var value = $("#search").val().toLowerCase();
        if(value){
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }
    });

    $(document).ready(function(){
        $(".filter-item").on("click", function() {
            var value = $(this).attr("name").toLowerCase();
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<!-- FIN FILTRE -->