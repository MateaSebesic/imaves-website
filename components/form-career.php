<form name ="" action="?" method="POST" enctype="multipart/form-data">

<br>
<h1 class = "unregistered-head2">
 PRIJAVA ZA POSAO
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
  
  .unregistered-head2{
    text-align: left;
    font-size: Bold 40px;
    letter-spacing: 0px;
    color: #F39200;
    padding-top: 5%;
    padding-left:4%;
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
    padding-top: 4%;
    padding-bottom: 4%;
    padding-left: 4%;
    padding-right: 4%;

  }
  .btnr:focus {
      outline: none;
      
  }
  .btnr:active {
      outline: none;
      
  }
  .btnr{
      outline: none;
      
  }
  
</style>
<div class="md-form form-group mt-5 form-padding">
  <label for="inputPlaceholderEx" class="unregistered-par2">Za poziciju<span style="color:orange;">*</span></label>
  <select id="inputPlaceholderEx" class="form-control form-control-contact"  name="pozicija" required>
    <option value="" selected disabled>Odaberite poziciju...</option>
    <option value="Developer">Developer (m/ž)</option>
    <option value="Configuration engineer za Pricefx">Configuration engineer za Pricefx (m/ž)</option>
    <option value="Stručni suradnik za 4me">Stručni suradnik za 4me (m/ž)</option>
    <option value="Stručni suradnik za BMC Software">Stručni suradnik za BMC Software (m/ž)</option>
    <option value="Informatičar">Informatičar (m/ž)</option>
    <option value="Project manager za pricefx (m/ž)">Project manager za pricefx (m/ž)</option>
    <option value="Stručni suradnik za Datalab Pantheon (m/ž)">Stručni suradnik za Datalab Pantheon (m/ž)</option>
  </select> 
  <label for="inputPlaceholderEx" class="unregistered-par2">Ime<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="name" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Prezime<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="surname" id="inputPlaceholderEx" class="form-control form-control-contact"required>
  <label for="inputPlaceholderEx" class="unregistered-par2">E-mail adresa<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="email" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Telefon</label>
  <input placeholder="" type="tel" name="telephone" pattern="[+][0-9]{3}-[0-9]{2}-[0-9]{3}"" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">Poruka<span style="color:orange;">*</span></label>
  <textarea placeholder="" rows="10" cols="50" type="text" name="message" id="inputPlaceholderEx" class="form-control form-control-contact-message " required></textarea>
  <label for="inputPlaceholderEx" class="unregistered-par2">Životopis - link ili datoteka (maksimalne veličine 10 MB) </label>
  <input placeholder="" type="text" name="link" id="inputPlaceholderEx" class="form-control form-control-contact">
  <br>
  <!--<input type="file" name="attachment"  id="myFile" placeholder=""><br>-->
  <label class=" registered-button registered-button-text btnr" style= "width :250px;background-color : #C7A694;">
      <i class="fa fa-image "></i>Učitaj datoteku<input type="file" style="display: none;" name="attachment">
</label>
  <br>
  
  


  
  <input class=" registered-button registered-button-text btnr " type="submit" style = "border: none; "name="button" value="Pošalji prijavu za posao" placeholder="">
</div>







</form>