<?php

class AdminIzMedijaController extends AController
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
				'actions'=>array('index','view','lista','prijevod'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$model=new IzMedija;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['IzMedija']))
		{
			$model->attributes=$_POST['IzMedija'];
			$model->pozicija = $this->pozicija();
			if($model->save()){
				$log = 'Kreiran je iz medija, id: '.$model->id.', naslov: '.$model->naslov;
				VelikiBrat::upisiLog($log);
				//kreiranje prijevoda
				$jezici = Jezik::model()->findAll('aktivno = 1');
				foreach($jezici as $jezik){
					$prijevod = new IzMedijaPrijevod;
					$prijevod->id_jezik = $jezik->id;
					$prijevod->id_iz_medija = $model->id;
					$prijevod->naziv = $model->naziv;
					$prijevod->naslov = $model->naslov;
					$prijevod->podnaslov = $model->podnaslov;
					$prijevod->sadrzaj = $model->sadrzaj;
					$prijevod->save();
				}
				//kraj kreiranja prijevoda
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

		if(isset($_POST['IzMedija']))
		{
			$model->attributes=$_POST['IzMedija'];
			if($model->save()){
				$log = 'Uređen je iz medija, id: '.$model->id;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Prikaz jezika za prijevod stavke izbornika
	 */
	
	public function actionPrijevod($id){
		$model = IzMedija::model()->findbyPk($id);
		$jezici = Jezik::model()->findAll('aktivno = 1');
		$ok = 0;
		if (isset($_GET['kopiraj'])){
			$izMedijaPrijevod = IzMedijaPrijevod::model()->findbyPk($_GET['kopiraj']);
			$izMedijaPrijevod->sadrzaj = $model->sadrzaj;
			$izMedijaPrijevod->naslov = $model->naslov;
			$izMedijaPrijevod->podnaslov = $model->podnaslov;
			$izMedijaPrijevod->naziv = $model->naziv;
			$izMedijaPrijevod->save();
			$ok = 1;
		}
		
		$this->render('prijevod',array(
			'model'=>$model,
			'jezici'=>$jezici,
			'ok'=>$ok,
		));
	}
	
	/**
	 * Lista svih Iz medija
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$objektBrisanje = IzMedija::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisan je IzMedija, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = IzMedija::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktiviran je IzMedija, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = IzMedija::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektiviran je IzMedija, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['pozicijaUp'])){
			$this->pozicijaUp($_GET['pozicijaUp']);
		}
		if (isset($_GET['pozicijaDown'])){
			$this->pozicijaDown($_GET['pozicijaDown']);
		}
		
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'pozicija ASC';
		$models = IzMedija::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$models,
		));
	}
	
	/**
	 * Definiranje pozicije za Iz Medija 
	 */
	
	public function pozicija(){
		$criteria = new CDbCriteria;
		$criteria->condition='aktivno=:aktivno AND obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0,':aktivno'=>1);
		$criteria->order = 'pozicija DESC';
		if ($zadnji = IzMedija::model()->find($criteria)){
			return $zadnji->pozicija + 1;
		}else{
			return 1;
		}	
	}
	
	/**
	* Pozicija up
	*/
    
	public function pozicijaUp($id){
	    $trazeno = IzMedija::model()->findbyPk($id);
	    
		    $trenutnaPozicija = $trazeno->pozicija;
		    if($trenutnaPozicija != '0'){
			$zeljenaPozicija = intval($trenutnaPozicija)-1;
			if($gornji = IzMedija::model()->find('aktivno = 1 AND obrisano = 0 AND pozicija = '.$zeljenaPozicija))
			{
			    $gornji->pozicija = $trenutnaPozicija;
			    $gornji->save();
			}
			$trazeno->pozicija = $zeljenaPozicija;
			$trazeno->save();
		    }
	}
	
	/**
	 * Pozicija down 
	 */
	
	public function pozicijaDown($id){
	    $trazeno = IzMedija::model()->findbyPk($id);
	    $trenutnaPozicija = $trazeno->pozicija;
	    
		    $zeljenaPozicija = intval($trenutnaPozicija)+1;
		    if($donji = IzMedija::model()->find('aktivno = 1 AND obrisano = 0 AND pozicija = '.$zeljenaPozicija))
		    {
			$donji->pozicija = $trenutnaPozicija;
			$donji->save();
		    }
		    $trazeno->pozicija = $zeljenaPozicija;
		    $trazeno->save();	
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
		$dataProvider=new CActiveDataProvider('IzMedija');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IzMedija('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IzMedija']))
			$model->attributes=$_GET['IzMedija'];

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
		$model=IzMedija::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='iz-medija-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
