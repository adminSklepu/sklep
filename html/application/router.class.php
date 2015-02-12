<?php
class router {
    private $registry;
    private $path;
    private $args = array();
    public $file;
    public $controller;
    public $action;

    function __construct($registry) {
        $this->registry = $registry;
    }

    function setPath($path) {
        if (is_dir($path) == false) {
            throw new Exception('Nieprawidłowa ścieżka kontrolera: ' . $path);
        }
        $this->path = $path;
    }

    public function loader() {
        $this->getController();

        if (is_readable($this->file) == false) {
            echo $this->file;
            die('404 not found');
        }
        //dołącz kontroller
        include $this->file;
        //utwórz instancję klasy kontrolera
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);
        //sprawdź, czy można wywołać akcje
        if (is_callable(array($controller, $this->action)) == false) {
            $action = 'index';
        } else {
            $action = $this->action;
        }
        //wywołaj akcje
        $controller->$action();
    }

    private function getController() {
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
        if (empty($route)) {
            $route = 'index';
        } else {
            $parts = explode('/', $route);
            $this->controller = $parts[0];
            if (isset($parts[1])) {
                $this->action = $parts[1];
            }
        }
        //pobranie argumentow
        if (!empty($parts)) {
            for ($i = 2; $i < count($parts); $i++) {
                $this->args[] = $parts[$i];
            }

            if (count($this->args) > 0) {
                $this->registry->id = $this->args[0];
            }
        }
        if (empty($this->controller)) {
            $this->controller = 'index';
        }
        if (empty($this->action)) {
            $this->action = 'index';
        }
        if (file_exists($this->path . '/' . $this->controller . 'Controller.php')) {
            $this->file = $this->path . '/' . $this->controller . 'Controller.php';
        } else {
            $this->file = $this->path . '/indexController.php';
            $this->controller = 'index';
            $this->action = 'index';
        }
    }
}
?>