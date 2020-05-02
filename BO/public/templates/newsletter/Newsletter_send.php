<center>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Envoi de la Newsletter</h1>
        <br>

        <br>
        <div class="card shadow mb-4">

            <form action="" method="get">
                <div class="form-group row">

                    <input type="hidden" name="to" value='<?= json_encode($this->subscribers, JSON_FORCE_OBJECT); ?>'>
                </div>
                <div class="form-group">
                    <input type="hidden" name="cas" value="BO_Newsletter">
                    <input type="hidden" name="action" value="ViewSubscribers">
                    <textarea class="form-control" id="content" name="content" rows="20">Contenu de la newsletter</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control col-sm-10" id="submit" name="sendNewsletter"
                           value="Envoyer">
                </div>
            </form>


        </div>
        <!-- /.container-fluid -->

    </div>

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function () {
            nicEditors.allTextAreas()
        });
        //]]>
    </script>
</center>