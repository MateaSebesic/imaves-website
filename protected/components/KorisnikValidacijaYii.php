<?php

class KorisnikValidacijaYii extends CUserIdentity{
    
    protected $_id;
    /*
     * Id korisnika postaje ime korisnika
     */
    public function getId() {
        return $this->_id;
    }
    /*
     * Yii klasa provjera autentičnosti
     */
    public function authenticate() {
        if(strpos($this->username, '@'))
        $korisnik=Korisnik::model()->find('LOWER(eMail)=?',array(strtolower($this->username)));
        else        
        $korisnik=Korisnik::model()->find('LOWER(korisnickoIme)=?',array(strtolower($this->username)));
        
	if($korisnik===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
	else if(!$korisnik->ValidatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
	else{
                $_SESSION['tinyMce'] = true;
				$this->_id=$korisnik->id;
				$this->username=$korisnik->korisnickoIme;
				$this->errorCode=self::ERROR_NONE;
	}
	return $this->errorCode==self::ERROR_NONE;
    }
}
?>