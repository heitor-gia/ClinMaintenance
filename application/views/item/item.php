<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clínica Odontológica - <?php echo $item['item'].' - BOX '.$item['num_box']; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<link rel="icon" href="<?php echo base_url('assets/images/favico.png');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
	
</head>
<body>
	<?php $this->load->view('partials/header'); ?>
	<main class="container row">



		

		<table class="table centered striped m12 s12 z-depth-1">
			<thead>
				<tr>
					<th colspan="5"><h3 class="center"><?php echo $item['item']; ?></h3></h3></th>
				</tr>
				<tr>
					<th colspan="5"><h4 class="center"><a href="<?php echo site_url('box/'.$item['num_box']) ?>">BOX <?php echo $item['num_box']; ?></a></h4></h5></th>
				</tr>
				<?php 
				if(!is_maintence($this)){?>
						<tr>
							<th  colspan=5>
								<a href="<?php echo site_url('tickets/newticket/'.$item['id'].'/'.$item['id_box']) ?>" class="btn center">Criar chamado</a>
							</th>
						</tr>
				<?php } ?>


				<tr>
					<th>ID Chamado</th>
					<th class="hide-on-med-and-down">Abertura</th>
					<th class="hide-on-med-and-down">Fechamento</th>
					<th>Descrição</th>
					<th>Situação</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($tickets) {?>

				<?php

				foreach (array_reverse($tickets) as $ticket) {
					?>
					<tr>
						<td><?php echo $ticket['id_ticket']?></a></td>
						<td class="hide-on-med-and-down" ><?php echo nice_date($ticket['creation_ticket'],'d/m/Y')."<br>".nice_date($ticket['creation_ticket'],'H:i:s'); ?></td>
						<td class="hide-on-med-and-down" id="close<?php echo $ticket['id_ticket']?>"><?php 
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
			<td colspan="5" class="success" style="padding: 0;">
				<div style="color:white;height:30vh;">
					<h3  style="margin-left: 0 auto">Este item não possui chamados</h3>			
				</div>
			</td>
			<?php } ?>
		</tbody>
	</table>



					
	</div>
</td>
</tbody>
</table>
	<div id="modal" class="modal">
			<div class="modal-content">
				<h4>Fechar chamado</h4>
				<p>Você deseja realmente fechar este chamado?</p>
			</div>
			<div class="modal-footer">
			<a id="closeticket" class="modal-action modal-close waves-effect waves-green btn green">Sim</a>
			<a id="closemodal" class="modal-action modal-close waves-effect waves-red btn-flat">Não</a>
			</div>
		</div>

</main>
<div class="center floating" id="messagebox" hidden="true">
	<p id="msg"></p>
</div>
<?php $this->load->view('partials/footer'); ?>
	<script>
		var url = "<?php echo site_url('tickets/closeticket')?>";
	</script>
	<script src="<?php echo base_url('assets/js/ajax/close_ticket.js'); ?>"></script>

</body>
</html>