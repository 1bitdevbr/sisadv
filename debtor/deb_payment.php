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
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $debTitle; ?><span class="subtitle"><?= $debPayment; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<form class="signin-form" formname="debtor" id="debtor" action="?pg=debtor/deb_payment_insert" method="POST">
					<input class="form-control" type="hidden" id="DEV_FK_CLIENT" name="DEV_FK_CLIENT" value="<?= $DADOS[ 'DEV_FK_CLIENT' ]; ?>" readonly />

					<div class="row">
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_DATE">Data</label>
							<input class="form-control" type="date" id="DEV_DATE" name="DEV_DATE" value="<?= $DADOS[ 'DEV_DATE' ]; ?>" readonly  />
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_FK_STATUS">Situação</label>
							<input class="form-control" type="text" id="DEV_FK_STATUS" name="DEV_FK_STATUS" value="<?= $DADOS[ 'STA_NAME' ]; ?>" readonly />
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_FK_FOLDER">Localização</label>
							<input class="form-control" type="text" id="DEV_FK_FOLDER" name="DEV_FK_FOLDER" value="<?= $DADOS[ 'PAS_NOME' ]; ?>" readonly />
						</div>
						<div class="form-group col-sm-6">
							<label class="label" for="DEV_PROCESS">Número do Processo</label>
							<input class="form-control" type="text" id="DEV_PROCESS" name="DEV_PROCESS" value="<?= processNumber( "#######-##.####.#.##.####" , $DADOS[ 'DEV_PROCESS' ] ); ?>" readonly />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="CLI_NOME">Cliente:</label>
							<input class="form-control" type="text" id="CLI_NOME" name="CLI_NOME" value="<?= $DADOS[ 'CLI_NOME' ]; ?>" readonly />
						</div>
						<div class="form-group col-sm-6">
							<label class="label" for="DEV_DEMANDED">Parte Contraria</label>
							<input class="form-control" type="text" id="DEV_DEMANDED" name="DEV_DEMANDED" value="<?= $DADOS[ 'DEV_DEMANDED' ]; ?>" readonly />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-10">
							<label class="label" for="DEV_DESCRIPTION">Descrição</label>
							<input class="form-control" type="text" id="DEV_DESCRIPTION" name="DEV_DESCRIPTION" value="<?= $DADOS[ 'DEV_DESCRIPTION' ]; ?>" readonly />
						</div>
						<div class="form-group col-sm-2">
							<label class="label" for="DEV_PRICE">Valor&nbsp;RS</label>
							<input class="form-control" type="text" id="DEV_PRICE" name="DEV_PRICE" size="10" maxlength="9" data-precision="2" value="<?= $DADOS[ 'DEV_PRICE' ]; ?>" readonly  />
						</div>
					</div>
					<hr style='width: auto; height: 2px; text-align: center; border: 0px; color:#ff9999; background:#FBEAD5;' />
					<div class="row justify-content-center align-items-center">
						<legend style="text-align: center;">Lançamento</legend>
						<div class="form-group col-sm-2" align="center">
							<label class="label" for="DEV_DT_PAYMENT">Data</label>
							<input class="form-control" type="date" name="DEV_DT_PAYMENT" id="DEV_DT_PAYMENT" value="" autofocus required />
						</div>
						<div class="form-group col-sm-2" align="center">
							<label class="label" for="DEV_AMOUNT">Valor&nbsp;RS</label>
							<input class="form-control money" type="text" id="DEV_AMOUNT" name="DEV_AMOUNT" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" required />
						</div>
					</div>

					<hr style='width: auto; height: 2px; text-align: center; border: 0px; color:#ff9999; background:#FBEAD5;' />

					<div class="form-group" align="center">
						<button class="btn btn-danger btn-md submit_btn" id="btn-lancar" name="btn-lancar" value="btn-lancar" onclick="return confirm('Confirma o lançamento?')"><i class="fas fa-database"></i>&nbsp;Salvar</button>
					</div>

				</form>

			</div><!-- /.Invoice -->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>