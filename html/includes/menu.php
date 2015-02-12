<?php
$login = $_SESSION['user'];
if (!empty($login)) {
    $db = $registry->db;
    if ($db::isUserInRole($login, 'admin')) {
?>
<!--Menu dla admina-->
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/<?= APP_ROOT ?>">HOME</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/<?= APP_ROOT ?>/produkt">Produkty</a></li>
                        <li><a href="/<?= APP_ROOT ?>/kategoria">Kategorie</a></li>
                        <li><a href="/<?= APP_ROOT ?>/zamowienie">Zamowienia</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <?php
    } else { 
        ?>
<!--MENU DLA ZALOGOWANEGO ZWYKŁEGO UŻYTKOWNIKA-->
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/<?= APP_ROOT ?>">HOME</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/<?= APP_ROOT ?>/zamowienie/moje_zamowienia">Zamowienia</a></li>
                        <li><a href="/<?= APP_ROOT ?>/produkt">Produkty</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <?php  }  ?>  <?php
} else {
    ?>
<!--MENU DLA GOŚCIA-->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/<?= APP_ROOT ?>">HOME</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                      <li><a href="/<?= APP_ROOT ?>/produkt">Produkty</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <?php } ?>


