<?php
class AdminController extends AController{

    /*
     * Admin
     */
    public function actionIndex(){
       // $this->redirect('index');
       $this->pageTitle = "Dobrodošli";
       $this->render('index');
    }
    
    /*
     * File mannager
     */
    public function actionFilemanager(){
         Layout::setLeftParams('navigacija',$this->getNavigacija('navigacija/filemanager'));
        $this->render('filemanager');
    }
    
    /*
     * Login korisnkia
     * $this->layout = Postavlja layout login 
     * Kreiranje instance Korisnik modela pomuću ActiveModel classe
     * Pripremi model za unos
     */
    public function actionLogin(){
       if(Yii::app()->user->isGuest){
           $this->layout = "login"; 
           $model = new KorisnikValidacija();
           if(isset($_POST['KorisnikValidacija'])){
               $model->attributes = $_POST['KorisnikValidacija'];
               if($model->validate() && $model->login())
                       $this->redirect(array('index'));
           }
           $this->render('/views/login',array('model'=>$model));
       }else{
           $this->redirect('admin');
       }
    }
    /*
     * odjava trenutačnog korisnika
     */
    public function actionLogout(){
        $this->layout = "login"; 
        Yii::app()->user->logout();
        $this->redirect('login');
    }
    /*
     * Registracija
     */
    public function actionRegister(){
       $this->layout = "login"; 
       $model = new ActiveModel("Korisnik","register");
       $model->setModelProperty("type", Korisnik::USER);
       $model->setModelProperty("created", time() );
       $model->setRedirect(Menu::get("login"));
       $model->create();
       $this->render('/views/register',array('model'=>$model->getInstance()));
    }
    
    /*
     * Ukoliko korisnik nema ovlasti za administriranje određene sekcije prebaci ga na ovu poruku
     */
    public function actionOvlasti(){
        if(!Yii::app()->user->isGuest){
            $this->layout = "login"; 
            $this->render('/views/ovlast');
        }else
            $this->redirect(Menu::get("home"));
    }
    
    /*
     * Prikazi sve korisnike
     */
    public function actionUserList(){
        $this->pageTitle = "Lista korisnika";
        $models = Korisnik::model()->findAll(array('condition'=>'`id` != '.Yii::app()->user->id));
        $this->render('userlist',array('models'=>$models));
    }
    /*
     * Dodaj korisnika
     */
    public function actionAddUser($id = 0){
     
     if ($id != 0){
	  $model = Korisnik::model()->findbyPk($id);
	  $this->pageTitle = "Uređivanje korisnika: ".$model->ime.' '.$model->prezime;
	  $model->lozinka = "";
     }else{
	 $model = new Korisnik;
	 $this->pageTitle = "Dodaj novog korisnika";
     }
     
        if(isset($_POST['Korisnik']))
		{
			$model->attributes=$_POST['Korisnik'];
			$model->vrsta=5;
			if($model->save())
				$this->redirect('UserList?ok=1');
		}
       
       // $model->setScenario('register');
       // $model->setRedirect('userlist');
        
       // $model->create();
        $this->render('adduser',array('model'=>$model));
    }
    /*
     * Obriši korisnika
     */
    public function actionDeleteUser($id){
        Korisnik::model()->deleteByPk($id);
        $this->redirect($this->createUrl('admin/userlist'));
    }
    
    public function actionKopiraj(){
     $this->render('kopiranje');
    }
    
    public function actionPomoc(){
     $this->render('pomoc');
    }
    
}