<h1>Edytuj produkt</h1>
<?php
$nazwa = "";
$cena = "";
$opis = "";
$kategorie = array();
$id = "";

if (!empty($model)) {
    $id = $model->getIdProduktu();
    $nazwa = $model->getNazwa();
    $cena = $model->getCena();
    $opis = $model->getOpis();
    $kategoriaProduktu = $model->getKategoria();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/produkt/edit">
    <div class="form-group">
        <label>Nazwa </label>
        <input class="form-control" type="text" name="nazwa" value="<?= $nazwa ?>" /> 
        <input type="hidden" name="id" value="<?= $id ?>" />
    </div>
    <div class="form-group">
        <label>Cena </label>
        <input class="form-control" type="text" name="cena"  value="<?= $cena ?>"/> 
    </div>
    <div class="form-group">
        <label>Kategoria</label>
        <select name="kategoria" class="form-control">
            <?php
            foreach ($kategorieAll as $kategoria) {
                if ($kategoria['id_kategorii'] == $kategoriaProduktu->getIdKategorii()) {
                    echo '<option value="' . $kategoria['id_kategorii'] . '" selected>' . $kategoria['nazwa'] . '</option>';
                } else {
                    echo '<option value="' . $kategoria['id_kategorii'] . '" >' . $kategoria['nazwa'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Opis </label>
        <input class="form-control" type="text" name="opis" value="<?= $opis ?>"/> 
    </div>

    <button type="submit"  class="btn btn-default" >Zapisz</button> 
</form>