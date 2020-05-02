<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gestion des inscrit à la Newsletter</h1>
    <br>

    <?= isset($_REQUEST['error']) ? "
       <div class='alert alert-danger' role='alert'>
            {$_REQUEST['error']}
       </div>" : ''; ?>

    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inscrits newsletter</h6>
            <br>
            <div class="form-check-inline col-sm-10">
                <input class="form-control col-smfa-rotate-180" id="search"
                       value="<?= isset($_REQUEST['search']) ? $_REQUEST['search'] : ''; ?>" type="text"
                       placeholder="Rechercher..">
            </div>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>EMAIL</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>EMAIL</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php
                    foreach ($this->subscribers as $subscriber) {
                        ?>
                        <tr class="search-item">
                            <th scope="row">
                                <?= $subscriber["idInscrit"] ?>
                            </th>
                            <td>
                                <?= $subscriber["mail"] ?>
                            </td>
                            <td>
                                <form method="GET" action="">
                                    <input type="hidden" name="cas" value="BO_Newsletter">
                                    <input type="hidden" name="action" value="ViewSubscribers">
                                    <input type="hidden" name="id" value="<?= $subscriber["idInscrit"] ?>">
                                    <input type="submit" name="deleteSubscriber" class="btn btn-danger"
                                           value="Supprimer">
                                </form>
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<!-- DEBUT FILTRE -->

<script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            let value = $(this).val().toLowerCase();
            $("#table .search-item").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        let value = $("#search").val().toLowerCase();
        if (value) {
            $("#table .search-item").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }
    });

    $(document).ready(function () {
        $(".filter-item").on("click", function () {
            let value = $(this).attr("name").toLowerCase();
            $("#table .search-item").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: 'focus'
        })
    })


</script>
<!-- FIN FILTRE -->