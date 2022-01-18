<?php

class SiteController extends Controller
{
	
	public $pageOgTitle = '';
	public $pageOgDesc = '';
	public $pageOgImage = '';
	public $naslovClanak = '';
	
	public $cssPath = '';
	public $jsPath = '';
	
	public $velikaFotka = '';
	/*
	* Include css & js
	*/
	public function init(){
		parent::init();
		$this->cssPath = Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/css/';
		$this->jsPath = Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/js/';
		
		
		
	
		
	
		
		
		
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery-1.8.3.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery-ui.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery.multi-open-accordion-1.5.3.js');
		//Yii::app()->clientScript->registerCssFile('http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
		
		Yii::app()->clientScript->registerCssFile($this->cssPath.'lightzap.css');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'lightzap.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery.cycle.all.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery-scrollto.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'jquery.simplemodal.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'basic.js');
		Yii::app()->clientScript->registerScriptFile( $this->jsPath.'custom.js');
		
		
		Yii::app()->clientScript->registerCssFile($this->cssPath.'main.css');
		//dropdown
		Yii::app()->clientScript->registerCssFile($this->cssPath.'dropdown/dropdown.css');
		//Yii::app()->clientScript->registerCssFile($this->cssPath.'menu/default.ultimate.css');
	}
	
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	
		//seo elementi
		$naslovnica = Seo::model()->findbypk(1);
		$this->pageTitle = $naslovnica->seo_naslov;
		Yii::app()->clientScript->registerMetaTag($naslovnica->seo_opis, 'description');
		Yii::app()->clientScript->registerMetaTag($naslovnica->seo_kljucne_rijeci, 'keywords');
		
	
		$theme = Yii::app()->params['theme'];
		$cssPath = Yii::app()->params['webURL'].'themes/'.$theme.'/css/';
		$jsPath = Yii::app()->params['webURL'].'themes/'.$theme.'/js/';
		
		
		$clanciITSM = array();
		$clanciITSM[] = Clanak::model()->findbyPk(22);
		$clanciITSM[] = Clanak::model()->findbyPk(23);
		$clanciITSM[] = Clanak::model()->findbyPk(24);
		

		$this->render('index',array('clanciITSM'=>$clanciITSM));
		
	}
	
	/**
	 * Prikaz članaka, određeni prikaz ovisno o kategoriji stavke izbornika
	 */
	
	public function actionIzbornik($id){
		if ($stavkaIzbornik = StavkaIzbornik::model()->findbyPk($id)){
			//postoji stavka izbornika
			$this->layout = 'ostalo_layout';
			
			$roditelj = StavkaIzbornik::model()->findbyPk($stavkaIzbornik->id_roditelj);
			$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$roditelj->id.'/velika/'.$roditelj->fotografija;
			if ($djed = StavkaIzbornik::model()->findbyPk($roditelj->id_roditelj)){
				$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$djed->id.'/velika/'.$djed->fotografija;
			}
			$sviZatvoreni = 0;
			
			//provjera da li je stavka ima djecu u harmonici
			if($stavkaIzbornik->vrsta == 2){
				//stavka je roditelj s djecom koja se ne prikazuju u drop-down-u, nego u harmonici
				$ostaleStavke = StavkaIzbornik::model()->findAll('aktivno = 1 AND obrisano = 0 AND id_roditelj = '.$stavkaIzbornik->id.' ORDER BY pozicija ASC');
				//ako se radi o članku 
				if(Clanak::model()->findbyPk($ostaleStavke[0]->id_clanak)){
				$prviClanak = Clanak::model()->findbyPk($ostaleStavke[0]->id_clanak);
				$sviZatvoreni = 1;//zahtjev da kod proizvoda sve bude zatvoreno u startu
				//seo & statistika
					Statistika::hitClanak($prviClanak->id);
					//definiranje SEO elemenata
					$this->pageTitle = $prviClanak->seo_naslov;
					Yii::app()->clientScript->registerMetaTag($prviClanak->seo_opis, 'description');
					Yii::app()->clientScript->registerMetaTag($prviClanak->seo_kljucne_rijeci, 'keywords');
					$this->render('clanak_harmonika',array('aktivnaStavka'=>$ostaleStavke[0],
												 'ostaleStavke'=>$ostaleStavke,
												 'sviZatvoreni'=>$sviZatvoreni));
				}
				if(Novost::model()->findbyPk($ostaleStavke[0]->id_novost)){
				$prviClanak = Novost::model()->findbyPk($ostaleStavke[0]->id_novost);
				$sviZatvoreni = 1;//zahtjev da kod proizvoda sve bude zatvoreno u startu
				//seo & statistika
					Statistika::hitClanak($prviClanak->id);
					//definiranje SEO elemenata
					$this->pageTitle = $prviClanak->seo_naslov;
					Yii::app()->clientScript->registerMetaTag($prviClanak->seo_opis, 'description');
					Yii::app()->clientScript->registerMetaTag($prviClanak->seo_kljucne_rijeci, 'keywords');
					$this->render('novost_harmonika',array('aktivnaStavka'=>$ostaleStavke[0],
												 'ostaleStavke'=>$ostaleStavke,
												 'sviZatvoreni'=>$sviZatvoreni));
				}
				
			}else{
				//stavka je klasična stavka i ovisno o vrsti roditelja prikazati će se sa ostalim stavkama u harmonici ili sama na stranici
				if ($roditelj->vrsta == 1){
					//prikaz u harmonici
					$clanak = Clanak::model()->findbyPk($stavkaIzbornik->id_clanak);
					
					//seo & statistika
					Statistika::hitClanak($clanak->id);
					//definiranje SEO elemenata
					$this->pageTitle = $clanak->seo_naslov;
					Yii::app()->clientScript->registerMetaTag($clanak->seo_opis, 'description');
					Yii::app()->clientScript->registerMetaTag($clanak->seo_kljucne_rijeci, 'keywords');
					
					
					
					$ostaleStavke = StavkaIzbornik::model()->findAll('aktivno = 1 AND obrisano = 0 AND id_roditelj = '.$stavkaIzbornik->id_roditelj.' ORDER BY pozicija ASC');
					$this->render('clanak_harmonika',array('aktivnaStavka'=>$stavkaIzbornik,
												 'ostaleStavke'=>$ostaleStavke,
												 'sviZatvoreni'=>$sviZatvoreni));
				}elseif($roditelj->vrsta == 0){
					if ($stavkaIzbornik->id_clanak){
						//prikaz jednog članka po stranici
						$clanak = Clanak::model()->findbyPk($stavkaIzbornik->id_clanak);
						
						//seo & statistika
						Statistika::hitClanak($clanak->id);
						//definiranje SEO elemenata
						$this->pageTitle = $clanak->seo_naslov;
						Yii::app()->clientScript->registerMetaTag($clanak->seo_opis, 'description');
						Yii::app()->clientScript->registerMetaTag($clanak->seo_kljucne_rijeci, 'keywords');
					}
					if ($stavkaIzbornik->id_novost){
						//prikaz jedne novosti po stranici
						$novost = Novost::model()->findbyPk($stavkaIzbornik->id_novost);
						
						//seo & statistika
						Statistika::hitNovost($novost->id);
						//definiranje SEO elemenata
						$this->pageTitle = $novost->seo_naslov;
						Yii::app()->clientScript->registerMetaTag($novost->seo_opis, 'description');
						Yii::app()->clientScript->registerMetaTag($novost->seo_kljucne_rijeci, 'keywords');
					}
					
					if ($stavkaIzbornik->id_clanak){
					$this->render('clanak_jedan',array('clanak'=>$clanak));
					}
					if ($stavkaIzbornik->id_novost){
						$this->render('novost_jedna',array('novost'=>$novost));
					}
				}
			}
		}else{
			$this->redirect(Yii::app()->params['webURL'].Yii::app()->language);
		}
	}
	

	
	/**
	 * Tehnička podrška, neregistrirani korisnici
	 */
	public function actionRegistrirani(){
		$this->layout = 'ostalo_layout';
		$this->pageTitle = 'Imaves - Tehnička podrška, registrirani korisnici';
		$roditelj = StavkaIzbornik::model()->findbyPk(3);
		$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$roditelj->id.'/velika/'.$roditelj->fotografija;
		$this->render('podrska_registrirani');
	}
	/**
	 * Tehnička podrška, neregistrirani korisnici
	 */
	
	public function actionNeregistrirani(){
		$this->layout = 'ostalo_layout';
		$this->pageTitle = 'Imaves - Tehnička podrška, neregistrirani korisnici';
		$roditelj = StavkaIzbornik::model()->findbyPk(3);
		$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$roditelj->id.'/velika/'.$roditelj->fotografija;
		
		$model=new Podrska;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$ok = 0;
		if(isset($_POST['Podrska']))
		{
			$model->attributes=$_POST['Podrska'];
			if($model->save()){
				$ok = 1;
			}
		}

		$this->render('podrska_neregistrirani',array(
			'model'=>$model,
			'ok'=>$ok,
		));
	}
	
	/**
	 * Prijava na novosti,
	 * ako nije ništa došlo _post-om redirect na naslovnu, inače spremi u bazu i zahvali se
	 */
	public function actionNovosti_prijava(){
		$this->layout = 'ostalo_layout';
		$this->pageTitle = 'Imaves - Predbilježba na Imaves novosti';
		$roditelj = StavkaIzbornik::model()->findbyPk(46);//roditelj su novosti, da se povuče velika fotka za novosti
		$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$roditelj->id.'/velika/'.$roditelj->fotografija;
		
		$model=new NovostiPrimanje;

		

		if(isset($_POST['newsMail']))
		{
			$model->e_mail = $_POST['newsMail'];
			$model->datum_vrijeme = Html::vrijemeZaBazu();
			if($model->save()){
				$this->render('novosti_zahvala');
			}
		}else{
			$this->redirect(Yii::app()->params['webURL'].Yii::app()->language);
		}
	}
	
	/**
	 * Pretraga
	 */
	
	public function actionPretraga(){
		$this->layout = 'ostalo_layout';
		$this->pageTitle = 'Imaves - Pretraga';
		$roditelj = StavkaIzbornik::model()->findbyPk(46);//roditelj su novosti, da se povuče velika fotka za novosti
		$this->velikaFotka = Yii::app()->params['webURL'].'fotografije/izbornik/'.$roditelj->id.'/velika/'.$roditelj->fotografija;
		
		if(isset($_POST['searchInput']))
		{
			$trazeno = $_POST['searchInput'];
			$pretragaClanak = Clanak::model()->findAll("naslov LIKE '%".$trazeno."%' OR sadrzaj LIKE '%".$trazeno."%' AND aktivno = 1 AND obrisano = 0");
			$pretragaNovost = Novost::model()->findAll("naslov LIKE '%".$trazeno."%' OR podnaslov LIKE '%".$trazeno."%' OR sadrzaj LIKE '%".$trazeno."%' AND aktivno = 1 AND obrisano = 0");
				$this->render('pretraga', array('pretragaClanak'=>$pretragaClanak,'pretragaNovost'=>$pretragaNovost));
			
		}else{
			$this->redirect(Yii::app()->params['webURL'].Yii::app()->language);
		}
	}
	
	/**
	 * Prikaz članka
	 */
	public function actionClanak($id){
		if ($clanak = Clanak::model()->findbyPk($id)){
			$this->layout = 'clanak_layout';
			//statistika
			Statistika::hitClanak($id);
			//definiranje SEO elemenata
				$this->pageTitle = $clanak->seo_naslov;
				Yii::app()->clientScript->registerMetaTag($clanak->seo_opis, 'description');
				Yii::app()->clientScript->registerMetaTag($clanak->seo_kljucne_rijeci, 'keywords');
			$this->naslovClanak = $clanak->naslov;
			//rendanje prikaza
			$this->render('clanak',array('clanak'=>$clanak));
			
		}else{
			//nešto ne valja sa odabirom članka, idi na index
			$this->redirect(Yii::app()->params['webURL'].Yii::app()->language);
		}
	}
	
	
	
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	
	
	
	public function actionKontakt()
	{
	    
	    $this->layout = "kontakt_layout";
	    //seo elementi
		$naslovnica = Seo::model()->findbypk(1);
	
			$this->pageTitle = $naslovnica->seo_naslov;
			Yii::app()->clientScript->registerMetaTag($naslovnica->seo_opis, 'description');
			Yii::app()->clientScript->registerMetaTag($naslovnica->seo_kljucne_rijeci, 'keywords');
		
		
		$theme = Yii::app()->params['theme'];
		$cssPath = Yii::app()->params['webURL'].'themes/'.$theme.'/css/';
		$jsPath = Yii::app()->params['webURL'].'themes/'.$theme.'/js/';
		Yii::app()->clientScript->registerScriptFile( $jsPath.'jquery.ui.map.js',  CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile( 'http://maps.google.com/maps/api/js?sensor=true&amp;language=hr',  CClientScript::POS_HEAD);
	    
	    
	    $model=new Kontakt;
	
	
	    if(isset($_POST['Kontakt']))
	    {
		$model->attributes=$_POST['Kontakt'];
		if($model->validate())
		{
		   $model->save();
		    $this->render('kontakt',array('model'=>$model,'ok'=>1));
		    break;
		}
	    }
	    $this->render('kontakt',array('model'=>$model));
	}
	
	
	

	
	
	

	


	
	
	
	
	
	
	
	
	
		
	
	
	
	
	
	
	

}