<?php

/**
 * This is the model class for table "podrska".
 *
 * The followings are the available columns in table 'podrska':
 * @property integer $id
 * @property string $datum_vrijeme
 * @property string $pitanje
 * @property string $ime_prezime
 * @property string $tvrtka
 * @property string $adresa
 * @property string $mjesto_pb
 * @property string $telefon
 * @property string $e_mail
 * @property integer $obrisano
 */
class Podrska extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Podrska the static model class
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
		return 'podrska';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pitanje, ime_prezime, e_mail', 'required'),
			array('obrisano', 'numerical', 'integerOnly'=>true),
			array('e_mail','email'),
			array('ime_prezime, tvrtka, adresa, mjesto_pb, telefon, e_mail', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datum_vrijeme, pitanje, ime_prezime, tvrtka, adresa, mjesto_pb, telefon, e_mail, obrisano', 'safe', 'on'=>'search'),
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
			'datum_vrijeme' => 'Datum Vrijeme',
			'pitanje' => Yii::t('web','PITANJE ILI KOMENTAR:'),
			'ime_prezime' => Yii::t('web','Ime i prezime:'),
			'tvrtka' => Yii::t('web','Tvrtka:'),
			'adresa' => Yii::t('web','Adresa:'),
			'mjesto_pb' => Yii::t('web','Mjesto/p.b.:'),
			'telefon' => Yii::t('web','Tel/GSM:'),
			'e_mail' => Yii::t('web','E-mail adresa'),
			'obrisano' => 'Obrisano',
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
		$criteria->compare('datum_vrijeme',$this->datum_vrijeme,true);
		$criteria->compare('pitanje',$this->pitanje,true);
		$criteria->compare('ime_prezime',$this->ime_prezime,true);
		$criteria->compare('tvrtka',$this->tvrtka,true);
		$criteria->compare('adresa',$this->adresa,true);
		$criteria->compare('mjesto_pb',$this->mjesto_pb,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('e_mail',$this->e_mail,true);
		$criteria->compare('obrisano',$this->obrisano);

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
		$message .= '<td colspan="2"><b>Podrška, neregistrirani korisnici</b></td>';
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
		$message .= "<td>Pitanje :</td>";
		$message .= "<td>".$this->pitanje."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Tvrtka :</td>";
		$message .= "<td>".$this->tvrtka."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Adresa :</td>";
		$message .= "<td>".$this->adresa."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Mjesto, poštanski broj :</td>";
		$message .= "<td>".$this->mjesto_pb."</td>";
		$message .= "</tr>";
		
		$message .= "<tr>";
		$message .= "<td>Telefon :</td>";
		$message .= "<td>".$this->telefon."</td>";
		$message .= "</tr>";
		
		$message .= "</table>";
		
		$mail = new PHPMailer();
		$mail->AddReplyTo($this->e_mail);
		$mail->SetFrom($this->e_mail);
		$mail->AddAddress(Yii::app()->params['emailZaKontakt']);
		$mail->Subject    = 'Podrška - Imaves';
		$mail->MsgHTML($message);
		$mail->AltBody    = "Da bi ispravno vidjeli ovu poruku, molimo koristite HTML kompatibilan e-mail preglednik!";
		if( $mail->Send() != false )
		{
		
                     
		}
	}
	}
}