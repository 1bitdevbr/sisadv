<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_GET[ 'id' ] ) ) {
		$ID = $_GET[ 'id' ];

				$SQL = " SELECT MAN.*, STA.STA_NAME, CLI.CLI_OFFICE, PLN.PLN_NAME, MD.MOD_NAME
				  				 FROM SYS_MANAGER MAN
									 JOIN SYS_STATUS STA ON STA.STA_ID = MAN.MAN_FK_STATUS
									 JOIN SYS_CLIENTS CLI ON CLI.CLI_ID = MAN.MAN_FK_CLIENT
									 JOIN SYS_PLANS PLN ON PLN.PLN_ID = MAN.MAN_FK_PLAN
									 JOIN SYS_MODULES MD ON MD.MOD_ID = MAN.MAN_FK_MODULE
									WHERE MAN.MAN_FK_STATUS = 1 AND MAN.MAN_ID = '$ID' ";

		$ROW = mysqli_query( $CONN1, $SQL );
		while( $DADOS = mysqli_fetch_row( $ROW ) ) {
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!--// CLIENT HEADER //-->
	<?php require 'man_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!--// CLIENT MENU //-->
			<?php require 'man_menu.php'; ?>

			<!-- INÍCIO DA PESQUISA -->
			<div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->
			  <div class="container"><!-- title row -->
					<div class="row col-12">
						<div class="form-group col-sm-2"></div>
						<div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
							<legend><?= $manSubtitle; ?></legend>
						</div>
						<div class="form-group col-sm-2"></div>
					</div><!-- /.col -->
			  </div>

			  <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid">

					<form class="signin-form" formname="inventario" id="inventario" action="?pg=setup/manager/man_inserir" method="POST">
						<div class="row">
							<div class="form-group col-sm-2">
								<label class="label" for="MAN_ID">#ID</label>
								<input class="form-control" type="text" id="MAN_ID" name="MAN_ID" value="<?= $DADOS[ 'MAN_ID' ]; ?>" readonly />
							</div>
							<div class="form-group col-sm-2">
								<label>Situação</label>
								<input class="form-control" type="text" id="MAN_FK_STATUS" name="MAN_FK_STATUS" value="<?= $DADOS[ 'STA_NAME' ]; ?>" readonly />
							</div>
							<div class="form-group col-sm-6">
								<label for="MAN_FK_CLIENT">CLIENTE</label>
								<?php
									$CLIENTE = $DADOS[ 'MAN_FK_CLIENT' ];
									if( $CLIENTE ) {
											$SQL = "SELECT CLI_ID, CLI_OFFICE FROM SYS_CLIENTS WHERE CLI_ID = '$CLIENTE' ";
											$ROW = mysqli_query( $CONN1, $SQL );
											$R = mysqli_fetch_array( $ROW );
											$MAN_FK_CLIENT = $R[ 'CLI_OFFICE' ];
											echo " <input class=\"form-control\" type=\"text\" name=\"MAN_FK_CLIENT\" value=\"$MAN_FK_CLIENT\" readonly /> ";
									} else {
											echo " Erro ";
									}
								?>
							</div>
							<div class="form-group col-sm-2">
								<label class="label" for="MAN_FK_PLAN">PLANO</label>
								<input class="form-control" type="text" id="MAN_FK_PLAN" name="MAN_FK_PLAN" value="<?= $DADOS[ 'PLN_NAME' ]; ?>" readonly />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-2">
								<label class="label" for="MAN_DT_CONTRACT">CONTRATO</label>
								<input class="form-control" type="date" id="MAN_DT_CONTRACT" name="MAN_DT_CONTRACT" value="<?= $DADOS[ 'MAN_DT_CONTRACT' ]; ?>" readonly />
							</div>
							<div class="form-group col-sm-2">
								<label class="label" for="MAN_DT_VALIDITY">VALIDADE</label>
								<input class="form-control" type="date" id="MAN_DT_VALIDITY" name="MAN_DT_VALIDITY" value="<?= $DADOS[ 'MAN_DT_VALIDITY' ]; ?>" readonly />
							</div>
							<div class="form-group col-sm-8">
								<label class="label" for="MAN_FK_MODULE">MODULOS</label>
								<input type="checkbox" <?php ( ( $DADOS[ 'MAN_FK_MODULE' ] == $DADOS[ 'MOD_ID' ] ) ? " checked" : "" ) ?> />&nbsp;<?= $DADOS[ 'MOD_NAME' ]; ?>
								<input type="checkbox" name="<?= $DADOS[ 'MOD_NAME' ]; ?>" <?php if( $DADOS[ 'MAN_FK_MODULE' ] == $DADOS[ 'MOD_ID' ] ){ ?> checked="checked" <?php } ?> />&nbsp;<?= $DADOS[ 'MOD_NAME' ]; ?>
							</div>
						</div>
						<hr style='width: auto; height:2px; text-align:center; border:0px; color:#ff9999; background:#FBEAD5;' />
						<div class="form-group" align="center">
							<a href="?pg=setup/manager/man_register" class="btn btn-info btn-md" title="Cadastrar"><i class="fas fa-plus"></i>&nbsp;Cadastrar</a>
							<a href="?pg=setup/manager/man_edit&id=<?= $DADOS[ 'MAN_ID' ]; ?>" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i>&nbsp;Editar</a>
						</div>
					</form>

				</div><!-- /.container-fluid -->

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<?php require 'man_footer.php'; ?>

			</div><!-- /.Invoice -->
		 <!-- FIM DA PESQUISA-->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<?php
		} }
	mysqli_close( $CONN1 );
?>