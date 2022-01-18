<?php
include "components/header.php";

include "components/navigation-slo.php";
?>
<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
<link rel="" href="https://unpkg.com/@popperjs/core@2">
<div style="overflow: hidden;">
    <br><br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-head2">Preizkusite celovito možnost upravljanja s poslovnimi storitvami.<br>Programska oprema je dizajnirana na podlagi ITIL priporočil.
            </p>
            <p class="most-used-par1-4me" style="padding-left:10%; padding-right:10%; font-weight:400;">Program 4me je nedvomno najhitrejši v obdelovanju velike količine zahtevkov in omogoča mnoge edinstvene funkcionalnosti, ki jih ne ponuja nobeno konkurentno orodje na IT tržišču; več informacij nudimo v nadaljevanju.<br> Impresivno je, da vse te storitve ne prinašajo skritih stroškov, za povrhu pa je sama implementacija programa 4me hitra, enostavna in neboleča. Ravno to, česar se verjetno večina delodajalcev boji, ni nikakršen izziv za 4me in Imaves tim. 
            </p>



        </div>
    </div>
    <div class="row">
        <div class="col ">
            <p class="most-used-par2">Bi radi poskusili 4me?
            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://www.4me.com/trial/" class="registered-button registered-button-text btnr"><span
                        class="registered-button-text">FREE TRIAL</span></a>
            </div>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-12">
            <p class="most-used-par2">Zahtevajte sestanek z nami za več informacij! 

            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://outlook.office365.com/owa/calendar/Imaves1@IMAVES.Hr/bookings/" class="registered-button registered-button-text btnr" style ="background-color: #FF5800"><span
                        class="registered-button-text">ZAHTEVAJTE SREČANJE</span></a>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-par1-4me">Ali pa obiščite uradno spletno stran 4me: <a class="most-used-link" href="http://4me.com/" target="blank">4me.com</a>
            </p>
            
        </div>
    </div>
    
    <div class="row promo-4me">
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_1-slo.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center " style="width: inherit;" src="assets/images/4me-promo-1-slo.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-2-slo.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
           
                <?php
                include "components/promo/4me_promo_2-slo.php";
                ?>
            </p>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_3-slo.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-3-slo.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-4-slo.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_4-slo.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_5-slo.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-5-slo.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-6-slo.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_6-slo.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
        <div class="col-md-12  col-lg-12 col-sm-12 col-12">
            <?php
            include "components/promo/video_slider-slo.php";
            ?>
        </div>
    </div>





    <?php
  include "components/footer-slo.php";
  ?>


    <script>
    
    $(".nav-language a[href='index.php']").attr("href", "4me-promo.php");
    $(document).ready(function() {
        $("#test").hover(function() {
            $('.modal').modal({
                show: true
            });
        });
    });
    $(".nav-language a[href='index-en.php']").attr("href", "4me-promo-en.php");
    $(document).ready(function() {
        $("#test").hover(function() {
            $('.modal').modal({
                show: true
            });
        });
    });
    
    

    </script>