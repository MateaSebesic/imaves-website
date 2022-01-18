<?php

class AdminVijestController extends AController
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
				'actions'=>array('index','view','lista','prijevod','velikaFotka','malaFotka'),
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
		$model=new Vijest;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vijest']))
		{
			$model->attributes=$_POST['Vijest'];
			if($model->save()){
				$log = 'Kreirana je vijest, id: '.$model->id;
				VelikiBrat::upisiLog($log);
				//kreiranje prijevoda
				$jezici = Jezik::model()->findAll('aktivno = 1');
				foreach($jezici as $jezik){
					$prijevod = new VijestPrijevod;
					$prijevod->id_jezik = $jezik->id;
					$prijevod->id_vijest = $model->id;
					$prijevod->naslov = $model->naslov;
					$prijevod->podnaslov = $model->podnaslov;
					$prijevod->sadrzaj = $model->sadrzaj;
					$prijevod->seo_naslov = $model->seo_naslov;
					$prijevod->seo_opis = $model->seo_opis;
					$prijevod->seo_kljucne_rijeci = $model->seo_kljucne_rijeci;
					$prijevod->save();
				}
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

		if(isset($_POST['Vijest']))
		{
			$model->attributes=$_POST['Vijest'];
			if($model->save()){
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Prikaz jezika za prijevod vijesti
	 */
	
	public function actionPrijevod($id){
		$model = Vijest::model()->findbyPk($id);
		$jezici = Jezik::model()->findAll('aktivno = 1');
		
		
		$this->render('prijevod',array(
			'model'=>$model,
			'jezici'=>$jezici,
		));
	}
	
	/**
	 * Lista svih vijesti
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$objektBrisanje = Vijest::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisana je Vijest, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = Vijest::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktivirana je Vijest, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = Vijest::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektivirana je Vijest, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'id ASC';
		$models = Vijest::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$models,
		));
	}
	
	/**
	 * Dodavanje velike fotografije za vijest
	 */
	
	public function actionVelikaFotka($id){
		if ($id){
			$model = Vijest::model()->findbypk($id);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/vijest/velike/'.$id);
				$novaFotka->definirajDimenzije(597,255);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(1)){
					$model->velika_fotka = $imeNoveFotke;
					$model->save();
					$ok = 1;
					
				}else{
					$ok = 0;
				}
				$this->render('velika_fotka',array(
						'model'=>$model,
						'ok'=>$ok,
				));
			}else{
				$this->render('velika_fotka',array(
						'model'=>$model,
				));
			}
		}else{
			$this->redirect('lista');
		}	
	}
	/**
	 * Dodavanje male fotografije za vijest
	 */
	
	public function actionMalaFotka($id){
		if ($id){
			$model = Vijest::model()->findbypk($id);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/ponuda/male/'.$id);
				$novaFotka->definirajDimenzije(175,135);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(1)){
					$model->mala_fotka = $imeNoveFotke;
					$model->save();
					$ok = 1;
					
				}else{
					$ok = 0;
				}
				$this->render('mala_fotka',array(
						'model'=>$model,
						'ok'=>$ok,
				));
			}else{
				$this->render('mala_fotka',array(
						'model'=>$model,
				));
			}
		}else{
			$this->redirect('lista');
		}	
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
		$dataProvider=new CActiveDataProvider('Vijest');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vijest('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vijest']))
			$model->attributes=$_GET['Vijest'];

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
		$model=Vijest::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vijest-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
