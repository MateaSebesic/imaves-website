<?php

/**
 * This is the model class for table "seo".
 *
 * The followings are the available columns in table 'seo':
 * @property integer $id
 * @property string $seo_naslov
 * @property string $seo_opis
 * @property string $seo_kljucne_rijeci
 */
class Seo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seo the static model class
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
		return 'seo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seo_naslov, seo_opis, seo_kljucne_rijeci', 'required'),
			array('seo_naslov, seo_opis, seo_kljucne_rijeci', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, seo_naslov, seo_opis, seo_kljucne_rijeci', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
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
		$criteria->compare('seo_naslov',$this->seo_naslov,true);
		$criteria->compare('seo_opis',$this->seo_opis,true);
		$criteria->compare('seo_kljucne_rijeci',$this->seo_kljucne_rijeci,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}