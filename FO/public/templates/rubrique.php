<section class="breadcrumb-area set-bg" data-setbg="../public/img/blog/blog-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-content">
                    <h2>Article</h2>

                </div>
            </div>
        </div>
    </div>
</section>

<br>

<section class="blog spad-2">
    <div class="container">
        <div class="row">

            <?= "<h1>" . $this->rubrique['titre'] . "</h1><br><br>
                <p>" . $this->rubrique['texteHtml'] . "</p><br><br>";
            ?>

        </div>
    </div>
</section>
}