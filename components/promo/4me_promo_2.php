<?php
$points = [

    [
        'title' => '„Samo mjena stalna jest.“',
        'description' => 'Latinska poslovica',
        'bullets' => [
            [
                'title' => '✓ SIAM – Service and Integration metoda: specijalizacija i integracija internog okruženja i vanjskih suradnika ',
                'popup_title' => 'SIAM – Service and Integration metoda: specijalizacija i integracija internog okruženja i vanjskih suradnika ',
                'popup_text' => 'Metodologija koja se može primijeniti u bilo koju okolinu koja zahtjeva odnos sa više raznih unutarnjih i vanjskih suradnika. Ono naglašava kako je specijalizacija izrazito bitna – jer dosljedno posvećivanje poslu multiplicira output, a svako poduzeće fokusira se na ono što radi najbolje te tako djeluje s ostalim poduzećima stvarajući trajnu sinergiju. ',
                'modal_text' => '<p>Osjećate li da nemate sve konce u rukama?<br>SIAM metodologija može se implementirati u bilo koju okolinu koja zahtjeva višestruki odnos s raznim unutarnjim i vanjskim suradnicima. 4me omogućuje sofisticiranu integraciju između različitih alata, ali i naglašava kako je specijalizacija izrazito bitna – jer dosljedno posvećivanje poslu multiplicira output.  <br>Kombinacijom integracije i fokusa na vlastito poslovanje  omogućuje se organizaciji da ostvaruje vlastitu viziju te pritom djeluje s ostalim poduzećima stvarajući trajnu sinergiju.  </p>',
                'youtube_link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ]
        ]
    ]
];
?>



<div class="container" style="text-align:center">
    <!--    <div class="row">-->
    <!--        <p class="col">-->
    <?php
    $counter = 4;
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
               
                <a href="#" data-toggle="modal" data-target="#modal_<?= $counter ?>"class="modal-title most-used-par2-4me">
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