<h1>Zapłać za zamówienie</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$id = "";
if (!empty($model)) {
    $id = $model->getIdZamowienia();
}
?>
<h3>Czy na pewno chcesz zapłacić za zamówienie?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/zamowienie/pay">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <button type="submit" name="cancel" class="btn btn-default">Anuluj</button> 
    <button type="submit" name="pay"  class="btn btn-default" > Zapłać</button>
</form> 