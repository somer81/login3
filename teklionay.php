<?php 
    $bag  =mysqli_connect("localhost","root","","login") ; 
    // $bag  =mysqli_connect("localhost","kullanıcı adı","şifre","veritbanı adı") ;         
      if(!$bag)
        {
          die("Veri Tabanına bağlanılamıyor!" . mysqli_error());
        }
  
    if($_SERVER['REQUEST_METHOD'] === "GET")
        {
            if(isset($_GET['kod']) && isset($_GET['email']))
            {
                $kod = mysqli_real_escape_string($bag,htmlentities($_GET['kod'])) ; 
                $email = mysqli_real_escape_string($bag,htmlentities($_GET['email'])) ; 
                
                $sql = "SELECT uid FROM uyeler WHERE email='$email' AND onay_kodu='$kod'";
                $sonuc = mysqli_query($bag,$sql); 
                 if(!$sonuc)
                  {
                    die("Sorgu çalıştırılamadı !" . mysqli_error($bag));  
                  }
                if(mysqli_num_rows($sonuc) == 1)
                {
                    $sql2 = "UPDATE uyeler set aktif=1, onay_kodu='0' WHERE email='$email' AND onay_kodu='$kod'" ;
                    $sonuc2 = mysqli_query($bag,$sql2); 
                     
                    if(!$sonuc2)
                     {
                       die("Sorgu çalıştırılamadı !" . mysqli_error($bag));  
                     }
                    echo "<div class='bg-success lead text-center'> Hesabınız aktifleştirildi
                    </div>"; 
                    mysqli_close($bag);  
                }
                else 
                {
                   $msg =  "<div class='bg-danger lead text-center'> Üzgünüz bilgileriniz kontrol ediniz! </div>";
                     $_SESSION['msg'] = $msj; 
                     mysqli_close($bag);
                     header("Location: kayit.php"); 
                }
                    
            }
            
        }

  



?>