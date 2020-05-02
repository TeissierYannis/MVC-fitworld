<center>
    <h1>Details rubrique</h1>



    <?php
    if(empty($this->headings)) header('Location:index.php?cas=BO_Headings&action=ViewHeading'); ?>

    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>

    <br>
    <div class="panel panel-info">
        <div class="panel-heading"><?= $this->headings['titre'] ?></div>
        <div class="panel-body"><?= $this->headings['texteHtml'] ?></div>
    </div>
    <br>


    <h1>Liste des sous-rubriques</h1>
    <br>

    <form method="GET" action="" class="form-group">
        <input type="hidden" name="cas" value="BO_Headings">
        <input type="hidden" name="action" value="addSubHeading">
        <button name="addSubHeading" class="btn btn-outline-secondary">Ajouter une sous-rubrique</button>
    </form>

    <div class="col-sm-10">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($this->subHeadings as $subHeading) {

                echo '<tr><th scope="row">' .
                    $subHeading["idRubrique"] . '</th><td>' .
                    $subHeading["titre"] . '</td><td>' .
                    substr(strip_tags($subHeading["texteHtml"]), 0, 50) . '...</td><td>


                <form method="GET" action="" class="form-group">

                    <input type="hidden" name="cas" value="BO_Headings">
                    <input type="hidden" name="id" value="' . $subHeading["idSousRubrique"] . '">
                    <button type="submit" name="deleteSubHeading" class="form-control btn btn-danger">Supprimer</button>
                </form>
                <form method="GET" action="" class="form-group">
                    <input type="hidden" name="cas" value="BO_Headings">
                    <input type="hidden" name="action" value="editSubHeading">
                    <input type="hidden" name="idSubHeading" value="' . $subHeading["idSousRubrique"] . '">
                    <input type="hidden" name="idHeading" value="' . $subHeading["idRubrique"] . '">

                    <button type="submit" name="editSousRubrique" class="form-control btn btn-info" >Editer</button>
                </form>

                <form method="GET" action="" class="form-group">
                    <input type="hidden" name="cas" value="BO_Headings">
                    <input type="hidden" name="action" value="ViewSubHeading">
                    <input type="hidden" name="idSubHeading" value="' . $subHeading["idSousRubrique"] . '">
                    <button type="submit" name="ViewSubHeading" class="form-control btn btn-warning">Afficher</button>
                </form>
            </td>
        </tr>';
            } ?>

            </tbody>
        </table>
    </div>
</center>
