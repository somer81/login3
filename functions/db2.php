<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
    <?php 

 define("SERVER","localhost");
     define("KU","root");
     define("SFR","");
     define("VT","login");

// include('../includes/ayar.php');

     //$bag = new mysqli($sun,$kadi,$sifre,$vt); 
     $bag = new mysqli(SERVER,KU,SFR,VT);
     
      if($bag->connect_error)
        {
              die("Bağlantı Hatası : " . $bag->connect_error);
        }
    
    $bag->set_charset("utf8");

     $sonuc = $bag->query("SELECT * from uyeler");
   
     echo "Kayıt Sayısı :" . $sonuc->num_rows  . "<br>"; 

       $kayit = $sonuc->fetch_assoc();

            print_r($kayit);

      $bag->close();
 
?>