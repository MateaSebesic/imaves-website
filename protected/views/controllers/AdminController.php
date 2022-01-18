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
           $this->redirect(Menu::get("home"));
       }
    }
    /*
     * odjava trenutačnog korisnika
     */
    public function actionLogout(){
        $this->layout = "login"; 
        Yii::app()->user->logout();
        $this->redirect(Menu::get("login"));
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
    public function actionAddUser(){
        $this->pageTitle = "Dodaj novog korisnika";
        $model = new ActiveModel('Korisnik');
        $model->setScenario('register');
        $model->setRedirect('userlist');
        $model->setModelProperty('type', 5);
        $model->create();
        $this->render('adduser',array('model'=>$model->getInstance()));
    }
    /*
     * Obriši korisnika
     */
    public function actionDeleteUser($id){
        Korisnik::model()->deleteByPk($id);
        $this->redirect($this->createUrl('admin/userlist'));
    }
    
    /**
     * Kopiranje baze
     */
    
    public function actionKopirajGrupe(){
 
     


     $this->render('kopiranje');
    }
    
}