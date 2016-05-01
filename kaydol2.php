<?php
   include("includes/header.php");
  include("includes/menu.php"); 
   ?>
   <div class="jumbotron">
  <h1>Üyelik </h1>
  <p>Sitemize ÜyeOlup Fırsatlardan Yararlanın </p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Dahası...</a></p>
</div>
   
   <?php


     @$ad =     koruma($_POST['ad']); 
        @$soyad = koruma($_POST['soyad']); 
        @$kadi =  koruma($_POST['kadi']); 
        @$sifre = md5(koruma($_POST['sifre'])); 


$sql = "INSERT INTO uyeler(ad,soyad,kadi,sifre) VALUES('" . $ad . "', '" . $soyad . "','" . 
        $kadi . "','" . $sifre . "')"; 

      if(sorgula($sql))
      {
          echo "Kayıt Eklendi";
      }
    else 
    {
         die("Sorgu Çalıştırılamadı"); 
    }


   mysqli_close($bag);


 include("includes/footer.php"); 


?>