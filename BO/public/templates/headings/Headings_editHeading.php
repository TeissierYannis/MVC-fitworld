<h1>Modifier rubrique</h1><br>
<form method="POST">
    <div class="form-group">
        <input type="hidden" name="cas" value="BO_Headings">
        <input type="hidden" name="action" value="ViewHeading">
        <label for="title">Titre : </label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $this->headings['titre'];?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu : </label>
        <textarea class="form-control" rows=20 name="content">

        <?= $this->headings['texteHtml']; ?>
        </div>
    </div>
    <div class="form-check">
        <input type="hidden" name="id" value="
        <?= $_REQUEST['idRubrique']; ?>">

        </textarea>
        <input type="submit" class="btn btn-primary" name="editCurrentHeading" value="Modifier"></input>
    </div>
</form>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
    //]]>
</script>