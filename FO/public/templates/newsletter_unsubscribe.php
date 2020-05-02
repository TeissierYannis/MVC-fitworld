<section class="breadcrumb-area set-bg" data-setbg="../public/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>Désinscription de la Newsletter</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-info">
                    <div class="contact-form">

                        <?= isset($_REQUEST['error']) ? "
                        <div class='alert alert-danger' role='alert'>
                            {$_REQUEST['error']}
                        </div>" : ''; ?>

                        <form id="formunsuscribe" action="" method="post">
                            <input type="hidden" name="cas" value="FO_Newsletter">
                            <input type="hidden" name="action" value="unsubscribe">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="email" class="form-control" name="mail" id="email"  placeholder="Email">
                                </div>
                                <div class="col-lg-12">

                                    <button type="submit" class="site-btn" name="unsubscribe">Désinscription</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>