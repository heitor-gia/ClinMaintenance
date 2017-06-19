<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<meta name="theme-color" content="#64B5F6" />
	<title>Clinica Odontológica</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
	<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/materialize.min.js');?>"></script>
</head>
<body>
	<?php $this->load->view('partials/header'); ?>
	<main>
		
		<div class="row">
			<div class="col m6 offset-m3 z-depth-1 s10 offset-s1 box">
				
				<h1 class="center">Login</h1>

				<div class="row">
						<div class="col m6 offset-m3 error" hidden="true" id="messagebox">
							<p class="center" id="msg"></p>
						</div>
						<div class="col m8 offset-m2 s12">
							<div class="input-field">
								<label for="user_name">Usuário</label>
								<input type="text" id="user_name">
							</div>
							<div class="input-field">
								<label for="password">Senha</label>
								<input type="password"  id="password">
							</div>
							<br>
							<input type="button" id="submit" value="ENTRAR" class="btn center">
						</div>
					</div>


				</div>
			</div>





		</main>
		<?php $this->load->view('partials/footer'); ?>
		
		<script src="<?php echo base_url('assets/js/ajax/login.js') ?>"></script>

	</body>
	</html>