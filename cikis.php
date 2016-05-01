<?php
include("includes/header.php"); 

// session_destroy();
 unset($_SESSION['email']); 
   
 mesaj(hataMesaj("Oturumunuz Sonlandırıldı"));
 yonlendir("giris.php");

?>


<?php 
 include("includes/footer.php"); 
?>