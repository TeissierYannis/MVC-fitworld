<section class="breadcrumb-area set-bg" data-setbg="../public/img/contact/contact-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>S\'inscrire</h2>

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

                        <form id="formregister" action="index.php?cas=FO_UsersActions&action=register" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Pseudo">
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Verification du mot de passe">
                                </div>
                                <div class="col-lg-12">

                                    <button type="submit" class="site-btn" name="inscription">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <a href="index.php?cas=FO_UsersActions&action=login">Déjà un compte ? Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>