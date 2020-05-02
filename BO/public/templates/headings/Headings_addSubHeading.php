<center>
    <h1>Ajouter une sous-rubrique</h1><br>

    <form method="POST">
        <div class="form-group col-md-2">
            <label for="idHeading">Rubrique</label>

            <select name="idHeading" id="idHeading" class="form-control">

                <?php foreach ($this->headings as $headings) { ?>
                    <option><?= $headings["idRubrique"] . ' - ' . $headings["titre"] ?></option>

                <?php } ?>

            </select>
        </div>

        <div class="form-group col-md-10">
            <input type="hidden" name="cas" value="ViewHeading">
            <input type="hidden" name="action" value="ViewHeading">
            <label for="title">Titre : </label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group col-md-12">
            <label for="content">Contenu : </label>
            <textarea class="form-control" name="content" rows="20"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="addNewSubHeading" value="Ajouter"></input>
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
</center>