<?php
include "components/header.php";
include "components/navigation.php";
?>


<div style="overflow: hidden;">
    <div class="row ">
        <div class="col-md-12  "><img class="header-img" style="width: inherit;"
                src="assets/images/background-job-top.png" alt="">
            <div class="centered most-used-head">PONUDA ZA POSAO</div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-3  col-lg-3 col-sm-0"></div>


        <div class="col-md-6 col-lg-6 col-sm-12 ">
            <div class="unregistered-form">
                <p class = "unregistered-head">
Trenutno nemamo otvorenu poziciju, ali ako se pronalazite u našem profilu firme, ispunite sljedeću formu prijave. Redovito ćemo pregledavati novopristigle prijave i kontaktirati kandidate s potencijalom za daljnji rast i razvoj unutar IMAVES-a!<br> <br>Veselimo se Vašoj prijavi!
</h1>


                <?php
                
                if(isset($_FILES["attachment"]["name"])){
                    if ($_FILES['attachment']['size'] > 10485760) {
                        echo '<h1 class="programming-head">Vaša prijava nije poslana.<br>Datoteka je prevelika.....</h1>';
                        die();
                    }
                        

    
                    $email = $_POST['email'];
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $telephone = $_POST['telephone'];
                    $message = $_POST['message'];
                    $link = $_POST['link'];
                    $fromemail =  $email;
                    $subject="Prijava za posao";
                    $email_message = '<h2>Prijava za posao</h2>
                    <p><b>Ime:</b> '.$name.'</p>
                    <p><b>Prezime:</b> '.$surname.'</p>
                    <p><b>Broj telefona:</b> '.$telephone.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Subject:</b> '.$subject.'</p>
                    <p><b>Link:</b> '.$link.'</p>
                    <p><b>Message:</b><br/>'.$message.'</p>';
                    $email_message.="CV je u prilogu";
                    $semi_rand = md5(uniqid(time()));
                    $headers = "Od: ".$fromemail;
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
                    $headers .= "\nMIME-Version: 1.0\n" .
                        "Content-Type: multipart/mixed;\n" .
                         " boundary=\"{$mime_boundary}\"";
                         if($_FILES["attachment"]["name"]!= ""){  
                             $strFilesName = $_FILES["attachment"]["name"];  
                             $strContent = chunk_split(base64_encode(file_get_contents($_FILES["attachment"]["tmp_name"])));  
                             $email_message .= "This is a multi-part message in MIME format.\n\n" .
                             "--{$mime_boundary}\n" .
                             "Content-Type:text/html; charset=\"iso-8859-1\"\n" ."Content-Transfer-Encoding: 7bit\n\n" .$email_message .= "\n\n";
                             $email_message .= "--{$mime_boundary}\n" .
                             "Content-Type: application/octet-stream;\n" .
                             " name=\"{$strFilesName}\"\n" .
                             //"Content-Disposition: attachment;\n" .
                             //" filename=\"{$fileatt_name}\"\n" .
                             "Content-Transfer-Encoding: base64\n\n" .
                             $strContent  .= "\n\n" .
                             "--{$mime_boundary}--\n";
                             
                         }$toemail="info@imaves.hr"; 
                         mail($toemail, $subject, $email_message, $headers);
                         echo '<h1 class="programming-head">Vaša prijava je poslana.<br>Kontaktirat ćemo Vas.....</h1>';}
                         else{
                             include "components/form-career.php";
                             
                         }
                         ?>
                
            </div>
        </div>
        <div class="col-md-3  col-lg-3 col-sm-0"></div>


    </div>

    <div class="row ">
        <div class="col-md-12  "><img style="width: inherit;" src="assets/images/background-job-bottom.png" alt="">
        </div>
    </div>

</div>
<style>
  #career{
    font-weight: bold;
    padding-top: 10px;
    border-bottom: 10px solid #F39200;
  }
</style>


<?php
include "components/footer.php";
?>