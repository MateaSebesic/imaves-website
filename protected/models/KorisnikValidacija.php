<?php
class KorisnikValidacija extends CFormModel{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;
        
	/**
	 * Pravila za validacuju atributa modela
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Definiranje naziva (label-a) za atribute tablice (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'username'=>'Korisničko ime',
                        'password'=>'Lozinka',
			'rememberMe'=>'Zapamti me na ovom računalu', 
		);
	}

	/**
	 * Validacija lozinke
	 */
	public function authenticate($attribute,$params)
	{
		$this->_identity = new KorisnikValidacijaYii($this->username,$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('password','Pogrešno korisničko ime ili lozinka');
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new KorisnikValidacijaYii($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===KorisnikValidacijaYii::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}