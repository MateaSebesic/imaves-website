<?php
$points = [

    [
        'title' => '"Nema kruha bez motike."',
        'description' => 'Narodna poslovica',
        'bullets' => [
            
            [
                'title' => '✓ Softver u kojem se nalazi sve što je potrebno za poslovanje',
                'popup_title' => 'Softver u kojem se nalazi sve što je potrebno za poslovanje',
                'popup_text' => 'Kompletno softversko rješenje za sve potrebe menadžmenta bilo kojeg poslovanja, od mikro poduzeća do multinacionalnih kompanija, a sastoji se od mnoštva različitih alata i funkcionalnosti kako bi rad zaposlenika bio produktivan. ',
                'modal_text' => 'Želite imati sve na jednom mjestu?<br>Kompletno softversko rješenje za sve potrebe menadžmenta bilo kojeg poslovanja, od mikro poduzeća do multinacionalnih kompanija, a sastoji se od mnoštva različitih alata i funkcionalnosti, kako bi rad zaposlenika bio produktivan.',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Virtualni agent',
                'popup_title' => 'Virtualni agent',
                'popup_text' => 'Umjesto da organizacije tjednima provode treninge za sve članke i standardne zahtjeve, 4me virtualni agent već ima dovoljno informacija da razumije kontekst razgovora u interakciji sa svakim korisnikom zasebno. 

Agent je vrsta Chatbot programa i umjetne inteligencije koji korisniku nudi pomoć pri zahtjevima, a uvjerljivo simulira ponašanje čovjeka kao razgovornog partnera: obrada prirodnog jezika za predlaganje koja će značajno poboljšati relevantnost odgovora.  

Ono što je najbolje, ta usluga je u potpunosti besplatna.  ',
                'modal_text' => 'Trebate li vlastitog asistenta? <br>Umjesto da organizacije tjednima provode treninge za sve članke i standardne zahtjeve, 4me virtualni agent već ima dovoljno informacija da razumije kontekst razgovora u interakciji sa svakim korisnikom zasebno, prilagođen svakome s osobnim navikama pretraživanja. <br>Agent je vrsta chatbot programa i umjetne inteligencije koji korisniku nudi pomoć pri zahtjevima, a uvjerljivo simulira i ponašanje čovjeka kao razgovornog partnera: obrada prirodnog jezika za predlaganje koja će značajno poboljšati relevantnost odgovora.<br>I najbolje od svega, ta je usluga u potpunosti besplatna. ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Auto Translation',
                'popup_title' => 'Auto Translation',
                'popup_text' => 'Korištenje umjetne inteligencije za automatsko prevođenje poruka prilikom korespondencije subjekata različitog govornog područja -  miče jezične barijere te omogućuje nesmetanu i pouzdanu komunikaciju.  
                Korisnik se obraća internacionalnom vanjskom suradniku na svom jeziku i obrnuto.  
                Automatski prijevod izvršava se trenutno te je moguće vidjeti i originalnu poruku, u slučaju da je potrebno.  
                Podržava preko 20 najvažnijih svjetskih jezika, kao i hrvatski. I kontinuirano dodavaju nove jezike na popis! ',
                'modal_text' => '
               Širite li poslovanje izvan granica matične zemlje?<br>Korištenje umjetne inteligencije za automatsko prevođenje poruka i zahtjeva prilikom korespondencije subjekata različitog govornog područja -  miče jezične barijere te omogućuje nesmetanu i pouzdanu komunikaciju. <br>
               Korisnik se obraća internacionalnom vanjskom suradniku na svom jeziku i obrnuto.<br>Automatski prijevod izvršava se trenutno, ali moguće je vidjeti i originalnu poruku, u slučaju da je potrebno. <br>Podržava preko 20 najvažnijih svjetskih jezika, kao i hrvatski.<br>I kontinuirano se dodaju novi jezici na popis! ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Softver dizajniran prema ITIL savjetima',
                'popup_title' => 'Softver dizajniran prema ITIL savjetima',
                'popup_text' => '“Information Technology Infrastructure Library”: zbirka najboljih praksi IT Service menadžmenta  ',
                'modal_text' => 'Držite li se najviših standarda kvalitete i poslovnih praksi? <br>4me rješenje prilagođeno je preporukama ITIL-a:<br> “Information Technology Infrastructure Library”: zbirka najboljih praksi IT Service menadžmenta ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ]
        ]
    ]
];
?>



<div class="container" style="text-align:center">
    <!--    <div class="row">-->
    <!--        <p class="col">-->
    <?php
    $counter = 9;
    $modals = '';

    foreach ($points as $point) {
    ?>
        
        <p class="most-used-par2-4me">
            <style>
                a {
                    color: gray;
                }
            </style>
            <?php

            foreach ($point['bullets'] as $bullet) {
                $counter += 1;
            ?>
                <br>
                
                <a href="#" data-toggle="modal" data-target="#modal_<?= $counter ?>" class="modal-title most-used-par2-4me">
                    <?= $bullet['title'] ?>

                </a>

             <?php
                $modals .= '
                    <!-- Modal -->
                    <div class="modal fade" id="modal_' . $counter . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title most-used-par2-4me" id="exampleModalLabel"
                                    style="color:#f39200;">
                                        ' . $bullet['title'] . '
                                    </h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="most-used-par1-4me" style="color:black">
                                <div class="row">
                                <div class="col"><p style="padding-left:5%; padding-right:5%">
                                    ' . $bullet['modal_text'] . '</p>
                                    
                                     
                                     
                                    </div>
                                    
                                    </div>
                                    
                                   
                                    <p class="most-used-par1-4me">Zatražite vama
                prilagođenu prezentaciju i demo : <a class="most-used-link" style="font-size: 24px;"
                                                     href="mailto:info@imaves.com?subject=Imaves 4me service">info@imaves.hr</a><p>
                       
                                </div>
                                <div class="modal-footer">
                     
                        
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
            }

            ?>
            <!--                </p>-->
          
        <?php
    }
    echo $modals;
        ?>
        <!--        </div>-->
        <!--    </div>-->
</div>


<script>
    $(document).ready(function() {
        $("#test").hover(function() {
            $('.modal').modal({
                show: true
            });
        });
    });
</script>