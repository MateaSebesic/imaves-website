<?php
$points = [

    [
        'title' => '"No bees, no honey."',
        'description' => 'Old folk proverb',
        'bullets' => [
            
            [
                'title' => '✓ Software that contains everything you need for business ',
                'popup_title' => 'Software that contains everything you need for business ',
                'popup_text' => 'Kompletno softversko rješenje za sve potrebe menadžmenta bilo kojeg poslovanja, od mikro poduzeća do multinacionalnih kompanija, a sastoji se od mnoštva različitih alata i funkcionalnosti kako bi rad zaposlenika bio produktivan. ',
                'modal_text' => 'Want to have everything in one place?<br>A complete software solution for all management needs of any business, from micro companies to multinational companies, which consists of many different tools and functionalities to make the work of employees productive. ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Virtual agent ',
                'popup_title' => 'Virtual agent ',
                'popup_text' => 'Umjesto da organizacije tjednima provode treninge za sve članke i standardne zahtjeve, 4me virtualni agent već ima dovoljno informacija da razumije kontekst razgovora u interakciji sa svakim korisnikom zasebno. 

Agent je vrsta Chatbot programa i umjetne inteligencije koji korisniku nudi pomoć pri zahtjevima, a uvjerljivo simulira ponašanje čovjeka kao razgovornog partnera: obrada prirodnog jezika za predlaganje koja će značajno poboljšati relevantnost odgovora.  

Ono što je najbolje, ta usluga je u potpunosti besplatna.  ',
                'modal_text' => 'Do you need your own assistant? <br>Instead of spending weeks on training for all articles and standard requests in organisation, the 4me virtual agent already has enough information to understand the context of the conversation interacting with each user individually, tailored to each with personal search habits. <br>Agent is a type of chatbot program and artificial intelligence that offers the user help with requests, and convincingly simulates human behavior as a conversational partner: processing natural language for suggestions that will significantly improve the relevance of the response. <br>And best of all, that service is completely free. 

 ',
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
               Are you expanding your business beyond your home country? <br>The use of artificial intelligence for automatic translation of messages and requests during correspondence of subjects of different speech areas - removes language barriers and enables uninterrupted and reliable communication. The user addresses the international external collaborator in their own language and vice versa. Automatic translation is performed immediately, but it is possible to see the original message, in case it is needed.  <br>It supports over 20 of the world&#39;s most important languages, as well as Croatian and Slovenian. <br>And new languages are constantly being added to the list! 

 ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
[
                'title' => '✓ Software designed according to ITIL tips ',
                'popup_title' => 'Software designed according to ITIL tips ',
                'popup_text' => '“Information Technology Infrastructure Library”: zbirka najboljih praksi IT Service menadžmenta  ',
                'modal_text' => 'Do you adhere to the highest standards of quality and business practices? <br>The 4me solution is adapted to the recommendations of ITIL: “Information Technology Infrastructure Library”: a collection of best practices of IT Service management. ',
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
                                    
                                   
                                    <p class="most-used-par1-4me">Request a personalized presentation and demo: <a class="most-used-link" style="font-size: 24px;"
                                                     href="mailto:info@imaves.com?subject=Imaves 4me service">info@imaves.hr</a><p>
                       
                                </div>
                                <div class="modal-footer">
                     
                        
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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