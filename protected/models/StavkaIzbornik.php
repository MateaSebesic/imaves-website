<?php

/**
 * This is the model class for table "stavka_izbornik".
 *
 * The followings are the available columns in table 'stavka_izbornik':
 * @property integer $id
 * @property integer $id_izbornik
 * @property integer $id_roditelj
 * @property string $naziv
 * @property integer $pozicija
 * @property integer $home
 * @property integer $kontakt
 * @property integer $login
 * @property integer $id_clanak
 * @property integer $vrsta
 * @property string $fotografija
 * @property integer $prikaz
 * @property integer $aktivno
 * @property integer $obrisano
 *
 * The followings are the available model relations:
 * @property Clanak $idClanak
 * @property Izbornik $idIzbornik
 * @property StavkaIzbornik $idRoditelj
 * @property StavkaIzbornik[] $stavkaIzborniks
 * @property StavkaPrijevod[] $stavkaPrijevods
 */
class StavkaIzbornik extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StavkaIzbornik the static model class
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
		return 'stavka_izbornik';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_izbornik, naziv, pozicija', 'required'),
			array('id_izbornik, id_roditelj, pozicija, home, kontakt, login, id_clanak, id_novost, id_vijest, iz_medija, vrsta, prikaz, aktivno, obrisano', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>256),
			array('fotografija', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_izbornik, id_roditelj, naziv, pozicija, home, kontakt, login, id_clanak, id_novost, id_vijest, iz_medija, vrsta, fotografija, prikaz, aktivno, obrisano', 'safe', 'on'=>'search'),
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
			'idClanak' => array(self::BELONGS_TO, 'Clanak', 'id_clanak'),
			'idIzbornik' => array(self::BELONGS_TO, 'Izbornik', 'id_izbornik'),
			'idRoditelj' => array(self::BELONGS_TO, 'StavkaIzbornik', 'id_roditelj'),
			'stavkaIzborniks' => array(self::HAS_MANY, 'StavkaIzbornik', 'id_roditelj'),
			'stavkaPrijevods' => array(self::HAS_MANY, 'StavkaPrijevod', 'id_stavka_izbornik'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_izbornik' => 'Izbornik',
			'id_roditelj' => 'Roditelj',
			'naziv' => 'Naziv',
			'pozicija' => 'Pozicija',
			'home' => 'Početna stranica',
			'kontakt' => 'Tehnička podrška, neregistrirani korisnici',
			'login' => 'Tehnička podrška, registrirani korisnici',
			'id_clanak' => 'Članak',
			'id_vijest' => 'Vijest',
			'id_novost' => 'Novost',
			'iz_medija' => 'Iz medija',
			'vrsta' => 'Vrsta (samo za roditelje)',
			'aktivno' => 'Aktivno',
			'obrisano' => 'Obrisano',
			'fotografija' => 'Fotografija',
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
		$criteria->compare('id_izbornik',$this->id_izbornik);
		$criteria->compare('id_roditelj',$this->id_roditelj);
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('pozicija',$this->pozicija);
		$criteria->compare('home',$this->home);
		$criteria->compare('kontakt',$this->kontakt);
		$criteria->compare('login',$this->login);
		$criteria->compare('id_clanak',$this->id_clanak);
		$criteria->compare('vrsta',$this->vrsta);
		$criteria->compare('fotografija',$this->fotografija,true);
		$criteria->compare('prikaz',$this->prikaz);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}