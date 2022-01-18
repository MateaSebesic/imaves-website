<?php
class Statistika{
    
    /**
     * Otvoren članak
     */
    public static function hitClanak($id){
        if($clanak = Clanak::model()->findbyPk($id)){
            $trenutno = $clanak->hits;
            $plusJedan = intval($trenutno) + 1;
            $clanak->hits = $plusJedan;
            $clanak->save();
            return true;
        }
    }
    
    /**
     * Otvorena novost
     */
    public static function hitNovost($id){
        if($novost = Novost::model()->findbyPk($id)){
            $trenutno = $novost->hits;
            $plusJedan = intval($trenutno) + 1;
            $novost->hits = $plusJedan;
            $novost->save();
            return true;
        }
    }
    
    /**
     * Otvorena kategorija
     */
    public static function hitKategorija($id){
        if($kategorija = Kategorija::model()->findbyPk($id)){
            $trenutno = $kategorija->pogledano_puta;
            $plusJedan = intval($trenutno) + 1;
            $kategorija->pogledano_puta = $plusJedan;
            $kategorija->save();
            return true;
        }
    }
    
    /**
     * Otvorena ponuda
     */
    public static function hitPonuda($id){
        if($ponuda = Ponuda::model()->findbyPk($id)){
            $trenutno = $ponuda->pogledano_puta;
            $plusJedan = intval($trenutno) + 1;
            $ponuda->pogledano_puta = $plusJedan;
            $ponuda->save();
            return true;
        }
    }
    
    
}

?>