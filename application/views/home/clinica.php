<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
	
</head>
<body>

	<?php $this->load->view('partials/header'); ?>

	<main class="container">
		
		<div class="row">
			<?php 

			foreach ($setores as $setor) {
				?>
				<div class="col m6 s12">
					<table class="table highlight z-depth-1 ">
						<thead>
							<th colspan="2" class="center title"><h4>SETOR <?php echo $setor[0]['sector_box']?></h4></th>
							<tr>
								<th class="center">Box</th>
								<th class="center main-table-sit">Situação</th>
							</tr>
						</thead>
						<tbody>

							<?php

							foreach ($setor as $box) {
								?>
								<tr>
									<td class="center"><a href="<?php echo site_url('box/'.$box['id_box'])?>"><?php echo "BOX ".$box['num_box']?></a></td>
									<?php echo $box['tickets']>0?'<td class="center main-table-sit danger">MANUTENÇÃO</td>':'<td class="center success main-table-sit">OPERANDO</td>'?>

								</tr>


								<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<?php } ?>

			</main>

			<?php $this->load->view('partials/footer'); ?>

		</body>
		</html>