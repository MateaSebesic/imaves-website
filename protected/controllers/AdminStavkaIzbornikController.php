<?php

class AdminStavkaIzbornikController extends AController
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
				'actions'=>array('create','update','lista','djeca','prijevod','uredi_prijevod', 'fotka'),
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
	public function actionCreate($izbornik)
	{
		$model=new StavkaIzbornik;
		$model->id_izbornik = $izbornik;
		$izbornik = Izbornik::model()->findbyPk($izbornik);
		if (isset($_GET['roditelj'])){
			$model->id_roditelj = $_GET['roditelj'];
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StavkaIzbornik']))
		{
		if ($model->id_roditelj){
				$model->pozicija = $this->pozicijaDijete($model->id_roditelj);
			}else{
				$model->pozicija = $this->pozicijaRoditelj();
			}
		
			$model->attributes=$_POST['StavkaIzbornik'];
			if($model->save()){
				//kreiranje prijevoda
				$jezici = Jezik::model()->findAll('aktivno = 1');
				foreach($jezici as $jezik){
					$prijevod = new StavkaPrijevod;
					$prijevod->id_jezik = $jezik->id;
					$prijevod->id_stavka_izbornik = $model->id;
					$prijevod->naziv = $model->naziv;
					$prijevod->save();
				}
				//kraj kreiranja prijevoda
				$log = 'Kreirana je stavka, id: '.$model->id;
				VelikiBrat::upisiLog($log);
				if ($model->id_roditelj){
					$this->redirect(array('djeca','roditelj'=>$model->id_roditelj,'ok'=>1));
				}else{
					$this->redirect(array('lista','izbornik'=>$izbornik->id,'ok'=>1));
				}
				
			}
		}
		

		$this->render('create',array(
			'model'=>$model,
			'izbornik'=>$izbornik,
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
		$izbornik = Izbornik::model()->findbyPk($model->id_izbornik);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StavkaIzbornik']))
		{
			$model->attributes=$_POST['StavkaIzbornik'];
			if($model->save()){
				if ($model->id_roditelj){
					$this->redirect(array('djeca','roditelj'=>$model->id_roditelj,'ok'=>1));
				}else{
					$this->redirect(array('lista','izbornik'=>$izbornik->id,'ok'=>1));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'izbornik'=>$izbornik,
		));
	}
	
	/**
	 * Prikaz jezika za prijevod stavke izbornika
	 */
	
	public function actionPrijevod($id){
		$model = StavkaIzbornik::model()->findbyPk($id);
		$jezici = Jezik::model()->findAll('aktivno = 1');
		
		
		$this->render('prijevod',array(
			'model'=>$model,
			'jezici'=>$jezici,
		));
	}
	
	/**
	 * Lista svih stavki unurat izbornika
	 */

	public function actionLista($izbornik)
	{
		
		if (isset($_GET['obrisi'])){
			$objektBrisanje = StavkaIzbornik::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisana je Stavka Izbornik, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['pozicijaUp'])){
			$this->pozicijaUp($_GET['pozicijaUp']);
		}
		if (isset($_GET['pozicijaDown'])){
			$this->pozicijaDown($_GET['pozicijaDown']);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = StavkaIzbornik::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktivirana je StavkaIzbornik, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = StavkaIzbornik::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektivirana je StavkaIzbornik, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		$izbornik = Izbornik::model()->findbyPk($izbornik);
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano AND id_izbornik=:izbornik AND id_roditelj IS NULL';
		$criteria->params=array(':obrisano'=>0,':izbornik'=>$izbornik->id);
		$criteria->order='pozicija ASC';
		$models = StavkaIzbornik::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$models,
			'izbornik'=>$izbornik,
		));
	}
	
	
	/**
	 * Dodavanje velike fotografije za stavku izbornika
	 */
	
	public function actionFotka($id){
		if ($id){
			$model = StavkaIzbornik::model()->findbypk($id);
			$izbornik = Izbornik::model()->findbyPk($model->id_izbornik);
			if (!empty($_FILES['fotka']['name'])){
				//ako je podignuta fotografija
				$novaFotka = new UploadFotke;
				$novaFotka->definirajFolder('fotografije/izbornik/'.$id);
				$novaFotka->definirajDimenzije(1920,320);
				if ($imeNoveFotke = $novaFotka->uploadajFotku(1)){
					$model->fotografija = $imeNoveFotke;
					$model->save();
					$ok = 1;
					
				}else{
					$ok = 0;
				}
				$this->render('fotka',array(
						'model'=>$model,
						'izbornik'=>$izbornik,
						'ok'=>$ok,
				));
			}else{
				$this->render('fotka',array(
					'izbornik'=>$izbornik,
						'model'=>$model,
				));
			}
		}else{
			$this->redirect('lista');
		}	
	}
	
	/**
	 * Lista svih stavki djece unurat stavke roditelja
	 */

	public function actionDjeca($roditelj)
	{
		
		if (isset($_GET['obrisi'])){
			$objektBrisanje = StavkaIzbornik::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisana je Stavka Izbornik, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['pozicijaUp'])){
			$this->pozicijaUp($_GET['pozicijaUp']);
		}
		if (isset($_GET['pozicijaDown'])){
			$this->pozicijaDown($_GET['pozicijaDown']);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = StavkaIzbornik::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktivirana je StavkaIzbornik, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = StavkaIzbornik::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektivirana je StavkaIzbornik, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		$roditelj = StavkaIzbornik::model()->findbyPk($roditelj);
		$izbornik = Izbornik::model()->findbyPk($roditelj->id_izbornik);
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano AND id_izbornik=:izbornik AND id_roditelj=:roditelj';
		$criteria->params=array(':obrisano'=>0,':izbornik'=>$izbornik->id,':roditelj'=>$roditelj->id);
		$criteria->order='pozicija ASC';
		$models = StavkaIzbornik::model()->findAll($criteria);
		$this->render('djeca',array(
			'models'=>$models,
			'izbornik'=>$izbornik,
			'roditelj'=>$roditelj,
		));
	}
	
	/**
	* Pozicija up
	*/
    
	public function pozicijaUp($id){
	    $trazeno = StavkaIzbornik::model()->findbyPk($id);
	    if ($trazeno->id_roditelj == NULL){
		    $trenutnaPozicija = $trazeno->pozicija;
		    if($trenutnaPozicija != '0'){
			$zeljenaPozicija = intval($trenutnaPozicija)-1;
			if($gornji = StavkaIzbornik::model()->find('obrisano = 0 AND id_roditelj IS NULL AND pozicija = '.$zeljenaPozicija))
			{
			    $gornji->pozicija = $trenutnaPozicija;
			    $gornji->save();
			}
			$trazeno->pozicija = $zeljenaPozicija;
			$trazeno->save();
		    }
	    }else{
		    $trenutnaPozicija = $trazeno->pozicija;
		    if($trenutnaPozicija != '0'){
			$zeljenaPozicija = intval($trenutnaPozicija)-1;
			$roditelj = $trazeno->id_roditelj;
			if($gornji = StavkaIzbornik::model()->find('obrisano = 0 AND id_roditelj = '.$roditelj.' AND pozicija = '.$zeljenaPozicija))
			{
			    $gornji->pozicija = $trenutnaPozicija;
			    $gornji->save();
			}
			$trazeno->pozicija = $zeljenaPozicija;
			$trazeno->save();
		    }
	    }
	}
	
	/**
	 * Pozicija down 
	 */
	
	public function pozicijaDown($id){
	    $trazeno = StavkaIzbornik::model()->findbyPk($id);
	    $trenutnaPozicija = $trazeno->pozicija;
	    if ($trazeno->id_roditelj == NULL){
		    $zeljenaPozicija = intval($trenutnaPozicija)+1;
		    if($donji = StavkaIzbornik::model()->find('id_roditelj IS NULL AND obrisano = 0 AND pozicija = '.$zeljenaPozicija))
		    {
			$donji->pozicija = $trenutnaPozicija;
			$donji->save();
		    }
		    $trazeno->pozicija = $zeljenaPozicija;
		    $trazeno->save();	
	    }else{
		    $zeljenaPozicija = intval($trenutnaPozicija)+1;
		    $roditelj = $trazeno->id_roditelj;
		    if($donji = StavkaIzbornik::model()->find('id_roditelj ='.$roditelj.' AND obrisano = 0 AND pozicija = '.$zeljenaPozicija))
		    {
			$donji->pozicija = $trenutnaPozicija;
			$donji->save();
		    }
		    $trazeno->pozicija = $zeljenaPozicija;
		    $trazeno->save();
	    }
	    
	}
	
	/**
	 * Definiranje pozicije za kategoriju 
	 */
	
	public function pozicijaRoditelj(){
		$criteria = new CDbCriteria;
		$criteria->condition='id_roditelj IS NULL AND obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'pozicija DESC';
		if ($zadnji = StavkaIzbornik::model()->find($criteria)){
			return $zadnji->pozicija + 1;
		}else{
			return 1;
		}	
	}
	
	/**
	 * Definiranje pozicije za podkategoriju unutar kategorije
	 */
	
	public function pozicijaDijete($roditelj){
		$criteria = new CDbCriteria;
		$criteria->condition='id_roditelj=:roditelj AND obrisano=:obrisano';
		$criteria->params=array(':roditelj'=>$roditelj, ':obrisano'=>0);
		$criteria->order = 'pozicija DESC';
		if ($zadnji = StavkaIzbornik::model()->find($criteria)){
			return $zadnji->pozicija + 1;
		}else{
			return 1;
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
		$dataProvider=new CActiveDataProvider('StavkaIzbornik');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StavkaIzbornik('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StavkaIzbornik']))
			$model->attributes=$_GET['StavkaIzbornik'];

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
		$model=StavkaIzbornik::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='stavka-izbornik-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
