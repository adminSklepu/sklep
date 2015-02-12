<?php

class Produkt {

    private $idProduktu;
    private $nazwa;
    private $idKategorii;
    private $cena;
    private $opis;
    private $kategoria;





    public function getKategoria() {
        return $this->kategoria;
    }

    public function setKategoria($kategoria) {
        $this->kategoria = $kategoria;
    }

    public function getIdProduktu() {
        return $this->idProduktu;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getIdMarki() {
        return $this->idMarki;
    }

    public function getIdKategorii() {
        return $this->idKategorii;
    }

    public function getCena() {
        return $this->cena;
    }

    public function getOpis() {
        return $this->opis;
    }

    public function setIdProduktu($idProduktu) {
        $this->idProduktu = $idProduktu;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setIdKategorii($idKategorii) {
        $this->idKategorii = $idKategorii;
    }

    public function setCena($cena) {
        $this->cena = $cena;
    }

    public function setOpis($opis) {
        $this->opis = $opis;
    }

}

?>