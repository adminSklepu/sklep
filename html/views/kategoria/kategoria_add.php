<h1>Dodaj kategorię</h1>
<?php
if (!empty($error)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php }
else if (!empty($success)) {  ?> 
    <div class="alert alert-success" role="alert">
        <?= $success ?>
    </div>
    <?php } ?>
<form method="POST" action="/<?= APP_ROOT ?>/kategoria/add">
    <div class="form-group">
        <label>Nazwa </label>
    <input type="text" name="nazwa" class="form-control"/>  
    </div>
    <button class="btn btn-default" type="submit">Dodaj</button>
</form>