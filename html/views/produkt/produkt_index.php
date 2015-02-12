<?php
?>
<h1>Lista produktów</h1>
<br />

<?php
  global $isAdmin;
if (!$isAdmin) {
    ?>
    <!-- WYBÓR KATEGORII -->
    <div class="form-group">
        <label>Wybierz kategorię</label>
        <select id="kategoria" name="kategoria" class="form-control">
            <option value="Wszystkie">Wszystkie</option>
            <?php
            foreach ($kategorie as $kategoria) {
                echo '<option value="' . $kategoria->getIdKategorii() . '">' . $kategoria->getNazwa() . '</option>';
            }
            ?>
        </select>
        <br />
    </div>
    <?php
}
?>


<div class="table-responsive">
    <table id="produkty" class="table table-bordered table-hover">

            <tr><th>Nazwa</th><th>Cena</th><th>Kategoria</th><th>Opis</th><th>Dodaj do koszyka</th> 
                <?php
                if ($isAdmin) {
                    ?>
                    <th>Edytuj</th><th>Usuń</th>
                    <?php
                }
                ?>
            </tr>
            <?php
            foreach ($produkty as $produkt) {
                echo '<tr>';
                echo '<td>' . $produkt->getNazwa() . '</td>';
                echo '<td>' . $produkt->getCena() . '</td>';
                echo '<td>' . $produkt->getKategoria()->getNazwa() . '</td>';
                echo '<td>' . $produkt->getOpis() . '</td>';
                echo '<td><a href="koszyk/add/' . $produkt->getIdProduktu() . '">Dodaj do koszyka</a></td>';
                if ($isAdmin) {
                    echo '<td><a href="produkt/edit/' . $produkt->getIdProduktu() . '">Edytuj</a></td>';
                    echo '<td><a href="produkt/delete/' . $produkt->getIdProduktu() . '">Usuń</a></td>';
                }
                echo '</tr>';
            }
            ?>
    </table>
</div>
<br />
<?php
if ($isAdmin) {
    ?>
    <a href="produkt/add">Dodaj</a>
    <?php
}
?>

  
 <!--SKRYPT JQUERY - ŻĄDANIE AJAX -->
<script>
    $("#kategoria").change(function () {
        var kat = $("#kategoria option:selected").val();
        $.ajax({
            url: 'html/async/getProductsByCategory.php',
            type: 'GET',
            data: {kategoria: kat},
            dataType : "html",
            contentType: 'application/html; charset=utf-8',
            success: function (response) {
                
                $("#produkty").html(response);
            },
            error: function () {
                alert("error");
            }
        });
    })
</script>
