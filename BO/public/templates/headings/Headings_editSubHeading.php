<h1>Modifier sous-rubrique</h1>
<br>
<form method="POST">
    <div class="form-group">
        <input type="hidden" name="cas" value="BO_Headings">
        <input type="hidden" name="action" value="ViewHeading">
        <label for="title">Titre : </label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $this->subHeadings[0]['titre']; ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu : </label>
        <textarea class="form-control" id="content" name="content"
                  rows="20"><?= $this->subHeadings[0]['texteHtml']; ?></textarea>
    </div>
    <div class="form-check">
        <input type="hidden" name="idSubHeading" value="<?= $_REQUEST['idSubHeading']; ?>">
        <input type="hidden" name="idHeading" value="<?= $_REQUEST["idHeading"]; ?>">
    </div>
    <input type="submit" class="btn btn-primary" name="editCurrentSubHeading" value="Modifier"></input>
</form>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
    //]]>
</script>