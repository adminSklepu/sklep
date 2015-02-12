<h1>Edytuj kategorię</h1>
<?php
if (!empty($error)) {  ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php } else if (!empty($success)) {   ?>
    <div class="alert alert-success" role="alert">
    <?= $success ?>
    </div>
    <?php }
$nazwa = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $id = $model->getIdKategorii(); } ?>
<form method="POST" action="/<?= APP_ROOT ?>/kategoria/edit">
    <div class="form-group">
        <label>Nazwa </label>
        <input class="form-control" type="text" name="nazwa" value="<?= $nazwa ?>" />
    </div>
    <input type="hidden" name="id" value="<?= $id ?>" />
    <button class="btn btn-default" type="submit">Zapisz</button><br />
</form>