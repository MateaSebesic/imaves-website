<?php
class Html extends CHtml{
    /*
     * attach Tynmce
     */
    public static function attachTynMce($plugins = "plugins",$minimum = false){
        $path = Yii::app()->homeUrl.$plugins."/tiny_mce/";
        Yii::app()->clientScript->registerScriptFile($path."jquery.tinymce.js",  CClientScript::POS_END);
        if($minimum)
        Yii::app()->clientScript->registerScriptFile($path."minimum.tiny.js",  CClientScript::POS_END);    
        else    
        Yii::app()->clientScript->registerScriptFile($path."textarea.tinymce.js",  CClientScript::POS_END);
    }
    
    /**
     * Trenutno vrijeme za spremanje u mysql bazu podataka
     */
    public static function vrijemeZaBazu(){
     $date = date('Y-m-d H:i:s', time());
     return $date;
    }
    
    /**
     * Prebacivanje vremena iz baze u hrvatski način
     */
    public static function vrijemeIzBaze($vrijemeBaza){
     $date = date("d.m.Y. H:i:s", strtotime( $vrijemeBaza ));
     return $date;
    }
    
 
}