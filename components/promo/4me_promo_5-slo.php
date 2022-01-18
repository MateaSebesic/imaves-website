<?php
$points = [

    [
        'title' => '"Dovršeni su poslovi ugodni"',
        'description' => 'Latinska poslovica',
        'bullets' => [
            [
                'title' => '✓ Vse funkcionalnosti znotraj ene licence',
                'popup_title' => 'Sve funkcionalnosti dostupne unutar jedne licence',
                'popup_text' => 'Se pri poslovanju pogosto zgodi, da so realni stroški višji od planiranih? <br>4me nima skritih funkcionalnosti, ki bi se morale plačati naknadno. V ceno ene licence so vštete vse možnosti uporabe 4me programske opreme.',
                'modal_text' => 'Se pri poslovanju pogosto zgodi, da so realni stroški višji od planiranih? <br>4me nima skritih funkcionalnosti, ki bi se morale plačati naknadno. V ceno ene licence so vštete vse možnosti uporabe 4me programske opreme.',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ],
            [
                'title' => '✓ Hitra, enostavna in neboleča implementacija',
                'popup_title' => 'Brza, jednostavna i bezbolna implementacija',
                'popup_text' => 'Vjerojatno od čega svi poslodavci strahuju, zapravo nije nikakav izazov za 4me softver i IMAVES tim! ',
                'modal_text' => 'Vas je strah sprememb?<br>Kar predstavlja strah večini podjetjem, ni poseben izziv za 4me programsko opremo in Imaves ekipo!',
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
    $counter = 13;
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