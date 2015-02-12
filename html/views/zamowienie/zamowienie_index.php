<h1>Lista zamówień</h1>
<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>
                Id
            </th>
            <th>
                Produkty
            </th>
            <th>
                Cena
            </th>
            <th>
                Data zamówienia
            </th>
            <th>
                Data realizacji
            </th>
            <th>
                Adres
            </th>
            <th>
                Uwagi
            </th>
            <th>
                Status
            </th>
            <th>
                Realizuj
            </th>
            <th>
                Usuń
            </th>
        </tr>
        <?php
        foreach ($zamowienia as $zamowienie) {
            echo '<tr>';
            echo '<td>' . $zamowienie->getIdZamowienia() . '</td>';
            echo '<td><div class="table-responsive"><table class="table table-bordered">'
            . '<tr><th>Nazwa</th><th>Cena</th><th>Ilość</th></tr>';
            foreach ($zamowienie->getProdukty() as $produktZamowienie) {
                echo '<tr>';
                echo '<td>' . $produktZamowienie->getProdukt()->getNazwa() . '</td>';
                echo '<td>' . $produktZamowienie->getProdukt()->getCena() . '</td>';
                echo '<td>' . $produktZamowienie->getIlosc() . '</td>';
                echo '</tr>';
            }
            echo '</table></div></td>';
            echo '<td>' . $zamowienie->getCena() . '</td>';
            echo '<td>' . $zamowienie->getDataZamowienia() . '</td>';
            echo '<td>' . $zamowienie->getDataRealizacji() . '</td>';
            echo '<td>' . $zamowienie->getAdres() . '</td>';
            echo '<td>' . $zamowienie->getUwagi() . '</td>';
            echo '<td>' . $zamowienie->getStatus() . '</td>';
            echo '<td><a href="zamowienie/realize/' . $zamowienie->getIdZamowienia() . '">Realizuj</a></td>';
            echo '<td><a href="zamowienie/delete/' . $zamowienie->getIdZamowienia() . '">Usuń</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>



