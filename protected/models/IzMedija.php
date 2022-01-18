<?php

/**
 * This is the model class for table "iz_medija".
 *
 * The followings are the available columns in table 'iz_medija':
 * @property integer $id
 * @property string $naziv
 * @property string $naslov
 * @property string $podnaslov
 * @property string $sadrzaj
 * @property string $fotografija
 * @property integer $pozicija
 * @property integer $aktivno
 * @property integer $obrisano
 * @property integer $hits
 *
 * The followings are the available model relations:
 * @property IzMedijaPrijevod[] $izMedijaPrijevods
 */
class IzMedija extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IzMedija the static model class
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
		return 'iz_medija';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naziv, naslov, sadrzaj', 'required'),
			array('pozicija, aktivno, obrisano, hits', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>500),
			array('naslov', 'length', 'max'=>256),
			array('podnaslov', 'length', 'max'=>300),
			array('fotografija', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naziv, naslov, podnaslov, sadrzaj, fotografija, pozicija, aktivno, obrisano, hits', 'safe', 'on'=>'search'),
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
			'izMedijaPrijevods' => array(self::HAS_MANY, 'IzMedijaPrijevod', 'id_iz_medija'),
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
			'naslov' => 'Naslov',
			'podnaslov' => 'Podnaslov',
			'sadrzaj' => 'Sadrzaj',
			'fotografija' => 'Fotografija',
			'pozicija' => 'Pozicija',
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
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('naslov',$this->naslov,true);
		$criteria->compare('podnaslov',$this->podnaslov,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('fotografija',$this->fotografija,true);
		$criteria->compare('pozicija',$this->pozicija);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);
		$criteria->compare('hits',$this->hits);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}