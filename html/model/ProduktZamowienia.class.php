<?php

class ProduktZamowienia {
    private $idZamowienia;
    private $idProduktu;
    private $ilosc;



    private $produkt;
    private $zamowienie;
    
    public function getIdZamowienia() {
        return $this->idZamowienia;
    }

    public function getIdProduktu() {
        return $this->idProduktu;
    }

    public function getIlosc() {
        return $this->ilosc;
    }


    public function getProdukt() {
        return $this->produkt;
    }

    public function getZamowienie() {
        return $this->zamowienie;
    }

    public function setIdZamowienia($idZamowienia) {
        $this->idZamowienia = $idZamowienia;
    }

    public function setIdProduktu($idProduktu) {
        $this->idProduktu = $idProduktu;
    }

    public function setIlosc($ilosc) {
        $this->ilosc = $ilosc;
    }


    public function setProdukt($produkt) {
        $this->produkt = $produkt;
    }

    public function setZamowienie($zamowienie) {
        $this->zamowienie = $zamowienie;
    }


    

}
