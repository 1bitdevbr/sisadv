<?php
	if( !isset( $_SESSION ) ) session_start();
	require_once(__DIR__ . '/config.php');
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4"><!-- Brand Logo -->

	<!-- LOGO -->
	<a href="index.php" class="brand-link" onmouseover="this.style.color='rgb( 248, 248, 226 )'" onmouseout="this.style.color='rgb( 204, 206, 207 )'">
		<img src="dist/img/sis/logo_bg_gold_192x192.png" alt="<?= $title; ?>" class="brand-image img-circle elevation-3 mt-1">
    <span class="brand-text" style="font-weight: light; font-size: 1.2em;"><img src="dist/img/sis/sisadv.png" width="150px" height="20px"></span>
	</a>

	<a href="#" class="brand-link" onmouseover="this.style.color='rgb( 248, 248, 226 )'" onmouseout="this.style.color='rgb( 204, 206, 207 )'">
		<img src="dist/img/calendar.png" class="brand-image elevation-3">
		<span class="brand-text" style="font-weight: light; font-size: .7em;"><?= date('d') ?> de <?= mostraMes(date('m')) ?> de <?= date('Y') ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar"><!-- Sidebar user panel (optional) -->

		<nav class="mt-2"><!-- Sidebar Menu -->
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

				<!-- MENU  ADMINISTRADOR -->
				<?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?>
				<li class="nav-item">
					<a href="#" class="nav-link active">
					<i class="nav-icon fa fa-chart-line"></i>
					<p style="color: rgb(255, 255, 255); font-weight: 700;">
						Administração
						<i class="fas fa-angle-left right"></i>
						<?php
							$USR_FK_CLIENT = $_SESSION[ 'USR_FK_CLIENT' ];
							$SQL = mysqli_query( $CONN1, " SELECT COUNT( MAN_FK_MODULE ) AS MODULOS FROM SYS_MANAGER WHERE MAN_FK_CLIENT = '$USR_FK_CLIENT' ");
							$DADOS = mysqli_fetch_assoc( $SQL );
							$MODULOS = $DADOS[ 'MODULOS' ];
						?>
						<span class="badge badge-pill badge-info right" style="font-weight: 400; font-size: 0.9em;"><?= $MODULOS; ?></span>
					</p>
					</a>
					<ul class="nav nav-treeview">
					<li class="nav-header" style="letter-spacing: 0.1em; font-weight: 700; text-transform: uppercase;">Módulos&nbsp;<i class="fas fa-inbox"></i></li>
						<li class="nav-item">
                            <?php if( in_array( $MOD_10, $MODULE ) ) { ?><a href="?pg=schedule/sch_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-calendar nav-icon" style="color: rgb( 177, 180, 124 );"></i>&nbsp;Agenda</a><?php } ?>
							<?php if( in_array( $MOD_07, $MODULE ) ) { ?><a href="?pg=matters/mat_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-question-circle nav-icon" style="color: rgb( 232, 245, 236 );"></i>&nbsp;Assuntos Pendentes</a><?php } ?>
							<?php if( in_array( $MOD_01, $MODULE ) ) { ?><a href="?pg=clients/clien_search" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-users nav-icon" style="color: rgb( 35, 168, 242 );"></i>&nbsp;Clientes</a><?php } ?>
							<?php if( in_array( $MOD_08, $MODULE ) ) { ?><a href="?pg=loan/loa_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-book nav-icon" style="color: rgb( 189, 188, 222 );"></i>&nbsp;Controle de Empréstimos</a><?php } ?>
							<?php if( in_array( $MOD_05, $MODULE ) ) { ?><a href="?pg=debtor/deb_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-money-check-alt nav-icon" style="color: rgb( 119, 230, 189 );"></i>&nbsp;Devedores de Cálculos</a><?php } ?>
							<?php if( in_array( $MOD_04, $MODULE ) ) { ?><a href="?pg=funds/fun_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-dollar-sign nav-icon" style="color: rgb( 253, 224, 139 );"></i>&nbsp;Fundos de Emergência</a><?php } ?>
							<?php if( in_array( $MOD_09, $MODULE ) ) { ?><a href="?pg=tasks/tsk_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-cog nav-icon" style="color: rgb( 219, 116, 58 );"></i>&nbsp;Gestão de Tarefas</a><?php } ?>
							<?php if( in_array( $MOD_06, $MODULE ) ) { ?><a href="?pg=inventory/inv_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-edit nav-icon" style="color: rgb( 254, 248, 231 );"></i>&nbsp;Inventário</a><?php } ?>
							<?php if( in_array( $MOD_03, $MODULE ) ) { ?><a href="?pg=finances/fin_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-book nav-icon" style="color: rgb( 247, 146, 116 );"></i>&nbsp;Livro Caixa</a><?php } ?>
							<?php if( in_array( $MOD_02, $MODULE ) ) { ?><a href="?pg=cases/cas_mainAdm" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;"><i class="fas fa-book nav-icon" style="color: rgb( 215, 194, 111 );"></i><p>Processos</p></a><?php } ?>
						</li>
						<li class="nav-header" style="letter-spacing: 0.1em; font-weight: 700; text-transform: uppercase;">Gerenciamento&nbsp;<i class="fas fa-users-cog"></i></li>
						<li class="nav-item">
							<a href="?pg=setup/lawyers/law_main" class="nav-link">
                <i class="fas fa-user-plus nav-icon" style="color: rgb( 189, 188, 222 );"></i>
								<p>Cadastrar advogado</p>
							</a>
              <a href="?pg=setup/perfil/upf_view" class="nav-link">
								<i class="fas fa-user-edit nav-icon" style="color: rgb( 189, 188, 222 );"></i>
								<p>Editar perfil</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>

				<!-- MENU  DE  USUARIOS /-->
				<?php if( $_SESSION[ 'USR_FK_LEVEL' ] == 1 ) { ?>
				<li class="nav-item">
					<a href="#" class="nav-link active">
						<i class="nav-icon fas fa-cogs"></i>
						<p style="color: rgb(255, 255, 255); font-weight: 700;">
							Menu
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-header" style="letter-spacing: 0.1em; font-weight: 700; text-transform: uppercase;">
                            Cadastros&nbsp;<i class="fas fa-users"></i>
                        </li>
						<?php if( in_array( $MOD_10, $MODULE ) ) { ?>
                        <li class="nav-item">
                            <a href="?pg=schedule/sch_main" class="nav-link" style="color: rgb( 211, 211, 213 ); font-weight: 500;">
                            <i class="fas fa-calendar nav-icon" style="color: rgb( 177, 180, 124 );"></i>&nbsp;Agenda
                            </a>
                        </li>
                        <?php } ?>
						<?php if( in_array( $MOD_01, $MODULE ) ) { ?>
						<li class="nav-item">
							<a href="?pg=clients/clien_search" class="nav-link">
								<i class="fas fa-users nav-icon" style="color: rgb( 35, 168, 242 );"></i>
								<p>Clientes</p>
							</a>
						</li>
						<?php } ?>
						<?php if( in_array( $MOD_02, $MODULE ) ) { ?>
						<li class="nav-item">
							<a href="?pg=cases/cas_main" class="nav-link">
								<i class="fas fa-book nav-icon" style="color: rgb( 215, 194, 111 );"></i>
								<p>Processos</p>
							</a>
						</li>
						<?php } ?>
						<?php if( in_array( $MOD_09, $MODULE ) ) { ?>
						<li class="nav-item">
							<a href="?pg=tasks/tsk_main" class="nav-link">
								<i class="fas fa-cog nav-icon" style="color: rgb( 215, 194, 111 );"></i>
								<p>Tarefas</p>
							</a>
						</li>
						<?php } ?>
						<li class="nav-header" style="letter-spacing: 0.1em; font-weight: 700; text-transform: uppercase;">Perfil&nbsp;<i class="fas fa-user"></i></li>
						<li class="nav-item">
							<a href="?pg=setup/perfil/upf_view" class="nav-link">
								<i class="fas fa-user-edit nav-icon" style="color: rgb( 189, 188, 222 );"></i>
								<p>Editar</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>

				<!-- MENU DESENVOLVEDOR /-->
				<?php if( $_SESSION[ 'USR_FK_LEVEL' ] == 4 ) { ?>
					<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cogs"></i>
						<p style="color: rgb(255, 255, 255); font-weight: 700;">
							Configurações
							<i class="fas fa-angle-left right"></i>
							<span class="right badge badge-danger">Setup</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-header" style="letter-spacing: 0.1em; font-weight: 700; text-transform: uppercase;">Gerenciar&nbsp;<i class="fas fa-cog"></i></li>
						<li class="nav-item">
							<a href="?pg=setup/clients/cli_main" class="nav-link">
								<i class="fas fa-user-friends nav-icon" style="color: rgb( 189, 188, 222 );"></i>
								<p>Clientes</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/manager/man_main" class="nav-link">
								<i class="fa fa-book nav-icon" style="color: rgb( 119, 230, 189 );"></i>
								<p>Contas</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/databases/dba_main" class="nav-link">
								<i class="fas fa-database nav-icon" style="color: rgb( 255, 42, 138 );"></i>
								<p>Base de Dados</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/maintenance/main_main" class="nav-link">
                                <i class="fa fa-wrench nav-icon" style="color: rgb( 244, 0, 0 );"></i>
								<p>Manutenção</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/modules/mod_main" class="nav-link">
								<i class="fas fa-th nav-icon" style="color: rgb( 194, 199, 208 );"></i>
								<p>Módulos</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/plans/pln_main" class="nav-link">
								<i class="fas fa-file nav-icon" style="color: rgb( 247, 146, 116 );"></i>
								<p>Planos</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/logs/log_main" class="nav-link">
								<i class="fas fa-cog nav-icon" style="color: rgb( 35, 168, 242 );"></i>
								<p>Registros de Acessos</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?pg=setup/users/usr_main" class="nav-link">
								<i class="fas fa-users nav-icon" style="color: rgb( 215, 194, 111 );"></i>
								<p>Usuários</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>

				<span class="brand-link"></span>

				<!-- RECURSOS -->
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fa fa-clock nav-icon" style="color: rgb( 211, 188, 140 );"></i>
						<p>Sessão:&nbsp;<span id="time">Carregando...</span></p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" data-widget="fullscreen">
						<i class="fas fa-expand-arrows-alt nav-icon" style="color: rgb( 161, 114, 255 );"></i>
						<p>Ativar tela inteira</p>
					</a>
				</li>
			</ul>
		</nav><!-- /.sidebar-menu -->

		<div>
			<button class="btn btn-success btn-sm" onclick="topFunction()" id="myBtn" title="Subir"><i class="fas fa-arrow-circle-up"></i></button>
		</div>

		<br />




	</div><!-- /.sidebar -->

</aside>

<script>
	// Get the button:
	let mybutton = document.getElementById("myBtn");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0; // For Safari
		document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	}
</script>