<?php

class AdminSlideshowController extends AController
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
				'actions'=>array('index','view','lista','dodaj'),
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
		$model=new Slideshow;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slideshow']))
		{
			$model->attributes=$_POST['Slideshow'];
			if($model->save())
				$log = 'Kreiran je slideshow, id: '.$model->id.', naslov: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
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

		if(isset($_POST['Slideshow']))
		{
			$model->attributes=$_POST['Slideshow'];
			if($model->save())
				$log = 'Promijenjen je slideshow, id: '.$model->id.', naslov: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	 * Lista svih slideshow-ova
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi']) AND $_GET['obrisi'] != 2){
			$slideshowBrisanje = Slideshow::model()->findbyPk($_GET['obrisi']);
			$slideshowBrisanje->obrisano = 1;
			$slideshowBrisanje->save();
			$log = 'Obrisan je slideshow, id: '.$slideshowBrisanje->id.', naslov: '.$slideshowBrisanje->naziv;
			VelikiBrat::upisiLog($log);
		}
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$slideshows = Slideshow::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$slideshows,
		));
	}
	
	/**
	 * Dodavanje ili uređivanje fotografija unutar slideshow-a
	 */
	
	/**
	 * Lists all models.
	 */
	public function actionDodaj($galerija)
	{
		
		$slideshow = Slideshow::model()->findbyPk($galerija);
		if (isset($_GET['obrisi'])){
			$objektBrisanje = Slide::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisan je slide, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = Slide::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktiviran je slide, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = Slide::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektiviran je slide, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['pozicijaUp'])){
			$this->slideUp($_GET['pozicijaUp']);
		}
		if (isset($_GET['pozicijaDown'])){
			$this->slideDown($_GET['pozicijaDown']);
		}
		
		
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano AND id_slideshow=:slideshow';
		$criteria->params=array(':obrisano'=>0,':slideshow'=>$galerija);
		$criteria->order = 'pozicija ASC';
		$fotke = Slide::model()->findAll($criteria);
		$this->render('listaFotki',array(
			'models'=>$fotke,
			'slideshow'=>$slideshow,
		));
	}
	
	/**
     * Pozicija up
     */
    
    public function slideUp($id){
        $trazeno = Slide::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $grupa = $trazeno->id_slideshow;
            if($gornji = Slide::model()->find('id_slideshow = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
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
    
    public function slideDown($id){
        $trazeno = Slide::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $grupa = $trazeno->id_slideshow;
            if($donji = Slide::model()->find('id_slideshow = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Slideshow');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Slideshow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slideshow']))
			$model->attributes=$_GET['Slideshow'];

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
		$model=Slideshow::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='slideshow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
