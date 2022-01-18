<?php
class UploadifyController extends Controller{
    
    public function init(){
        Yii::app()->setTheme("adminnovo");
        $theme = Yii::app()->theme->name;
        Layout::$IMAGES = '/themes/'.$theme.'/css/images/icons/';
        Layout::$IMAGES128 = '/themes/'.$theme.'/css/images/icons/128/';
        Layout::$IMAGES32= '/themes/'.$theme.'/css/images/icons/32/';
    }
    /*
     * Spremi fotografiju za članak
     */
    public function actionSpremiFotkuClanak($id,$name,$file,$page = 1){
        if(!Yii::app()->request->isAjaxRequest)
       die("Može se pristupiti samo putem ajax poziva");   
       
       $clanak = Clanak::model()->findbyPk($id);
       $clanak->fotografija = $file;
       $clanak->save();
     
       echo json_encode(array(
           
           'name'=>$file,
           
           'image'=>CHtml::image('/fotografije/clanak/'.$id.'/mala/'.$file,$clanak->naslov),
             
           ));
    }
    
    /*
     * Spremi fotografiju za grupu
     */
    public function actionSpremiFotkuGrupa($id,$name,$file,$page = 1){
        if(!Yii::app()->request->isAjaxRequest)
       die("Može se pristupiti samo putem ajax poziva");   
       
       $grupa = Grupa::model()->findbyPk($id);
       $grupa->fotografija = $file;
       $grupa->save();
     
       echo json_encode(array(
           
           'name'=>$file,
           
           'image'=>CHtml::image('/fotografije/grupa/'.$id.'/mala/'.$file,$grupa->naslov),
             
           ));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
     * Spremi uploudano u bazu
     */
    public function actionSaveUploaded($id,$name,$file,$page = 1){
       if(!Yii::app()->request->isAjaxRequest)
       die("Može se pristupiti samo putem ajax poziva");   
       
       $slike = new FotoSlike();
       $slike->fotoid = $id;
       $slike->file = $file;
       $slike->name = $name;
       $slike->insert();
       echo json_encode(array(
           'id'=>$slike->id,
           'name'=>$slike->name,
           'fotoid'=>$id,
           'file'=>$file,
           'uredi'=>Layout::getImageLink('edit',Menu::get('adminfotogalerijeedit',array('id'=>$slike->id,'page'=>$page,'galleria'=>$id))),
           'image'=>CHtml::image('/static/gallery/'.$id.'/mala/'.$file,$slike->name),
           'delete'=>Layout::getImageLink('delete',$this->createUrl('uploadify/delete',array('id'=>$slike->id,'page'=>$page)))     
           ));
    }
    /*
     * Spremi artikl sliku 
     */
    public function actionSaveArticleSlika($id,$name,$file,$page = 1){
        if(!Yii::app()->request->isAjaxRequest)
       die("Može se pristupiti samo putem ajax poziva");   
       
       $clanak = Clanak::model()->findbyPk($id);
       $clanak->fotografija = $file;
       $clanak->save();
     
       echo json_encode(array(
           
           'name'=>$slike->name,
           
           'image'=>CHtml::image('/fotografije/clanak/'.$id.'/mala/'.$file,$clanak->naslov),
             
           ));
    }
    
    /*
     * Uploudaj article sliku
     */
    public function actionUploadArticleSlika($id,$name,$file){
        if(!Yii::app()->request->isAjaxRequest)
       die("Može se pristupiti samo putem ajax poziva");   
       
       echo json_encode(array(
           'fotoid'=>$id,
           'file'=>$file,
           'name'=>$name,
           'hidden'=>CHtml::hiddenField('KatalogArtikli[slike]['.$file.']',$name,array('id'=>$file)),
           'image'=>CHtml::image('/static/articles/'.$id.'/mala/'.$file,$name),
           'delete'=>Layout::getImageLink('delete',$this->createUrl('uploadify/deleteslika',array('fotoid'=>$id,'file'=>$file)),array('class'=>"obrisislikuartikla"))     
           ));
    }
    
    /*
     * Obriši article sliku - prilikom dodavanja artikla
     */
    public function actionDeleteslika($fotoid,$file){
        unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/mala/'.$file);
        unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/srednja/'.$file);
        unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/velika/'.$file);
        echo 1;
    }
    /*
     * Obriši sliku
     */
    public function actionDelete($id,$page){
        $model = FotoSlike::model()->findByPk($id);
        $fotoid = $model->fotoid;
        $file = $model->file;
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/gallery/'.$fotoid.'/mala/'.$file);
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/gallery/'.$fotoid.'/srednja/'.$file);
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/gallery/'.$fotoid.'/velika/'.$file);
        $model->delete();
        $this->redirect(Menu::get('adminaddgalleria',array('id'=>$fotoid,'page'=>$page)));
    }
    
    /*
     * Obriši artikl liku
     */
    public function actionDeleteArticleSlika($id,$page){

        $model = KatalogArtikliSlike::model()->findByPk($id);
        $fotoid = $model->articleid;
        $file = $model->file;
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/mala/'.$file);
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/srednja/'.$file);
        @unlink($_SERVER['DOCUMENT_ROOT'].'/static/articles/'.$fotoid.'/velika/'.$file);
        $model->delete();
        $this->redirect(Menu::get('adminkatalogslike',array('id'=>$fotoid,'page'=>$page)));
    }
    
    /*
     * Uploudaj file
     */
    public function actionUpload(){
        if (!empty($_FILES)) {
                    $tempFile = $_FILES['Slika']['tmp_name'];
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['folder'];

                    if(!is_dir($targetPath))            mkdir($targetPath,0755);
                    if(!is_dir($targetPath.'/mala'))    mkdir($targetPath.'/mala',0755);
                    if(!is_dir($targetPath.'/srednja')) mkdir($targetPath.'/srednja',0755);
                    if(!is_dir($targetPath.'/velika'))  mkdir($targetPath.'/velika',0755);
                    $velikaPath = $targetPath.'/velika';
                    $targetPath = $targetPath.'/';

                    $newName = str_replace(array('č','ć','ž','š','đ',' '),array('c','c','z','s','d','_'),  strtolower( trim($_FILES['Slika']['name']) ) );
                    $rand = mt_rand(1, 1000);
                    $newName = $rand."_".preg_replace("/\s+/","_", $newName);
                   
                    
                    $targetFile =  str_replace('//','/',$targetPath) . $newName;
                    move_uploaded_file($tempFile,$targetFile);

                    UploadifyHtml::CreateThumbnail($targetPath, $newName,"/mala",200,150);
                    UploadifyHtml::CreateThumbnail($targetPath, $newName,"/srednja",640,480);
                    copy($targetFile,str_replace('//','/',$targetPath).'velika/'. $newName);
                   
                    
                    unlink($targetFile);
                    $name = preg_replace("/\.\w+/","$1", $_FILES['Slika']['name']);
                    echo json_encode(array('name'=>$name,'file'=>$newName));
        }
    }

}