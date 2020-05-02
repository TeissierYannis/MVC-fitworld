<center>
    <h1>Details Sous-Rubrique</h1>
    <br>
    <?php echo empty($this->subHeadings) ? "<h2 style='color:red;'>Unknow Sub-heading</h2>" : ""; ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= $this->subHeadings[0]["titre"]; ?></div>
        <div class="panel-body"><?= $this->subHeadings[0]["texteHtml"]; ?></div>
    </div>
</center>

