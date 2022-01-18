<?php

/**
 * This is the model class for table "vijest_prijevod".
 *
 * The followings are the available columns in table 'vijest_prijevod':
 * @property integer $id
 * @property integer $id_vijest
 * @property integer $id_jezik
 * @property string $naslov
 * @property string $podnaslov
 * @property string $sadrzaj
 * @property string $seo_naslov
 * @property string $seo_opis
 * @property string $seo_kljucne_rijeci
 *
 * The followings are the available model relations:
 * @property Jezik $idJezik
 * @property Vijest $idVijest
 */
class VijestPrijevod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VijestPrijevod the static model class
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
		return 'vijest_prijevod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_vijest, id_jezik, naslov, sadrzaj, seo_naslov, seo_opis, seo_kljucne_rijeci', 'required'),
			array('id_vijest, id_jezik', 'numerical', 'integerOnly'=>true),
			array('naslov', 'length', 'max'=>500),
			array('podnaslov', 'length', 'max'=>1000),
			array('seo_naslov, seo_opis, seo_kljucne_rijeci', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_vijest, id_jezik, naslov, podnaslov, sadrzaj, seo_naslov, seo_opis, seo_kljucne_rijeci', 'safe', 'on'=>'search'),
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
			'idJezik' => array(self::BELONGS_TO, 'Jezik', 'id_jezik'),
			'idVijest' => array(self::BELONGS_TO, 'Vijest', 'id_vijest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_vijest' => 'Id Vijest',
			'id_jezik' => 'Id Jezik',
			'naslov' => 'Naslov',
			'podnaslov' => 'Podnaslov',
			'sadrzaj' => 'Sadrzaj',
			'seo_naslov' => 'Seo Naslov',
			'seo_opis' => 'Seo Opis',
			'seo_kljucne_rijeci' => 'Seo Kljucne Rijeci',
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
		$criteria->compare('id_vijest',$this->id_vijest);
		$criteria->compare('id_jezik',$this->id_jezik);
		$criteria->compare('naslov',$this->naslov,true);
		$criteria->compare('podnaslov',$this->podnaslov,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('seo_naslov',$this->seo_naslov,true);
		$criteria->compare('seo_opis',$this->seo_opis,true);
		$criteria->compare('seo_kljucne_rijeci',$this->seo_kljucne_rijeci,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}