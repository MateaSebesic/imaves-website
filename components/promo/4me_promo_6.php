<?php
$points = [

    [
        'title' => ' "Sretan je onaj koji ništa ne duguje"',
        'description' => 'Latinska poslovica',
        'bullets' => [
            [
                'title' => '✓ Freemium accounti',
                'popup_title' => 'Freemium accounti',
                'popup_text' => 'Ne želite donijeti naglu odluku?<br>Uz Freemium account dobijete funkcionalnosti poput:<br>Self-service, Smartphone aplikacije, Virtualnog agenta, Auto Translation, Analitike i ostale funkcionalnosti!  ',
                'modal_text' => '
                <p>Ne želite donijeti naglu odluku?<br>Uz Freemium account dobijete funkcionalnosti poput:<br>Self-service, Smartphone aplikacije, Virtualnog agenta, Auto Translation, Analitike i ostale funkcionalnosti!  </p>',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ Nema skrivenih troškova',
                'popup_title' => 'Nema skrivenih troškova',
                'popup_text' => 'Komplikacije oko planiranih i stvarnih troškova su prošlost: 1 licenca za korištenje svih funkcionalnosti aplikacije.  ',
                'modal_text' => '<p>Koliko su Vam puta stvarni troškovi bili veći od planiranih?<br>Komplikacije oko planiranih i stvarnih troškova postaju prošlost: <br>1 licenca za korištenje svih funkcionalnosti 4me aplikacije.  </p>',
                'youtube_link'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/ZQF1b04JSpo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ], [
                'title' => '✓ Besplatni online treninzi',
                'popup_title' => 'Besplatni online treninzi',
                'popup_text' => 'Zašto biste plaćali skupe treninge za učenje korištenja softvera? Besplatni online treninzi za svaku radnu poziciju dostupni su bilo kada za bilo koga. ',
                'modal_text' => '<p>Zašto biste plaćali skupe treninge edukacije? Besplatni online treninzi dostupni su za svaku radnu poziciju, bilo kada i bilo gdje. </p> ',
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