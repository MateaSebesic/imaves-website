<?php

class AjaxController extends Controller{
    
    
    public function init(){
        if(!Yii::app()->request->isAjaxRequest){
            die("This is not ajax request");
        }
        parent::init();
    }
    
    
    /**
     * Aktivacija članaka
     */
    
    public function actionAktivirajclanak($id){
        $clanak = Clanak::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija članaka
     */
    
    public function actionDeaktivirajclanak($id){
        $clanak = Clanak::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje članaka
     */
    
    public function actionObrisiclanak($id){
        $clanak = Clanak::model()->findbyPk($id);
        $clanak->delete();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
     * Aktiviraj model
     */
    public function actionActivate($id,$model,$column = "active"){
        $model = new ActiveModel($model);
        $model->edit($id);
        $data = $model->getInstance();
        if($data->$column == 0)
        $model->setModelProperty($column,1);
        else
        $model->setModelProperty($column,0);    
        
        if($model->update())
           echo json_encode(array('updated'=>1,'active'=>$model->getInstance()->$column));
        else
           echo json_encode(array('updated'=>0)); 
    }
    
    /*
     * Vrati data po id ovisno o modelu
     */
    public function actionGetDataById($id,$model){
        $name = new $model;
        $models = $name->findAll(array('condition'=>'parent = '.$id));
        $data = array();
        foreach($models as $mod){
            array_push($data,array('id'=>$mod->id,'name'=>$mod->name,'parent'=>$name->findByPk($mod->id)->name));
        }
        
        if(!empty($data))
        echo json_encode($data);
        else
        echo "null";
    }
    
    
    /*
     * Prikaži listu članaka
     */
    public function actionClanciListData(){
        $models = Clanci::model()->findAll(array('order'=>'name ASC'));
        if(is_array($models)){
            $STRING = '<table class="data">';
            $STRING .= '<thead>';
            $STRING .= '<tr>';
            //$STRING .= '<th>Id članka</th>';  
            $STRING .= '<th>Ime članka</th>';
            $STRING .= '<th>Odaberite</th>';
            $STRING .= '</tr>';
            $STRING .= '</thead>';
            $STRING .= '<tbody>';
            foreach($models as $model){
                        $STRING .= '<tr>';
                            //$STRING .= '<td>'.$model->id.'</td>';
                            $STRING .= '<td><span id="typename-'.$model->id.'">'.$model->name.'</span></td>';
                            $STRING .= '<td>'.CHtml::radioButton('selectclanak',false,array('value'=>$model->id,'class'=>'selecttype')).'</td>';
                        $STRING .= '</tr>';
            }
            $STRING .= '</tbody></table>';
            echo $STRING;
        }else{
            echo "Lista članka nije definirana";
        }
    }
    
  
    
      
    /*
     * Katalog
     */
       public function actionKatalogKategorijeListData(){
        $models = KatalogKategorije::getAllRecrusiveData();
          if(is_array($models)){
            $STRING = Html::createRecursiveRadioBottunsForKatalogKategorije($models);
            echo $STRING;
        }else{
            echo "Lista kategorija nije definirana";
        }
    }
    
    
    public function actionFotogalerijaListData(){
         $models = Foto::model()->findAll(array('order'=>'name ASC'));
          if(is_array($models)){
            $STRING = '<table class="data">';
            $STRING .= '<thead>';
            $STRING .= '<tr>';
            $STRING .= '<th>Id </th>';  
            $STRING .= '<th>Ime </th>';
            $STRING .= '<th>Odaberite</th>';
            $STRING .= '</tr>';
            $STRING .= '</thead>';
            $STRING .= '<tbody>';
            foreach($models as $model){
                        $STRING .= '<tr>';
                            $STRING .= '<td>'.$model->id.'</td>';
                            $STRING .= '<td><span id="typename-'.$model->id.'">'.$model->name.'</span></td>';
                            $STRING .= '<td>'.CHtml::radioButton('selectkategorija',false,array('value'=>$model->id,'class'=>'selecttype')).'</td>';
                        $STRING .= '</tr>';
            }
            $STRING .= '</tbody></table>';
            echo $STRING;
        }else{
            echo "Lista kategorija nije definirana";
        }
    }
    
    /*
     * jax set article
     */
    
    public function actionSetArticle($id,$delete=null){
      
        if($delete == 1){
            SelectedArticles::model()->deleteAll(array('condition'=>'articleid = '.$id));
        }else{
           
            $model = new SelectedArticles();
            $model->articleid = $id;
            $model->session = session_id();
            $model->date = time();
            $model->insert();
            
        }
        echo SelectedArticles::model()->count('session = "'.session_id().'"');
    }
    
    /**
     * Updates katalog position
     * @param type $itemId int
     * @param type $currentId int
     */
    public function actionUpdateKatalogPosition($itemId,$currentId)
    {
        $itemData = preg_split("/-/",$itemId,-1,PREG_SPLIT_NO_EMPTY);
        $currentItemData = preg_split("/-/",$currentId,-1,PREG_SPLIT_NO_EMPTY);
        $itemId = str_replace("S","",$itemData[0]);
        $itemIdPozicija =  $itemData[1];
        
        $currentId = str_replace("S","",$currentItemData[0]);
        $currentIdPozicija = $currentItemData[1];

        $criteria = new CDbCriteria();
        $criteria->condition = " `pozicija` BETWEEN :IT AND :CUR ";
        $criteria->params = array(':IT'=>$itemId,':CUR'=>$currentId);
        $models = KatalogArtikli::model()->findAll($criteria);
        if(!empty($models)){
            foreach($models as $updatemodel){
                 if($itemId > $currentId)
                    $updatemodel->pozicija = $updatemodel->pozicija-1;
                 else
                    $updatemodel->pozicija = $updatemodel->pozicija+1;
                 
                $updatemodel->update();
            }
        }
//        $models = KatalogArtikli::model()->findAll();
//        if(!empty($models)){
//            foreach($models as $updatemodel){
//                $updatemodel->pozicija = $updatemodel->id;
//                $updatemodel->update();
//            }
//        }
        
        $model = KatalogArtikli::model()->findByPk($itemId);
        if($model){
            $model->pozicija = $currentIdPozicija;
            $model->update();
        }
    }
   
}

