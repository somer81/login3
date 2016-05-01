        if($_SERVER["REQUEST_METHOD"] === "GET")
        {
            if(isset($_GET['kod']) && isset($_GET['email']))
            {
                $kod = koruma(temizle($_GET['kod'])); 
                $email = koruma(temizle($_GET['email'])); 
                
                $sql = "SELECT uid FROM uyeler WHERE email = '$email' AND onay_kodu='"  .
                    "$kod'"; 
                $sonuc = sorgula($sql);
                dogrula($sonuc); 
                
                if(kayitSayisi($sonuc) == 1) 
                {
                    $sql2 = "UPDATE uyeler SET aktif= 1 , onay_kodu= '0' WHERE email = '$email' AND onay_kodu='$kod'"; 
                    
                $sonuc2 = sorgula($sql2);
                dogrula($sonuc2);  
                    
                    $msg = "<div class='bg-success'>Hesabınız Aktifleştirildi Üye Girişi Yapınız </div>";
                    
                   // $_SESSION['msg'] = $msg;
                    mesaj($msg); 
                    
                    yonlendir("giris.php");
                    
                }
                else
                {
                    $msg = "<div class='bg-danger text-center lead'> Aktivasyon Gerçekleşmedi </div>";
                      mesaj($msg); 
                    yonlendir("kayit.php");
                }
                    
                
            }
            
            
        }