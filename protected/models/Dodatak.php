<?php

/**
 * This is the model class for table "dodatak".
 *
 * The followings are the available columns in table 'dodatak':
 * @property integer $id
 * @property string $naziv
 * @property string $sadrzaj
 * @property integer $aktivno
 * @property integer $obrisano
 *
 * The followings are the available model relations:
 * @property Clanak[] $clanaks
 */
class Dodatak extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dodatak the static model class
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
		return 'dodatak';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naziv, sadrzaj', 'required'),
			array('aktivno, obrisano', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naziv, sadrzaj, aktivno, obrisano', 'safe', 'on'=>'search'),
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
			'clanaks' => array(self::HAS_MANY, 'Clanak', 'id_dodatak'),
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
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('sadrzaj',$this->sadrzaj,true);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}