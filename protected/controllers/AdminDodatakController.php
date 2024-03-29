<?php

class AdminDodatakController extends AController
{
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','lista'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Dodatak;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dodatak']))
		{
			$model->attributes=$_POST['Dodatak'];
			if($model->save()){
				$log = 'Kreiran je dodatak, id: '.$model->id.', naziv: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dodatak']))
		{
			$model->attributes=$_POST['Dodatak'];
			if($model->save()){
				$log = 'Uređen je dodatak, id: '.$model->id.', naziv: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Lista svih dodataka
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$objektBrisanje = Dodatak::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisan je dodatak, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
			if ($clanci = Clanak::model()->findAll('id_dodatak = '.$objektBrisanje->id)){
				foreach($clanci as $clanak){
					$clanak->id_dodatak = NULL;
					$clanak->save();
				}
			}
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = Dodatak::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktiviran je dodatak, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = Dodatak::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektiviran je dodatak, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
			if ($clanci = Clanak::model()->findAll('id_dodatak = '.$objektDektivacija->id)){
				foreach($clanci as $clanak){
					$clanak->id_dodatak = NULL;
					$clanak->save();
				}
			}
		}
		
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'id ASC';
		$clanci = Dodatak::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$clanci,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Dodatak');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Dodatak('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dodatak']))
			$model->attributes=$_GET['Dodatak'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Dodatak::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dodatak-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
