<?php
Abstract class baseController {
    protected $registry;
    //w konstruktorze przekazujemy rejestr, aby mieć dostęp do zmiennych w nim zawartych
    function __construct($registry) {
        $this->registry = $registry;
    }
    //wszystkie kontrollery dziedziczące kontroller bazowy muszą posiadać metodę index
    abstract function index();
    
    function ograniczDostepTylkoDlaAdmina() {
        $login = $_SESSION['user'];
        $db = $this->registry->db;
        if (empty($login) || (!$db::isUserInRole($login, 'admin'))) {
            $location = '/' . APP_ROOT . '/';
            header("Location: $location");
            return;
        }
    }

    function ograniczDostepTylkoDlaZalogowanegoUzytkownika() {
        $login = $_SESSION['user'];
        $db = $this->registry->db;
        if (empty($login)) {
            $location = '/' . APP_ROOT . '/';
            header("Location: $location");
            return;
        }
    }
}
?>