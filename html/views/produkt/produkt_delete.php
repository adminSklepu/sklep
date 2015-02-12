<h1>Usuń produkt</h1>
<?php

$nazwa = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $id = $model->getIdProduktu();
}
?>
<h3>Czy na pewno chcesz usunąć produkt: <b><?=$nazwa?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/produkt/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <button class="btn btn-default" type="submit" name="cancel" >Anuluj</button> <br />
    <button class="btn btn-default" type="submit" name="delete" />Usuń</button>  
</form>