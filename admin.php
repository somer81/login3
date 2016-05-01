<?php include("includes/header.php") ?>

  
  <?php include("includes/menu.php") ?>



	<div class="jumbotron">
		<h1 class="text-center">

      <?php 
        //   unset($_SESSION['email']); 
     //  echo "Hoşgeldin "  . $_SESSION['email']  ;  ?>
    <?php 
     if(girisYaptimi()){

			echo "Hoşgeldin "  . $_SESSION['email']  ; 

		} else {
			yonlendir("giris.php");
		}
    
?>


		</h1>
	</div>

<?php include("includes/footer.php") ?>