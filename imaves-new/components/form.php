<form name ="" action="?" method="POST">


<h1 class = "unregistered-head">
  NEREGISTRIRANI KORISNICI
</h1>
<h5 class="unregistered-par1">
Polja označena zvjezdicom (<span style="color:orange;">*</span>) obavezno je ispuniti!
</h5>

<style>
  .form-control-contact{
    border-top:none; border-left:none;  border-right:none;   border-bottom:1px solid #F39200; border-radius:0;
  }
  .form-control-contact-message{
    border-top:1px solid #F39200; border-left:1px solid #F39200;  border-right:1px solid #F39200;   border-bottom:1px solid #F39200; border-radius:0;
  }
  .unregistered-head{
    text-align: left;
    font: Bold 40px/53px Dosis;
    letter-spacing: 0px;
    padding-top: 5%;
    padding-left:4%;
    color: #F39200;
    text-transform: uppercase;
    opacity: 1;

  }
  .unregistered-par1{
    text-align: left;
    padding-left:4%;
    font: Regular 18px/30px Dosis;
    letter-spacing: 0px;
    color: #000000;
    
  }
  .unregistered-par2{
    text-align: left;
    font: Light 26px/40px Dosis;
    letter-spacing: 0px;
    color: #707070;
    opacity: 1;
    padding-top: 4%;
    

  }
  .form-padding{
    padding-top: 2%;
    padding-bottom: 4%;
    padding-left: 4%;
    padding-right: 4%;

  }
  .btnr:focus {
      outline: none;
      }


  
</style>
<div class="md-form form-group mt-5 form-padding">
  <label for="inputPlaceholderEx" class="unregistered-par2">Ime<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="name" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Prezime<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="surname" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Tvrtka</label>
  <input placeholder="" type="text" name="company" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">Telefon</label>
  <input placeholder="" type="text" name="telephone" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">E-mail adresa<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="email" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Pitanje ili komentar<span style="color:orange;">*</span></label>
  <textarea placeholder="" rows="10" cols="50" type="text" name="message" id="inputPlaceholderEx" class="form-control form-control-contact-message "required ></textarea>
  <br>
  
  

  <input class=" registered-button registered-button-text btnr " type="submit" style = "border: none;"  value="Pošalji" placeholder="">
</div>






</form>


