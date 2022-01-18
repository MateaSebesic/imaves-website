<?php
$points = [
   
    [
        'title' => '"Clear agreements-good friends "',
        'description' => 'Latinska poslovica',
        'bullets' => [
            [
                'title' => '✓ SLA (Service Level Agreements) ',
                'popup_title' => 'SLA (Service Level Agreements) ',
                'popup_text' => 'Jednostavno definiranje razina odnosa s klijentima: kategorizirane usluge s obzirom na njihove potrebe poslovanja. ',
                'modal_text' => 'Not sure what you&#39;re up to?<br>Easily define customer relationship levels: categorized services according to their business needs and your service catalog. ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ Team’s work',
                'popup_title' => 'Team’s work',
                'popup_text' => 'Nikada jednostavnija suradnja između zaposlenika i njihovih vanjskih suradnika: sve poruke i privitci na jednom mjestu, uz mogućnost poziva ili videopoziva! ',
                'modal_text' => 'Do you often get lost in the sea of emails?<br>Never easier collaboration between employees and their external collaborators: all messages and attachments in one place, with connection to e-mail and the possibility of a call or video call! 

  ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ 4me mobile application ',
                'popup_title' => '4me mobile application ',
                'popup_text' => 'Niste pri računalu? Iskoristite potpuni potencijal digitalne usluge i timske komunikacije uz 4me mobilnu aplikaciju za Android i IOS. ',
                'modal_text' => 'Not at the computer?<br>Harness the full potential of digital service and team communication with the 4th mobile app for Android and iOS. 

  ',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ 4me Connect',
                'popup_title' => '4me Connect',
                'popup_text' => 'Imate potrebu dodatno se informirati glede dobivenog zahtjeva?<br> 4me aplikacija podiže komunikaciju na višu razinu: pozivi i videopozivi unutar same 4me aplikacije! ',
                'modal_text' => 'Do you need additional information about the received request?<br>The 4me solution takes communication to a higher level: calls and video calls within the 4me application itself! ',
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
    $counter = 0;
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