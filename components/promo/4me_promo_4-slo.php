<?php
$points = [

    [
        'title' => '"Nema kruha bez motike."',
        'description' => 'Narodna poslovica',
        'bullets' => [
            
            [
                'title' => '✓ Programska oprema, ki vsebuje vse potrebno za poslovanje',
                'popup_title' => 'Programska oprema, ki vsebuje vse potrebno za poslovanje',
                'popup_text' => 'Kompletno softversko rješenje za sve potrebe menadžmenta bilo kojeg poslovanja, od mikro poduzeća do multinacionalnih kompanija, a sastoji se od mnoštva različitih alata i funkcionalnosti kako bi rad zaposlenika bio produktivan. ',
                'modal_text' => 'Želite imeti vse na enem mestu?<br>Celovita programska rešitev za vse potrebe menedžmenta za podjetje kakršnegakoli obsega – od mikro do multinacionalnih podjetij. Vsebuje širok nabor različnih orodij in funkcionalnosti, ki zaposlenemu omogočaju večjo produktivnost.',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Virtualni agent',
                'popup_title' => 'Virtualni agent',
                'popup_text' => 'Umjesto da organizacije tjednima provode treninge za sve članke i standardne zahtjeve, 4me virtualni agent već ima dovoljno informacija da razumije kontekst razgovora u interakciji sa svakim korisnikom zasebno. 

Agent je vrsta Chatbot programa i umjetne inteligencije koji korisniku nudi pomoć pri zahtjevima, a uvjerljivo simulira ponašanje čovjeka kao razgovornog partnera: obrada prirodnog jezika za predlaganje koja će značajno poboljšati relevantnost odgovora.  

Ono što je najbolje, ta usluga je u potpunosti besplatna.  ',
                'modal_text' => 'Potrebujete lastnega asistenta?<br>Namesto, da podjetje več tednov izvaja tečaje za uporabo programske opreme, nudi 4me virutalni asistent že sam po sebi dovolj informacij da je razumljiv kontekst v interakciji z vsakim uporabnikom posebej, prilagojen vsakomur s personaliziranimi  navadami iskanja.<br>Asistent je vrsta chatbot programa, vključuje umetno inteligenco, ki uporabniku nudi pomoč pri nalogah in hkrati prepričljivo oponaša človeško obnašanje tekom pogovora: obdeluje jezikovne strukture in kreira predloge, ki lahko znatno izboljšajo relevantnost odgovora. <br>Kar je najbolje, ta storitev je popolnoma brezplačna. ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Auto Translation',
                'popup_title' => 'Auto Translation',
                'popup_text' => 'Korištenje umjetne inteligencije za automatsko prevođenje poruka prilikom korespondencije subjekata različitog govornog područja -  miče jezične barijere te omogućuje nesmetanu i pouzdanu komunikaciju.  
                Korisnik se obraća internacionalnom vanjskom suradniku na svom jeziku i obrnuto.  
                Automatski prijevod izvršava se trenutno te je moguće vidjeti i originalnu poruku, u slučaju da je potrebno.  
                Podržava preko 20 najvažnijih svjetskih jezika, kao i hrvatski. I kontinuirano dodavaju nove jezike na popis! ',
                'modal_text' => 'Širite poslovanje izven meja matične države? <br>Uporablja se umetna inteligenca za samodejno (avtomatsko) prevajanje sporočil za komunikacijo s subjekti različnih govornih področij – jezične bariere se tako premostijo in omogočena je nemotena ter zanesljiva komunikacija. <br>
               Uporabnik pristopa zunanjemu sodelavcu iz tujine s sporočilom v svojem jeziku in obratno.   <br>Prevod se odvija samodejno tekom sestavljanja sporočila, mogoče pa je tudi hkrati videti originalno sporočilo. <br>Podpira preko 20 svetovnih jezikov, med temi v auto translate obliki tudi slovenščino.   <br>In novi jeziki se nenehno dodajajo na seznam!',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Programska oprema oblikovana na podlagi ITIL priporočil',
                'popup_title' => 'Programska oprema oblikovana na podlagi ITIL priporoči',
                'popup_text' => '“Information Technology Infrastructure Library”: zbirka najboljih praksi IT Service menadžmenta  ',
                'modal_text' => 'Se držite najvišjih standardov kvalitete in poslovnih praks? <br>4me rešitev je prilagojena priporočilom ITIL-a (“Information Technology Infrastructure Library”): <br>zbirka najboljših praks IT storitvenega menadžmenta (IT Service Management).',
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
                                    
                                   
                                    <p class="most-used-par1-4me">Zahtevajte osebno predstavitev in predstavitev: <a class="most-used-link" style="font-size: 24px;"
                                                     href="mailto:info@imaves.com?subject=Imaves 4me service">info@imaves.hr</a><p>
                       
                                </div>
                                <div class="modal-footer">
                     
                        
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Zapri</button>
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