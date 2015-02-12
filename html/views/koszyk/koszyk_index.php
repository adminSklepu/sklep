<h1>Koszyk</h1>
<form method="POST" action="/<?= APP_ROOT ?>/koszyk/edit">
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr><th>Nazwa</th><th>Cena</th><th>Ilość</th><th>Usuń</th>  </tr>                  
        <?php
        for ($i = 0; $i < count($produkty); $i++) {
            echo '<tr>';
            echo '<td>' . $produkty[$i]->getNazwa() . '</td>';
            echo '<td>' . $produkty[$i]->getCena() . '</td>';
            echo '<td> <input class="form-control" type="text" name="'. $produkty[$i]->getIdProduktu() .'" value="'. $ilosci[$i] .'"/></td>';
            echo '<td><a href="koszyk/delete/' . $produkty[$i]->getIdProduktu() . '">Usuń</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<button class="btn btn-default" >Zapisz zmiany</button> <br />
<a href="/<?= APP_ROOT ?>/produkt">Kontynuuj zakupy</a>  <br />
<a href="zamowienie/add">Do kasy</a>
</form>