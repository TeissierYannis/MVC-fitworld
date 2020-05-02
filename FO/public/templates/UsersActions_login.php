<section class="breadcrumb-area set-bg" data-setbg="../public/img/elements/element-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>Se connecter</h2>
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

                        <form id="formlogin" action="index.php?cas=FO_UsersActions&action=login" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Pseudo">
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                                </div>

                                <div class="col-lg-12">

                                    <button type="submit" class="site-btn" name="connexion">Connexion</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <a href="index.php?cas=FO_UsersActions&action=register">Pas de compte ? S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>