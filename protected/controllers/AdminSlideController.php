<?php

class AdminSlideController extends AController
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
				'actions'=>array('index','view','updatephoto','updatetext'),
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

	public function actionCreate($slideshow)
	{
		$model=new Slide;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if ($slideshow){
			
			$odabraniSlideshow = Slideshow::model()->findbyPk($slideshow);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/slideshow/'.$slideshow);
				$novaFotka->definirajDimenzije(1920,481);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(1)){
					$model->fotografija = $imeNoveFotke;
					$model->naziv = 'Novi slide';
					$model->opis = 'Novi slide';
					$model->link = 'Novi slide';
					$model->id_slideshow = $slideshow;
					$model->pozicija = $this->pozicija($slideshow);
					$model->save();
					$log = 'Kreiran je slide, id: '.$model->id;
					VelikiBrat::upisiLog($log);
					$this->redirect(array('UpdateText','id'=>$model->id,'ok'=>1));
					break;
					
				}else{
					$ok = 0;
				}
				$this->render('create',array(
						'ok'=>$ok,
						'slideshow'=>$odabraniSlideshow,
						'model'=>$model,
				));
			}else{
				$this->render('create',array(
						'slideshow'=>$odabraniSlideshow,
						'model'=>$model,
				));
			}
			
			
			
			
		}else{
			$this->redirect(Yii::app()->params['webURL'].'adminFotogalerija/lista');
		}
		
		
	}
	
	public function actionUpdateText($id){
		$model = Slide::model()->findbyPk($id);
		if(isset($_POST['Slide']))
		{
			$model->attributes=$_POST['Slide'];
			if($model->save())
				$log = 'Promijenjen je tekst za slide, id: '.$model->id;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('AdminSlideshow/dodaj','ok'=>1,'galerija'=>$model->id_slideshow));
		}

		$this->render('update_text',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdatePhoto($id)
	{
		$model=Slide::model()->findbyPk($id);
		$slideshow = $model->id_slideshow;
		if ($slideshow){
			$odabraniSlideshow = Slideshow::model()->findbyPk($slideshow);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/slideshow/'.$slideshow);
				$novaFotka->definirajDimenzije(1920,481);
				if ($imeNoveFotke = $novaFotka->uploadajFotku()){
					$model->fotografija = $imeNoveFotke;
					$model->id_slideshow = $slideshow;
					$model->save();
					$log = 'Promijenjena je fotka za slide, id: '.$model->id;
					VelikiBrat::upisiLog($log);
					$this->redirect(array('UpdateText','id'=>$model->id));
					break;
				}else{
					$ok = 0;
				}
				$this->render('update_photo',array(
						'ok'=>$ok,
						'slideshow'=>$odabraniSlideshow,
				));
			}else{
				$this->render('update_photo',array(
						'model'=>$model,
						'slideshow'=>$odabraniSlideshow,
				));
			}
		}else{
			$this->redirect(Yii::app()->params['webURL'].'adminSlideshow/lista');
		}
	}
	
	public function pozicija($slideshow){
		$criteria = new CDbCriteria;
		$criteria->condition='id_slideshow=:id_slideshow AND obrisano=:obrisano';
		$criteria->params=array(':id_slideshow'=>$slideshow, ':obrisano'=>0);
		$criteria->order = 'pozicija DESC';
		if ($zadnjiSlide = Slide::model()->find($criteria)){
			return $zadnjiSlide->pozicija + 1;
		}else{
			return 1;
		}	
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

		if(isset($_POST['Slide']))
		{
			$model->attributes=$_POST['Slide'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Slide');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Slide('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slide']))
			$model->attributes=$_GET['Slide'];

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
		$model=Slide::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='slide-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
