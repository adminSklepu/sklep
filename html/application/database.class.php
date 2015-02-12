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

    

}

?>