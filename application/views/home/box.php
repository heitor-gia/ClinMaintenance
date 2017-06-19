<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Box <?php echo $box[0]['num_box'] ?> </title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
	
</head>
<body >
	<?php $this->load->view('partials/header');?>
	<main class="container">
		<table class="table striped  z-depth-1">
			<thead>
				<tr>
					<th colspan="2"><h3 class="center">BOX <?php echo $box[0]['num_box'] ?></h3></th>
				</tr>
				<tr>
					<th colspan="2"><h5 class="center"> SETOR <?php echo $box[0]['sector_box'] ?></h5></th>
				</tr>

				<tr>
					<th class="center">ITEM</th>
					<th class="center">OPERANDO</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($box as $item) {
					?>
					<tr>
						<td class="center"><a href="<?php echo site_url('tickets/item/'.$item['id'].'/'.$item['id_box']);?>" ><?php echo $item['item'];?></a></td>
						<?php echo $item['operating']<=0?'<td class="danger center">NÃO ':'<td class="success center">SIM '?></td>

					</tr>
					<?php
				}	
				?>
			</tbody>
		</table>
	</main>
	<?php $this->load->view('partials/footer');?>

</body>
</html>