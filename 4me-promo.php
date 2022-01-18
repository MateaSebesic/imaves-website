<?php
include "components/header.php";

include "components/navigation.php";
?>
<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
<link rel="" href="https://unpkg.com/@popperjs/core@2">
<div style="overflow: hidden;">
    <br><br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-head2">Iskusite sveobuhvatne mogućnosti upravljanja poslovnim uslugama. <br>Softver dizajniran prema ITIL® preporukama. 
            </p>
            <p class="most-used-par1-4me" style="padding-left:10%; padding-right:10%; font-weight:400;">Softver 4me je definitivno i nedvojbeno najbrži u procesuiranju velike količine zahtjeva te omogućuje mnoge jedinstvenosti, koje ne nudi niti jedan drugi konkurent na IT tržištu. 

 U konačnici, impresivno je da sve te usluge nemaju skrivene troškove, a kao kruna svega navedenoga 4me implementacija je brza, jednostavna i bezbolna – vjerojatno od čega svi poslodavci strahuju, zapravo nije nikakav izazov za 4me rješenje i IMAVES tim. 
            </p>



        </div>
    </div>
    <div class="row">
        <div class="col ">
            <p class="most-used-par2">Želite li isprobati 4me?
            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://www.4me.com/trial/" class="registered-button registered-button-text btnr"><span
                        class="registered-button-text">FREE TRIAL</span></a>
            </div>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-12">
            <p class="most-used-par2">Za više informacija zatražite sastanak s nama!
            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://outlook.office365.com/owa/calendar/Imaves1@IMAVES.Hr/bookings/" class="registered-button registered-button-text btnr" style ="background-color: #FF5800"><span
                        class="registered-button-text">ZATRAŽI SASTANAK</span></a>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-par1-4me">Ili posjetite službenu 4me WEB stranicu : <a class="most-used-link" href="http://4me.com/" target="blank">4me.com</a>
            </p>
            
        </div>
    </div>
    
    <div class="row promo-4me">
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_1.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center " style="width: inherit;" src="assets/images/4me-promo-1.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-2.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
           
                <?php
                include "components/promo/4me_promo_2.php";
                ?>
            </p>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_3.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-3.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-4.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_4.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_5.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-5.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-6.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_6.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
        <div class="col-md-12  col-lg-12 col-sm-12 col-12">
            <?php
            include "components/promo/video_slider.php";
            ?>
        </div>
    </div>





    <?php
  include "components/footer.php";
  ?>


    <script>
    $(".nav-language a[href='index-en.php']").attr("href", "4me-promo-en.php");
    
    $(".nav-language a[href='index-slo.php']").attr("href", "4me-promo-slo.php");
    
    
    $(document).ready(function() {
        $("#test").hover(function() {
            $('.modal').modal({
                show: true
            });
        });
    });
    
   
    </script>