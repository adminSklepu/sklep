<?php
class kategoriaController extends baseController {
    //LISTA KATEGORII
    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $this->registry->template->results = $db::getKategoriaList();
        $this->registry->template->show('kategoria/kategoria_index');
    }
    //DODANIE NOWEJ KATEGORII
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            if (empty($error)) {
                $kategoria = new Kategoria();
                $kategoria->setNazwa($nazwa);
                if ($db::addKategoria($kategoria)) {
                    $success .= 'Dodano kategorię <br />';
                } else {
                    $error .= 'Dodanie kategorii nie powiodło się <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('kategoria/kategoria_add');
    }
    //EDYCJA KATEGORII
    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            if (empty($error)) {
                $kategoria = new Kategoria();
                $id = trim($_POST['id']);
                $kategoria->setIdKategorii($id);
                $kategoria->setNazwa($nazwa);
                if ($db::updateKategoria($kategoria)) {
                    $success .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
        } else {
            $id = $this->registry->id;

            $kategoria = $db::getKategoriaById($id);
            $this->registry->template->model = $kategoria;
        }
        $this->registry->template->show('kategoria/kategoria_edit');
    }
    //USUNIĘCIE KATEGORII
    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $kategoria = new Kategoria();
                $id = trim($_POST['id']);
                $kategoria->setIdKategorii($id);
                if ($db::deleteKategoria($kategoria)) {
                    $success .= 'Usunięto kategorię <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. Kategoria może być aktualnie używana przez produkty. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/kategoria';
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('kategoria/kategoria_action_result');
        } else {
            $id = $this->registry->id;
            $kategoria = $db::getKategoriaById($id);
            $this->registry->template->model = $kategoria;
            $this->registry->template->show('kategoria/kategoria_delete');
        }
    }

}

?>