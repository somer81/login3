$hatalar = [];

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$email 		= temizle($_POST['email']);
		$sifre	    = temizle($_POST['sifre']);
		$hatirla    = isset($_POST['hatirla']);

		if(empty($email)) 
            $hatalar[] = "Email allanı Boş Geçilemez! ";
        
        if(empty($sifre)) 
			$hatalar[] = "Şifre boş geçilemez";

           if(!empty($hatalar)) 
           {
               foreach ($hatalar as $hata) 
               {
                  echo hataMesaj($hata);
               }
           }
           else {
                    if(uyeGiris($email, $sifre, $hatirla)) 
                        yonlendir("admin.php");
                    else 
                        echo hataMesaj("Bilgileriniz doğru değil !");		       
	           }
    } 