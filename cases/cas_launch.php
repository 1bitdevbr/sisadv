<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 1;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

	// Selecionando o ID do processo a ser Editado/Alterado
	if (isset($_GET['id']) && isset($_GET['parc'])) {
		$id = $_GET['id'];
		$parc = $_GET['parc'];
		$SQL = mysqli_query($CONN, " SELECT PRO.*
																	 FROM PPR_PROC_PROCESSOS PRO
																	 JOIN PAS_PROC_PASTA PAS 			ON PAS.PAS_ID = PRO.PPR_FK_PASTA
																	 JOIN CLI_CLIENTES CLI 				ON CLI.CLI_ID = PRO.PPR_FK_CLIENTE
																	 JOIN PHO_PROC_HONORARIOS HON ON HON.PHO_ID = PRO.PPR_FK_HONORARIOS
																	 JOIN PDE_PROC_DEFENSORIA DEF ON DEF.PDE_ID = PRO.PPR_FK_DEFENSORIA
																	 JOIN PNA_PROC_NATUREZA NAT 	ON NAT.PNA_ID = PRO.PPR_FK_NATUREZA
																	 JOIN PME_PROC_MEIO MEI 			ON MEI.PME_ID = PRO.PPR_FK_MEIO
																	 JOIN STA_STATUS STA 					ON STA.STA_ID = PRO.PPR_FK_STATUS
																	 JOIN PIN_PROC_INSS INS 			ON INS.PIN_ID = PRO.PPR_FK_INSS
																	 JOIN PTD_PROC_TABELA_DEF TBD ON TBD.PTD_ID = PRO.PPR_FK_COD_ACAO
																	 JOIN PPE_PROC_PERCENTUAL PER ON PER.PPE_ID = PRO.PPR_FK_PERCENTUAL
																	WHERE PRO.PPR_ID = '$id'
															");
		$DADOS = mysqli_fetch_array($SQL);
	}
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $casePayment; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid">

					<div class="card-body">

						<form class="signin-form" formname="cases" action="?pg=cases/cas_launch_update" method="POST">

							<!-- PROCESSOS EM GERAL -->
							<div class="card-body">

								<div class="row">
									<div class="form-group col-sm-6">
										<label style="color: rgb( 205, 205, 205 );" for="PPR_FK_CLIENTE">Cliente:</label>
										<?php
										$SQL = mysqli_query($CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ");
										while ($ROW = mysqli_fetch_array($SQL)) {
											if ($DADOS['PPR_FK_CLIENTE'] == $ROW['CLI_ID']) {
												$FK_CLIENT_NAME = $ROW['CLI_NOME'];
											}
										}
										?>
										<input class="form-control" type="hidden" id="PPR_FK_CLIENTE" name="PPR_FK_CLIENTE" value="<?= $DADOS['PPR_FK_CLIENTE']; ?>" readonly />
										<input class="form-control" type="hidden" id="CLI_NOME" name="CLI_NOME" value="<?= $FK_CLIENT_NAME ?>" readonly />
										<input class="form-control" type="text" value="<?= $FK_CLIENT_NAME; ?>" readonly />
									</div>
									<div class="form-group col-sm-6">
										<label style="color: rgb( 205, 205, 205 );" class="label">Parte Contrária</label>
										<input class="form-control" type="text" id="PPR_PARTE_CONTRARIA" name="PPR_PARTE_CONTRARIA" value="<?= $DADOS['PPR_PARTE_CONTRARIA']; ?>" readonly />
									</div>
								</div>

								<div class="row">
									<div class="form-group col-sm-6">
										<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_NUM_PROCESSO">Número do Processo</label>
										<input class="form-control" type="text" id="PPR_NUM_PROCESSO" name="PPR_NUM_PROCESSO" value="<?= $DADOS['PPR_NUM_PROCESSO']; ?>" readonly />
									</div>
									<div class="form-group col-sm-6">
										<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_COMARCA">Comarca</label>
										<input class="form-control" type="text" id="PPR_COMARCA" name="PPR_COMARCA" value="<?= $DADOS['PPR_COMARCA']; ?>" readonly />
									</div>
								</div>

								<div class="row">
									<div class="form-group col-sm-3">
										<label style="color: rgb( 205, 205, 205 );">Natureza da Ação</label>
										<?php
										$SQL = mysqli_query($CONN, " SELECT * FROM PNA_PROC_NATUREZA ");
										while ($ROW = mysqli_fetch_array($SQL)) {
											if ($DADOS['PPR_FK_NATUREZA'] == $ROW['PNA_ID']) {
												$FK_NATUREZA_NAME = $ROW['PNA_NOME'];
											}
										}
										?>
										<input class="form-control" type="hidden" id="PPR_FK_NATUREZA" name="PPR_FK_NATUREZA" value="<?= $DADOS['PPR_FK_NATUREZA']; ?>" />
										<input class="form-control" type="text" value="<?= $FK_NATUREZA_NAME ?>" readonly />
									</div>
									<div class="form-group col-sm-3">
										<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_MEIO">Digital/Físico</label>
										<?php
										$SQL = mysqli_query($CONN, " SELECT * FROM PME_PROC_MEIO ");
										while ($ROW = mysqli_fetch_array($SQL)) {
											if ($DADOS['PPR_FK_MEIO'] == $ROW['PME_ID']) {
												$FK_MEIO_NAME = $ROW['PME_NOME'];
											}
										}
										?>
										<input class="form-control" type="hidden" id="fk_meio" name="PPR_FK_MEIO" value="<?= $DADOS['PPR_FK_MEIO']; ?>" />
										<input class="form-control" type="text" value="<?= $FK_MEIO_NAME; ?>" readonly />
									</div>
									<div class="form-group col-sm-6">
										<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_TIPO_ACAO">Tipo de Ação</label>
										<input class="form-control" type="text" id="PPR_TIPO_ACAO" name="PPR_TIPO_ACAO" value="<?= $DADOS['PPR_TIPO_ACAO']; ?>" readonly />
									</div>
								</div>
								<br />

								<!--// INICIO DAS INFORMAÇÕES DO CONTRATO -->
								<legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações do Contrato</legend>
								<div class="row" style="justify-content: center; align-items: center; vertical-align: middle;">

									<div class="col-12 col-sm-6 col-md-2"><!--// DATA //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">DATA DO CONTRATO</span>
												<span class="info-box-number">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_CONTRATO" value="<?= date("d/m/Y", strtotime($DADOS['PPR_DT_CONTRATO'])) ?>" readonly />
													</div>
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

									<div class="col-12 col-sm-6 col-md-2"><!--// VALOR //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">VALOR DO CONTRATO</span>
												<span class="info-box-number">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
														<input class="form-control" style="text-align: center;" type="text" name="PPR_VALOR" value="<?= formata_dinheiro($DADOS['PPR_VALOR']) ?>" readonly />
													</div>
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

									<div class="col-12 col-sm-6 col-md-2"><!--// NR PARCELAS //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">NÚMERO DE PARCELAS</span>
												<span class="info-box-number">
													<input class="form-control" style="text-align: center;" type="text" name="PPR_QTD_PARCELA" value="<?= $DADOS['PPR_QTD_PARCELA'] ?>" readonly />
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

									<div class="col-12 col-sm-6 col-md-2"><!--// VR PARCELA //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">VALOR DA PARCELA</span>
												<span class="info-box-number">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
														<input class="form-control" style="text-align: center; font-weight: 700; color: rgb( 205, 205, 205 );" type="text" id="PPR_VALOR_PARCELA" name="PPR_VALOR_PARCELA" value="<?= formata_dinheiro($DADOS['PPR_VALOR_PARCELA']) ?>" readonly />
													</div>
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

									<div class="col-12 col-sm-6 col-md-2"><!--// INICIO PGTO //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">INÍCIO DO PAGAMENTO</span>
												<span class="info-box-number">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_INICIO_PGTO" value="<?= ($DADOS['PPR_DT_INICIO_PGTO'] != 0000 - 00 - 00 ? date("d/m/Y", strtotime($DADOS['PPR_DT_INICIO_PGTO'])) : '') ?>" readonly />
													</div>
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

									<div class="col-12 col-sm-6 col-md-2"><!--// SALDO //-->
										<div class="info-box">
											<div class="info-box-content">
												<span class="info-box-text badge badge-danger" style="font-size: 1.0rem; line-height: 0.9em; color: rgb( 255, 199, 240, 20 ); font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">SALDO DEVEDOR</span>
												<span class="info-box-number">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
														<input class="form-control" style="text-align: center; font-weight: 700; color: rgb( 255, 199, 240, 20 );" type="text" id="PPR_SALDO" name="PPR_SALDO" value="<?= formata_dinheiro($DADOS['PPR_SALDO']) ?>" readonly />
													</div>
												</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div><!-- /.col -->

								</div><!-- /.row -->

								<br />
								<!--// INICIO DOS LANÇAMENTOS //-->
								<div class="row justify-content-center align-items-center alert alert-success" role="alert" style="background: rgb( 52, 58, 64 );">
									<?php
									$SQL = mysqli_query( $CONN, " SELECT PPR_MENSALISTA FROM PPR_PROC_PROCESSOS WHERE PPR_ID = '$id' " );
									$ROW = mysqli_fetch_array( $SQL );
									$PPR_MENSALISTA = $ROW[ 'PPR_MENSALISTA' ];
									if( $PPR_MENSALISTA == 1 ) { ?>
										<div class="form-group" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
											<label style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Última Parcela<sup title="Caso seja a última parcela, este contrato será finalizado." style="color: rgb( 255, 255, 255 );"><strong>&nbsp;(*)</strong></sup></label>
											<div class="custom-control form-control-sm custom-switch">
												<input type="checkbox" class="custom-control-input" name="PARCELA_FIM" value="1" id="customSwitch1">
												<label class="custom-control-label" for="customSwitch1"></label>
											</div>
										</div>
									<?php } ?>
									<div class="form-group col-sm-2" align="center">
										<label style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</label>
										<input class="form-control" type="date" name="PPR_DT_PGTO" value="" autofocus required />
									</div>
									<div class="form-group col-sm-2" align="center">
										<label style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</label>
										<input class="form-control money" type="text" id="valor" name="PPR_VALOR" value="" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" required />
									</div>
								</div>
								<div class="form-group" align="center">
									<input class="form-control" type="hidden" id="id" name="id" value="<?= $id; ?>" />
									<input class="form-control" type="hidden" id="PPP_NR_PARCELA" name="PPP_NR_PARCELA" value="<?= $parc; ?>" />
									<input class="form-control" type="hidden" id="PPR_MENSALISTA" name="PPR_MENSALISTA" value="<?= $PPR_MENSALISTA; ?>" />
									<button class="btn btn-danger btn-md submit_btn" id="btn-lancar" name="btn-lancar" value="btn-lancar" onclick="return confirm('Confirma o lançamento da parcela: ( <?= $parc; ?> ) ?')"><i class="fas fa-edit"></i>&nbsp;Lançar</button>
								</div>

							</div>
						</form>

					</div>

				</div><!-- /.container-fluid -->

			</div><!-- /.Invoice -->

		</div><!-- /.End Container-fluid -->

	</section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>