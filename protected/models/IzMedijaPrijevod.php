<?php

/**
 * This is the model class for table "iz_medija_prijevod".
 *
 * The followings are the available columns in table 'iz_medija_prijevod':
 * @property integer $id
 * @property string $naziv
 * @property integer $id_iz_medija
 * @property integer $id_jezik
 * @property string $naslov
 * @property string $podnaslov
 * @property string $sadrzaj
 *
 * The followings are the available model relations:
 * @property IzMedija $idIzMedija
 * @property Jezik $idJezik
 */
class IzMedijaPrijevod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IzMedijaPrijevod the static model class
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
		return 'iz_medija_prijevod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naziv, id_iz_medija, id_jezik, naslov, sadrzaj', 'required'),
			array('id_iz_medija, id_jezik', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>500),
			array('naslov', 'length', 'max'=>256),
			array('podnaslov', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naziv, id_iz_medija, id_jezik, naslov, podnaslov, sadrzaj', 'safe', 'on'=>'search'),
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
			'idIzMedija' => array(self::BELONGS_TO, 'IzMedija', 'id_iz_medija'),
			'idJezik' => array(self::BELONGS_TO, 'Jezik', 'id_jezik'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'naziv' => 'Naziv',
			'id_iz_medija' => 'Id Iz Medija',
			'id_jezik' => 'Id Jezik',
			'naslov' => 'Naslov',
			'podnaslov' => 'Podnaslov',
			'sadrzaj' => 'Sadrzaj',
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
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('id_iz_medija',$this->id_iz_medija);
		$criteria->compare('id_jezik',$this->id_jezik);
		$criteria->compare('naslov',$this->naslov,true);
		$criteria->compare('podnaslov',$this->podnaslov,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}