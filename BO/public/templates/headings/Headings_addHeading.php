<center>
    <h1>Ajouter une rubrique</h1>
    <br>
    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>
    <form method="POST" action="">
        <div class="form-group row">
            <input type="hidden" name="cas" value="BO_Headings">
            <input type="hidden" name="action" value="ViewHeading">
            <label for="title" class="col-sm-2">Titre : </label>
            <input type="text" class="form-control col-sm-8" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="content">Contenu : </label>
            <textarea rows=20 class="form-control" id="content" name="content"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" name="addNewHeading" value="Ajouter"></input>
    </form>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function () {
            nicEditors.allTextAreas()
        });
        //]]>
    </script>
</center>