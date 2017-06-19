<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica - Usuários</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">

	
</head>
<body>
	<?php $this->load->view('partials/header'); ?>

	<main class="container valign-wrapper">
		<?php if ($users) {?>
		<table class="table striped centered z-depth-1">
			<thead>
				<th colspan="4" class="center "><h4>USUÁRIOS ATIVOS</h4></th>
				<tr>
					<th>Nome</th>
					<th>Tipo</th>
					<th style="max-width: 10px;"></th>

				</tr>
			</thead>
			<tbody>

				<?php
				foreach ($users as $user) {
					?>
					<tr id="row<?php echo $user['id_user']?>">
						

						<td><?php echo $user['name_user']?></a></td>

						<td><?php echo $user['description_user_type']?></td>
						<?php if($user['user_type']!=1) {?>
							
							<td><a class="dropdown-button btn-flat" style="max-width: 5px" data-activates="<?php echo 'menu'.$user['id_user']; ?>"><i class="material-icons right">more_vert</i></a></td>

							<ul id="<?php echo 'menu'.$user['id_user']; ?>" class="dropdown-content">
								
								<li><button id="delete<?php echo $user['id_user'];?>" class="btn-flat"
								>Excluir</button></li>

								<li><button id="reset<?php echo $user['id_user'];?>" class="btn-flat">Resetar</button></li>
							</ul>

						<?php } else {?>

							<td></td>
						<?php
						}
					}
					?>

				</tbody>
			</table>
			<?php } ?>
		</main>	

		<div class="center floating" id="messagebox" hidden="true">
			<p id="msg"></p>
		</div>

		<!-- Modal Structure -->
		<div id="modal-delete" class="modal">
			<div class="modal-content">
				<h4>Excluir usuário</h4>
				<p>Você deseja realmente exluir este usuário?</p>
			</div>
			<div class="modal-footer">
			<a id="btndelete" class="modal-action modal-close waves-effect green btn">Sim</a>
			<a class="modal-action modal-close waves-effect waves-red btn-flat">Não</a>
			</div>
		</div>

		<div id="modal-reset" class="modal">
			<div class="modal-content">
				<h4>Resetar usuário</h4>
				<p>Você deseja realmente resetar este usuário?</p>
			</div>
			<div class="modal-footer">
			<a id="btnreset" class="modal-action modal-close waves-effect green btn">Sim</a>
			<a class="modal-action modal-close waves-effect waves-red btn-flat">Não</a>
			</div>
		</div>
		
		<?php $this->load->view('partials/footer'); ?>
		<script>
			var urldelete = "<?php echo site_url('users/deleteuser') ?>";
			var urlreset = "<?php echo site_url('users/resetuser') ?>";
		</script>
		<script src="<?php echo base_url('assets/js/ajax/user_control.js')?>"></script>

	</body>
	</html>