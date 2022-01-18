<?php

class AdminClanakController extends AController
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
				'actions'=>array('create','update','lista','fotogalerija','dodatak','prijevod'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Kreiranje novog članka
	 */
	public function actionCreate()
	{
		$model=new Clanak;
		if(isset($_POST['Clanak']))
		{
			$model->attributes=$_POST['Clanak'];
			if($model->save()){
				$log = 'Kreiran je članak, id: '.$model->id.', naslov: '.$model->naslov;
				VelikiBrat::upisiLog($log);
				//kreiranje prijevoda
				$jezici = Jezik::model()->findAll('aktivno = 1');
				foreach($jezici as $jezik){
					$prijevod = new ClanakPrijevod;
					$prijevod->id_jezik = $jezik->id;
					$prijevod->id_clanak = $model->id;
					$prijevod->naslov = $model->naslov;
					$prijevod->sadrzaj = $model->sadrzaj;
					$prijevod->seo_naslov = $model->seo_naslov;
					$prijevod->seo_opis = $model->seo_opis;
					$prijevod->seo_kljucne_rijeci = $model->seo_kljucne_rijeci;
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
	 * Uređivanje članka
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Clanak']))
		{
			$model->attributes=$_POST['Clanak'];
			if($model->save()){
				$log = 'Uređen je članak, id: '.$model->id.', naslov: '.$model->naslov;
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
		$model = Clanak::model()->findbyPk($id);
		$jezici = Jezik::model()->findAll('aktivno = 1');
		$ok = 0;
		if (isset($_GET['kopiraj'])){
			$clanakPrijevod = ClanakPrijevod::model()->findbyPk($_GET['kopiraj']);
			$clanakPrijevod->sadrzaj = $model->sadrzaj;
			$clanakPrijevod->naslov = $model->naslov;
			$clanakPrijevod->seo_naslov = $model->seo_naslov;
			$clanakPrijevod->seo_opis = $model->seo_opis;
			$clanakPrijevod->seo_kljucne_rijeci = $model->seo_kljucne_rijeci;
			$clanakPrijevod->save();
			$ok = 1;
		}
		
		
		$this->render('prijevod',array(
			'model'=>$model,
			'jezici'=>$jezici,
			'ok'=>$ok,
		));
	}


	/**
	 * Lista svih članaka
	 */
	
	public function actionLista()
	{
		if (isset($_GET['obrisi'])){
			$clanakBrisanje = Clanak::model()->findbyPk($_GET['obrisi']);
			$clanakBrisanje->obrisano = 1;
			$clanakBrisanje->save();
			$log = 'Obrisan je članak, id: '.$clanakBrisanje->id.', naslov: '.$clanakBrisanje->naslov;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['aktiviraj'])){
			$objektAktivacija = Clanak::model()->findbyPk($_GET['aktiviraj']);
			$objektAktivacija->aktivno = 1;
			$objektAktivacija->save();
			$log = 'Aktiviran je članak, id: '.$objektAktivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['deaktiviraj'])){
			$objektDektivacija = Clanak::model()->findbyPk($_GET['deaktiviraj']);
			$objektDektivacija->aktivno = 0;
			$objektDektivacija->save();
			$log = 'Dektiviran je članak, id: '.$objektDektivacija->id;
			VelikiBrat::upisiLog($log);
		}
		if (isset($_GET['naslovnica'])){
			if ($clanciNaslovnica = Clanak::model()->findAll('naslovnica = 1')){
				foreach($clanciNaslovnica as $clanak){
					$clanak->naslovnica = NULL;
					$clanak->save();
				}
			}
			$clanakNaslovnica = Clanak::model()->findbyPk($_GET['naslovnica']);
			$clanakNaslovnica->naslovnica = 1;
			$clanakNaslovnica->save();
			$log = 'Članak je postavljen na naslovnicu, id: '.$clanakNaslovnica->id;
			VelikiBrat::upisiLog($log);
		}
		$criteria = new CDbCriteria;
		$criteria->condition='obrisano=:obrisano';
		$criteria->params=array(':obrisano'=>0);
		$criteria->order = 'id ASC';
		$clanci = Clanak::model()->findAll($criteria);
		$this->render('lista',array(
			'models'=>$clanci,
		));
	}
	
	/**
	* Pridruživanje fotogalerije članku
	*/
	public function actionFotogalerija($id){
		$model = Clanak::model()->findbyPk($id);
		if(isset($_POST['Clanak']))
			{
				$pomoc = new Clanak;
				$pomoc->attributes = $_POST['Clanak'];
				$model->id_fotogalerija = $pomoc->id_fotogalerija;
				if($model->save())
					$this->redirect(array('lista','ok'=>1));
			}
			$this->render('fotogalerija',array(
				'model'=>$model,
			));
	    }
		
	/**
	* Pridruživanje dodatka članku
	*/
	public function actionDodatak($id){
		$model = Clanak::model()->findbyPk($id);
		if(isset($_POST['Clanak']))
			{
				$pomoc = new Clanak;
				$pomoc->attributes = $_POST['Clanak'];
				$model->id_dodatak = $pomoc->id_dodatak;
				if($model->save()){
					$this->redirect(array('lista','ok'=>1));
				}
			}
			$this->render('dodatak',array(
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
		$model=Clanak::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Traženi članak ne postoji.');
		return $model;
	}

}
