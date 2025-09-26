<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

	if( isset( $_GET[ 'id' ] ) ) {
		$ID = $_GET[ 'id' ];

		$SQL = " SELECT DEV.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME, STA.STA_NAME
							 FROM DEV_CALC_MOV DEV
							 JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = DEV.DEV_FK_CLIENT
							 JOIN STA_STATUS STA ON STA.STA_ID = DEV.DEV_FK_STATUS
							 JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = DEV.DEV_FK_FOLDER
						  WHERE DEV.DEV_ID = '$ID'
					 ORDER By DEV.DEV_ID DESC ";

		$RESULTADO = mysqli_query( $CONN, $SQL );
		$DADOS = mysqli_fetch_array( $RESULTADO );
	}
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $debTitle; ?><span class="subtitle"><?= $debSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<form class="signin-form" formname="debtor" id="debtor" action="?pg=debtor/deb_update" method="POST">
					<input class="form-control" type="hidden" id="DEV_ID" name="DEV_ID" value="<?= $DADOS[ 'DEV_ID' ]; ?>" readonly />

					<div class="row">
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_DATE">Data</label>
							<input class="form-control" type="date" id="DEV_DATE" name="DEV_DATE" value="<?= $DADOS[ 'DEV_DATE' ]; ?>" />
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_FK_STATUS">Situação</label>
							<select class="form-control" name="DEV_FK_STATUS" id="DEV_FK_STATUS">
								<?php
									$SQL = mysqli_query( $CONN, " SELECT STA_ID, STA_NAME FROM STA_STATUS ORDER By STA_NAME ");
									while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
									<option value="<?= $ROW[ 'STA_ID' ]; ?>"<?php if( $DADOS[ 'DEV_FK_STATUS' ] == $ROW[ 'STA_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'STA_NAME' ]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_FK_FOLDER">Localização</label>
							<select class="form-control" name="DEV_FK_FOLDER" id="DEV_FK_FOLDER">
								<?php
									$SQL = mysqli_query( $CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
									while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
									<option value="<?= $ROW[ 'PAS_ID' ]; ?>"<?php if( $DADOS[ 'DEV_FK_FOLDER' ] == $ROW[ 'PAS_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'PAS_NOME' ]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label class="label" for="DEV_PROCESS">Número do Processo</label>
							<input class="form-control" type="text" id="DEV_PROCESS" name="DEV_PROCESS" value="<?= processNumber( "#######-##.####.#.##.####" , $DADOS[ 'DEV_PROCESS' ] ); ?>" onkeyup="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="DEV_FK_CLIENT">Cliente:</label>
							<select class="form-control" name="DEV_FK_CLIENT" id="DEV_FK_CLIENT">
								<?php
									$SQL = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER By CLI_NOME ");
									while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
									<option value="<?= $ROW[ 'CLI_ID' ]; ?>"<?php if( $DADOS[ 'DEV_FK_CLIENT' ] == $ROW[ 'CLI_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'CLI_NOME' ]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label class="label" for="DEV_DEMANDED">Parte Contraria</label>
							<input class="form-control" type="text" id="DEV_DEMANDED" name="DEV_DEMANDED" value="<?= $DADOS[ 'DEV_DEMANDED' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-10">
							<label class="label" for="DEV_DESCRIPTION">Descrição</label>
							<input class="form-control" type="text" id="DEV_DESCRIPTION" name="DEV_DESCRIPTION" value="<?= $DADOS[ 'DEV_DESCRIPTION' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_PRICE">Valor</label>
							<input class="form-control money" type="text" id="DEV_PRICE" name="DEV_PRICE" size="10" maxlength="9" data-precision="2" value="<?= formata_dinheiro( $DADOS[ 'DEV_PRICE' ] ) ?>" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" />
						</div>
					</div>

					<hr style='width: auto; height:2px; text-align:center; border:0px; color:#ff9999; background:#FBEAD5;' />

					<div class="form-group" align="center">
						<a href="?pg=debtor/deb_edit&id=<?= $DADOS[ 'DEV_ID' ]; ?>" class="btn btn-danger" title="Editar"><i class="fas fa-database"></i>&nbsp;Salvar</a>
					</div>

				</form>

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>