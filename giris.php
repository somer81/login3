<?php include("includes/header.php"); ?>

 <?php if(girisYaptimi()) yonlendir('admin.php'); ?>
  
  <?php include("includes/menu.php") ?>
	

	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			
                       
             <?php mesajGoster(); ?>

             
           
			<?php uyeGirisDogrula(); ?>
		
								
		</div>
	</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="giris.php" class="active" id="login-form-link">Giriş</a>
							</div>
							<div class="col-xs-6">
								<a href="kayit.php" id="">Kayıt</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
									</div>
									<div class="form-group">
										<input type="password" name="sifre" id="login-
										sifre" tabindex="2" class="form-control" placeholder="Şifre" required>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="hatirla" id="hatirla">
										<label for="hatirla"> Beni Hatırla</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Giriş Yap">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover.php" tabindex="5" class="forgot-password">Şifremi Unuttum?</a>
												</div>
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
		
	<?php include("includes/footer.php"); ?>