  <!-- Footer -->
  
  <!-- Footer -->
  <footer class="first-footer">
    <!-- Footer Links -->
    
      <!-- Grid row -->
      <div class="row" style=" padding-bottom: 2%;padding-left: 10%; padding-right: 10%">
        <!-- Grid column -->
        <div class="col-md-3 mx-auto" >
          <!-- Links -->
          <p class="footer-heading-1">IMAVES d.o.o. </p>
          <ul class="list-unstyled footer-address">
            <li>
              <a>Business office address:</a>
            </li>
            <li>
              <a class="footer-link" href="https://goo.gl/maps/mXPw9o4rUGeq2w8T6" target="_blank">Vukovarska street 274  </a><br />
            </li>
            <li>
              <a>10000 Zagreb, Republic of Croatia</a>
            </li>
            <br>
            <li>
              <a>Headquarter address:</a>
            </li>
            <li>
              <a>Mihanovićeva street 20</a>
            </li>
            <li>
              <a>10000 Zagreb, Republic of Croatia</a>
            </li>
          </ul>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">
          <!-- Links -->
          <h5 class="footer-heading-2">CONTACT</h5>
          <ul class="list-unstyled  footer-address">
            <li>
            Tel: <a class="footer-link" href="tel:+38516430510" >+385 1 643 05 10</a>
            </li>
            <li>
              <a>Email : <a class="footer-link" href="mailto:info@imaves.com">info@imaves.hr</a> </a>
            </li>
        </div>
        <!-- Grid column -->
 
        <!-- Grid column -->
        <div class="col-md-3 mx-auto">
          <!-- Links -->
          <h5 class="footer-heading-2">TECHNICAL SUPPORT</h5>
          <ul class="list-unstyled  footer-address">
            <li>
              <a target="_blank" href="https://imaves.4me.com/" class="footer-link">Registered users</a>
            </li>
            <li>
              <a href="unregistered-en.php" class="footer-link">Non-registered users</a>
            </li>
          </ul>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 mx-auto">
          <!-- Links -->
          <h5 class="footer-heading-2">ABOUT IMAVES</h5>
          <ul class="list-unstyled footer-address">
            <li>
              <a href="general-information-en.php" class="footer-link">General information</a>
            </li>
            <li>
              <a href="profile-en.php" class="footer-link">Company profile</a>
            </li>
            <li>
              <a href="mission-en.php" class="footer-link">Mission</a>
            </li>
            <br>
            <li>
              <a href="quality-policy-en.php" class="footer-link">Quality policy</a>
            </li>
            <li>
              <a href="iso-en.php" class="footer-link">ISO certificate</a>
            </li>
            <li>
              <a href="codex-en.php" class="footer-link">Code of Ethics</a>
            </li>
            <li>
              <a href="privacy-policy-en.php" class="footer-link">Privacy policy</a>
            </li>
          </ul>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
  </footer>
  <!-- Footer -->
  <!-- Footer -->
  <footer class="page-footer" style="background-color: #F39200;">
    <!-- Footer Elements -->
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <div class="col-sm-0 col-lg-1"></div>
        <!--Grid column-->
        <div class="col-sm-4 col-lg-2 logo-wrapper">
          <!--Image-->
          <img src="assets/images/bmc-logo.png" alt="Responsive image">
        </div>
        <!--Grid column-->
        <div class="col-sm-0 col-lg-2"></div>
        <!--Grid column-->
        <div class="col-sm-4 col-lg-2  logo-wrapper">
          <!--Image-->
          <img src="assets/images/4me-logo.png" alt="Responsive image">
        </div>
        <!--Grid column-->
        <div class="col-sm-0 col-lg-2"></div>
        <!--Grid column-->
        <div class="col-sm-4 col-lg-2  logo-wrapper">
          <!--Image-->
          <img src="assets/images/PriceFx-logo.png" alt="Responsive image">
        </div>
        <!--Grid column-->
        <div class="col-sm-0 col-lg-1"></div>
      </div>
      <!--Grid row-->
    </div>
    <!-- Footer Elements -->
    <!-- Copyright -->
    <div class="footer-copyright"> © 2020 All rights reserved • IMAVES d.o.o.
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </div>
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
<script>

// below code line means when page loads on browser then run the following script
$(document).ready(function () {

    //select the POPUP DIV and show it
    $("#popup").hide().fadeIn(2000);

    //close the POPUP buuton  if the button with id="close" is clicked
    $("#close").on("click", function (e) {
        e.preventDefault();
        $("#popup").fadeOut(2000);
    });

});
</script>
<?php
include "components/closing.php";
?>