<?php 
class AController extends CController{
    

    public $layout = "admin";
    public $menu=array();
    public $breadcrumbs=array();
    public $_cssPath;
    public $_jsPath;   
    public $_allow = array('login','logout','ovlasti');
    
    /*
     * Premješteno radi druge verzije
     */
    public $navigacija_params = array();
 
    /*
     * Glavna metoda za inicializaciju klase
     */
    public function init(){
        parent::init();
          
    }
  
    
   
    /*
     * Filter za provjeru usera
     */
    public function filters(){
        return array('accessControl');
    }

    /*
     * Ovlasti korisnika, ukoliko nije ulogiran redirect na login url
     */
    public function accessRules() {
        return array(
             array('allow',
                'users'=>array('@'),
                'controllers'=>array('admin'),
            ),  
            array('allow',
                'users'=>array('*'),
                'controllers'=>array('admin'),
                'actions'=>$this->_allow,
            ),  
            array('deny',
                'users'=>array('*'),
                'message'=>Yii::t('admin','User {user} is not allowed to see this page',array('{user}'=>Yii::app()->user->name)),
            ),  
        );
    }
    
    /*
     * Parsiraj css po kontroleru
     */
   public function renderCss($name,$scenario="screen"){
       Yii::app()->clientScript->registerCssFile($this->getCssPath().$name,$scenario);
   }
   
   
   /*
     * prije svake akcije pozovi atuh metodu
     */
    public function beforeAction($action) {
      
        if(!in_array($action->getId(),$this->_allow))
        $this->auth();
        $this->setTemplatesAndThemes();
        return   parent::beforeAction($action);
    }
   /*
    * Auth metoda služi za provjeru nakon login usera
    * Provjerava da li korisnik ima ovlasti za određeni kontroler admin sekcije stranice
    */
   public function auth(){
        if(!Yii::app()->user->isGuest){
               /*
                * Korisnik model vraća jedan row iz baze  po PK 
                * Pk ili u mysql serveru je kratica za primary key
                * To je prva kolumna unutar tablice databaze
                * Koja je obićno auto inkrementirana 
               */
        
              $korisnik = Korisnik::model()->findByPk(Yii::app()->user->id);
              if($korisnik->vrsta == Korisnik::USER)
                   $this->redirect(Menu::get("usernotauthorised"));
              else if($korisnik->vrsta == Korisnik::INVALID)
                   $this->redirect(Menu::get("usernotauthorised"));
        }
   }
   
   
   
   public function getNavigacija($route,$params = array()){
        return $this->renderPartial($route, $params, true);
   }
   
   
   /*
    * Templates And Themes
    */
   public function setTemplatesAndThemes(){


        Yii::app()->setTheme("administracija");

        
        $theme = Yii::app()->theme->name;
        
        
        //putanje za css i js:
        $this->_cssPath = Yii::app()->params['webURL'].'themes/'.$theme.'/css/';
        $this->_jsPath = Yii::app()->params['webURL'].'themes/'.$theme.'/js/';
       
        //definiranje .css i .js datoteka:
        //css:
        Yii::app()->clientScript->registerCssFile($this->_cssPath.'screen.css');
        Yii::app()->clientScript->registerCssFile($this->_cssPath.'fixed.css');
        Yii::app()->clientScript->registerCssFile($this->_cssPath.'fixed.css');
        //js:
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'excanvas.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery-1.7.2.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.cookie.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.visualize.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile( Yii::app()->params['webURL'].'plugins/tiny_mce/tinymce.min.js', CClientScript::POS_HEAD);
        
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.visualize-tooltip.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery-animate-css-rotate-scale.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery-ui-1.8.13.custom.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.poshytip.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.quicksand.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.dataTables.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.facebox.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.uniform.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'jquery.wysiwyg.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'syntaxHighlighter/shCore.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'syntaxHighlighter/shBrushXml.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'syntaxHighlighter/shBrushJScript.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'syntaxHighlighter/shBrushCss.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'syntaxHighlighter/shBrushPhp.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'fileTree/jqueryFileTree.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->_jsPath.'custom.js', CClientScript::POS_END); 
        
       
   }
}
