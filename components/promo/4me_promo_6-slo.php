<?php
$points = [

    [
        'title' => ' "Sretan je onaj koji ništa ne duguje"',
        'description' => 'Latinska poslovica',
        'bullets' => [
            [
                'title' => '✓ Freemium accounti',
                'popup_title' => 'Freemium accounti',
                'popup_text' => 'Se ne želite prenagliti z odločitvijo?  <br>Preizkusite brezplačno različico 4me programske opreme z brezplačnim uporabniškim računom, ki obsega funkcijo samopostrežnosti (self-service), aplikacije za pametne telefone, virtualnega asistenta, avtomatsko prevajanje, analitike in preostale funkcionalnosti! ',
                'modal_text' => '
                <p>Se ne želite prenagliti z odločitvijo?  <br>Preizkusite brezplačno različico 4me programske opreme z brezplačnim uporabniškim računom, ki obsega funkcijo samopostrežnosti (self-service), aplikacije za pametne telefone, virtualnega asistenta, avtomatsko prevajanje, analitike in preostale funkcionalnosti!</p>',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ Brez skritih stroškov ',
                'popup_title' => 'Brez skritih stroškov',
                'popup_text' => 'Komplikacije oko planiranih i stvarnih troškova su prošlost: 1 licenca za korištenje svih funkcionalnosti aplikacije.  ',
                'modal_text' => '<p>Koliko krat so bili realni stroški višji od načrtovanih?<br>Razhajanja med načrtovanimi in dejanskimi stroški so preteklost:<br>1 licenca vključuje uporabo vseh funkcionalnosti programske opreme.</p>',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ Brezplačni spletni tečaji',
                'popup_title' => 'Brezplačni spletni tečaji',
                'popup_text' => 'Zakaj bi plačevali drage tečaje uporabe? <br> Brezplačni spletni tečaji so dostopni za vsako delovno mesto, kjer koli in kadar koli.',
                'modal_text' => '<p>Zakaj bi plačevali drage tečaje uporabe? <br> Brezplačni spletni tečaji so dostopni za vsako delovno mesto, kjer koli in kadar koli.</p> ',
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
    $counter = 15;
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