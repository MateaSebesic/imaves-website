<?php


class GoogleMape extends CHtml{
    public $apiKey = "AIzaSyBGdKEFPS1KBZh1yjOrhmFQVr82Y-F-rJU";
    public $koordinate = "";
    public $naslov = "";
    
    public function postaviKoordinate($koor){
        $this->koordinate = $koor;
    }
    
    public function postaviNaslov($naslov){
        $this->naslov = $naslov;
    }
    
    public function postaviKartu(){
        $skripta01 = 'http://maps.google.com/maps?file=api&v=2&key='.$this->apiKey;
        $skripta02 = '
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.setCenter(new GLatLng(37.4419, -122.1419), 13);
        function createMarker(point, text, title) {
          var marker = new GMarker(point,{title:title});
          GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(text);
          });
          return marker;
        }
        var marker = createMarker(new GLatLng(37.4419, -122.1419), "Marker text", "Example Title text");
        map.addOverlay(marker);
      }
    }
    ';
    
        $skripta03 = 'GUnload()';
        Yii::app()->clientScript->registerScriptFile( $skripta01, CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScript( $skripta02, CClientScript::POS_HEAD);
	Yii::app()->clientScript->registerScript( $skripta03, CClientScript::POS_END);

        
    }
    
}


?>