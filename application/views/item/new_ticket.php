<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica - Chamados</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">


</head>
<body>
	<?php $this->load->view('partials/header'); ?>
	<?php /*var_dump($options); var_dump($itens) ; var_dump($boxes)*/?>
	<main>
		<div class="row">
			<div class="box row col m6 offset-m3 z-depth-1 s10 offset-s1 box">
				<h4 class="center">Novo chamado</h4>
				<form method="POST" class="row col m8 offset-m2" action="<?php echo site_url("tickets/createTicket") ?>">

					<div class="input-field col m4">

						<select name="id_box">
							<?php foreach ($boxes as $box) {
								?>
								<option value="<?php echo $box['id_box'];?>" <?php if($options['id_box']==$box['id_box']) echo "selected"; ?> ><?php echo trim($box['num_box']); ?></option>

								<?php
							} ?>
						</select>
						<label>Box</label>
						
					</div>
					
					<div class="input-field col  m8">

						<select name="id_item">
							<?php foreach ($itens as $item) {
								?>


								<option value="<?php echo $item['id_item'];?>" <?php if($options['id_item']==$item['id_item']) echo "selected"; ?>><?php echo $item['name_item'] ?></option>

								<?php
							} ?>
						</select>

						<label>Item</label>
						
					</div>
					


					<div class="col m12 input-field">
						<textarea required name="description" id="description" class="materialize-textarea"></textarea>	
						<label for="description">Descrição do problema:</label>
					</div>

					<input type="submit" value="Criar" class="btn">
					
				</form>
			</div>
		</div>
	</main>
	<?php $this->load->view('partials/footer'); ?>

</body>
</html>