<h1>Lista kategorii</h1>
<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th><th>Nazwa</th><th>Edytuj</th><th>Usuń</th>                                                               
        </tr>
        <?php
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['id_kategorii'] . '</td>';
            echo '<td>' . $row['nazwa'] . '</td>';
            echo '<td><a href="kategoria/edit/' . $row['id_kategorii'] . '">Edytuj</a></td>';
            echo '<td><a href="kategoria/delete/' . $row['id_kategorii'] . '">Usuń</a></td>';
            echo '</tr>';
        }
        ?>
    </table>

</div>
<a href="kategoria/add">Dodaj</a>
