<?php

include "components/header.php";
include "components/navigation.php";
?>


<div style="overflow: hidden;">
	<div class="row ">
		<div class="col-md-0  col-lg-4 col-xl-4 col-sm-0 col-0 d-none d-lg-block"><img class = "header-img" style="width: inherit;" src="assets/images/background-unregistered.png" alt="">
			<div class="centered unreg-head">TEHNIČKA PODRŠKA</div>

		</div>
		<div class="col-md-1 col-lg-1 col-sm-1 col-1">

		</div>
		<div class="col-md-10 col-lg-5 col-sm-10 col-12 col-10">
			<div class= "unregistered-form">


				<?php

				if ($_POST) {
					$name = $_POST['name'];
					$surname = $_POST['surname'];
					$email = $_POST['email'];
					$company = $_POST['company'];
					$telephone = $_POST['telephone'];
					$msg = $_POST['message'];

					mail("info@imaves.hr","Kontakt od ".$name .$surname .$email .$company .$telephone, $msg);

					echo '<h1 class="programming-head">Poruka je poslana. <br>Kontaktirat ćemo Vas.....</h1>';
				} else {
					include "components/form.php";
				}
				?>
			</div>
		</div>
		<div class="col-md-1 col-lg-2 col-sm-1 col-1">

		</div>
	</div>
</div>









<?php
include "components/footer.php";
?>