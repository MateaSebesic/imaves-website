<?php
$points = [

    [
        'title' => '„Only change is perpetual.“',
        'description' => 'Ancient greek proverb',
        'bullets' => [
            [
                'title' => '✓ SIAM - Service and Integration method: specialization and integration of internal environment and external associates ',
                'popup_title' => 'SIAM - Service and Integration method: specialization and integration of internal environment and external associates ',
                'popup_text' => 'Metodologija koja se može primijeniti u bilo koju okolinu koja zahtjeva odnos sa više raznih unutarnjih i vanjskih suradnika. Ono naglašava kako je specijalizacija izrazito bitna – jer dosljedno posvećivanje poslu multiplicira output, a svako poduzeće fokusira se na ono što radi najbolje te tako djeluje s ostalim poduzećima stvarajući trajnu sinergiju. ',
                'modal_text' => 'Do you feel like you don’t have all the strings in your hands?<br>SIAM methodology can be implemented in any environment that requires multiple relationships with various internal and external collaborators. 4me enables sophisticated integration between different tools, but also emphasizes that specialization is extremely important - because consistent dedication to work multiplies output. <br>The combination of integration and focus on its own business enables the organization to realize its own vision and at the same time work with other companies, creating lasting synergy. ',
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