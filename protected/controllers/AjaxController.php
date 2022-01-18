<?php

class AjaxController extends Controller{
    
    
    public function init(){
     //   if(!Yii::app()->request->isAjaxRequest){
         //   die("This is not ajax request");
       // }
        parent::init();
    }
    
    ///Članci
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
    
    
     /**
     * Pozicija up
     */
    
    public function actionclanakup($id){
        $trazeno = Clanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $grupa= $trazeno->kategorija;
            if($gornji = Clanak::model()->find('kategorija = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down 
     */
    
    public function actionclanakdown($id){
        $trazeno = Clanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $grupa = $trazeno->kategorija;
            if($donji = Clanak::model()->find('kategorija = '.$grupa.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
   /**
     * Prijevod članaka
     */
    
    public function actionprevediclanak($id){
        $orginal = Clanak::model()->findbyPk($id);
		$kopija = new ClanakEn;
		$kopija->naslov = $orginal->naslov.'_EN';
                $kopija->id = $orginal->id;
		$kopija->sadrzaj = $orginal->sadrzaj;
		$kopija->kategorija = $orginal->kategorija;
		$kopija->SEO_naslov = $orginal->SEO_naslov;
		$kopija->SEO_opis = $orginal->SEO_opis;
		$kopija->SEO_kljucneRijeci = $orginal->SEO_kljucneRijeci;
                $kopija->pozicija = $orginal->pozicija;
                $kopija->aktivno = $orginal->aktivno;
		$kopija->podnaslov = $orginal->podnaslov;
                $kopija->link = $orginal->link;
                $kopija->save();
    }
    
    /**
     * Prijevod grupe
     */
    
    public function actionprevedigrupu($id){
        $orginal = Grupa::model()->findbyPk($id);
		$kopija = new GrupaEn;
		$kopija->naziv = $orginal->naziv.'_EN';
                $kopija->id = $orginal->id;
		$kopija->roditelj = $orginal->roditelj;
		$kopija->pozicija = $orginal->pozicija;
                $kopija->aktivno = $orginal->aktivno;
		$kopija->fotografija = $orginal->fotografija;
		
		$kopija->naslov = $orginal->naslov;
		$kopija->vrsta = $orginal->vrsta;
	
                
                $kopija->save();
    }
    
     /**
     * Prijevod članaka
     */
    
    public function actionprevediproizvod($id){
        $orginal = Proizvod::model()->findbyPk($id);
		$kopija = new ProizvodEn;
		$kopija->naziv = $orginal->naziv.'_EN';
                $kopija->id = $orginal->id;
		$kopija->idGrupa = $orginal->idGrupa;
		$kopija->idProizvodac = $orginal->idProizvodac;
		$kopija->sifra = $orginal->sifra;
		$kopija->cijena = $orginal->cijena;
		$kopija->opis = $orginal->opis;
		$kopija->karakteristika = $orginal->karakteristika;
		$kopija->sastav = $orginal->sastav;
                $kopija->pozicija = $orginal->pozicija;
                $kopija->aktivno = $orginal->aktivno;
                $kopija->save();
    }
    
    ///Slideshow
    /**
     * Aktivacija slide-a
     */
    
    public function actionAktivirajslide($id){
        $clanak = Slideshow::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija članaka
     */
    
    public function actionDeaktivirajslide($id){
        $clanak = Slideshow::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje članaka
     */
    
    public function actionObrisislide($id){
        $clanak = Slideshow::model()->findbyPk($id);
        $clanak->delete();
    }
    
    
     /**
     * Pozicija up
     */
    
    public function actionupslide($id){
        $trazeno = Slideshow::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
        
            if($gornji = Slideshow::model()->find('pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down 
     */
    
    public function actiondownslide($id){
        $trazeno = Slideshow::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            
            if($donji = Slideshow::model()->find('pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
     ////Fotke članaka
    /**
     * Brisanje fotke 
     */
    
    public function actionobrisifotkuclanak($id){
        $fotka = FotografijaClanak::model()->findbyPk($id);
        $fotka->aktivno = 0;
         $fotka->pozicija = 0;
        $fotka->save();
    }
    
      /**
     * Pozicija up
     */
    
    public function actionclanakfotkaup($id){
        $trazeno = FotografijaClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idClanak;
            if($gornji = FotografijaClanak::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down
     */
    
    public function actionclanakfotkadown($id){
        $trazeno = FotografijaClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idClanak;
            if($donji = FotografijaClanak::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    
    
    
    ///Proizvodi
    /**
     * Aktivacija proizvoda
     */
    
    public function actionAktivirajproizvod($id){
        $clanak = Proizvod::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija proizvoda
     */
    
    public function actionDeaktivirajproizvod($id){
        $clanak = Proizvod::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje proizvoda
     */
    
    public function actionObrisiproizvod($id){
        $clanak = Proizvod::model()->findbyPk($id);
        $clanak->delete();
    }
    ////Fotke proizvoda
    /**
     * Brisanje fotke proizvoda
     */
    
    public function actionobrisifotkuproizvod($id){
        $fotka = FotografijaProizvod::model()->findbyPk($id);
        $fotka->aktivno = 0;
        $fotka->pozicija = 0;
        $fotka->save();
    }
    
      /**
     * Pozicija up
     */
    
    public function actionproizvodfotkaup($id){
        $trazeno = FotografijaProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idProizvod;
            if($gornji = FotografijaProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down fotke
     */
    
    public function actionproizvodfotkadown($id){
        $trazeno = FotografijaProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idProizvod;
            if($donji = FotografijaProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    
    ////Video
    /**
     * Aktivacija videa
     */
    
    public function actionAktivirajvideo($id){
        $clanak = VideoProizvod::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija videa
     */
    
    public function actionDeaktivirajvideo($id){
        $clanak = VideoProizvod::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje videa
     */
    
    public function actionObrisivideo($id){
        $clanak = VideoProizvod::model()->findbyPk($id);
        $clanak->delete();
    }
    
    /**
     * Pozicija up videa
     */
    
    public function actionvideoup($id){
        $trazeno = VideoProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idProizvod;
            if($gornji = VideoProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actionvideodown($id){
        $trazeno = VideoProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idProizvod;
            if($donji = VideoProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    ///Video članka
    ////Video
    /**
     * Aktivacija videa
     */
    
    public function actionAktivirajvideoclanka($id){
        $clanak = VideoClanak::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija videa
     */
    
    public function actionDeaktivirajvideoclanka($id){
        $clanak = VideoClanak::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje videa
     */
    
    public function actionObrisivideoclanka($id){
        $clanak = VideoClanak::model()->findbyPk($id);
        $clanak->delete();
    }
    
    /**
     * Pozicija up videa
     */
    
    public function actionvideoupclanka($id){
        $trazeno = VideoClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idClanak;
            if($gornji = VideoClanak::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actionvideodownclanka($id){
        $trazeno = VideoClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idClanak;
            if($donji = VideoProizvod::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    
    
    
    
    ////Dokumenti
    /**
     * Aktivacija 
     */
    
    public function actionAktivirajdokument($id){
        $clanak = DokumentProizvod::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija
     */
    
    public function actionDeaktivirajdokument($id){
        $clanak = DokumentProizvod::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje videa
     */
    
    public function actionObrisidokument($id){
        $clanak = DokumentProizvod::model()->findbyPk($id);
        $clanak->delete();
    }
    
    /**
     * Pozicija up
     */
    
    public function actiondokumentup($id){
        $trazeno = DokumentProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idProizvod;
            if($gornji = DokumentProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actiondokumentdown($id){
        $trazeno = DokumentProizvod::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idProizvod;
            if($donji = DokumentProizvod::model()->find('idProizvod = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
     ////Dokumenti za članke
    /**
     * Aktivacija 
     */
    
    public function actionAktivirajdokumentclanka($id){
        $clanak = DokumentClanak::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija
     */
    
    public function actionDeaktivirajdokumentclanka($id){
        $clanak = DokumentClanak::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje videa
     */
    
    public function actionObrisidokumentclanka($id){
        $clanak = DokumentClanak::model()->findbyPk($id);
        $clanak->delete();
    }
    
    /**
     * Pozicija up
     */
    
    public function actiondokumentupclanka($id){
        $trazeno = DokumentClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            $proizvod = $trazeno->idClanak;
            if($gornji = DokumentClanak::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actiondokumentdownclanka($id){
        $trazeno = DokumentClanak::model()->findbyPk($id);
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            $proizvod = $trazeno->idClanak;
            if($donji = DokumentClanak::model()->find('idClanak = '.$proizvod.' AND pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    ////Podgrupe
    
 /**
     * Pozicija up
     */
    
    public function actionpodgrupaup($id){
        $trazeno = Grupa::model()->findbyPk($id);
        $roditelj = $trazeno->roditelj;
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            
            if($gornji = Grupa::model()->find('pozicija = '.$zeljenaPozicija.' AND roditelj = '.$roditelj))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
        //echo json_encode(array('glavna'=>$roditelj));
        echo $roditelj;
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actionpodgrupadown($id){
        $trazeno = Grupa::model()->findbyPk($id);
        $roditelj = $trazeno->roditelj;
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            
            if($donji = Grupa::model()->find('pozicija = '.$zeljenaPozicija.' AND roditelj = '.$roditelj))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
           
            //echo json_encode(array('glavna'=>$roditelj));
            echo $roditelj;
        
    }
    
    
    
    ////PGrupe
    
 /**
     * Pozicija up
     */
    
    public function actiongrupaup($id){
        $trazeno = Grupa::model()->findbyPk($id);
        $vrsta = $trazeno->vrsta;
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            
            if($gornji = Grupa::model()->find('pozicija = '.$zeljenaPozicija.' AND vrsta = '.$vrsta))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down videa
     */
    
    public function actiongrupadown($id){
        $trazeno = Grupa::model()->findbyPk($id);
        $vrsta = $trazeno->vrsta;
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            
            if($donji = Grupa::model()->find('pozicija = '.$zeljenaPozicija.' AND roditelj = '.$vrsta))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
    }
    
    /**
     * Aktivacija 
     */
    
    public function actionAktivirajgrupu($id){
        $grupa = Grupa::model()->findbyPk($id);
        $roditelj = $grupa->roditelj;
        $grupa->aktivno = 1;
        $grupa->save();
        if($roditelj != 0){
            echo $roditelj;
        }
    }
    
    /**
     * Dektivacija
     */
    
    public function actiondeaktivirajgrupu($id){
        $grupa = Grupa::model()->findbyPk($id);
        $roditelj = $grupa->roditelj;
        $grupa->aktivno = 0;
        $grupa->save();
        if($roditelj != 0){
            echo $roditelj;
        }
    }
    
    /**
     * Brisanje videa
     */
    
    public function actionObrisigrupu($id){
        $grupa = Grupa::model()->findbyPk($id);
        $roditelj = $grupa->roditelj;
        $grupa->delete();
        if($roditelj != 0){
            echo $roditelj;
        }
    }
    
    ////Proizvođači
    /**
     * Aktivacija 
     */
    
    public function actionAktivirajproizvodac($id){
        $clanak = Proizvodac::model()->findbyPk($id);
        $clanak->aktivno = 1;
        $clanak->save();
    }
    
    /**
     * Dektivacija 
     */
    
    public function actionDeaktivirajproizvodac($id){
        $clanak = Proizvodac::model()->findbyPk($id);
        $clanak->aktivno = 0;
        $clanak->save();
    }
    
    /**
     * Brisanje 
     */
    
    public function actionObrisiproizvodac($id){
        $clanak = Proizvodac::model()->findbyPk($id);
        $clanak->delete();
    }
    
    /**
     * Pozicija up
     */
    
    public function actionproizvodacup($id){
        $trazeno = Proizvodac::model()->findbyPk($id);
        
        $trenutnaPozicija = $trazeno->pozicija;
        if($trenutnaPozicija != '0'){
            $zeljenaPozicija = intval($trenutnaPozicija)-1;
            
            if($gornji = Proizvodac::model()->find('pozicija = '.$zeljenaPozicija))
            {
                $gornji->pozicija = $trenutnaPozicija;
                $gornji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        }
    }
    
    /**
     * Pozicija down 
     */
    
    public function actionproizvodacdown($id){
        $trazeno = Proizvodac::model()->findbyPk($id);
        
        $trenutnaPozicija = $trazeno->pozicija;
        
            $zeljenaPozicija = intval($trenutnaPozicija)+1;
            
            if($donji = Proizvodac::model()->find('pozicija = '.$zeljenaPozicija))
            {
                $donji->pozicija = $trenutnaPozicija;
                $donji->save();
            }
            $trazeno->pozicija = $zeljenaPozicija;
            $trazeno->save();
        
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

