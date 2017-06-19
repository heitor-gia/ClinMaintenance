<div class="navbar-fixed">
	<nav class="blue lighten-2">
		<div>
			<!-- <img src="<?php echo base_url('assets/images/favico.png');?>" alt="icon" width="48px" height="48px">-->
			
			<span class="brand-logo">
				<h5>Clinica Odontológica</h5>
			</span>
			<?php  if (is_logado($this)){?>



			<a href="#" data-activates="mobile-demo" id="menu" class="button-collapse"><i class="material-icons">menu</i></a>


			<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="<?php echo site_url(); ?>">Início</a></li>
				
				<?php if(is_admin($this)){?>

					<li><a href="<?php echo site_url('itens')?>">Itens</a></li>
					<li><a class="dropdown-button" href="#!" data-activates="users">Usuários<i class="material-icons right">arrow_drop_down</i></a></li>
				
				<?php } 

				if(is_responsable($this)||is_admin($this)){
				?>

					<li><a class="dropdown-button" href="#!" data-activates="tickets">Chamados<i class="material-icons right">arrow_drop_down</i></a></li>

				<?php } ?>
					<li><a href="<?php echo site_url('manutencao'); ?>">Manutenção</a></li>
					<li><a class="dropdown-button" href="#!" style="height:64px" data-activates="options"><i class="material-icons center">more_vert</i></a></li>
			</ul>
			<?php if(is_admin($this)){?>
				<ul id="users" class="dropdown-content">
					<li><a href="<?php echo site_url('users/allusers'); ?>">Todos usuários</a></li>
					<li><a href="<?php echo site_url('users/newuser') ?>">Novo usuário</a></li>
				</ul>
			<?php }

			if(is_responsable($this)||is_admin($this)){?>
			
				<ul id="tickets" class="dropdown-content">
					<li><a href="<?php echo site_url('tickets/alltickets'); ?>">Todos chamados</a></li>
					<li><a href="<?php echo site_url('tickets/newticket') ?>">Novo chamado</a></li>
					<li><a href="<?php echo site_url('tickets/records') ?>">Relatórios</a></li>
				</ul>

			<?php } ?>

				<ul id="options" class="dropdown-content">
					<li><a href="<?php echo site_url('users/configPassword') ?>">Alterar senha</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo site_url('users/logout') ?>">Sair</a></li>
				</ul>



			<ul class="side-nav" id="mobile-demo">
				<li><a href="<?php echo site_url(); ?>">Início</a></li>
				<li class="divider"></li>
				<?php if(is_responsable($this)||is_admin($this)){ ?>
				<li><a href="<?php echo site_url('tickets/alltickets'); ?>">Chamados</a></li>
				<li><a href="<?php echo site_url('tickets/newticket') ?>">Novo chamado</a></li>
				<li><a href="<?php echo site_url('tickets/records') ?>">Relatórios</a></li>
				<li class="divider"></li>
				<?php }

				if(is_admin($this)){ ?>
				<li><a href="<?php echo site_url('users/allusers'); ?>">Todos usuários</a></li>
				<li><a href="<?php echo site_url('users/newuser') ?>">Novo usuário</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('itens')?>">Itens</a></li>
				<li class="divider"></li>
				<?php } ?>
				<li><a href="<?php echo site_url('manutencao'); ?>">Manutenção</a></li>
				<li><a href="<?php echo site_url('users/configPassword') ?>">Alterar senha</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('users/logout') ?>">Sair</a></li>
			</ul>
			
			<?php } ?>
		</div>

	</nav>
</div>