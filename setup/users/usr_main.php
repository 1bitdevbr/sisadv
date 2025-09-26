<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!--// USER HEADER //-->
	<?php require 'usr_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!--// USER MENU //-->
			<?php require 'usr_menu.php'; ?>

			<!-- INÍCIO DA PESQUISA -->
			<div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->

				<div class="container">
					<div class="row col-12"><!-- title row -->
						<div class="form-group col-sm-2">

						</div>
						<div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
							<legend><?= $usrSubtitle; ?></legend>
						</div>
						<div class="form-group col-sm-2">

						</div>
					</div>
					<!-- /.col -->
				</div>

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid table-responsive">

					<!-- INÍCIO DA PESQUISA -->
					<table id="table" class="table table-dark table-striped table-hover table-sm">
						<caption>Resultado da consulta</caption>
						<thead class="thead-dark">
							<tr>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 247, 146, 116 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">#ID</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">User Ativo</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Online</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Foto</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Login</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Nome</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Nível</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Cliente</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">Base de Dados</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">User BD</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 247, 146, 116 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">AÇÕES</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                // Início da consulta sql
								$SQL = " SELECT U.*, L.*, C.*, D.*, S.*
                                           FROM SYS_USERS U
                                           JOIN SYS_LEVEL L ON L.LVL_ID = U.USR_FK_LEVEL
                                           JOIN SYS_CLIENTS C ON C.CLI_ID = U.USR_FK_CLIENT
                                           JOIN SYS_DATABASES D ON D.DBA_ID = U.USR_FK_DB_NAME
                                           JOIN SYS_STATUS S ON S.STA_ID = U.USR_FK_STATUS
                                       ORDER BY C.CLI_OFFICE, U.USR_NAME
                                       ";
								$ROW = mysqli_query($CONN1, $SQL);

								while ($DADOS = mysqli_fetch_assoc($ROW)) {
							?>
								<tr>
									<th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 247, 146, 116 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['USR_ID']; ?></th>
									<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
										<?php
											if( $DADOS[ 'USR_FK_STATUS' ] == 1 ) {
													echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
											} else {
													echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
											}
										?>
									</td>
									<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
										<?php
											if( $DADOS[ 'USR_ONLINE' ] == 1 ) {
													echo '<i class="fas fa-check" style="color: rgb( 255, 0, 0 );"></i>'; // 1 - ATIVO
											} else {
													echo '<i class="fas fa-times" style="color: rgb( 134, 140, 125 );"></i>'; // 0 - INATIVO
											}
										?>
									</td>
									<td class="image" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
										<?php if (empty($DADOS['USR_PHOTO'])) {
												$IMG = '/dist/img/user.png';
										} else {
												$IMG = '/dist/img/' . $DADOS['USR_PHOTO'] . '';
										} ?>
										<span><img class="img-circle" src="<?= $IMG; ?>" width="30px" height="30px" /></span>
									</td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['USR_LOGIN'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['USR_NAME'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['LVL_NAME'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['CLI_OFFICE'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); font-size: 1.0em; font-weight: 600;"><?= $DADOS['DBA_NAME'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); font-size: 1.0em; font-weight: 600;"><?= $DADOS['DBA_USER'] ?></td>
									<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                        <a href="?pg=setup/users/usr_view&id=<?= $DADOS['USR_ID']; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i>
                                        </a>&nbsp;
                                        <a href="?pg=setup/users/usr_edit&id=<?= $DADOS['USR_ID']; ?>" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;
                                        <a href="?pg=setup/users/usr_delete&id=<?= $DADOS['USR_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este registro?')"><i class="fas fa-trash"></i></a>
                                    </td>
								</tr>
							<?php
							    }
							?>
						</tbody>
					</table>
					<!-- FIM DA PESQUISA-->

				</div><!-- /.container-fluid -->

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<?php require 'usr_footer.php'; ?>

			</div><!-- /.Invoice -->
			<!-- FIM DA PESQUISA-->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php mysqli_close( $CONN1 ); ?>