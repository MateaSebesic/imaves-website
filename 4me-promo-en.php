<?php
include "components/header.php";

include "components/navigation-en.php";
?>
<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
<link rel="" href="https://unpkg.com/@popperjs/core@2">
<div style="overflow: hidden;">
    <br><br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-head2">Experience all-inclusive business service management capabilities. <br>Software designed according to ITIL® recommendations. 
            </p>
            <p class="most-used-par1-4me" style="padding-left:10%; padding-right:10%; font-weight:400;">4me software is definitely and arguably the fastest in processing a large amount of requests and offers numerous unique features, which are not offered by any other competitor in the IT market.<br> Ultimately, it’s impressive that all of these services have no hidden costs, and as a cherry on top, 4me implementation is quick, easy and painless - what most employers fear is actually no challenge for the 4me solution and the IMAVES team. 
            </p>



        </div>
    </div>
    <div class="row">
        <div class="col ">
            <p class="most-used-par2">Want to try 4me?
            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://www.4me.com/trial/" class="registered-button registered-button-text btnr"><span
                        class="registered-button-text">FREE TRIAL</span></a>
            </div>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-12">
            <p class="most-used-par2">Request a meeting for more information! 

            </p>
            <div class="registered-button-div">
                <a target="_blank" href="https://outlook.office365.com/owa/calendar/Imaves1@IMAVES.Hr/bookings/" class="registered-button registered-button-text btnr" style ="background-color: #FF5800"><span
                        class="registered-button-text">REQUEST A MEETING</span></a>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col ">
            <p class="most-used-par1-4me">Or visit the official 4me WEB site: <a class="most-used-link" href="http://4me.com/" target="blank">4me.com</a>
            </p>
            
        </div>
    </div>
    
    <div class="row promo-4me">
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_1-en.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center " style="width: inherit;" src="assets/images/4me-promo-1-en.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-2-en.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
           
                <?php
                include "components/promo/4me_promo_2-en.php";
                ?>
            </p>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_3-en.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-3-en.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-4-en.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_4-en.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_5-en.php";
            ?>
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-5-en.png" alt="">
        </div>
    </div>

    <div class="row promo-4me">
    <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <img class="text-center" style="width: inherit;" src="assets/images/4me-promo-6-en.png" alt="">
        </div>
        <div class="col-md-6  col-lg-6 col-sm-6 col-6">
            <?php
            include "components/promo/4me_promo_6-en.php";
            ?>
        </div>

    </div>

    <div class="row promo-4me">
        <div class="col-md-12  col-lg-12 col-sm-12 col-12">
            <?php
            include "components/promo/video_slider-en.php";
            ?>
        </div>
    </div>





    <?php
  include "components/footer-en.php";
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
    $(".nav-language a[href='index-slo.php']").attr("href", "4me-promo-slo.php");
    
    $(document).ready(function() {
        $("#test").hover(function() {
            $('.modal').modal({
                show: true
            });
        });
    });
    

    </script>