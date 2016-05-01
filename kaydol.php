
       <?php  include("includes/header.php"); ?>
	
   <?php  include("includes/menu.php"); ?>
 
     <?php   
include('includes/ayar.php'); 

      $bag = new mysqli(SERVER,KU,SFR,VT); // bğağlantı nesnesi oluşturulur aynı zamanda bağlantı açılır
     
      if($bag->connect_error)
        {
              die("Bağlantı Hatası : " . $bag->connect_error); // Bağlantı Hatası varsa PHP scriptinin dışına atar sonlanır
        }
    
        $bag->set_charset("utf8");  // Karakter kodlamasını UTF-8 mysql 

        $sql = "INSERT INTO uyeler(kadi,ad,soyad,sifre) VALUES(?,?,?,?)"; 
// Sorgu oluşturulur - Parametre dışarıdan alacak , ? 
          
         $komut = $bag->prepare($sql); // Komut çalıştırılmaya hazırlanır
       
         $komut->bind_param("ssss",$kadi,$ad,$soyad,$sifre); 
// Hangi parametreleri alacağı bildirilir 
         
//      $ad = koruma($_POST['ad']);  Veri güvenliğini sağlanır 
        $ad =  $bag->real_escape_string($_POST['ad']); 
        $soyad = $bag->real_escape_string($_POST['soyad']); 
        $kadi = $bag->real_escape_string($_POST['kadi']); 
        $sifre = md5($bag->real_escape_string($_POST['sifre'])); 


        if($komut->execute())  // komut çalıştırılır 
        echo "Kayıt Eklendi"; 
        else
            echo "Kayıt ekleme başarısız"; 


      $bag->close(); 
  



?>
   <?php  include("includes/footer.php"); ?>
	
   ?>