<?php

class Zamowienie {
	private $idZamowienia;
	private $idKlienta;
        private $cena;
	private $dataZamowienia;
	private $dataRealizacji;
	private $status;  //nowe, zaplacone, zrealizowane     
        private $produkty;
        private $adres;
        private $uwagi;
        
        public function getCena() {
            return $this->cena;
        }

        public function setCena($cena) {
            $this->cena = $cena;
        }

                
        public function getAdres() {
            return $this->adres;
        }

        public function getUwagi() {
            return $this->uwagi;
        }

        public function setAdres($adres) {
            $this->adres = $adres;
        }

        public function setUwagi($uwagi) {
            $this->uwagi = $uwagi;
        }

                public function getIdZamowienia() {
            return $this->idZamowienia;
        }

        public function getIdKlienta() {
            return $this->idKlienta;
        }
        
        public function getDataZamowienia() {
            return $this->dataZamowienia;
        }

        public function getDataRealizacji() {
            return $this->dataRealizacji;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getProdukty() {
            return $this->produkty;
        }

        public function setIdZamowienia($idZamowienia) {
            $this->idZamowienia = $idZamowienia;
        }

        public function setIdKlienta($idKlienta) {
            $this->idKlienta = $idKlienta;
        }

        public function setDataZamowienia($dataZamowienia) {
            $this->dataZamowienia = $dataZamowienia;
        }

        public function setDataRealizacji($dataRealizacji) {
            $this->dataRealizacji = $dataRealizacji;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setProdukty($produkty) {
            $this->produkty = $produkty;
        }
}
?>