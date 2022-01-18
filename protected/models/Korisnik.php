<?php

/**
 * Ovo je klasa modela tablice "korisnik".
 *
 * U tablici 'korisnik' dostupni su slijedeći atributi:
 * @property integer $id
 * @property string $korisnickoIme
 * @property string $lozinka
 * @property string $eMail
 * @property string $ime
 * @property string $prezime
 * @property integer $vrsta
 * @property string $token
 * @property string $datumKreiranja
 * @property string $zadnjiLogIn
 */
class Korisnik extends CActiveRecord
{
	const SUPERADMIN = 5;
	const ADMIN = 4;
	const MODERATOR = 3;
	const EDITOR = 2;
	const USER = 1;
	const INVALID = -1;
	
	public $_emailLozinka;
	public $lozinkaPonovno;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Korisnik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Naziv tablice
	 */
	public function tableName()
	{
		return 'korisnik';
	}

	/**
	 * Pravila za validacuju atributa modela
	 */
	public function rules()
	{
		return array(
			array('korisnickoIme, lozinka','required'),
			array('eMail, ime, prezime, vrsta','required','on'=>'register'),
			array('lozinkaPonovno, token, datumKreiranja, zadnjiLogIn', 'default'),
			array('eMail','email'),
			array('korisnickoIme, lozinka, eMail, ime, prezime','length','min'=>4),
			array('vrsta','numerical','integerOnly'=>true),
		);
	}

	/**
	 * Definiranje naziva (label-a) za atribute tablice (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'korisnickoIme' => 'Korisničko ime',
			'lozinka' => 'Lozinka',
			'eMail' => 'E-Mail',
			'ime' => 'Ime',
			'prezime' => 'Prezime',
			'vrsta' => 'Vrsta',
			'token' => 'Token',
			'datumKreiranja' => 'Datum Kreiranja',
			'zadnjiLogIn' => 'Zadnji LogIn',
		);
	}

	/* 
	* Prije spremanja lozinke u bazu ista se kriptira
	*/
	public function beforeSave() {
		//$this->_emailPassword = $this->password;
		$this->lozinka = self::hashPassword($this->lozinka);
		return true;
	}
       
	/* 
	 * Nakon spremanja korisničkih podataka u bazu, šalje se obavijest o registraciji mailom
	 * Instancira se Mail klasa, definira se poruka, te se ista šalje korisniku i administratoru sustava
	 */
	public function afterSave() {
		/*
		$message = "<table>";
		$message .= "<tr>";
		$message .= "<td>Ime :</td>";
		$message .= "<td>".$this->ime."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Prezime :</td>";
		$message .= "<td>".$this->prezime."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Korisničko ime :</td>";
		$message .= "<td>".$this->korisnickoIme."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Lozinka :</td>";
		$message .= "<td>".$this->_emailLozinka."</td>";
		$message .= "</tr>";
		$message .= "</table>";
		
		$mail = new Mail();
		//definiranje naslova e-mail poruke
		$mail->setTitle("Registracija korisnika - ".Yii::app()->params['nazivTvrtke']);
		//definiranje subjecta e-mail poruke
		$mail->setSubject("Registracija korisnika - ".Yii::app()->params['nazivTvrtke']);
		//definiranje sadržaja e-mail poruke
		$mail->setMessage($message);
		//slanje e-mail poruke korisniku i administratoru sustava
		$mail->sendMail(Yii::app()->params['adminEmail']);
		$mail->sendMail($this->eMail);
		return true;
		*/
	}
	
	/*
	* Validacija lozinke
	*/
	public function ValidatePassword($lozinka){
		return $this->lozinka == self::hashPassword($lozinka);
	}
       
       /*
	* Kriptiranje lozinke uz dodavanje malo Vegete =) radi težeg probijanja lozinke
	* Ukoliko se dodatak promijeni nitko se neće moći ulogirati...
	*/
	public static function hashPassword($password){
		//return md5($password."(.)¸vEgEtA¸(.)");
		return md5($password."salted");
	}
}