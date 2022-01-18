<?php
class Korisno extends CHtml{
    
    /**
     * Naslov članka ili proizvoda pretvara se u seo friendly riječ koja se može postaviti unutar URL-a
     */
    
    public function naslovLink($naslov){
        $naslov = strtolower ($naslov);
        $naslov = str_replace("š", "s", $naslov);
        $naslov = str_replace("ž", "z", $naslov);
        $naslov = str_replace("đ", "d", $naslov);
        $naslov = str_replace("č", "c", $naslov);
        $naslov = str_replace("ć", "c", $naslov);
        $naslov = str_replace("Š", "s", $naslov);
        $naslov = str_replace("Ž", "z", $naslov);
        $naslov = str_replace("Đ", "d", $naslov);
        $naslov = str_replace("Č", "c", $naslov);
        $naslov = str_replace("Ć", "c", $naslov);
        $naslov = ereg_replace("[^A-Za-z0-9 ]", "", $naslov);
        $naslov = str_replace(" ", "_", $naslov);
        return $naslov;
    }
    
}

?>