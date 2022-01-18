<?php

/**
 * This is the model class for table "kontakt".
 *
 * The followings are the available columns in table 'kontakt':
 * @property integer $id
 * @property string $ime_prezime
 * @property string $e_mail
 * @property string $naslov
 * @property string $poruka
 */
class Kontakt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kontakt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kontakt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ime_prezime, e_mail, naslov, poruka', 'required'),
			array('ime_prezime, e_mail', 'length', 'max'=>256),
			array('naslov', 'length', 'max'=>100),
			array('e_mail','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ime_prezime, e_mail, naslov, poruka', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ime_prezime' => 'Ime i prezime',
			'e_mail' => 'E-mail',
			'naslov' => 'Naslov',
			'poruka' => 'Sadržaj',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ime_prezime',$this->ime_prezime,true);
		$criteria->compare('e_mail',$this->e_mail,true);
		$criteria->compare('naslov',$this->naslov,true);
		$criteria->compare('poruka',$this->poruka,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/* 
	 * Nakon spremanja kontakta u bazu, isti se šalje 
	 * 
	 */
	public function afterSave() {
		if($this->isNewRecord)
        {
		$message = "<table>";
		
		$message .= "<tr>";
		$message .= '<td colspan="2"><b>Kontakt - Imaves</b></td>';
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Ime i prezime:</td>";
		$message .= "<td>".$this->ime_prezime."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>E-mail :</td>";
		$message .= "<td>".$this->e_mail."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Naslov :</td>";
		$message .= "<td>".$this->naslov."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Poruka :</td>";
		$message .= "<td>".$this->poruka."</td>";
		$message .= "</tr>";
		
		$message .= "</table>";
		
		$mail = new PHPMailer();
		$mail->AddReplyTo($this->e_mail);
		$mail->SetFrom($this->e_mail);
		$mail->AddAddress(Yii::app()->params['emailZaKontakt']);
		$mail->Subject    = 'Kontakt - Grofovo Tours';
		$mail->MsgHTML($message);
		$mail->AltBody    = "Da bi ispravno vidjeli ovu poruku, molimo koristite HTML kompatibilan e-mail preglednik!";
		if( $mail->Send() != false )
		{
		
                     
		}
	}
	}
}