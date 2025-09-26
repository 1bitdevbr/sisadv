<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 4;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!--// USER HEADER //-->
	<?php require 'pln_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!--// MODULES MENU //-->
			<?php require 'pln_menu.php'; ?>

			<!-- INÍCIO DA PESQUISA -->
			<div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->

				<div class="container">
					<div class="row col-12"><!-- title row -->
						<div class="form-group col-sm-2">

						</div>
						<div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
							<legend><?= $plnSubtitle; ?></legend>
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
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">PLANO</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">DESCRIÇÃO</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">VALOR</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 247, 146, 116 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">AÇÕES</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                // Início da consulta sql
								$SQL = " SELECT *
								 		   FROM SYS_PLANS
									   ORDER BY PLN_ID
									   ";
								$ROW = mysqli_query($CONN1, $SQL);

								while ($DADOS = mysqli_fetch_assoc($ROW)) {
							?>
								<tr>
									<th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 247, 146, 116 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['PLN_ID']; ?></th>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['PLN_NAME']; ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['PLN_DESCRIPTION']; ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS['PLN_PRICE']; ?></td>
									<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 6%;">
                                        <a href="?pg=setup/plans/pln_edit&id=<?= $DADOS['PLN_ID']; ?>" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fas fa-edit"></i>
                                        </a>&nbsp;
                                        <a href="?pg=setup/plans/pln_delete&id=<?= $DADOS['PLN_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este registro?')"><i class="fas fa-trash"></i></a>
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

				<?php require 'pln_footer.php'; ?>

			</div><!-- /.Invoice -->
			<!-- FIM DA PESQUISA-->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php mysqli_close( $CONN1 ); ?>