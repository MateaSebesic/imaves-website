<?php

class AdminKontaktController extends AController
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','lista'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Pregled upita
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	/**
	 * Lista svih upita
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$upitBrisanje = Kontakt::model()->findbyPk($_GET['obrisi']);
			$upitBrisanje->obrisano = 1;
			$upitBrisanje->save();
			$log = 'Obrisan je kontakt upit , id: '.$upitBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'id DESC';
		$models = Kontakt::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$models,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Kontakt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
