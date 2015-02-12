<?php
class Kategoria {
    //atrybuty
    private $idKategorii;
    private $nazwa;
    //pobierz ID
    public function getIdKategorii() {
        return $this->idKategorii;
    }
    //pobierz nazwę
    public function getNazwa() {
        return $this->nazwa;
    }
    //ustaw ID
    public function setIdKategorii($idKategorii) {
        $this->idKategorii = $idKategorii;
    }
    //ustaw nazwę
    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }
}
?>