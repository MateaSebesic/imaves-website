<form id="form2" name ="" action="?" method="POST">


<h1 class = "unregistered-head">
UNREGISTERED USERS
</h1>
<h5 class="unregistered-par1">
Fields marked with an asterisk (<span style="color:orange;">*</span>) are required!
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

}


  
</style>

<div class="md-form form-group mt-5 form-padding">
  <label for="inputPlaceholderEx" class="unregistered-par2">First name<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="name" id="inputPlaceholderEx" class="form-control form-control-contact"  required />
  <label for="inputPlaceholderEx" class="unregistered-par2">Last name<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="surname" id="inputPlaceholderEx" class="form-control form-control-contact"  required />
  <label for="inputPlaceholderEx" class="unregistered-par2">Company</label>
  <input placeholder="" type="text" name="company" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">Mobile number</label>
  <input placeholder="" type="text" name="telephone" id="inputPlaceholderEx" class="form-control form-control-contact">
  <label for="inputPlaceholderEx" class="unregistered-par2">E-mail address<span style="color:orange;">*</span></label>
  <input placeholder="" type="text" name="email" id="inputPlaceholderEx" class="form-control form-control-contact"  required />
  <label for="inputPlaceholderEx" class="unregistered-par2">Question or comment<span style="color:orange;">*</span></label>
  <textarea placeholder="" rows="10" cols="50" type="text" name="message" id="inputPlaceholderEx" class="form-control form-control-contact-message " required /></textarea>
  <br>
  
  

  <input class=" registered-button registered-button-text btnr " type="submit" style = "border: none;"  value="SEND" placeholder="">
</div>


<script>
$('#form2 input[type=text]').on('change invalid', function() {
    var textfield = $(this).get(0);
    
    // 'setCustomValidity not only sets the message, but also marks
    // the field as invalid. In order to see whether the field really is
    // invalid, we have to remove the message first
    textfield.setCustomValidity('');
    
    if (!textfield.validity.valid) {
      textfield.setCustomValidity('This field is required!');  
    }
});

</script>






</form>


