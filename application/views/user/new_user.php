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
					<h4 class="center">Novo usuário</h4>
					<div class="row">
					
						<div class="col m6 offset-m3" hidden="true" id="messagebox">
							<p class="center" id="msg"></p>
						</div>
						<br>
						
						<div class="col m10 offset-m1 s12 row">
								<div class="input-field col m7">
									<input type="text"  id="user_name">
									<label data-error="O nome não pode conter espaços"  data-success="right" for="user_name">Nome usuario</label>
								</div>
								<div class="input-field col m5">

									<select id="type">
									<?php foreach ($user_types as $type) {
											?>
											<option value="<?php echo $type['id_user_type'];?>"><?php echo trim($type['description_user_type']); ?></option>

											<?php
										} ?>
									</select>
									<label>Tipo de usuário</label>

								</div>
									
								<input type="button" value="CRIAR" id="submit" class="btn col m4 offset-m4">
							
						</div>
					</div>

				</div>
			</div>


		</main>
		<?php $this->load->view('partials/footer'); ?>
		<script src="<?php echo base_url('assets/js/ajax/create_user.js') ?>"></script>




	</body>
	</html>