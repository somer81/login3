
   <?php  include("includes/header.php"); ?>
	
   <?php  include("includes/menu.php"); ?>
	
    <div class="jumbotron">
  <h1>Üyelik </h1>
  <p>Sitemize ÜyeOlup Fırsatlardan Yararlanın </p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Dahası...</a></p>
    </div>
   
   
  <div class="row">
     <div class="col-md-6 col-md-offset-3">
	<?php 
	   
    mesajGoster(); 

    $sonuc =  sorgula("Select * from uyeler"); 
 	 
     echo "<h2> Toplam " . kayitSayisi($sonuc) . " kayıt bulundu </h2><br>";
    ?>
    <table class='table'>   
   <?php  $i = 0 ; 
     if($sonuc)
	 {
	   while($satir = veriYakala($sonuc))
	    {
		   echo  ($i % 2 == 0 ) ? "<tr class='success'>" : "<tr class='danger'>";
           $i++;
           echo  "<td>" . $satir['ad'] .  "</td><td>" . 
                  $satir['soyad'] . "</td><td>" . $satir['kadi'] ;
            echo "</td></tr>"; 
           
 		}
	 }
        ?>
    </table>
 
    </div>
</div>
	
	<?php  include("includes/footer.php"); ?>
    