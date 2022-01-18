<?php

/**
 * This is the model class for table "clanak".
 *
 * The followings are the available columns in table 'clanak':
 * @property integer $id
 * @property string $naslov
 * @property string $sadrzaj
 * @property string $seo_naslov
 * @property string $seo_kljucne_rijeci
 * @property string $seo_opis
 * @property integer $id_fotogalerija
 * @property integer $id_dodatak
 * @property integer $naslovnica
 * @property integer $aktivno
 * @property integer $obrisano
 * @property integer $hits
 *
 * The followings are the available model relations:
 * @property Fotogalerija $idFotogalerija
 * @property Dodatak $idDodatak
 * @property StavkaIzbornik[] $stavkaIzborniks
 */
class Clanak extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clanak the static model class
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
		return 'clanak';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naslov, sadrzaj, seo_naslov, seo_kljucne_rijeci, seo_opis', 'required'),
			array('id_fotogalerija, id_dodatak, naslovnica, aktivno, obrisano, hits', 'numerical', 'integerOnly'=>true),
			array('naslov, seo_naslov, seo_kljucne_rijeci', 'length', 'max'=>256),
			array('link','default'),
			array('seo_opis', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naslov, sadrzaj, seo_naslov, seo_kljucne_rijeci, seo_opis, link, id_fotogalerija, id_dodatak, naslovnica, aktivno, obrisano, hits', 'safe', 'on'=>'search'),
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
			'idFotogalerija' => array(self::BELONGS_TO, 'Fotogalerija', 'id_fotogalerija'),
			'idDodatak' => array(self::BELONGS_TO, 'Dodatak', 'id_dodatak'),
			'stavkaIzborniks' => array(self::HAS_MANY, 'StavkaIzbornik', 'id_clanak'),
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
			'sadrzaj' => 'Sadrzaj',
			'seo_naslov' => 'Seo Naslov',
			'seo_kljucne_rijeci' => 'Seo Kljucne Rijeci',
			'seo_opis' => 'Seo Opis',
			'id_fotogalerija' => 'Id Fotogalerija',
			'id_dodatak' => 'Id Dodatak',
			'naslovnica' => 'Naslovnica',
			'aktivno' => 'Aktivno',
			'obrisano' => 'Obrisano',
			'hits' => 'Hits',
			'link' => 'Link (za partnere)',
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
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('seo_naslov',$this->seo_naslov,true);
		$criteria->compare('seo_kljucne_rijeci',$this->seo_kljucne_rijeci,true);
		$criteria->compare('seo_opis',$this->seo_opis,true);
		$criteria->compare('id_fotogalerija',$this->id_fotogalerija);
		$criteria->compare('id_dodatak',$this->id_dodatak);
		$criteria->compare('naslovnica',$this->naslovnica);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);
		$criteria->compare('hits',$this->hits);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}