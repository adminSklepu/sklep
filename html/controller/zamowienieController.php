<?php
class zamowienieController extends baseController {
    //POBRANIE I WYSWIETLENIE LISTY WSZYSTKICH ZAMOWIEN (DLA ADMINA)
    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $results = $db::getZamowienieList();
        $zamowienia = array();
        foreach ($results as $row) {
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($row['id_zamowienia']);
            $zamowienie->setIdKlienta($row['id_klienta']);
            $zamowienie->setAdres($row['adres']);
            $zamowienie->setUwagi($row['uwagi_dodatkowe']);
            $produkty = $db::getProduktyZamowienia($row['id_zamowienia']);
            $zamowienie->setProdukty($produkty);
            $cena = 0.0;
            foreach ($produkty as $produkt) {
                $cena += $produkt->getIlosc() * $produkt->getProdukt()->getCena();
            }
            $zamowienie->setCena($cena);
            $zamowienie->setDataZamowienia($row['data_zamowienia']);
            $zamowienie->setDataRealizacji($row['data_realizacji']);
            $zamowienie->setStatus($row['status']);
            $zamowienia[] = $zamowienie;
        }
        $this->registry->template->zamowienia = $zamowienia;
        $this->registry->template->show('zamowienie/zamowienie_index');
    }

    //POBANIE I WYSWIETLENIE ZAMOWIEN ZALOGOWANEGO ZWYKLEGO UZYTKOWNIKA
    public function moje_zamowienia() {
        $this->ograniczDostepTylkoDlaZalogowanegoUzytkownika();
        $db = $this->registry->db;
        $login = $_SESSION['user'];
        $user = $db::getUserByLogin($login);
        $results = $db::getZamowienieUserList($user->getId());
        $zamowienia = array();
        foreach ($results as $row) {
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($row['id_zamowienia']);
            $zamowienie->setIdKlienta($row['id_klienta']);
            $zamowienie->setAdres($row['adres']);
            $zamowienie->setUwagi($row['uwagi_dodatkowe']);
            $produkty = $db::getProduktyZamowienia($row['id_zamowienia']);
            $zamowienie->setProdukty($produkty);
            $cena = 0.0;
            foreach ($produkty as $produkt) {
                $cena += $produkt->getIlosc() * $produkt->getProdukt()->getCena();
            }
            $zamowienie->setCena($cena);
            $zamowienie->setDataZamowienia($row['data_zamowienia']);
            $zamowienie->setDataRealizacji($row['data_realizacji']);
            $zamowienie->setStatus($row['status']);
            $zamowienia[] = $zamowienie;
        }
        $this->registry->template->zamowienia = $zamowienia;
        $this->registry->template->show('zamowienie/zamowienie_indexUser');
    }

    //DODANIE NOWEGO ZAMOWIENIA
    public function add() {
        $this->ograniczDostepTylkoDlaZalogowanegoUzytkownika();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $produkty = array();
        $ilosci = array();
        if (isset($_SESSION['koszyk'])) {          
            foreach ($_SESSION['koszyk'] as $idProduktu => $ilosc) {
                $produkt = $db::getProduktById($idProduktu);
                $produkty[] = $produkt;
                $ilosci[] = $ilosc;
            }
            $user = $db::getUserByLogin($_SESSION['user']);
            $adres = $user->getAdres();
            $this->registry->template->adres = $adres;
            $this->registry->template->produkty = $produkty;
            $this->registry->template->ilosci = $ilosci;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adres = trim($_POST['adres']);
            if (empty($adres)) {
                $error .= 'Uzupełnij pole adres <br />';
            }
            $uwagi = trim($_POST['uwagi']);

            if (empty($error)) {
                for ($i = 0; $i < count($produkty); $i++) {
                    $p = $produkty[$i];
                    $il = $ilosci[$i];
                    $produktZamowienia = new ProduktZamowienia();
                    $produktZamowienia->setIlosc($il);
                    $produktZamowienia->setProdukt($p);
                    $produktZamowienia->setIdProduktu($p->getIdProduktu());
                    $produktyZ[] = $produktZamowienia;
                }

                $zamowienie = new Zamowienie();
                $zamowienie->setProdukty($produktyZ);
                $kwota = 0.0;
                foreach ($produktyZ as $p) {
                    $kwota += $p->getProdukt()->getCena() * $p->getIlosc();
                }
                $zamowienie->setCena($kwota);
                $zamowienie->setStatus("nowe");
                $zamowienie->setUwagi($uwagi);
                $zamowienie->setAdres($adres);
                $user = $db::getUserByLogin($_SESSION['user']);
                $userId = $user->getId();
                $zamowienie->setIdKlienta($userId);
                if ($db::addZamowienie($zamowienie)) {
                    $success .= 'Dodano zamowienie <br />';
                    unset($_SESSION['koszyk']);
                    unset($_SESSION['calkowita_wartosc']);
                    unset($_SESSION['wartosc']);
                } else {
                    $error .= 'Dodanie zamowienia nie powiodło się <br />';
                }
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('zamowienie/zamowienie_add');
    }

    //USUNIECIE ZAMOWIENIA
    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $id = trim($_POST['id']);
                $zamowienie = $db::getZamowienieById($id);
                if ($db::deleteZamowienie($zamowienie)) {
                    $success .= 'Usunięto zamówienie <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/zamowienie';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('zamowienie/zamowienie_action_result');
        } else {
            $id = $this->registry->id;
            $zamowienie = $db::getZamowienieById($id);
            $this->registry->template->model = $zamowienie;
            $this->registry->template->show('zamowienie/zamowienie_delete');
        }
    }

    //ZREALIZOWANIE (WYSLANIE) ZAMOWIENIA
    public function realize() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['realize'])) {
                $id = trim($_POST['id']);
                $zamowienie = $db::getZamowienieById($id);
                $zamowienie->setStatus("Zrealizowane");
                if ($db::realizeZamowienie($zamowienie)) {
                    $success .= 'Wysłano zamówienie <br />';
                } else {
                    $error .= 'Realizacja nie powiodła się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/zamowienie';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('zamowienie/zamowienie_action_result');
        } else {
            $id = $this->registry->id;
            $zamowienie = $db::getZamowienieById($id);
            $this->registry->template->model = $zamowienie;
            $this->registry->template->show('zamowienie/zamowienie_realize');
        }} } ?>