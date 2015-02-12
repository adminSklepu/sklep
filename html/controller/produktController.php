<?php

class produktController extends baseController {

    public function index() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $results = $db::getProduktList();
        $produkty = array();
        foreach ($results as $row) {
            $produkt = new Produkt();
            $produkt->setIdProduktu($row['id_produktu']);
            $produkt->setNazwa($row['nazwa']);
            $produkt->setCena($row['cena']);
            $produkt->setOpis($row['opis']);
            $produkt->setIdKategorii($row['id_kategorii']);
            $kategoria = $db::getKategoriaById($row['id_kategorii']);
            $produkt->setKategoria($kategoria);
            $produkty[] = $produkt;
        }
        $kategorie = array();
        $results = $db::getKategoriaList();
        foreach ($results as $row) {
            $kategoria = new Kategoria();
            $kategoria->setIdKategorii($row['id_kategorii']);
            $kategoria->setNazwa($row['nazwa']);
            $kategorie[] = $kategoria;
        }
        $this->registry->template->produkty = $produkty;
        $this->registry->template->kategorie = $kategorie;
        $this->registry->template->show('produkt/produkt_index');
    }



    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $kategorieList = $db::getKategoriaList();
        $this->registry->template->kategorie = $kategorieList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            $cena = trim($_POST['cena']);
            if (empty($cena)) {
                $error .= 'Uzupełnij pole cena <br />';
            }
            $idKategorii = $_POST['kategoria'];
            if (empty($idKategorii)) {
                $error .= 'Wybierz pole kategoria <br />';
            }
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $produkt = new Produkt();
                $produkt->setNazwa($nazwa);
                $produkt->setCena($cena);
                $produkt->setIdKategorii($idKategorii);
                $produkt->setOpis($opis);
                if ($db::addProdukt($produkt)) {
                    $success .= 'Dodano produkt <br />';
                } else {
                    $error .= 'Dodanie produktu nie powiodło się <br />';
                }
            }

            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }

        $this->registry->template->show('produkt/produkt_add');
    }

    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $kategorieList = $db::getKategoriaList();
        $this->registry->template->kategorieAll = $kategorieList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id']);
            if (empty($id)) {
                $error .= 'Błąd <br />';
            }
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            $cena = trim($_POST['cena']);
            if (empty($cena)) {
                $error .= 'Uzupełnij pole cena <br />';
            }
            $idKategorii = $_POST['kategoria'];
            if (empty($idKategorii)) {
                $error .= 'Wybierz pole kategoria <br />';
            }
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $produkt = new Produkt();
                $produkt->setIdProduktu($id);
                $produkt->setNazwa($nazwa);
                $produkt->setCena($cena);
                $produkt->setIdKategorii($idKategorii);
                $produkt->setOpis($opis);
                if ($db::updateProdukt($produkt)) {
                    $success .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('produkt/produkt_action_result');
        } else {
            $id = $this->registry->id;
            $produkt = $db::getProduktById($id);
            $this->registry->template->model = $produkt;
            $this->registry->template->show('produkt/produkt_edit');
        }
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $id = trim($_POST['id']);
                $produkt = $db::getProduktById($id);
                if ($db::deleteProdukt($produkt)) {
                    $success .= 'Usunięto produkt <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/produkt';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('produkt/produkt_action_result');
        } else {
            $id = $this->registry->id;
            $produkt = $db::getProduktById($id);
            $this->registry->template->model = $produkt;
            $this->registry->template->show('produkt/produkt_delete');
        }
    }

}

?>