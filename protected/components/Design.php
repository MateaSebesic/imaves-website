<?php

/**
 * Klasa koja sadrži sve potrebne metode za izradu dizajna web stranice
 */

 //Metode:
 //1--> Kod za fotke... za ulaz (naziv_fotke, alt_tag) vraća link, fotku povlači iz teme
 //1.1-->Putanja do fotke (vraća putanju do fotke)
 //2--> Prvi članak... vraća prvi članak u grupi
 //3--> Seo friendly... vraća seo friendly naziv iz stringa
 //4--> Punjenje arraya... ukoliko array ima manje članova nego je potrebo, isti se dupliciraju
 //5--> Skrati string... skrati string i doda ... na kraju
 //6--> Preostalo vrijeme, od a do b
 

class Design extends CHtml{
    
/**
 * Kod za fotke
 */
public static function fotka($naziv,$alt="",$class=""){
    if ($alt=="" && $class==""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/images/'.$naziv.'" />';
    }
    if ($alt!="" && $class==""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/images/'.$naziv.'" alt="'.$alt.'" />';
    }
    if ($alt!="" && $class!=""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/images/'.$naziv.'" alt="'.$alt.'" class="'.$class.'"  />';
    }
    
}

/**
 * Kod za fotke
 */
public static function adminFotka($naziv,$alt="",$class=""){
    if ($alt=="" && $class==""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/administracija/img/'.$naziv.'" />';
    }
    if ($alt!="" && $class==""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/administracija/img/'.$naziv.'" alt="'.$alt.'" />';
    }
    if ($alt!="" && $class!=""){
        return '<img src="'.Yii::app()->params['webURL'].'themes/administracija/img/'.$naziv.'" alt="'.$alt.'" class="'.$class.'"  />';
    }
    
}

/**
 * Putanja do fotke
 */
public static function fotkaPutanja(){
    return Yii::app()->params['webURL'].'themes/'.Yii::app()->params['theme'].'/img/';
}


/**
 * Seo friendly link
 */
public static function seoFriendly($realname){
    $realname = str_replace(array('(',')'),array('',''),  $realname  );
    $realname = str_replace(array('Š','Č','Ć','Ž','ž','š','đ',' '),array('s','c','c','z','z','s','d','_'),  $realname  );
    $realname = str_replace(array('č','ć','ž','š','đ',' '),array('c','c','z','s','d','_'),  strtolower( trim($realname) ) );
    $seoname = preg_replace('/\%/',' percentage',$realname); 
    $seoname = preg_replace('/\@/',' at ',$seoname); 
    $seoname = preg_replace('/\&/',' and ',$seoname); 
    $seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
    $seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
    $seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
    $seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens 
    $seoname = strtolower($seoname); 
    return $seoname;
}


/**
 * Skrati string
 */
public static function skratiString($dugacki,$broj){
    return  substr ($dugacki, 0, $broj).'...';
}

/**
 * Preostalo vrijeme
 */

public static function  preostaloVrijeme($kraj) {
    $now = new DateTime();
    $future_date = new DateTime($kraj);
    $interval = $future_date->diff($now);
    echo $interval->format("%D:%H:%I:%S");
}
/**
* Prikaz fotogalerije
*/
public static function prikaziFotogaleriju($id = 0){
    if ($id != 0){
        $criteria = new CDbCriteria;
        $criteria->condition='id_fotogalerija=:id_fotogalerija AND obrisano=:obrisano AND aktivno=:aktivno';
        $criteria->params=array(':id_fotogalerija'=>$id, ':obrisano'=>0,'aktivno'=>1);
        $criteria->order = 'pozicija ASC';
        if ($fotografije = Fotografija::model()->findAll($criteria)){
            //ispis naziva...
            $fotogalerija = Fotogalerija::model()->findbyPk($id);
            //ispis fotogalerije
            echo '<table id="fotke">';
            echo '<tr>';
            $broj = 1;
            foreach($fotografije as $fotka){
                echo '<td height="120">';
                    echo '<a href="'.Yii::app()->params['webURL'].'fotografije/fotogalerija/'.$id.'/extra/'.$fotka->fotografija.'" data-lightzap="group_name" alt="'.$fotogalerija->naziv.'">';
                        echo '<img class="fotka" src="'.Yii::app()->params['webURL'].'fotografije/fotogalerija/'.$id.'/mala/'.$fotka->fotografija.'" alt="'.$fotogalerija->naziv.'"/>';
                    echo '</a>';
                echo '</td>';
                if($broj %5 == 0) {
                    echo '</tr><tr>';
                }
                $broj++;
            }
            echo '</tr></table>';
        }
        
    }else{
        return false;
    }
}
 
/**
 * Administracija, ispis poruke
 */
public static function obavijestAkcija($ok, $objekt = 'Promijena'){
   if ($ok == 1){
       echo '<div class="grid_24"><div class="notice success"><p>';
       echo $objekt. ' je uspješno spremljena';
       echo '</p></div></div>';
   }elseif($ok == 0){
       echo '<div class="grid_24"><div class="notice error"><p>';
       echo $objekt. ' nije uspješno spremljena';
       echo '</p></div></div>';
   }
}
    
    
/**
 * Administracija, pozicija
 * uzima trenutni link, id modela i njegovu poziciju
 * prilagođava poziciju u za brojeve manje od 10
 */
public static function prikaziPoziciju($link,$id,$pozicija){
    $pozicijaPrikaz = $pozicija;
    if (intval($pozicija) < 10){
        $pozicijaPrikaz = '0'.$pozicija;
    }
    echo '<a href="';
    echo $link.'pozicijaUp='.$id;
    echo '"><span class="icon upload">&nbsp;</span></a>';
    echo $pozicijaPrikaz;
    echo '&nbsp;&nbsp;';
    echo '<a href="';
    echo $link.'pozicijaDown='.$id;
    echo '"><span class="icon download">&nbsp;</span></a>';
}
    
/**
 * Administracija, aktivno/neaktivno
 * uzima link, id modela i vrijednost polja aktivno
 */
public static function aktivnoNeaktivno($link,$id,$aktivno){
    if ($aktivno == 0){
        echo '<a class="tip" title="Aktiviraj" href="'.$link.'aktiviraj='.$id.'"><span class="icon error">&nbsp;</span></a>';
    }else{
        echo '<a class="tip" title="Aktiviraj" href="'.$link.'deaktiviraj='.$id.'"><span class="icon success">&nbsp;</span></a>';
    }
}
 
 
/**
* Prikaz naslova članaka
*/
public static function clanakNaslov($id){
 $clanak = Clanak::model()->findbyPk($id);
 if(Yii::app()->language == 'hr'){
     return $clanak->naslov_hr;
 }elseif(Yii::app()->language == 'en'){
     return $clanak->naslov_en;
 }else{
     return $clanak->naslov_de;
 }
}
 
/**
* Prikaz sadržaja članaka
*/
public static function clanakSadrzaj($id){
 $clanak = Clanak::model()->findbyPk($id);
 if(Yii::app()->language == 'hr'){
     return $clanak->sadrzaj_hr;
 }elseif(Yii::app()->language == 'en'){
     return $clanak->sadrzaj_en;
 }else{
     return $clanak->sadrzaj_de;
 }
}
 
/**
 * Prikaz naziva kategorije
 */
public static function kategorijaNaziv($id){
   $kategorija = Kategorija::model()->findbyPk($id);
   if(Yii::app()->language == 'hr'){
       return $kategorija->naziv_hr;
   }elseif(Yii::app()->language == 'en'){
       return $kategorija->naziv_en;
   }else{
       return $kategorija->naziv_de;
   }
}
 
 

/**
  * Ispis slideshowa, ulaz je id slideshowa
  */
 
 public static function slideshow($id){
    if ($slideshow = Slideshow::model()->findbyPk($id)){
        if($slides = Slide::model()->findAll('id_slideshow = '.$id.' AND aktivno = 1 AND obrisano = 0 ORDER BY pozicija ASC')){
            foreach($slides as $slide){
                //odabir jezika
                $prikaziSlide = 0;
                if (Yii::app()->language == 'hr'){
                        $naslov = $slide->naziv;
                        $opis = $slide->opis;
                        $link = $slide->link;
                        if ($slide->objavi_hr == 1){$prikaziSlide = 1;}
                }elseif (Yii::app()->language == 'en'){
                        $naslov = $slide->naziv_en;
                        $opis = $slide->opis_en;
                        $link = $slide->link_en;
                        if ($slide->objavi_en == 1){$prikaziSlide = 1;}
                }elseif (Yii::app()->language == 'de'){
                        $naslov = $slide->naziv_de;
                        $opis = $slide->opis_de;
                        $link = $slide->link_de;
                        if ($slide->objavi_de == 1){$prikaziSlide = 1;}
                }
                if ($prikaziSlide == 1){
                echo '<div class="slide">';
                echo '<a href="'.$link.'" class="slideLink">';
                    echo '<div class="slidePhoto" style="background: url('.Yii::app()->params['webURL'].'fotografije/slideshow/'.$id.'/velika/'.$slide->fotografija.') no-repeat; background-position: center top;" >';
                    //echo '<img class="sliderImage" src="'.Yii::app()->params['webURL'].'fotografije/slideshow/'.$id.'/velika/'.$slide->fotografija.'" />';
                    echo '</div>';
                    echo '<div class="slideCaption"><div class="slideField">';
                    echo '<p class="slideTitle">'.$naslov.'</p>';
                    echo '<p class="slideText">'.$opis.'</p>';
                    echo '</div></div>';
                echo '</a>';
                echo '</div>';
                }
            }
        }else{
            //ako nema niti jednog slide-a
        }
        
    }else{
        //ako nema slideshowa
    }
 }
 
 
 
 
 
public static function ispisiMenu($izbornik){
    /**
     * Izbornik radi na slijedećem principu:
     * ako je stavka roditelj, a vrsta je (0)->jedan članak na stranici ili (1)->prikaz u harmonici, tada će se prikazati djeca
     * ako je stavka roditelj, a vrsta je (2)->djeca u harmonici, tada se djeca neće prikazati već će se otvoriti harmonika s otvorenim prvim djetetom
     *
     * Prijevod, uzima se stavka te se gleda da li postoji prijevod za aktivni jezik za tu stavku
     */
    $stavkeIzbornik = StavkaIzbornik::model()->findAll('obrisano = 0 AND aktivno = 1 AND id_roditelj IS NULL AND id_izbornik = '.$izbornik.' ORDER BY pozicija ASC');
    echo '<ul id="nav" class="dropdown dropdown-horizontal">';
    foreach ($stavkeIzbornik as $stavka){
        //prvo se provjerava da li je odobren prijevod za trenutnu stavku
        $prikaziStavku = 1;
        if (Yii::app()->language != 'hr'){
            if (Yii::app()->language == 'en'){
                //id za en jezik je 1
                $stavkaPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$stavka->id.' AND id_jezik = 1');
                if ($stavkaPrijevod->objavi != 1){
                    $prikaziStavku = 0;
                }
            }
            if (Yii::app()->language == 'de'){
                //id za de jezik je 2
                $stavkaPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$stavka->id.' AND id_jezik = 2');
                if ($stavkaPrijevod->objavi != 1){
                    $prikaziStavku = 0;
                }
            }
        }
        if ($prikaziStavku == 1){
            if ($dijete = StavkaIzbornik::model()->find('obrisano = 0 AND aktivno = 1 AND id_roditelj = '.$stavka->id.' AND id_izbornik = '.$izbornik)){
                //provjera vrste roditelja
                if ($stavka->vrsta == 2){
                    //znači da se djeca ne prikazuju u drop-down-u
                    if (Yii::app()->language == 'hr'){
                        $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                        echo '<li><a href="'.$link.'">'.$stavka->naziv.'</a></li>';
                    }else{
                        $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavkaPrijevod->naziv);
                        echo '<li><a href="'.$link.'">'.$stavkaPrijevod->naziv.'</a></li>';  
                    }
                }else{
                    //djeca se prikazuju u drop-down-u
                    Design::ispisiDjecu($stavka->id);
                }
            }else{
                // stavka nije roditelj, treba ju ispisati
                $link = "#";
                if ($stavka->home){
                    //početna stranica
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/';
                }elseif($stavka->kontakt){
                    //tehnička podrška, neregistrirani korisnici
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.'tehinicka_podrska_neregistrirani_korisnici';
                }elseif($stavka->login){
                    //tehnička podrška, registrirani korisnici
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.'tehinicka_podrska_registrirani_korisnici';
                }elseif($stavka->id_clanak){
                    //članak
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                }elseif($stavka->id_novost){
                    //članak
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                }
                if (Yii::app()->language == 'hr'){
                    echo '<li><a href="'.$link.'">'.$stavka->naziv.'</a></li>';
                }else{
                    echo '<li><a href="'.$link.'">'.$stavkaPrijevod->naziv.'</a></li>';
                }
            }
        }
    }
    echo '</ul>';
}


/**
 * Ispis djece u izborniku
 */
public static function ispisiDjecu($roditelj){
    $roditelj = StavkaIzbornik::model()->findbyPk($roditelj);
    $izbornik = $roditelj->id_izbornik;
    $stavkeDjeca = StavkaIzbornik::model()->findAll('obrisano = 0 AND aktivno = 1 AND id_roditelj = '.$roditelj->id.' AND id_izbornik = '.$izbornik.' ORDER BY pozicija ASC');
    $prikaziRoditelja = 1;
    //provjera da li je objavljen prijevod za roditelja ukoliko jezik nije hr
    if (Yii::app()->language == 'en'){
        //id za en jezik je 1
        $roditeljPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$roditelj->id.' AND id_jezik = 1');
        if ($roditeljPrijevod->objavi != 1){
            $prikaziRoditelja = 0;
        }
    }
    if (Yii::app()->language == 'de'){
        //id za de jezik je 2
        $roditeljPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$roditelj->id.' AND id_jezik = 2');
        if ($roditeljPrijevod->objavi != 1){
            $prikaziRoditelja = 0;
        }
    }
    if ($prikaziRoditelja == 1){
    if (Yii::app()->language == 'hr'){
        echo '<li><a href="#" class="dir">'.$roditelj->naziv.'</a>';
    }else{
        echo '<li><a href="#" class="dir">'.$roditeljPrijevod->naziv.'</a>';
    }
        
    echo '<ul>';
    foreach ($stavkeDjeca as $stavka){
        if ($dijete = StavkaIzbornik::model()->find('obrisano = 0 AND aktivno = 1 AND id_roditelj = '.$stavka->id.' AND id_izbornik = '.$izbornik)){
            //provjera prijevoda
            $prikaziStavku = 1;
            if (Yii::app()->language != 'hr'){
                //ako jezik nije hr provjeri prijevod
                if (Yii::app()->language == 'en'){
                    //id za en jezik je 1
                    $stavkaPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$stavka->id.' AND id_jezik = 1');
                    if ($stavkaPrijevod->objavi != 1){
                        $prikaziStavku = 0;
                    }
                }
                if (Yii::app()->language == 'de'){
                    //id za de jezik je 2
                    $stavkaPrijevod = StavkaPrijevod::model()->find('id_stavka_izbornik = '.$stavka->id.' AND id_jezik = 2');
                    if ($stavkaPrijevod->objavi != 1){
                        $prikaziStavku = 0;
                    }
                }
            }
            //provjera vrste roditelja
            if ($stavka->vrsta == 2 && $prikaziStavku == 1){
                //znači da se djeca ne prikazuju u drop-down-u
                $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                if (Yii::app()->language == 'hr'){
                    echo '<li><a href="'.$link.'">'.$stavka->naziv.'</a></li>';
                }else{
                    echo '<li><a href="'.$link.'">'.$stavkaPrijevod->naziv.'</a></li>';
                }
            }else{
                //djeca se prikazuju u drop-down-u
                Design::ispisiDjecu($stavka->id);
            }
        }else{
            $link = "#";
            if ($stavka->home){
                //početna stranica
                $link = Yii::app()->params['webURL'].Yii::app()->language.'/';
            }elseif($stavka->kontakt){
                //tehnička podrška, neregistrirani korisnici
                $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.'tehinicka_podrska_neregistrirani_korisnici';
            }elseif($stavka->login){
                //tehnička podrška, registrirani korisnici
                $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.'tehinicka_podrska_registrirani_korisnici';
            }elseif($stavka->id_clanak){
                //članak
                if (Yii::app()->language == 'hr'){
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                }else{
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavkaPrijevod->naziv);
                }
            }elseif($stavka->id_novost){
                //članak
                if (Yii::app()->language == 'hr'){
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavka->naziv);
                }else{
                    $link = Yii::app()->params['webURL'].Yii::app()->language.'/'.$stavka->id.'/'.Design::seoFriendly($stavkaPrijevod->naziv);
                }
            }
                if (Yii::app()->language == 'hr'){
                    echo '<li><a href="'.$link.'">'.$stavka->naziv.'</a></li>';
                }elseif($prikaziStavku == 1){
                    echo '<li><a href="'.$link.'">'.$stavkaPrijevod->naziv.'</a></li>';
                }
        } 
    }
    echo '</ul>';
    echo '</li>';
    }
}

}

?>