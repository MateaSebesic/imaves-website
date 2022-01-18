<?php

/**
 * This is the model class for table "jezik".
 *
 * The followings are the available columns in table 'jezik':
 * @property integer $id
 * @property string $naziv
 * @property string $kratica
 * @property integer $aktivno
 *
 * The followings are the available model relations:
 * @property ClanakPrijevod[] $clanakPrijevods
 * @property SeoPrijevod[] $seoPrijevods
 */
class Jezik extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jezik the static model class
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
		return 'jezik';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naziv, kratica', 'required'),
			array('aktivno', 'numerical', 'integerOnly'=>true),
			array('naziv', 'length', 'max'=>255),
			array('kratica', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naziv, kratica, aktivno', 'safe', 'on'=>'search'),
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
			'clanakPrijevods' => array(self::HAS_MANY, 'ClanakPrijevod', 'id_jezik'),
			'seoPrijevods' => array(self::HAS_MANY, 'SeoPrijevod', 'id_jezik'),
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
			'kratica' => 'Kratica',
			'aktivno' => 'Aktivno',
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
		$criteria->compare('kratica',$this->kratica,true);
		$criteria->compare('aktivno',$this->aktivno);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}