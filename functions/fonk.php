<?php 
    
	function bagKont()
	{
	   global $bag;  
	    if(!$bag)
		echo "Bağlantı Sağlanılamadı"; 
	}
  
   function temizle($metin)
   {
       return htmlentities($metin); 
   }


  function mesaj($msg)
  {
      if(!empty($msg))
      {
          $_SESSION['msg'] = $msg;     
      }
      else 
          $msg = ""; 
  }

    function mesajGoster()
    {
       if(isset($_SESSION['msg']))
       {
           echo $_SESSION['msg'];
           unset($_SESSION['msg']); 
       }
           
    }

    function yonlendir($url)
    {
        header("Location:{$url}"); 
    }


/*********************Form bilgilerini Kontrol Et*********************/ 

function hataMesaj($hata) {

 return <<<OMR

<div class="alert alert-danger alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong>DİKKAT!</strong> $hata
 </div>
OMR;
}   

function tokenUret(){
$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));
return $token;
}



function formKontrol()
   {
       if($_SERVER["REQUEST_METHOD"] === "POST") // IE da da sorun çıkmaması için  
        {
          global $bag ; 
           $min = 3 ; 
           $max = 50;
           $hatalar = [] ; 
           
           $ad = temizle($_POST['ad']);
           $soyad = temizle($_POST['soyad']);
           $kadi = temizle($_POST['kadi']);
           $email = temizle($_POST['email']);
           $sifre = temizle($_POST['sifre']);
           $sifret = temizle($_POST['sifret']);
           
            if(strlen($ad) < $min)
            $hatalar[] = "İsim alanı {$min} karakterden az olamaz";
            if(strlen($ad) > $max)
            $hatalar[] = "İsim alanı {$max} karakterden çok olamaz";
           if(strlen($soyad) < $min)
            $hatalar[] = "Soyad alanı {$min} karakterden az olamaz";
            if(strlen($soyad) > $max)
            $hatalar[] = "Soyad alanı {$max} karakterden çok olamaz";
           if(strlen($kadi) < $min)
            $hatalar[] = "Kullanıcı adı alanı {$min} karakterden az olamaz";
            if(strlen($kadi) > $max)
            $hatalar[] = "Kullanıcı alanı {$max} karakterden çok olamaz";
           if(strlen($sifre) < $min)
            $hatalar[] = "Şifre alanı {$min} karakterden az olamaz";
            if(strlen($sifre) > $max)
            $hatalar[] = "Şifre alanı {$max} karakterden çok olamaz";
           
            if(emailVarmi($email))
                $hatalar[] = "Bu eposta adresi zaten kullanımda";
           if(kadiVarmi($kadi))
                $hatalar[] = "Bu kullanıcı adı zaten kullanımda";
           if($sifre !== $sifret)
                $hatalar[] = "Şifreler birbiriyle eşleşmiyor!!";
            
           if(!empty($hatalar))
           {
               foreach($hatalar as $hata)
                   echo hataMesaj($hata); 
           }
           else
           {
             
               $onay = md5($kadi + microtime());
               
               if(uyeEkle($kadi,$ad,$soyad,$email,$onay,$sifre))
                 {
                   $konu = "Aktivasyon Emaili";
                   $msj = "Üyeliğinizi aktifleştirmek için aşağıdaki linki tıklayınız 
                   http://www.omersevinc.net/onay.php?kod=$onay&email=$email";
                   $baslik = "From:yanitlama@omersevinc.net"; 
                   
                   if(mailGonder($email,$konu,$msj,$baslik))
                       $msg = "Mail adresine bilgi gönderildi";
                   else 
                       $msg = "Mail Gönderilemedi";
                   
                   $msg .= '<div class="alert alert-success alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong>Bilgi : </strong>' .  $bag->affected_rows . 'adet Kayıt Başarıyla Eklendi </div>';

                   mesaj($msg);   
                   yonlendir("index.php"); 
                 }
               
           }
       }
       
        }
   

  
  function emailVarmi($email)
  {
     $email = koruma($email); 
      $sql = "SELECT * FROM uyeler WHERE email ='$email'"; 
      $sonuc = sorgula($sql); 
      if(kayitSayisi($sonuc) != 0)
          return true; 
      else 
          return false;
  }
  function kadiVarmi($kadi)
  {
       $kadi = koruma($kadi);  
       $sql = "SELECT * FROM uyeler WHERE kadi = '$kadi'";
       $sonuc = sorgula($sql);
       if(kayitSayisi($sonuc) != 0)
       {
           return true;
       }
      else 
          return false;           
  }

  function mailGonder($email,$konu,$msj,$baslik)
  {
     return mail($email,$konu,$msj,$baslik);
  }



 /**************** Kayıt Ekleme *******************************/

   function uyeEkle($kadi,$ad,$soyad,$email,$onay,$sifre)
   {
        
       global $bag;   // Dışarıda tanımlanan $bag değişkenini kullanmak için 
       
       // if(isset($_POST['btnkayit']))
       if($_SERVER["REQUEST_METHOD"] == "POST") // IE da da sorun çıkmaması için  
        {
       $sql = "INSERT INTO uyeler(kadi,ad,soyad,email,onay_kodu,sifre) VALUES(?,?,?,?,?,?)"; 
             
        $ad =  koruma($ad); 
        $soyad = koruma($soyad); 
        $kadi = koruma($kadi);
        $email = koruma($email);
        $sifre = md5($sifre);  

         $komut = $bag->prepare($sql); 
   
       $komut->bind_param("ssssss",$kadi,$ad,$soyad,$email,$onay,$sifre);   // Dışarıdan girilen değerleri soru içindeki ? ile gösterilen parametrelere değer olarak atar 
           
        if($komut->execute())  //  komutu çalıştırır
            
            return true; 
           
            }
 }

 
/************************ Kullanıcıyı Aktifleştir ***********************************/
function kAktif() {
    
        if($_SERVER['REQUEST_METHOD'] === "GET")
        {
            
            if(isset($_GET['kod']) && isset($_GET['email']))
            {
                
                $kod = koruma(temizle($_GET['kod'])) ; 
                $email = koruma(temizle($_GET['email'])) ; 
                
                $sql = "SELECT uid FROM uyeler WHERE email='$email' AND onay_kodu='$kod'";
                $sonuc = sorgula($sql); 
                dogrula($sonuc); 
                
                if(kayitSayisi($sonuc) == 1)
                {
                    $sql2 = "UPDATE uyeler set aktif=1, onay_kodu='0' WHERE email='$email' AND onay_kodu='$kod'" ;
                    $sonuc2 = sorgula($sql2); 
                    dogrula($sonuc2); 
                    
                    $msj = "<div class='bg-success lead text-center'> Hesabınız aktifleştirildi
                    </div>"; 
                    
                    mesaj($msj); 
                    
                    yonlendir("giris.php"); 
                }
                else 
                {
                   $msj =  "<div class='bg-danger lead text-center'> Üzgünüz bilgileriniz kontrol ediniz! </div>";
                    
                     mesaj($msj); 
                    yonlendir("kayit.php"); 
                }
                    
            }
            
        }

}

/****************Üye Girişini Doğrula ********************/

function uyeGirisDogrula(){
    
       $hatalar = [] ; 
        $min = 3 ;  
        $max = 50 ; 
    
       if($_SERVER['REQUEST_METHOD'] == "POST")
       {
           $email = temizle($_POST['email']); 
           $sifre = temizle($_POST['sifre']);
           $hatirla = isset($_POST['hatirla']); 
           
         /*    if(empty($email))
                $hatalar = "Email Alanı Boş Geçilemez!"; 
            if(empty($sifre))
                $hatalar = "Şifre Boş Geçilemez";  */ 
           
           if(strlen($sifre) < $min)
            $hatalar[] = "Şifre alanı {$min} karakterden az olamaz";
            if(strlen($sifre) > $max)
            $hatalar[] = "Şifre alanı {$max} karakterden çok olamaz";
           if(strlen($email) < $min)
            $hatalar[] = "Email alanı {$min} karakterden az olamaz";
            if(strlen($email) > $max)
            $hatalar[] = "Email alanı {$max} karakterden çok olamaz";

                
                if(!empty($hatalar)) 
                {
                     foreach($hatalar as $hata)
                        {
                        echo hataMesaj($hata);
                        }
                }
                else 
                {
                    
                if(uyeGiris($email,$sifre,$hatirla))
                    yonlendir("admin.php"); 
                else 
                {
                     mesaj(hataMesaj("Hatalı bilgileri girdiniz Üyelik Kaydınız Olmayabilir veya Yanlış Bilgi Girmiş Olabilirsiniz!")); 
                    
                     yonlendir("giris.php"); 
                }
                        
                }
                
           
       }
	
}  // fonksiyon 

/***************** LOGIN ********************************************/
   
function uyeGiris($email, $sifre, $hatirla) {
        //   mysqli_real_escape_string()
    
    $sql = "SELECT sifre,uid FROM uyeler WHERE email = '" . koruma($email) . "' AND aktif = 1" ;
    
    $sonuc = sorgula($sql); 
    dogrula($sonuc); 
    
    if(kayitSayisi($sonuc) == 1) 
    {
        $satir = veriYakala($sonuc); 
        $vt_sifre = $satir['sifre']; 
        if(md5($sifre) === $vt_sifre)
        {
            if($hatirla == "on")
               setcookie('email',$email, time() + 24 * 60 * 60) ;    
               $_SESSION['email'] = $email; 
                return true; 
        }
        else 
        {
            return false;
        }
    }
    else 
    {
        return false;
    }    
	
} // fonksiyon sonu 

function girisYaptimi(){
      if(isset($_SESSION['email']))
          return true; 
      else if(isset($_COOKIE['email']))
         { 
             $_SESSION['email'] = $_COOKIE['email']; 
             return true;
         }
    else 
        {
            return false;
	   }   
}

/******************** Şifre Hatırlatma ********************************/

  function sifreYenile() {

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = temizle($_POST['email']);


			if(emailVarmi($email)) {
                
			$onaykodu = md5($email + microtime());
			setcookie('gecici_erisim_kodu', $onaykodu, time()+ 15 * 60);
                
			$sql = "UPDATE uyeler SET onay_kodu = '".koruma($onaykodu)."' WHERE email = '".koruma($email)."'";
                
			$sonuc = sorgula($sql);
            dogrula($sonuc); 

			$konu = "Şifrenizi Yenileyin! ";
			$emailmsj =  " Şifre Yenileme Kodunuz {$onaykodu}

			Şifrenizi Yenilemek İçin Tıklayınız http://omersevinc.net/kod.php?email=$email&code=$onaykodu";

			$baslik = "From: cevaplama@omersevinc.net";

			mailGonder($email, $konu, $emailmsj, $baslik);

			mesaj("<p class='bg-success text-center'>Lütfen Eposta Kutunuzu veya Spam Klasörünüzü Kontrol Edin</p>");

			yonlendir("index.php");


			} else {
				echo hataMesaj("Bu email adresi sitemimize kayıtlı değil!!");
			}

		} else {
			yonlendir("index.php");
               }
// token kontrol 
		
        if(isset($_POST['cancel_submit'])) {
	        mesaj("<p class='bg-danger text-center'>Şifre Resetleme İptal Edildi</p>");
            yonlendir("giris.php");
		}

	} // post requestinin sonu 

} // fonksiyon sonu 



/**************** Kodu Doğrulama ********************/


function kodDogrula() {

    if(isset($_COOKIE['gecici_erisim_kodu'])) {

			if(!isset($_GET['email']) && !isset($_GET['code'])) {
				
                yonlendir("index.php");
			} 
            else if (empty($_GET['email']) || empty($_GET['code'])) {

				yonlendir("index.php");
			
            } 
        else {
				if(isset($_POST['code'])) {

					$email = temizle($_GET['email']);

					$onay_kodu = temizle($_POST['code']);

					$sql = "SELECT uid FROM uyeler WHERE onay_kodu = '".koruma($onay_kodu)."' AND email = '".koruma($email)."'";
					
                    $sonuc = sorgula($sql);

					if(kayitSayisi($sonuc) == 1) {

						setcookie('gecici_erisim_kodu', $onay_kodu, time()+ 15*60);

						yonlendir("reset.php?email=$email&code=$onay_kodu");


					} else {
						echo hataMesaj("Üzgünüz Hatalı Onay Kodu!!");

					}
				}
			}
        
	} else {

		mesaj("<p class='bg-danger text-center'> Üzgünüz Şifre Resetleme Süreniz Doldu Tekrar Yenileme İşlemi Başlatınız</p>");

		yonlendir("sifreyenile.php");
	}







}



/**************** Password Reset Function ********************/


function sifreReset() {

	if(isset($_COOKIE['gecici_erisim_kodu'])) {
        
		if(isset($_GET['email']) && isset($_GET['code'])) {

			if(isset($_SESSION['token']) && isset($_POST['token'])) {

				if($_POST['token'] === $_SESSION['token']) {

					if($_POST['password']=== $_POST['confirm_password'])  { 

						$yenisifre = md5($_POST['password']);

						$sql = "UPDATE uyeler SET sifre = '".koruma($yenisifre)."', validation_code = 0 WHERE email = '".koruma($_GET['email'])."'";
						
                        sorgula($sql);

						mesaj("<p class='bg-success text-center'>Şifreniz Başarıyla Güncellendi Tekrar Giriş Yapabilirsiniz</p>");
                        
						yonlendir("giris.php");
						
						} else {

							echo hataMesaj("Şifreleriniz Eşleşmiyor");
						}
				  }
			} 
		} 

	}else {

		mesaj("<p class='bg-danger text-center'>Sorry your time has expired</p>");

		yonlendir("sifreyenile.php");
		}
}


?>