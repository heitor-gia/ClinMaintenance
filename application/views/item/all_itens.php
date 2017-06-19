<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica - Itens</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">

	
</head>
<body>
	<?php $this->load->view('partials/header'); ?>

	<main class="container valign-wrapper">
		<table class="table striped centered z-depth-1">
			<thead>
				<tr><th colspan="3" class="center "><h4>ITENS</h4></th></tr>
				<tr><th colspan="3" class="center "><a class="btn waves-effect" id="newitem" >Novo Item</a></h4></th></tr>
				<tr>
					<th>Nome</th>
					<th style="max-width: 10px;"></th>

				</tr>
			</thead>
			<tbody>

		<?php if ($itens) {?>
				<?php
				foreach ($itens as $item) {
					?>
					<tr id="row<?php echo $item['id_item'];?>">
						<td id="name<?php echo $item['id_item'] ?>"><?php echo $item['name_item']?></a></td>

						<?php if(is_admin($this)) {?>
							
							<td>

							
								
								<a id="item<?php echo $item['id_item'];?>" 
								class="btn-flat waves-effect edit" 
								data-id="<?php echo $item['id_item'];?>"
								data-name="<?php echo $item['name_item'];?>"
								data-description="<?php echo $item['description_item'];?>"
								><i class="material-icons">mode_edit</i></a>
								<?php if($item['tickets']==0){?>
								<a id="delete<?php echo $item['id_item'];?>" 
								class="btn-flat waves-effect delete" 
								data-id="<?php echo $item['id_item'];?>"
								><i class="material-icons">delete</i></a>
								<?php }?>
							</td>
	
							

						<?php } else {?>

							<td></td>
						<?php
						}
					}
					?>
			<?php } ?>

				</tbody>
			</table>

		</main>	
		<div id="modal" class="modal" >
			<div class="modal-content">
				<h4 id="title">Novo Item</h4>
				<div class="row">
					<div class="center col m6 offset-m3 input-field s12 error" id="messagebox-modal" hidden="true">
						<p id="msg-modal">O item não poderá ser excluído após receber um chamado.</p>
					</div>
					<div class="center col m6 offset-m3 input-field s12 info-box" id="messagebox-info">
						<p>O item não poderá ser excluído após receber um chamado.</p>
					</div>
					<div class="col m10 offset-m1 input-field s12">
						<input id="name_item" type="text">
						<label>Nome do item:</label>
					</div>

					<div class="col m10 offset-m1 input-field s12">
						<textarea  id="description" class="materialize-textarea"></textarea>	
						<label for="description">Descrição(opcional):</label>
					</div>
				</div>
			</div>
			<div class="modal-footer  row">
				<div class="col m10 offset-m1 s12 row">
					<a id="confirm" class="modal-action  waves-effect btn green center col s6 m4 offset-m1">Cadastrar</a>
					<a id="cancel" class="modal-action waves-effect modal-close waves-red btn-flat center col s6 m4 ">Cancelar</a>
				</div>
			</div>
		</div>
			<div id="modal-delete" class="modal">
			<div class="modal-content">
				<h4>Excluir Item</h4>
				<p>Você deseja realmente exluir este item?</p>
			</div>
			<div class="modal-footer">
			<a id="btndelete" class="modal-action modal-close waves-effect green btn">Sim</a>
			<a class="modal-action modal-close waves-effect waves-red btn-flat">Não</a>
			</div>

		</div>

		<div class="center floating" id="messagebox" hidden="true">
			<p id="msg"></p>
		</div>
		<?php $this->load->view('partials/footer'); ?>
		<script src="<?php echo base_url('assets/js/ajax/item_control.js'); ?>"></script>

	</body>
	</html>