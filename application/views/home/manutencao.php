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
	<?php $this->load->view('partials/header');  ?>
	<main class="container valign-wrapper">
		
		<?php if ($itens) {?>
		<table class="table striped z-depth-1">
			<thead>
				<th colspan="4" class="center "><h4>EM MANUTENÇÃO</h4></th>
				<tr>
					<th>Box</th>
					<th>Item</th>
					<th>Setor</th>
					<th id="main-table-sit" class="center">Situação</th>
				</tr>
			</thead>
			<tbody>

				<?php

				foreach ($itens as $item) {
					?>
					<tr>
						<td><a href="<?php echo site_url('box/'.$item['num_box'])?>"><?php echo $item['num_box']?></a></td>
						<td><a href="<?php echo site_url('tickets/item/'.$item['id'].'/'.$item['id_box'])?>"><?php echo $item['item']; ?>
						</a></td>
						<td><?php echo $item['sector_box']; ?></td>
						<?php echo $item['operating']<=0?'<td class="danger center">MANUTENÇÃO</td>':'<td class="success center">OPERANDO</td>'?>

					</tr>


					<?php
				}
				?>
			</tbody>
		</table>
		<?php 	} else { ?>

		<div class="success center valign-wrapper valign z-depth-1" style="color:white;border-radius:10px;height:30vh; margin-left: auto; margin-right: auto;padding: 5vw;">
			<h3 class="valign" style="margin-left: auto; margin-right: auto;">Sem itens em manutenção</h3>
		</div>
		<?php } ?>
	</main>
	<?php $this->load->view('partials/footer');  ?>

</body>
</html>