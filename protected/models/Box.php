<?php

/**
 * This is the model class for table "box".
 *
 * The followings are the available columns in table 'box':
 * @property integer $id
 * @property string $naziv
 * @property string $sadrzaj
 * @property string $link
 * @property integer $obrisano
 *
 * The followings are the available model relations:
 * @property BoxPrijevod[] $boxPrijevods
 */
class Box extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Box the static model class
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
		return 'box';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, naziv, sadrzaj, link', 'required'),
			array('id, obrisano', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>255),
			array('link', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naziv, sadrzaj, link, obrisano', 'safe', 'on'=>'search'),
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
			'boxPrijevods' => array(self::HAS_MANY, 'BoxPrijevod', 'id_box'),
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
			'sadrzaj' => 'Sadrzaj',
			'link' => 'Link',
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
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('obrisano',$this->obrisano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}