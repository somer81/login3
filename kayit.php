<?php  include("includes/header.php"); ?>
<?php  include("includes/menu.php"); ?>


   
  <div class="row">
		<div class="col-lg-6 col-lg-offset-3">
               
               <?php 
          //  print_r($_SESSION);  
           
        //    echo $_SESSION['msg'];
            
             mesajGoster(); 
         
            formKontrol(); 
                
            ?>
								
		</div>



	</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="giris.php">Giriş</a>
							</div>
							<div class="col-xs-6">
								<a href="kayit.php" class="active" id="">Kayıt Ol</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								
                                    <form id="register-form" method="post" role="form" action="">

									<div class="form-group">
										<input type="text" name="kadi" id="kadi" tabindex="1" class="form-control" placeholder="Kullanıcı Adı" value="" required >
									</div>
									<div class="form-group">
										<input type="text" name="ad" id="ad" tabindex="2" class="form-control" placeholder="İsminiz" value="" required >
									</div>
									<div class="form-group">
										<input type="text" name="soyad" id="soyad" tabindex="3" class="form-control" placeholder="Soyadınız" value="" required >
									</div>
									<div class="form-group">
										<input type="text" name="email" id="email" tabindex="4" class="form-control" placeholder="Eposta Adresiniz" value="" required >
									</div>
									<div class="form-group">
										<input type="password" name="sifre" id="sifre" tabindex="5" class="form-control" placeholder="Şifreniz" value="" required >
									</div>
									<div class="form-group">
										<input type="password" name="sifret" id="sifret" tabindex="6" class="form-control" placeholder="Şifreniz tekrar..." value="" required >
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btnkayit" id="btnkayit" tabindex="7" class="form-control btn btn-register" value="Kaydol">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

<?php  include("includes/footer.php"); ?>