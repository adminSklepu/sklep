<h1>Usuń zamówienie</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$id = "";
if (!empty($model)) {
    $id = $model->getIdZamowienia();
}
?>
<h3>Czy na pewno chcesz usunąć zamówienie?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/zamowienie/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <button type="submit" name="cancel"  class="btn btn-default" >Anuluj</button> 
    <button type="submit" name="delete" class="btn btn-default" >Usuń </button>
</form>