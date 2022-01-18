<form name ="" action="?" method="POST"  enctype="multipart/form-data"  id="form2" >

<br>
<h1 class = "unregistered-head2">
JOB APPLICATION
</h1>


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
  .unregistered-par2:active{
      outline: none;
  }
  .unregistered-par2:hover{
      outline: none;
  }
  .unregistered-par2:focus{
      outline: none;
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

  
</style>
<div class="md-form form-group mt-5 form-padding">
  <label for="inputPlaceholderEx" class="unregistered-par2">First name<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="name" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Last name<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="surname" id="inputPlaceholderEx" class="form-control form-control-contact"required>
  <label for="inputPlaceholderEx" class="unregistered-par2">E-mail address<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="email" id="inputPlaceholderEx" class="form-control form-control-contact" required>
  <label for="inputPlaceholderEx" class="unregistered-par2">Telephone</label>
  <input placeholder="" type="text" name="telephone" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">Message<span style="color:orange;">*</span></label>
  <textarea placeholder="" rows="10" cols="50" type="text" name="message" id="inputPlaceholderEx" class="form-control form-control-contact-message " required></textarea>
  <label for="inputPlaceholderEx" class="unregistered-par2">CV -  file (max size 10 MB) </label>
  <!--<input type="file" name="attachment"  id="myFile" value="Select file" placeholder=""><br>-->
   <label class=" registered-button registered-button-text btnr" style= "width :250px;background-color : #C7A694;">
      <i class="fa fa-image "></i>Upload file<input type="file" style="display: none;" name="attachment">
</label>
  <br>
  
  

  
  <input class=" registered-button registered-button-text btnr " type="submit" style = "border: none; "name="button" value="Send your application" placeholder="">
</div>






</form>