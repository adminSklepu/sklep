<?php
Class Registry {
    //tablica przechowująca zmienne
    private $vars = array();
    //wstawienie zmiennej do rejestru
    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }
    //pobranie warości zmiennej
    public function __get($index) {
        return $this->vars[$index];
    }
}
?>