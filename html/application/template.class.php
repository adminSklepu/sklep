<?php
Class Template {
    private $registry;
    //zmienne widoku
    private $vars = array();
    //w konstruktorze przekazujemy rejestr
    function __construct($registry) {
        $this->registry = $registry;
    }
    //dodanie zmiennej do widoku
    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }
    //wyswietlenie danego widoku
    public function show($name) {
        $path = __SITE_PATH . '/views/' . $name . '.php';
        if (file_exists($path) == false) {
            throw new Exception('Template not found in ' . $path);
            return false;
        }
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }
        include $path;
    }
}
?>