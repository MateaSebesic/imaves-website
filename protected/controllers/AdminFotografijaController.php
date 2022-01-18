<?php

class AdminFotografijaController extends AController
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updatePhoto'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Kreiranje nove fotografije
	 */

	public function actionCreate($galerija)
	{
		$model=new Fotografija;
		if ($galerija){
			
			$fotogalerija = Fotogalerija::model()->findbyPk($galerija);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/fotogalerija/'.$galerija);
				$novaFotka->definirajDimenzije(570,400);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(0)){
					$model->fotografija = $imeNoveFotke;
					$model->id_fotogalerija= $galerija;
					$model->alt = $fotogalerija->naziv;
					$model->pozicija = $this->pozicija($galerija);
					$model->save();
					$log = 'Dodana je nova fotografija, id: '.$model->id;
					VelikiBrat::upisiLog($log);
					$this->redirect(array('update','id'=>$model->id,'ok'=>1));
					break;
					
				}else{
					$ok = 0;
				}
				$this->render('create',array(
						'galerija'=>$galerija,
						'ok'=>$ok,
						'fotogalerija'=>$fotogalerija,
						'model'=>$model,
				));
			}else{
				$this->render('create',array(
						'galerija'=>$galerija,
						'fotogalerija'=>$fotogalerija,
						'model'=>$model,
				));
			}	
		}else{
			$this->redirect(Yii::app()->params['webURL'].'adminFotogalerija/lista');
		}
		
		
	}
	
	/**
	 * Izmijena fotografije
	 */
	
	public function actionUpdatePhoto($id)
	{
		$model=Fotografija::model()->findbyPk($id);
		$galerija= $model->id_fotogalerija;
		if ($galerija){
			
			$fotogalerija = Fotogalerija::model()->findbyPk($galerija);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/fotogalerija/'.$galerija);
				$novaFotka->definirajDimenzije(150,150);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(0)){
					$model->fotografija = $imeNoveFotke;
					$model->id_fotogalerija= $galerija;
					
					$model->pozicija = $this->pozicija($galerija);
					$model->save();
					$log = 'Izmijenjena je fotografija, id: '.$model->id;
					VelikiBrat::upisiLog($log);
					$this->redirect(array('adminFotogalerija/dodaj','galerija'=>$model->id_fotogalerija,'ok'=>1));
					break;
					
				}else{
					$ok = 0;
				}
				$this->render('update_photo',array(
						'galerija'=>$galerija,
						'ok'=>$ok,
						'fotogalerija'=>$fotogalerija,
						'model'=>$model,
				));
			}else{
				$this->render('update_photo',array(
						'galerija'=>$galerija,
						'fotogalerija'=>$fotogalerija,
						'model'=>$model,
				));
			}	
		}else{
			$this->redirect(Yii::app()->params['webURL'].'admin');
		}
		
		
	}
	
	/**
	 * Određivanje pozicije za novu fotografiju unutar fotogalerije
	 */
	
	public function pozicija($galerija){
		$criteria = new CDbCriteria;
		$criteria->condition='id_fotogalerija=:id_galerije AND obrisano=:obrisano';
		$criteria->params=array(':id_galerije'=>$galerija, ':obrisano'=>0);
		$criteria->order = 'pozicija DESC';
		if ($zadnjaFotka = Fotografija::model()->find($criteria)){
			return $zadnjaFotka->pozicija + 1;
		}else{
			return 1;
		}
		
		
	}

	/**
	 * Uređivanje opisa (alt taga)
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Fotografija']))
		{
			$model->attributes=$_POST['Fotografija'];
			if($model->save()){
				$log = 'Uređen je opis fotografije, id: '.$model->id;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('adminFotogalerija/dodaj','galerija'=>$model->id_fotogalerija));
			}
		}

		$this->render('update',array(
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
		$model=Fotografija::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='fotografija-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
