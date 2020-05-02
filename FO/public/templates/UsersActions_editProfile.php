<section class="breadcrumb-area set-bg" data-setbg="../public/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>Mon profil</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="container">
    <div class="container-fluid">
        <ul id="clothingnav1" class="nav nav-tabs" role="tablist">

            <li class="nav-item"><a style="color: black" class="nav-link active " href="#home1" id="hometab1" role="tab"
                                    data-toggle="tab" aria-controls="home" aria-expanded="true">Informations</a></li>
            <li class="nav-item"><a style="color: black" class="nav-link " href="#paneTwo1" role="tab" id="hatstab1"
                                    data-toggle="tab" aria-controls="hats">Modifier le mot de passe</a></li>
            <li class="nav-item"><a style="color: black" class="nav-link " href="#paneTwo2" role="tab" id="hatstab2"
                                    data-toggle="tab" aria-controls="hats">Modifier l'adresse email</a></li>
            <li class="nav-item"><a style="color: black" class="nav-link " href="#paneTwo3" role="tab" id="hatstab3"
                                    data-toggle="tab" aria-controls="hats">Abonnement</a></li>
        </ul>
        <br>
        <!-- Content Panel -->
        <div id="clothingnavcontent1" class="tab-content">
            <div role="tabpanel" class="tab-pane fade show active" id="home1" aria-labelledby="hometab1">
                <div class="row">
                    <div class="col-xl-2">Pseudo</div>
                    <div class="col-xl-6"><?= $this->infos['pseudo'] ?></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-2">Adresse email</div>
                    <div class="col-xl-6"><?= $this->infos["email"] ?></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-2">Abonnement</div>
                    <div class="col-xl-6">
                        <?php
                        if(isset($this->subscription[0]["idAbonnement"])){

                        if(date('d-m-Y') <(new DateTime($this->subscription[0]["dateFin"]))->format('d-m-Y'))
                            echo 'Fin le '. (new DateTime($this->subscription[0]["dateFin"]))->format('d/m/Y');
                        else
                        echo 'Contrat terminé le ' . (new
                        DateTime($this->subscription[0]["dateFin"]))->format('d/m/Y') . '</p>';

                        }else
                        echo 'Aucun contrat</p>'; ?>

                    </div>
                </div>
                <br>

                <?php
                if(isset($this->subscription[0]["idAbonnement"])) {
                echo '
                <div class="row">
                    <div class="col-xl-2">Statut du paiement</div>
                    <div class="col-xl-6">';


                        if ($this->subscription[0]['monthlyPayment'] > date('Y-m-d')) {
                        echo '<p style="color:green">Paiement reçu</p>';
                        } else {
                        echo '<p style="color:red">En attente de paiement</p>';
                        }
                        ?>

                    </div>
                </div>
                <br>

                <?php } ?>

                <div class="col-xl-8">
                    <button id="btn-contact" (click)="clearModal()" data-toggle="modal"
                            data-target="#modaleSuppressionCompte" class="btn btn-danger btn-block follow">Supprimer mon
                        compte
                    </button>
                </div>
                <br><br>
            </div>
            <div role="tabpanel" class="tab-pane fade " id="paneTwo1" aria-labelledby="hatstab1">
                <form>
                    <form method="post" class="contact-form">

                        <div class="form-group">
                            <input type="hidden" name="cas" value="FO_UsersActions">
                            <input type="hidden" name="action" value="editProfile">
                        </div>
                        <div class="form-group">
                            <label for="txtPasswordActuel">Mot de passe actuel</label>
                            <input type="password" id="txtPasswordActuel" class="form-control" name="passwordActuel">
                        </div>
                        <div class="form-group">
                            <label for="txtPasswordNouveau">Nouveau mot de passe</label>
                            <input type="password" id="txtPasswordNouveau" class="form-control" name="passwordNouveau">
                        </div>
                        <div class="form-group">
                            <label for="txtPasswordNouveauRepeat">Confirmation nouveau mot de passe</label>
                            <input type="password" id="txtPasswordNouveauRepeat" class="form-control"
                                   name="passwordNouveauRepeat">
                        </div>
                        <button type="submit" name="validerInfosPassword" class="btn btn-primary">Valider</button>
                    </form>

            </div>
            <div role="tabpanel" class="tab-pane fade " id="paneTwo2" aria-labelledby="hatstab2">
                <form class="contact-form" method="post">

                    <div class="form-group">
                        <input type="hidden" name="cas" value="FO_UsersActions">
                        <input type="hidden" name="action" value="editProfile">
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>

                        <input type="email" id="txtEmail" class="form-control" name="email" value="<?=$this->infos['email']?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe actuel</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                    <button type="submit" name="validerInfos" class="btn btn-primary">Valider</button>
                </form>

            </div>
            <div role="tabpanel" class="tab-pane fade " id="paneTwo3" aria-labelledby="hatstab3">

                <?php

                if(isset($this->subscription[0]['monthlyPayment']) && !($this->subscription[0]['monthlyPayment'] >
                date('Y-m-d'))){
                echo '
                <button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#modalePayer"
                        class="btn btn-primary btn-block follow">Payer
                </button>
                '; ?>

                <br>
                <form class="contact-form">
                    <input type="hidden" name="cas" value="FO_UsersActions">
                    <input type="hidden" name="action" value="editProfile">
                    <br>
                    <button input="submit" name="annulerAbonnement" class="btn btn-secondary btn-block">Annuler mon
                        abonnement
                    </button>
                </form>

                <?php
                }else{
                if (!isset($this->subscription[0]["idAbonnement"]))  {

                echo '<a href="index.php?cas=FO_UsersActions&action=buy" class="btn btn-secondary btn-block">Souscrire
                    à un abonnement</a>';

                }else{
                echo '
                <br>
                <form class="contact-form">
                    <input type="hidden" name="cas" value="FO_UsersActions">
                    <input type="hidden" name="action" value="editProfile">
                    <br>
                    <button input="submit" name="annulerAbonnement" class="btn btn-secondary btn-block">Annuler mon
                        abonnement
                    </button>
                </form>
                ';
                }
                }
                    ?>

            </div>

        </div>


        <?= isset($_REQUEST['error']) ? "
            <div class='alert alert-danger' role='alert'>
                {$_REQUEST['error']}
            </div>" : '';
        ?>

    </div>
    <br>
    <br>
    <br>
    <br>


</section>


<!-- MODALES -->

<div class="modal fade" id="modaleSuppressionCompte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleSuppressionCompte">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger">Toutes mes informations serons perdus, aucun retour en arrière n'est possible !
                    <br>
                    Mon abonnement sera annulé et mon compte entièrement supprimé !</h5>
                <form method="post">

                    <div class="form-group">
                        <input type="hidden" name="cas" value="FO_UsersActions">
                        <input type="hidden" name="action" value="editProfil">
                    </div>
                    <button type="submit" name="supprimerCompte" class="btn btn-primary">Je suis sur de vouloir
                        supprimer mon compte
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalePayer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalePayer">Payer l'abonnement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger">Vous devez payer votre mensualité</h5>
                <form method="post">

                    <div id="paypal-button-container"></div>

                    <h1 id="errorDisplay"></h1>
                    <div id="dataSuccess" data-success></div>
                    <script
                            src="https://www.paypal.com/sdk/js?client-id=Aco8_XC33cjeZEr6tmt2zC743oVHW3Olbo6khl6FO9e3kOXSSCzoXTboHcZdXYhFwUAJIEBVllifkVJT&currency=EUR">
                    </script>


                    <script>

                        function updateData() {
                            let dataSuccess = document.querySelector("#dataSuccess").dataset.success;
                            return JSON.parse(dataSuccess);
                        }

                        //var url = "transactionID=" + details.purchase_units.0.payments.captures.0.id + "&paymentStatus=" + details.purchase_units.0.payments.captures.0.status + "&element=" + details.purchase_units.0.reference_id;
                        paypal.Buttons({
                            createOrder: function (data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        "reference_id": "abo1",
                                        amount: {
                                            "value": "0.01",
                                            "currency": "EUR",
                                        }
                                    }]

                                });
                            },
                            onCancel: function (data) {
                                // ANNULATION
                                document.onclick = new Function("return true");
                                document.getElementById("errorDisplay").innerHTML = "Paiement annulé";
                            },
                            onError: function (err) {
                                // ERREUR
                                document.onclick = new Function("return true");
                                document.getElementById("errorDisplay").innerHTML = "Une erreur est survenue " + err;

                            },
                            onApprove: function (data, actions, fs) {
                                return actions.order.capture().then(function (details) {
                                    // TRANSACTION EFFECTUE

                                    document.getElementById("errorDisplay").innerHTML = details.payer.name.given_name;
                                    document.querySelector("#dataSuccess").setAttribute("data-success", JSON.stringify(details));
                                    var dataSuccess = updateData();

                                    document.location.replace("index.php?cas=FO_UsersActions&action=transactionSuccess&transactionID="
                                        + dataSuccess.purchase_units[0].payments.captures[0].id + "&paymentStatus="
                                        + dataSuccess.purchase_units[0].payments.captures[0].status + "&element="
                                        + dataSuccess.purchase_units[0].reference_id + "&date="
                                        + dataSuccess.create_time);
                                });
                            },

                        }).render("#paypal-button-container");
                    </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>