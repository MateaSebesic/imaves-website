<?php

/**
 * This is the model class for table "fotografija".
 *
 * The followings are the available columns in table 'fotografija':
 * @property integer $id
 * @property integer $id_fotogalerija
 * @property string $fotografija
 * @property string $alt
 * @property integer $pozicija
 * @property integer $aktivno
 * @property integer $obrisano
 *
 * The followings are the available model relations:
 * @property Fotogalerija $idFotogalerija
 */
class Fotografija extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fotografija the static model class
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
		return 'fotografija';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_fotogalerija, fotografija, alt, pozicija', 'required'),
			array('id_fotogalerija, pozicija, aktivno, obrisano', 'numerical', 'integerOnly'=>true),
			array('fotografija', 'length', 'max'=>1000),
			array('alt', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_fotogalerija, fotografija, alt, pozicija, aktivno, obrisano', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_fotogalerija' => 'Id Fotogalerija',
			'fotografija' => 'Fotografija',
			'alt' => 'Opis fotografije',
			'pozicija' => 'Pozicija',
			'aktivno' => 'Aktivno',
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
		$criteria->compare('id_fotogalerija',$this->id_fotogalerija);
		$criteria->compare('fotografija',$this->fotografija,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('pozicija',$this->pozicija);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}