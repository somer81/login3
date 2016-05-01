<?php 

		$bag = mysqli_connect("localhost","root","","login"); 

        mysqli_set_charset($bag,"utf8");
		
		function sorgula($sorgu){
		     global $bag; 
			 return mysqli_query($bag,$sorgu); 
		}

        function veriYakala($tablo)
        {
            return mysqli_fetch_assoc($tablo);
        }

        function koruma($metin)
        {
            global $bag;
            return mysqli_real_escape_string($bag,$metin);
        }

       function kayitSayisi($tablo)
       {
             return mysqli_num_rows($tablo);            
       }

       function dogrula($sonuc)
       {
           global $bag;
           if(!$sonuc)
           {
               die("Sorgu Çalıştırlamadı" . mysqli_error($bag)); 
           }
       }

       function kontrol()
       {
           global $bag; 
               if(!$bag) 
                    {
               die("Veritabanı Bağlantı Hatası :" . mysqli_connect_error());
                   exit();
                   }
       }

?>