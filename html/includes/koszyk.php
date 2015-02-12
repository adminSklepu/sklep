<?php
if (isset($_SESSION['koszyk']) && isset($_SESSION['calkowita_ilosc']) && isset($_SESSION['wartosc'])) {
    ?> 
    <h3>Koszyk</h3>
    <p>Ilość produktów w koszyku: <?= $_SESSION['calkowita_ilosc'] ?> </p>
    <p>Cena: <?= $_SESSION['wartosc'] ?> </p>
    <p><a href="/<?= APP_ROOT ?>/koszyk">Przejdź do koszyka</a></p>
    <?php 
}

