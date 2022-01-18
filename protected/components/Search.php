<?php 
/*
 * Main Search Class
 * 
 */
Class Search{
    
    public $model;
    public $sort = null;
    public $dataProvider;
    public $criteria = array();
    
    const DATE = 1;
    const CONSTANT = 2;
    /*
     * Constuructor of Search Class
     */
    public function __construct($model){
        $this->model = $model;
        $this->dataProvider = new CActiveDataProvider($this->model);
    }
  /*
   * sets Criteria for current data Provider class
   */
    public function setCriteria($value){
       $this->dataProvider->setCriteria($value); 
    }
    /*
     * add condition
     */
    public function addCriteriaCondition($name,$value,$comparison = '=',$operator = 'AND',$const = null){
        $criteria = $this->getCriteria();
        if($const == self::DATE)
        $val = "'".Html::databaseDate($_GET[$value])."'";    
        else if($const == self::CONSTANT)
        $val = "'".Reservations::getConstant($_GET[$value])."'";        
        else    
        $val = "'".$_GET[$value]."'";
        isset($_GET[$value]) && !empty($_GET[$value]) ? $criteria->addCondition('`'.$name.'`'.$comparison.$val,$operator) : null;
    }
   
    /*
     * add condition
     */
    public function setDefaultCriteriaConditions(){
        $criteria = $this->getCriteria();
        
        $criteria->addCondition('`status` = 3 OR `status` = 7 OR `status` = 8');
    }
    
    /*
     * add Order
     */
    public function addOrder($default = null){
      
        
        if(isset($_GET['sort']))
        $sort = $_GET['sort'];
        
        if(strpos($sort,'.')){
        $order = explode(".",$sort);
        $this->criteria['order'] = $order[0]." DESC";
        }else 
        $this->criteria['order'] = $sort;
       
        empty($_GET['sort']) ? !empty($default) ? $this->criteria['order'] = $default : null  : $this->criteria['order'];
        
        $this->setCriteria(  $this->criteria  );
    }
    /*
     * join
     */
    public function addJoinObject(){
        if(isset($_GET['filterobject']) && !empty($_GET['filterobject']) ){
            $criteria = $this->getCriteria();
            $models = Capacitytype::model()->findAll('object_id ='.$_GET['filterobject']);
            //print_r($models);
        if(isset($_GET['filtersmjestaj']) && !empty($_GET['filtersmjestaj']) ){    
            
                $criteria->addCondition('capacity_id = '.$_GET['filtersmjestaj'],'OR');
           
        }else{
            if(count($models) > 0){
                foreach($models as $model){
                $criteria->addCondition('capacity_id = '.$model->id,'AND');
                }
            }else
                $criteria->addCondition('capacity_id = 0');
        }
        }
    }
    /*
     * 
     * gets Criteria of current Data Provider Class
     */
    public function getCriteria(){
       return $this->dataProvider->getCriteria();
    }
    
    /*
     * Sets Sort for data provider
     */
    public function setSort($value){
       $sort = new CSort($this->model);
       $sort->attributes = $value;
       $this->dataProvider->setSort($sort);
    }
    /*
     * sets Pagination for data provider
     */
    public function setPagination($value = 10){
     $model = new $this->model;   
     $pages = new CPagination($model->count($this->getCriteria()));
     $pages->pageSize = $value;
     $pages->applyLimit($this->getCriteria());
     $this->dataProvider->setPagination($pages);
    }
    
    /*
     * Getting data from data provider
     */
    public function getData(){
       return $this->dataProvider->getData();
    }
    
    /*
     * Returns Current Data provider Instance
     */
    public function getDataProvider(){
        return $this->dataProvider;
    }
    
    /*
     * Returns pagination data
     */
    public function getPagination(){
        return $this->dataProvider->getPagination();
    }
}
