<?php

class AdminFotogalerijaController extends AController
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','lista','dodaj'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}



	/**
	 * Kreiranje nove fotogalerije
	 */
	public function actionCreate()
	{
		$model=new Fotogalerija;

		if(isset($_POST['Fotogalerija']))
		{
			$model->attributes=$_POST['Fotogalerija'];
			if($model->save()){
				$log = 'Kreirana je fotogalerja, id: '.$model->id.', naziv: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Uređivanje fotogalerije
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Fotogalerija']))
		{
			$model->attributes=$_POST['Fotogalerija'];
			if($model->save()){
				$log = 'Uređena je fotogalerija, id: '.$model->id.', naziv: '.$model->naziv;
				VelikiBrat::upisiLog($log);
				$this->redirect(array('lista','ok'=>1));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lista svih fotogalerija u sustavu
	 */
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$fotogalerijaBrisanje = Fotogalerija::model()->findbyPk($_GET['obrisi']);
			$fotogalerijaBrisanje->obrisano = 1;
			$fotogalerijaBrisanje->save();
			$log = 'Obrisana je fotogalerija, id: '.$model->id;
			VelikiBrat::upisiLog($log);
		}
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		
		$fotogalerija = Fotogalerija::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$fotogalerija,
		));
	}
	
	/**
	 * Lista fotografija unutar fotogalerije
	 */
	public function actionDodaj($galerija)
	{
		
		$fotogalerija = Fotogalerija::model()->findbyPk($galerija);
		if (isset($_GET['obrisi'])){
			$objektBrisanje = Fotografija::model()->findbyPk($_GET['obrisi']);
			$objektBrisanje->obrisano = 1;
			$objektBrisanje->save();
			$log = 'Obrisana je fotka, id: '.$objektBrisanje->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['pozicijaUp'])){
			$this->fotkaUp($_GET['pozicijaUp']);
		}
		if (isset($_GET['pozicijaDown'])){
			$this->fotkaDown($_GET['pozicijaDown']);
		}
		
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano AND id_fotogalerija=:galerija';
		$criteria->params=array(':obrisano'=>0,':galerija'=>$galerija);
		$criteria->order = 'pozicija ASC';
		
          
		$fotke = Fotografija::model()->findAll($criteria);
		
		$this->render('listaFotki',array(
			'models'=>$fotke,
			'fotogalerija'=>$fotogalerija,
		));
	}
	
	/**
	* Pozicija up
	*/
    
	public function fotkaUp($id){
	    $trazeno = Fotografija::model()->findbyPk($id);
	    $trenutnaPozicija = $trazeno->pozicija;
	    if($trenutnaPozicija != '0'){
		$zeljenaPozicija = intval($trenutnaPozicija)-1;
		$grupa= $trazeno->id_fotogalerija;
		if($gornji = Fotografija::model()->find('id_fotogalerija = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
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
    
	public function fotkaDown($id){
	    $trazeno = Fotografija::model()->findbyPk($id);
	    $trenutnaPozicija = $trazeno->pozicija;
	    
		$zeljenaPozicija = intval($trenutnaPozicija)+1;
		$grupa = $trazeno->id_fotogalerija;
		if($donji = Fotografija::model()->find('id_fotogalerija = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
		{
		    $donji->pozicija = $trenutnaPozicija;
		    $donji->save();
		}
		$trazeno->pozicija = $zeljenaPozicija;
		$trazeno->save();
	    
	}

	

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Fotogalerija::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


}
