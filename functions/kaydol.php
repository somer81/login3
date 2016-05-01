<?php 
   include('../includes/ayar.php'); 

      $bag = new mysqli(SERVER,KU,SFR,VT);
     
      if($bag->connect_error)
        {
              die("Bağlantı Hatası : " . $bag->connect_error);
        }
    
        $bag->set_charset("utf8");

        $sql = "INSERT INTO uyeler(kadi,ad,soyad,sifre) VALUES(?,?,?,?)"; 

       

         
        $ad =  $bag->real_escape_string($_POST['ad']); 
        $soyad = $bag->real_escape_string($_POST['soyad']); 
        $kadi = $bag->real_escape_string($_POST['kadi']); 
        $sifre = md5($bag->real_escape_string($_POST['sifre'])); 

         $komut = $bag->prepare($sql); 
   
        $komut->bind_param("s",$kadi);
        $komut->bind_param("s",$ad);
        $komut->bind_param("s",$soyad);
        $komut->bind_param("s",$sifre);

        if($komut->execute())
        echo "Kayıt Eklendi"; 


      $bag->close(); 
  



?>