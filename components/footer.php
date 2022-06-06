  <!-- Footer -->

  <!-- Footer -->
  <footer class="first-footer">
      <!-- Footer Links -->
      
          <!-- Grid row -->
          <div class="row" style=" padding-bottom: 2%;padding-left: 10%; padding-right: 10%">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-3 col-xl-3 ">
                  <!-- Links -->
                  <p class="footer-heading-1">IMAVES d.o.o. </p>
                  <ul class="list-unstyled footer-address">
                      <li>
                          <a>Adresa poslovnice:</a>
                      </li>
                      <li>
                          <a class="footer-link" href="https://goo.gl/maps/mXPw9o4rUGeq2w8T6" target="_blank">Ulica
                              Grada Vukovara 274 </a><br />
                      </li>
                      <li>
                          <a>10000 Zagreb, Republika Hrvatska</a>
                      </li>
                      <br>
                      <li>
                          <a>Adresa sjedišta:</a>
                      </li>
                      <li>
                          <a>Mihanovićeva ulica 20</a>
                      </li>
                      <li>
                          <a>10000 Zagreb, Republika Hrvatska</a>
                      </li>
                  </ul>
              </div>
              <!-- Grid column -->
              
              <!-- Grid column -->
              <div class="col-md-3 col-lg-3 col-xl-3">
                  <!-- Links -->
                  <h5 class="footer-heading-2">KONTAKT</h5>
                  <ul class="list-unstyled  footer-address">
                      <li>
                          Tel: <a class="footer-link" href="tel:+38516430510">+385 1 643 05 10</a>
                      </li>
                      <li>
                          <a>Email : <a class="footer-link" href="mailto:info@imaves.com">info@imaves.hr</a> </a>
                      </li>
              </div>
              <!-- Grid column -->
              
              <!-- Grid column -->
              <div class="col-md-3 col-lg-3 col-xl-3 ">
                  <!-- Links -->
                  <h5 class="footer-heading-2">TEHNIČKA PODRŠKA</h5>
                  <ul class="list-unstyled  footer-address">
                      <li>
                          <a target="_blank" href="https://imaves.4me.com/" class="footer-link">Registrirani korisnici</a>
                      </li>
                      <li>
                          <a href="unregistered.php" class="footer-link">Neregistrirani korisnici</a>
                      </li>
                  </ul>
              </div>
              <!-- Grid column -->
              
              <!-- Grid column -->
              <div class="col-md-3 col-lg-3 col-xl-3">
                  <!-- Links -->
                  <h5 class="footer-heading-2">O IMAVESU</h5>
                  <ul class="list-unstyled footer-address">
                      <li>
                          <a href="general-information.php" class="footer-link">Opće informacije</a>
                      </li>
                      <li>
                          <a href="profile.php" class="footer-link">Profil tvrtke</a>
                      </li>
                      <li>
                          <a href="mission.php" class="footer-link">Misija (djelatnost)</a>
                      </li>
                      <br>
                      <li>
                          <a href="quality-policy.php" class="footer-link">Politika kvalitete</a>
                      </li>
                      <li>
                          <a href="iso.php" class="footer-link">Certifikati</a>
                      </li>
                      <li>
                          <a href="codex.php" class="footer-link">Povelja Kodeks etike</a>
                      </li>
                      <li>
                          <a href="privacy-policy.php" class="footer-link">Politika privatnosti</a>
                      </li>
                      <li>
                          <a href="tender.php" class="footer-link">Natječaji</a>
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
          <!--Grid row-->
          <div class="row">
              <!--Grid column-->
              <div class="col-sm-4 col-lg-4  logo-wrapper">
                  <!--Image-->
                  <img src="assets/images/4me-logo-reg-white.webp" alt="Responsive image">
              </div>
              <div class="col-sm-4 col-lg-4 logo-wrapper">
                  <!--Image-->
                  <img src="assets/images/bmc-logo.png" alt="Responsive image">
              </div>
              <!--Grid column-->
              <div class="col-sm-4 col-lg-4  logo-wrapper">
                  <!--Image-->
                  <img src="assets/images/PriceFx-logo.png" alt="Responsive image">
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
