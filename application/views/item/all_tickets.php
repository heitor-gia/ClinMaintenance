<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica - Chamados</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">


	
</head>
<body>
	<?php $this->load->view('partials/header'); ?>

	<main class="container valign-wrapper">
		
			<?php if ($tickets) {?>
			<table id="mytable" class="table striped centered z-depth-1">
				<thead>
					<th colspan="7" class="center"><h4>TODOS OS CHAMADOS</h4></th>
					<tr>
						<th class="hide-on-med-and-down">ID Cham.</th>
						<th>Item</th>
						<th>Box</th>
						<th class="hide-on-med-and-down">Abertura</th>
						<th class="hide-on-med-and-down">Fechamento</th>
						<th>Descrição</th>
						<th>Situação</th>
					</tr>
				</thead>
				<tbody>

					<?php
					foreach ($tickets as $ticket) {
						?>
						<tr>
							<td class="hide-on-med-and-down"><?php echo $ticket['id_ticket']?></td>

							<td><a href="<?php echo site_url('tickets/item/'.$ticket['id_item'].'/'.$ticket['id_box']) ?>"><?php echo $ticket['item']?></a></td>

							<td><a href="<?php echo site_url('box/'.$ticket['id_box']); ?>"><?php echo $ticket['num_box']?></a></td>

							<td class="hide-on-med-and-down"><?php echo nice_date($ticket['creation_ticket'],'d/m/Y')."<br>".nice_date($ticket['creation_ticket'],'H:i:s'); ?></td>

							<td id="close<?php echo $ticket['id_ticket']?>" class="hide-on-med-and-down" ><?php 
								if($ticket['close_ticket']){
									echo nice_date($ticket['close_ticket'],'d/m/Y')."<br>".nice_date($ticket['close_ticket'],'H:i:s'); 
								} ?>
								</td>
								<td class="td-description"><?php echo $ticket['description_ticket']; ?></td>
								<?php if($ticket['close_ticket']==NULL){?>
								
								<td id="<?php echo 'sit'.$ticket['id_ticket'] ?>"
									data-status=false
									<?php if(!$this->agent->is_mobile()){?>
										class="danger center tooltipped danger-hover"
										data-position="left" 
										data-delay="10" 
										data-tooltip="Clique para fechar o chamado" 
									<?php } else {?>
										class="danger center"
									<?php }?>

									style="cursor:pointer;">	
									ABERTO
									
								</td>	
								<?php } else {?>
									<td id="<?php echo 'sit'.$ticket['id_ticket']?>" data-status=true class="success center">
										OK
									</td>
								<?php }?>

							</tr>


							<?php
						}
						?>

				</tbody>
			</table>
		
			<?php 	} else { ?>

				<div class="success center valign-wrapper valign z-depth-1" style="color:white;border-radius:10px;height:30vh; margin-left: auto; margin-right: auto;padding: 5vw;">
					<h3 class="valign" style="margin-left: auto; margin-right: auto;">Ainda não existem chamados</h3>
				</div>
			<?php } ?>
		
	</main>	
		<div class="center floating" id="messagebox" hidden="true">
			<p id="msg"></p>
		</div>
		<div id="modal" class="modal">
			<div class="modal-content">
				<h4>Fechar chamado</h4>
				<p>Você deseja realmente fechar este chamado?</p>
			</div>
			<div class="modal-footer">
			<a id="closeticket" class="modal-action modal-close waves-effect green btn">Sim</a>
			<a id="closemodal" class="modal-action modal-close waves-effect waves-red btn-flat">Não</a>
			</div>
		</div>
	
		
			<?php echo $links; ?>
		
	<?php $this->load->view('partials/footer'); ?>
	<script>
		var url = "<?php echo site_url('tickets/closeticket')?>";
	</script>
	<script src="<?php echo base_url('assets/js/ajax/close_ticket.js'); ?>"></script>
	


</body>
</html>