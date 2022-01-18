<?php

/**
 * This is the model class for table "novosti_primanje".
 *
 * The followings are the available columns in table 'novosti_primanje':
 * @property integer $id
 * @property string $datum_vrijeme
 * @property string $e_mail
 * @property integer $obrisano
 */
class NovostiPrimanje extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NovostiPrimanje the static model class
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
		return 'novosti_primanje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('datum_vrijeme, e_mail', 'required'),
			array('obrisano', 'numerical', 'integerOnly'=>true),
			array('e_mail', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datum_vrijeme, e_mail, obrisano', 'safe', 'on'=>'search'),
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
			'e_mail' => 'E Mail',
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
		$message .= '<td colspan="2"><b>Novosti, predbilježba</b></td>';
		$message .= "</tr>";
		
		
		$message .= "<tr>";
		$message .= "<td>E-mail :</td>";
		$message .= "<td>".$this->e_mail."</td>";
		$message .= "</tr>";
		
		
		
		$message .= "</table>";
		
		$mail = new PHPMailer();
		$mail->AddReplyTo($this->e_mail);
		$mail->SetFrom($this->e_mail);
		$mail->AddAddress(Yii::app()->params['emailZaKontakt']);
		$mail->Subject    = 'Novosti - Imaves';
		$mail->MsgHTML($message);
		$mail->AltBody    = "Da bi ispravno vidjeli ovu poruku, molimo koristite HTML kompatibilan e-mail preglednik!";
		if( $mail->Send() != false )
		{
		
                     
		}
	}
	}
}