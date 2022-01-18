<?php

/**
 * This is the model class for table "slide".
 *
 * The followings are the available columns in table 'slide':
 * @property integer $id
 * @property integer $id_slideshow
 * @property string $fotografija
 * @property string $naziv
 * @property string $opis
 * @property string $link
 * @property integer $objavi_hr
 * @property string $naziv_en
 * @property string $opis_en
 * @property string $link_en
 * @property integer $objavi_en
 * @property string $naziv_de
 * @property string $opis_de
 * @property string $link_de
 * @property integer $objavi_de
 * @property integer $pozicija
 * @property integer $aktivno
 * @property integer $obrisano
 *
 * The followings are the available model relations:
 * @property Slideshow $idSlideshow
 */
class Slide extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Slide the static model class
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
		return 'slide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_slideshow, fotografija, naziv, opis, link, pozicija', 'required'),
			array('id_slideshow, objavi_hr, objavi_en, objavi_de, pozicija, aktivno, obrisano', 'numerical', 'integerOnly'=>true),
			array('fotografija, link, opis_en, link_en, opis_de, link_de', 'length', 'max'=>1000),
			array('naziv, opis', 'length', 'max'=>256),
			array('naziv_en, naziv_de', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_slideshow, fotografija, naziv, opis, link, objavi_hr, naziv_en, opis_en, link_en, objavi_en, naziv_de, opis_de, link_de, objavi_de, pozicija, aktivno, obrisano', 'safe', 'on'=>'search'),
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
			'idSlideshow' => array(self::BELONGS_TO, 'Slideshow', 'id_slideshow'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_slideshow' => 'Id Slideshow',
			'fotografija' => 'Fotografija',
			'naziv' => 'Naziv',
			'opis' => 'Opis',
			'link' => 'Link',
			'objavi_hr' => 'Objavi Hr',
			'naziv_en' => 'Naziv En',
			'opis_en' => 'Opis En',
			'link_en' => 'Link En',
			'objavi_en' => 'Objavi En',
			'naziv_de' => 'Naziv De',
			'opis_de' => 'Opis De',
			'link_de' => 'Link De',
			'objavi_de' => 'Objavi De',
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
		$criteria->compare('id_slideshow',$this->id_slideshow);
		$criteria->compare('fotografija',$this->fotografija,true);
		$criteria->compare('naziv',$this->naziv,true);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('objavi_hr',$this->objavi_hr);
		$criteria->compare('naziv_en',$this->naziv_en,true);
		$criteria->compare('opis_en',$this->opis_en,true);
		$criteria->compare('link_en',$this->link_en,true);
		$criteria->compare('objavi_en',$this->objavi_en);
		$criteria->compare('naziv_de',$this->naziv_de,true);
		$criteria->compare('opis_de',$this->opis_de,true);
		$criteria->compare('link_de',$this->link_de,true);
		$criteria->compare('objavi_de',$this->objavi_de);
		$criteria->compare('pozicija',$this->pozicija);
		$criteria->compare('aktivno',$this->aktivno);
		$criteria->compare('obrisano',$this->obrisano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}