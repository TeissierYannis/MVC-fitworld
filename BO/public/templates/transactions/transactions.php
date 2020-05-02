<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Toutes les transactions</h1>
    <br>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
            <br>
            <div class="form-check-inline col-sm-10">
                <form class="form-check-inline col-sm-10">
                    <input class="form-control col-smfa-rotate-180" id="search" type="text" placeholder="Rechercher..">
                    <div class="dropdown col-sm-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filtre
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="filter-item dropdown-item" name="COMPLETED" href="#">Transaction validé</a>
                            </li>
                            <li><a class="filter-item dropdown-item" name="Abonnement" href="#">Abonnement</a></li>
                            <li><a class="filter-item dropdown-item" name="29" href="#">Prix</a></li>
                            <li><a class="filter-item dropdown-item" name="Compte supprimé" href="#">Compte supprimé</a></li>
                            <li><a class="filter-item dropdown-item" name="" href="#">Tous</a></li>
                        </ul>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Statut</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Date mensualité</th>
                        <th>Utilisateur</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Statut</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Date mensualité</th>
                        <th>Utilisateur</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($this->transactions as $transaction) { ?>
                        <tr class="search-item">
                            <th scope="row">
                                <?= $transaction["transactionId"] ?>
                            </th>
                            <td>
                                <?= $transaction["paymentStatus"]; ?>
                            </td>
                            <td>
                                <?php
                                if ($transaction["typeAchat"] == "abo1")
                                    echo 'Abonnement';
                                else echo '?' ?>
                            </td>
                            <td>
                                <?php
                                if ($transaction["typeAchat"] == "abo1")
                                    echo '29';
                                else echo '?'; ?>
                            </td>
                            <td>
                                <?= $transaction["monthlyPayment"]; ?>
                            </td>
                            <td>
                                <?php
                                if (!is_null($transaction["idUser"])) {
                                    $i = 0;
                                    while ($transaction["idUser"] != $this->pseudos[$i]['id']) {
                                        $i++;
                                    }
                                    echo $this->pseudos[$i]['pseudo'];
                                } else echo 'Compte supprimé'; ?>
                            </td>
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