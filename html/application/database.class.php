<?php

Class Database {

    private static $db;

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=sklep;charset=utf8', 'root', '');
            return new Database();
        }
    }


    //użytkownicy
    //dodanie użytkownika
    public static function addUser($user) {
        $stmt = self::$db->prepare("INSERT INTO uzytkownik(imie,nazwisko,adres,telefon,email,login,haslo) "
                . "VALUES(:imie,:nazwisko,:adres,:telefon,:email,:login,:haslo)");
        $stmt->execute(array(
            ':imie' => $user->getImie(), ':nazwisko' => $user->getNazwisko(), ':adres' => $user->getAdres(),
            ':telefon' => $user->getTelefon(), ':email' => $user->getEmail(),
            ':login' => $user->getLogin(), ':haslo' => sha1($user->getHaslo()))
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    //pobranie użytkownika po id
    public static function getUserByID($id) {
        $stmt = $db->prepare('SELECT * FROM uzytkownik WHERE id=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik;
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }
    //pobranie użytkownika po loginie i haśle
    public static function getUserByLoginAndPassword($login, $password) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=? and haslo=?');
        $stmt->execute(array($login, sha1($password)));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }
    //pobranie użytkownika o podanym loginie
    public static function getUserByLogin($login) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=?');
        $stmt->execute(array($login));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }
    //pobranie użytkownika o podanym mailu
    public static function getUserByEmail($email) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE email=?');
        $stmt->execute(array($email));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    //role
    //sprawdzenie, czy użytkownik posiada określoną rolę
    public static function isUserInRole($login, $role) {
        $userRoles = self::userRoles($login);
        return in_array($role, $userRoles);
    }
    //pobranie wszystkich roli użytkownika
    public static function userRoles($login) {
        $stmt = self::$db->prepare("SELECT r.name FROM uzytkownik u 	
		INNER JOIN users_roles ur on(u.id = ur.user_id)
		INNER JOIN roles r on(ur.role_id = r.id)
		WHERE	u.login = ?");
        $stmt->execute(array($login));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = array();
        for ($i = 0; $i < count($result); $i++) {
            $roles[] = $result[$i]['name'];
        }
        return $roles;
    }

    /*
     * kategorie
     */
    //POBRANIE KATEGORII NA PODSTAWIE ID
    public static function getKategoriaById($id) {
        $stmt = self::$db->prepare('SELECT * FROM kategoria WHERE id_kategorii=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $kategoria = new Kategoria();
            $kategoria->setIdKategorii($result['id_kategorii']);
            $kategoria->setNazwa($result['nazwa']);
            return $kategoria;
        }
    }
    //DODANIE KATEGORII
    public static function addKategoria($kategoria) {
        $stmt = self::$db->prepare("INSERT INTO kategoria(nazwa) "
                . "VALUES(:nazwa)");
        $stmt->execute(array(':nazwa' => $kategoria->getNazwa()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    //POBRANIE LISTY KATEGORII
    public static function getKategoriaList() {
        $stmt = self::$db->query('SELECT * FROM kategoria');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //USUNIECIE KATEGORII
    public static function deleteKategoria($kategoria) {
        $stmt = self::$db->prepare('DELETE FROM kategoria WHERE id_kategorii=?');
        $stmt->execute(array($kategoria->getIdKategorii()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    //EDYCJA KATEGORII
    public static function updateKategoria($kategoria) {
        $stmt = self::$db->prepare('UPDATE kategoria set nazwa=? WHERE id_kategorii=?');
        $stmt->execute(array($kategoria->getNazwa(), $kategoria->getIdKategorii()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    /*
     * Produkty
     */

    public static function getProduktById($id) {
        $stmt = self::$db->prepare('SELECT * FROM produkt p WHERE id_produktu=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $produkt = new Produkt();
            $produkt->setIdProduktu($result['id_produktu']);
            $produkt->setNazwa($result['nazwa']);
            $produkt->setIdKategorii($result['id_kategorii']);
            $produkt->setKategoria(self::getKategoriaById($result['id_kategorii']));
            $produkt->setCena($result['cena']);
            $produkt->setOpis($result['opis']);
            return $produkt;
        }
    }

    public static function addProdukt($produkt) {
        $stmt = self::$db->prepare("INSERT INTO produkt(nazwa,cena,id_kategorii,opis) "
                . "VALUES(:nazwa , :cena, :id_kategorii, :opis)");
        $stmt->execute(array(
            ':nazwa' => $produkt->getNazwa(),
            ':id_kategorii' => $produkt->getIdKategorii(),
            ':cena' => $produkt->getCena(),
            ':opis' => $produkt->getOpis()
        ));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getProduktList() {
        $stmt = self::$db->query('SELECT * FROM produkt');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public static function getProduktListByCategory($idKategorii) {
        $stmt = self::$db->prepare('SELECT * FROM produkt WHERE id_kategorii=?');
         $stmt->execute(array($idKategorii));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteProdukt($produkt) {
        $stmt = self::$db->prepare('DELETE FROM produkt WHERE id_produktu=?');
        $stmt->execute(array($produkt->getIdProduktu()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateProdukt($produkt) {
        try {
            self::$db->beginTransaction();
            $stmt = self::$db->prepare('UPDATE produkt set nazwa=:nazwa, cena=:cena, '
                    . 'id_kategorii=:id_kategorii,'
                    . 'opis=:opis WHERE id_produktu=:id');
            $stmt->execute(array(
                ':id' => $produkt->getIdProduktu(),
                ':nazwa' => $produkt->getNazwa(),
                ':id_kategorii' => $produkt->getIdKategorii(),
                ':opis' => $produkt->getOpis(),
                ':cena' => $produkt->getCena()
            ));

            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                self::$db->commit();
                return TRUE;
            }
        } catch (Exception $ex) {
            echo $ex;
            self::$db->rollBack();
            return FALSE;
        }
    }

    /*
     * Zamówienia
     */

    public static function getZamowienieById($id) {
        $stmt = self::$db->prepare('SELECT * FROM zamowienie WHERE id_zamowienia=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($result['id_zamowienia']);

            $produktyZamowienia = self::getProduktyZamowienia($id);
            $zamowienie->setProdukty($produktyZamowienia);
            $kwota = 0.0;
            foreach ($produktyZamowienia as $p) {
                $kwota += $p->getProdukt()->getCena() * $p->getIlosc();
            }
            $zamowienie->setCena($kwota);
            $zamowienie->setAdres($result['adres']);
            $zamowienie->setDataRealizacji($result['data_realizacji']);
            $zamowienie->setDataZamowienia($result['data_zamowienia']);
            $zamowienie->setIdKlienta($result['id_klienta']);
            $zamowienie->setStatus($result['status']);
            $zamowienie->setUwagi($result['uwagi_dodatkowe']);
            return $zamowienie;
        }
    }

    public static function addZamowienie($zamowienie) {
        $stmt = self::$db->prepare("INSERT INTO zamowienie(id_klienta,adres,uwagi_dodatkowe,status,data_zamowienia) "
                . "VALUES(:id_klienta, :adres, :uwagi_dodatkowe, :status, now())");
        $stmt->execute(array(
            ':id_klienta' => $zamowienie->getIdKlienta(),
            ':adres' => $zamowienie->getAdres(),
            ':uwagi_dodatkowe' => $zamowienie->getUwagi(),
            ':status' => $zamowienie->getStatus()
        ));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            $idZamowienia = self::$db->lastInsertId();
            if (!empty($idZamowienia)) {
                foreach ($zamowienie->getProdukty() as $produkt) {
                    $stmt = self::$db->prepare("INSERT INTO szczegoly_zamowienia(id_zamowienia, id_produktu,ilosc) "
                            . "VALUES(:id_zamowienia, :id_produktu , :ilosc)");
                    $stmt->execute(array(
                        ':id_produktu' => $produkt->getIdProduktu(),
                        ':id_zamowienia' => $idZamowienia,
                        ':ilosc' => $produkt->getIlosc()
                    ));
                }
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function getZamowienieList() {
        $stmt = self::$db->query('SELECT * FROM zamowienie');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getZamowienieUserList($idUser) {
        $stmt = self::$db->prepare('SELECT * FROM zamowienie WHERE id_klienta=?');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProduktyZamowienia($idZamowienia) {
        $stmt = self::$db->prepare('SELECT * FROM szczegoly_zamowienia WHERE id_zamowienia=?');
        $stmt->execute(array($idZamowienia));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $produkty = array();
        foreach ($results as $row) {
            $idProduktu = $row['id_produktu'];
            $produkt = self::getProduktById($idProduktu);
            $produktZamowienia = new ProduktZamowienia();
            $produktZamowienia->setIdProduktu($idProduktu);
            $produktZamowienia->setIdZamowienia($idZamowienia);
            $produktZamowienia->setIlosc($row['ilosc']);
            $produktZamowienia->setProdukt($produkt);
            $produkty[] = $produktZamowienia;
        }
        return $produkty;
    }

    public static function deleteZamowienie($zamowienie) {
        $stmt = self::$db->prepare('DELETE FROM zamowienie WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getIdZamowienia()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function payZamowienie($zamowienie) {
        $stmt = self::$db->prepare('UPDATE zamowienie SET status=? , data_zamowienia=now() WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getStatus(), $zamowienie->getIdZamowienia()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function realizeZamowienie($zamowienie) {
        $stmt = self::$db->prepare('UPDATE zamowienie SET data_realizacji=now() , status=? WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getStatus(), $zamowienie->getIdZamowienia()));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

}

?>