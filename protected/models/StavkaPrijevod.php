<?php

/**
 * This is the model class for table "stavka_prijevod".
 *
 * The followings are the available columns in table 'stavka_prijevod':
 * @property integer $id
 * @property integer $id_stavka_izbornik
 * @property integer $id_jezik
 * @property integer $objavi
 * @property string $naziv
 *
 * The followings are the available model relations:
 * @property StavkaIzbornik $idStavkaIzbornik
 * @property Jezik $idJezik
 */
class StavkaPrijevod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StavkaPrijevod the static model class
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
		return 'stavka_prijevod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_stavka_izbornik, id_jezik, naziv', 'required'),
			array('id_stavka_izbornik, id_jezik, objavi', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_stavka_izbornik, id_jezik, objavi, naziv', 'safe', 'on'=>'search'),
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
			'idStavkaIzbornik' => array(self::BELONGS_TO, 'StavkaIzbornik', 'id_stavka_izbornik'),
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
			'id_stavka_izbornik' => 'Id Stavka Izbornik',
			'id_jezik' => 'Id Jezik',
			'objavi' => 'Objavi',
			'naziv' => 'Naziv',
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
		$criteria->compare('id_stavka_izbornik',$this->id_stavka_izbornik);
		$criteria->compare('id_jezik',$this->id_jezik);
		$criteria->compare('objavi',$this->objavi);
		$criteria->compare('naziv',$this->naziv,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}