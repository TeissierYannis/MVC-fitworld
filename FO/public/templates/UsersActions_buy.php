<section class="breadcrumb-area set-bg" data-setbg="../public/img/blog/blog-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>S'abonner</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<center>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div id="paypal-button-container"></div>

            <h1 style="color:red" id="errorDisplay"></h1>
            <div id="dataSuccess" data-xzf2 data-success></div>
            <script
                    src="https://www.paypal.com/sdk/js?client-id=Aco8_XC33cjeZEr6tmt2zC743oVHW3Olbo6khl6FO9e3kOXSSCzoXTboHcZdXYhFwUAJIEBVllifkVJT&currency=EUR">
            </script>


            <script>

                function updateData() {
                    var dataSuccess = document.querySelector("#dataSuccess").dataset.success;
                    return JSON.parse(dataSuccess);
                }

                function xzf2() {
                    var xzf2 = document.querySelector("#dataSuccess").dataset.xzf2;
                    return xzf2;
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
                        document.getElementById("errorDisplay").innerHTML = "Une erreur est survenue ";

                    },
                    onApprove: function (data, actions, fs) {
                        return actions.order.capture().then(function (details) {
                            // TRANSACTION EFFECTUE
                            document.onclick = new Function("return false");
                            document.querySelector("#dataSuccess").setAttribute("data-success", JSON.stringify(details));
                            document.querySelector("#dataSuccess").setAttribute("data-xzf2", "xzf2");
                            var dataSuccess = updateData();
                            document.getElementById("errorDisplay").innerHTML = "Redirection patientez...";
                            document.location.replace("index.php?cas=FO_UsersActions&action=transactionSuccess&transactionID="
                                + dataSuccess.purchase_units[0].payments.captures[0].id + "&paymentStatus="
                                + dataSuccess.purchase_units[0].payments.captures[0].status + "&element="
                                + dataSuccess.purchase_units[0].reference_id + "&date="
                                + dataSuccess.create_time + "xzf2=" +
                                +xzf2);
                        });
                    },

                }).render("#paypal-button-container");


            </script>
        </div>
    </div>
</div>
</center>