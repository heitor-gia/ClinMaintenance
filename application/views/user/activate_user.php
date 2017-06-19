<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clinica Odontológica</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">


<body>
	<?php $this->load->view('partials/header'); ?>
	<main>
		
		<div class="row">
			<div class="col m6 offset-m3 z-depth-1 s10 offset-s1 box">
				<h1 class="center">Ativar usuário</h1>
				<div class="row">
						<div class="col m6 offset-m3 error" hidden="true" id="messagebox">
							<p id="msg" class="center"></p>
						</div>
					<div class="col m8 offset-m2 s12">

							<div class="input-field">
								<label for="newpswd">Nova senha</label>
								<input type="password" readonly onfocus="this.removeAttribute('readonly');" name="newpswd" id="newpswd">
							</div>
							<div class="input-field">
								<label for="confpswd">Confirme a nova senha</label>
								<input type="password" name="confpswd" id="confpswd">
							</div>
							<br>
							<input type="submit" id="submit" value="CONFIRMAR" class="btn">
						
					</div>
				</div>
				
			</div>
		</div>
		
		
	</main>
	<?php $this->load->view('partials/footer'); ?>

	
	<script type="text/javascript" src="<?php echo base_url('assets/js/ajax/activate_user.js'); ?>"></script>


</body>
</html>