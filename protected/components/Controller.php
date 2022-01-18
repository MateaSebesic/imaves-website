<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='glavni_layout';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        /*
         * Glavna metoda za inicializaciju 
         */
        public function init(){
	    if(isset($_GET['lang'])){
			Yii::app()->setLanguage($_GET['lang']);
	    }else{
            Yii::app()->setLanguage('hr');
        }
            parent::init();
            session_start();
            Yii::app()->setTheme("imaves");
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        }
		/*
         * static Controller::method()->newmethod
         */
        public static function method(){
            return Yii::app()->getController();
        }
}