<?php

/**
 * This is the model class for table "vijest".
 *
 * The followings are the available columns in table 'vijest':
 * @property integer $id
 * @property string $naslov
 * @property string $podnaslov
 * @property string $sadrzaj
 * @property string $seo_naslov
 * @property string $seo_opis
 * @property string $seo_kljucne_rijeci
 * @property string $mala_fotka
 * @property string $velika_fotka
 * @property integer $aktivno
 * @property integer $obrisano
 * @property integer $hits
 *
 * The followings are the available model relations:
 * @property VijestPrijevod[] $vijestPrijevods
 */
class Vijest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vijest the static model class
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
		return 'vijest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naslov, sadrzaj, seo_naslov, seo_opis, seo_kljucne_rijeci', 'required'),
			array('aktivno, obrisano, hits', 'numerical', 'integerOnly'=>true),
			array('naslov', 'length', 'max'=>500),
			array('podnaslov, mala_fotka, velika_fotka', 'length', 'max'=>1000),
			array('seo_naslov, seo_opis, seo_kljucne_rijeci', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naslov, podnaslov, sadrzaj, seo_naslov, seo_opis, seo_kljucne_rijeci, mala_fotka, velika_fotka, aktivno, obrisano, hits', 'safe', 'on'=>'search'),
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
			'vijestPrijevods' => array(self::HAS_MANY, 'VijestPrijevod', 'id_vijest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'naslov' => 'Naslov',
			'podnaslov' => 'Podnaslov',
			'sadrzaj' => 'Sadrzaj',
			'seo_naslov' => 'Seo Naslov',
			'seo_opis' => 'Seo Opis',
			'seo_kljucne_rijeci' => 'Seo Kljucne Rijeci',
			'mala_fotka' => 'Mala Fotka',
			'velika_fotka' => 'Velika Fotka',
			'aktivno' => 'Aktivno',
			'obrisano' => 'Obrisano',
			'hits' => 'Hits',
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
		$criteria->compare('naslov',$this->naslov,true);
		$criteria->compare('podnaslov',$this->podnaslov,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('seo_naslov',$this->seo_naslov,true);
		$criteria->compare('seo_opis',$this->seo_opis,true);
		$criteria->compare('seo_kljucne_rijeci',$this->seo_kljucne_rijeci,true);
		$criteria->compare('mala_fotka',$this->mala_fotka,true);
		$criteria->compare('velika_fotka',$this->velika_fotka,true);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);
		$criteria->compare('hits',$this->hits);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}