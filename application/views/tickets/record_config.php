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
	<main>
		<div class="row">
			<div class="box row col m6 offset-m3 z-depth-1 s10 offset-s1 box">
				<h3 class="center">Relatórios</h3>

						<div class="col m6 offset-m3 error" hidden="true" id="messagebox">
							<p class="center" id="msg"></p>
						</div>
			<form method="POST" class="row col m8 offset-m2" action="<?php echo site_url("tickets/relatorio.pdf") ?>">
					<div class="input-field col m12 s12">

						<select name="record">
							<option value="1">Chamados por item</option>
							<option value="2">Chamados por data</option>
							<option value="3">Relatório geral dos boxes</option>
						</select>
						<label>Relatório</label>
					</div>
					<div  class="col m6 date input-field s12" hidden="true">
						<input id="min" name="min" type="date" class="datepicker">
						<label for="min">De:</label>
						
					</div>
					<div  class="col m6 date input-field s12" hidden="true">
						<input id="max" name="max" type="date" class="datepicker">
						<label for="max">Até:</label>
					</div>

					<button id="submit" class="btn col m12 s12" >Gerar relatório</button>
					
					
					
				</form>
			</div>
		</div>
	</main>
	<?php $this->load->view('partials/footer'); ?>
	<script src="<?php echo base_url('assets/js/records.js')?>">   
	</script>

</body>
</html>