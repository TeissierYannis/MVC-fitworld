<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gestion de tous les utilisateurs</h1>
    <br>

    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>

    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tous les Utilisateurs</h6>
            <br>
            <div class="form-check-inline col-sm-10">
                <input class="form-control col-smfa-rotate-180" id="search" value="<?=isset($_REQUEST['search']) ? $_REQUEST['search'] : ''?>" type="text" placeholder="Rechercher..">
                <div class="dropdown col-sm-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filtre
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="filter-item dropdown-item" name="Valide" href="#">Abonnement valide</a></li>
                        <li><a class="filter-item dropdown-item" name="fini" href="#">Abonnement fini</a></li>
                        <li><a class="filter-item dropdown-item" name="aucun" href="#">Aucun abonnement</a></li>
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
                        <th>Pseudo</th>
                        <th>Abonnement</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Pseudo</th>
                        <th>Abonnement</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php
                    foreach($this->datas['users'] as $user){
                   echo '
                    <tr class="search-item">
                        <th scope="row">
                            <a href="index.php?cas=BO_Users&action=ViewUsers&search='. $user["pseudo"] .'">
                            '.$user["pseudo"].'
                            </a>
                        </th>
                        <td>
                            Aucun
                        </td>
                    </tr>';
                    }

                    foreach($this->datas['subscribers'] as $abo){
                    ?>

                    <tr class="search-item">
                        <th scope="row">
                            <a href="index.php?cas=BO_Users&action=ViewSubscribers&search=<?=$abo["pseudo"]?>">
                            <?=$abo["pseudo"]?>
                            </a>
                        </th>
                        <td>
                            <a href="index.php?cas=BO_Users&action=ViewSubscribers&search=<?=$abo["pseudo"]?>">
                            <?php

                            if((new DateTime())->format('Y-m-d') < (new DateTime($abo['dateFin']))->format('Y-m-d')) {
                                echo  'Valide';
                            } else {
                                echo 'Contrat terminé le ' . (new DateTime($abo["dateFin"]))->format('d/m/Y');
                            }
                            ?>
                            </a></td>
                    </tr>
                    <?php } ?>

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
            let value = $(this).val().toLowerCase();
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function(){
        let value = $("#search").val().toLowerCase();
        if(value){
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }
    });

    $(document).ready(function(){
        $(".filter-item").on("click", function() {
            let value = $(this).attr("name").toLowerCase();
            $("#table .search-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<!-- FIN FILTRE -->