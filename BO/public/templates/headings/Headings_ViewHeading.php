<center><br><br>
    <h1>Liste des rubriques</h1><br>
    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>

    <form method="GET" action="" class="form-group">
        <input type="hidden" name="cas" value="BO_Headings">
        <input type="hidden" name="action" value="addHeading">
        <button class="btn btn-outline-secondary"></span> Ajouter une rubrique</button>
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
            foreach ($this->headings as $heading) {
                echo '<tr><th scope="row">' .
                    $heading["idRubrique"] . '</th><td>' .
                    $heading["titre"] . '</td><td>' .
                    substr(strip_tags($heading["texteHtml"]), 0, 50) . '...</td><td>
                   
                   
                    <form method="POST" action="" class="form-group">
                              
                        <input type="hidden" name="cas" value="BO_Headings">
                        <input type="hidden" name="action" value="ViewHeading">
                        <input type="hidden" name="id" value="' . $heading["idRubrique"] . '">
                         <button type="submit" name="deleteHeading" class="form-control btn btn-danger">Supprimer</button>
                     </form>
                     <form method="POST" action="" class="form-group">
                     <input type="hidden" name="cas" value="BO_Headings">
                        <input type="hidden" name="action" value="editHeading">
                        <input type="hidden" name="idRubrique" value="' . $heading["idRubrique"] . '">
                         <button type="submit" name="editRubrique" class="form-control btn btn-info" >Editer</button>
                     </form>
                     <form method="POST" action="" class="form-group">
                     <input type="hidden" name="cas" value="BO_Headings">
                        <input type="hidden" name="action" value="detailsHeading">
                        <input type="hidden" name="id" value="' . $heading["idRubrique"] . '">
                         <button type="submit" name="detailsHeading" class="form-control btn btn-warning">Afficher</button>
                     </form>
                    </td>
                 </tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</center>