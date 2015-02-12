<?php

class Uzytkownik {
	private $id;
	private $imie;
	private $nazwisko;
	private $adres;
	private $telefon;
	private $email;
	private $login;
        private $haslo;
	private $role = array();
        
        public function __cunstruct(){   
        }
               	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getImie(){
		return $this->imie;
	}
	public function setImie($imie){
		$this->imie = $imie;
	}
	public function getNazwisko(){
		return $this->nazwisko;
	}
	public function setNazwisko($nazwisko){
		$this->nazwisko = $nazwisko;
	}
	public function getAdres(){
		return $this->adres;
	}
	public function setAdres($adres){
		$this->adres = $adres;
	}
	public function getTelefon(){
		return $this->telefon;
	}
	public function setTelefon($telefon){
		$this->telefon = $telefon;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function getLogin(){
		return $this->login;
	}
	public function setLogin($login){
		$this->login = $login;
	}      
        public function getHaslo(){
		return $this->haslo;
	}
	public function setHaslo($haslo){
		$this->haslo = $haslo;
	}
	public function getRole(){
		return $this->role;
	}
	public function setRole($role){
		$this->role = $role;
	}	
}
?>