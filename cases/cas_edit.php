<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

	// Selecionando o ID do processo a ser Editado/Alterado
	if( isset( $_GET[ 'id' ] ) ) {
		// $id = $_GET[ 'id' ];
        // Certifique-se de que o ID está sendo filtrado de maneira segura para evitar SQL Injection
        $id = mysqli_real_escape_string($CONN, $_GET['id']);
		$SQL = mysqli_query( $CONN, " SELECT PRO.*
																		FROM PPR_PROC_PROCESSOS PRO
																		JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PRO.PPR_FK_PASTA
																		JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PRO.PPR_FK_CLIENTE
																		JOIN PHO_PROC_HONORARIOS HON ON HON.PHO_ID = PRO.PPR_FK_HONORARIOS
																		JOIN PDE_PROC_DEFENSORIA DEF ON DEF.PDE_ID = PRO.PPR_FK_DEFENSORIA
																		JOIN PNA_PROC_NATUREZA NAT ON NAT.PNA_ID = PRO.PPR_FK_NATUREZA
																		JOIN PME_PROC_MEIO MEI ON MEI.PME_ID = PRO.PPR_FK_MEIO
																		JOIN STA_STATUS STA ON STA.STA_ID = PRO.PPR_FK_STATUS
																		JOIN PIN_PROC_INSS INS ON INS.PIN_ID = PRO.PPR_FK_INSS
																		JOIN PTD_PROC_TABELA_DEF TBD ON TBD.PTD_ID = PRO.PPR_FK_COD_ACAO
																		JOIN PPE_PROC_PERCENTUAL PER ON PER.PPE_ID = PRO.PPR_FK_PERCENTUAL
 																	 WHERE PRO.PPR_ID = '$id' ");
		$DADOS = mysqli_fetch_array( $SQL );
	}
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $caseUpdt; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid">

					<form id="CAS_UPDT" name="CAS_UPDT" class="signin-form" formname="cases" action="?pg=cases/cas_edit_update" method="POST">

						<!-- PROCESSOS EM GERAL -->
						<div class="card-body">
							<legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Processos em Geral</legend>
							<div class="row">
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_CASO">#Caso</label>
									<input type="hidden" id="id" name="id" value="<?= $id; ?>" />
									<input class="form-control" type="text" id="PPR_CASO" name="PPR_CASO" value="<?= $DADOS[ 'PPR_CASO' ]; ?>" autofocus />
								</div>
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_STATUS">Status</label>
									<div>
										<select class="form-control" id="PPR_FK_STATUS" name="PPR_FK_STATUS">
											<?php
												$QR = mysqli_query( $CONN, " SELECT * FROM STA_STATUS ");
												while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
													<option value="<?= $ROW[ 'STA_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_STATUS' ] == $ROW[ 'STA_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'STA_NAME' ]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_HONORARIOS">Honorários</label>
									<div>
										<select class="form-control" id="PPR_FK_HONORARIOS" name="PPR_FK_HONORARIOS">
											<?php
												$SQL = mysqli_query( $CONN, " SELECT * FROM PHO_PROC_HONORARIOS ORDER By PHO_ID DESC ");
												while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
													<option value="<?= $ROW[ 'PHO_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_HONORARIOS' ] == $ROW[ 'PHO_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PHO_NOME' ]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_DEFENSORIA">Defensoria</label>
									<div>
										<select class="form-control" id="PPR_FK_DEFENSORIA" name="PPR_FK_DEFENSORIA">
											<?php
												$SQL = mysqli_query( $CONN, " SELECT * FROM PDE_PROC_DEFENSORIA ORDER By PDE_ID DESC ");
												while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
													<option value="<?= $ROW[ 'PDE_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == $ROW[ 'PDE_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PDE_NOME' ]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_PASTA">Pasta</label>
									<select class="form-control" name="PPR_FK_PASTA">
										<?php
											$SQL = mysqli_query( $CONN, " SELECT * FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
											while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
												<option value="<?= $ROW[ 'PAS_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_PASTA' ] == $ROW[ 'PAS_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PAS_NOME' ]; ?></option>
										<?php }	?>
									</select>
								</div>
								<div class="form-group col-sm-2">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_CREDITO_PODRE">Crédito Perdido</label>
									<select class="form-control" name="PPR_CREDITO_PODRE">
										<?php
											$SQL = mysqli_query( $CONN, " SELECT PPR_ID, PPR_CREDITO_PODRE FROM PPR_PROC_PROCESSOS WHERE PPR_ID = '$id' ");
											// Verifica se o resultado da query é válido
                                            if ($SQL && mysqli_num_rows($SQL) > 0) {
                                                // Busca os dados da consulta
                                                $row = mysqli_fetch_assoc($SQL);
                                                $creditoPodre = $row['PPR_CREDITO_PODRE'];
                                            } else {
                                                echo "Registro não encontrado!";
                                                exit;
                                            }

                                            // Verifica se a função já foi declarada
                                            if (!function_exists('selected')) {
                                                function selected($value, $option) {
                                                    return $value == $option ? 'selected' : '';
                                                }
                                            }
                                        ?>
                                        <option value="0" <?= selected($creditoPodre, 0); ?>>Não</option>
                                        <option value="1" <?= selected($creditoPodre, 1); ?>>Sim</option>
									</select>
								</div>
							</div>

							<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

							<div class="row">
								<div class="form-group col-sm-6">
									<label style="color: rgb( 205, 205, 205 );" for="PPR_FK_CLIENTE">Cliente:</label>
									<select class="form-control" name="PPR_FK_CLIENTE" id="PPR_FK_CLIENTE">
										<?php
											$QR = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ");
											while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
												<option value="<?= $ROW[ 'CLI_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_CLIENTE' ] == $ROW[ 'CLI_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'CLI_NOME' ]; ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group col-sm-6">
									<label style="color: rgb( 205, 205, 205 );" class="label">Parte Contrária</label>
									<input class="form-control" type="text" name="PPR_PARTE_CONTRARIA" value="<?= $DADOS[ 'PPR_PARTE_CONTRARIA' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
								</div>
							</div>

							<div class="row">
								<div class="form-group col-sm-6">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_NUM_PROCESSO">Número do Processo</label>
									<input class="form-control" type="text" id="PPR_NUM_PROCESSO" name="PPR_NUM_PROCESSO" value="<?= $DADOS[ 'PPR_NUM_PROCESSO' ]; ?>" onkeypress="$(this).mask('0000000-00.0000.0.00.0000');" />
								</div>
								<div class="form-group col-sm-6">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_COMARCA">Comarca</label>
									<input class="form-control" type="text" id="PPR_COMARCA" name="PPR_COMARCA" value="<?= $DADOS[ 'PPR_COMARCA' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
								</div>
							</div>

							<div class="row">
								<div class="form-group col-sm-3">
									<label style="color: rgb( 205, 205, 205 );">Natureza da Ação</label>
									<select class="form-control" id="PPR_FK_NATUREZA" name="PPR_FK_NATUREZA">
										<?php
											$QR = mysqli_query( $CONN, " SELECT * FROM PNA_PROC_NATUREZA ORDER By PNA_NOME ");
											while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
											<option value="<?= $ROW[ 'PNA_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_NATUREZA' ] == $ROW[ 'PNA_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PNA_NOME' ]; ?></option>
										<?php }	?>
									</select>
								</div>
								<div class="form-group col-sm-3">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_MEIO">Digital/Físico</label>
									<select class="form-control" id="PPR_FK_MEIO" name="PPR_FK_MEIO">
										<?php
											$QR = mysqli_query( $CONN, " SELECT * FROM PME_PROC_MEIO ");
											while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
											<option value="<?= $ROW[ 'PME_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_MEIO' ] == $ROW[ 'PME_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PME_NOME' ]; ?></option>
										<?php }	?>
									</select>
								</div>
								<div class="form-group col-sm-6">
									<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_TIPO_ACAO">Tipo de Ação</label>
									<input class="form-control" type="text" id="PPR_TIPO_ACAO" name="PPR_TIPO_ACAO" value="<?= $DADOS[ 'PPR_TIPO_ACAO' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
								</div>
							</div>

							<!-- INFORMAÇÕES DO CONTRATO -->
							<?php
								if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == 2 ) {
									echo '<legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações do Contrato</legend>';
										echo '<div class="row" style="display: flex; flex-direction: row; justify-content: center; align-items: center; text-align: center;">';
											echo '<div class="form-group col-sm-2">';
												echo '<label style="color: rgb( 205, 205, 205 );">Data do Contrato</label>';
												echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_CONTRATO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_CONTRATO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10" />';
											echo '</div>';
											echo '<div class="form-group col-sm-2">';
												echo '<label style="color: rgb( 205, 205, 205 );">Valor do Contrato</label>';
												echo '<input class="form-control money" id="valor" style="text-align: center;" type="text" name="PPR_VALOR" value=" ' . number_format($DADOS[ 'PPR_VALOR' ],2,",",".") . ' " placeholder=" '. formata_dinheiro( $DADOS[ 'PPR_VALOR' ] ) . ' " maxlength="9" data-precision="2" onkeypress="$(\'.money\').mask(\'000.000.000.000.000,00\', {reverse: true}); " />';
											echo '</div>';
											echo '<div class="form-group col-sm-2">';
												echo '<label style="color: rgb( 205, 205, 205 );">Número de parcelas</label>';
												echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_QTD_PARCELA" value=" ' . $DADOS[ 'PPR_QTD_PARCELA' ] . ' " />';
											echo '</div>';
											echo '<div class="form-group col-sm-2">';
												echo '<label style="color: rgb( 205, 205, 205 );">Dia do Pagamento</label>';
												echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DIA_PGTO" value=" ' . $DADOS[ 'PPR_DIA_PGTO' ] . ' " />';
											echo '</div>';
											echo '<div class="form-group col-sm-2">';
												echo '<label style="color: rgb( 205, 205, 205 );">Início do Pagamento</label>';
												echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_INICIO_PGTO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_INICIO_PGTO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
											echo '</div>';
										echo '</div>';
								}
							?>

							<!-- PROCESSOS DE CONVÊNIOS DPE-OAB/SP -->
							<?php
								if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == 1 ) {
									echo '<legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações do Convênio DPE-OAB/SP</legend>';
									echo '<div class="row">';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_COD_ACAO">Código de Ação</label>';
											echo '<select class="form-control" name="PPR_FK_COD_ACAO">';
															$QR = mysqli_query( $CONN, " SELECT * FROM PTD_PROC_TABELA_DEF ");
															while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
																<option value="<?= $ROW[ 'PTD_ID' ]; ?>"<?php if( $DADOS[ 'PPR_FK_COD_ACAO' ] == $ROW[ 'PTD_ID' ] ) {?>selected<?php } ?>><?= $ROW[ 'PTD_COD_ACAO' ]; ?></option>
															<?php }	?>
										<?php
											echo '</select>';
										echo '</div>';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );">Nomeação</label>';
											echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_NOMEACAO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_NOMEACAO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
										echo '</div>';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );">Sentença</label>';
											echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_PUB_SENTENCA" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_PUB_SENTENCA' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
										echo '</div>';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );">Transito</label>';
											echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_TRANS_JULGADO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_TRANS_JULGADO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
										echo '</div>';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );">Envio Certidão</label>';
											echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_ENVIO_CERTIDAO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_ENVIO_CERTIDAO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
										echo '</div>';
										echo '<div class="form-group col-sm-2">';
											echo '<label style="color: rgb( 205, 205, 205 );">Recebimento</label>';
											echo '<input class="form-control" style="text-align: center;" type="text" name="PPR_DT_RECEBIMENTO" value=" ' . date( 'd/m/Y', strtotime( $DADOS[ 'PPR_DT_RECEBIMENTO' ] ) ) . ' " onkeyup="var v = this.value; if (v.match(/^\d{2}$/) !== null) { this.value = v + \'/\'; } else if (v.match(/^\d{2}\/\d{2}$/) !== null) { this.value = v + \'/\'; }" maxlength="10"/>';
										echo '</div>';
									echo '</div>';
									echo '<div class="row">';
										echo '<div class="form-group col-sm-3">';
											echo '<label style="color: rgb( 205, 205, 205 );">Percentual pago</label>';
											echo '<select id="select" onChange="pSel(this.value);" class="form-control" name="PPR_FK_PERCENTUAL">';
															$QR = mysqli_query( $CONN, " SELECT * FROM PPE_PROC_PERCENTUAL ");
															while( $ROW = mysqli_fetch_array( $QR ) ) {
																echo '<option value=" ' . $ROW[ 'PPE_ID' ] . ' " ' . ( $DADOS[ 'PPR_FK_PERCENTUAL' ] == $ROW[ 'PPE_ID' ] ? ' selected ' :  '' ) . '> ' . $ROW[ 'PPE_VALOR' ] . '</option>';
															}
											echo '</select>';
										echo '</div>';
										echo '<div class="form-group col-sm-3">';
											echo '<label style="color: rgb( 205, 205, 205 );">Valor da tabela</label>';
											echo '<input class="form-control money" type="text" id="valor" name="PPR_VALOR_TABELA" value=" '. formata_dinheiro( $DADOS[ 'PPR_VALOR_TABELA' ] ) . ' " placeholder=" '. formata_dinheiro( $DADOS[ 'PPR_VALOR_TABELA' ] ) . ' " maxlength="9" data-precision="2" onkeypress="$(\'.money\').mask(\'000.000.000.000.000,00\', {reverse: true});" />';
										echo '</div>';
										echo '<div class="form-group col-sm-3">';
											echo '<label style="color: rgb( 205, 205, 205 );">% Retenção INSS</label>';
											echo '<select class="form-control" name="PPR_FK_INSS">';
															$QR = mysqli_query( $CONN, " SELECT * FROM PIN_PROC_INSS ");
															while( $ROW = mysqli_fetch_array( $QR ) ) {
																echo '<option value=" ' . $ROW[ 'PIN_ID' ] . ' " ' . ( $DADOS[ 'PPR_FK_INSS' ] == $ROW[ 'PIN_ID' ] ? ' selected ' :  '' ) . '> ' . $ROW[ 'PIN_PERCENTUAL' ] . '</option>';
															}
											echo '</select>';
										echo '</div>';
									echo '</div>';
								}
							?>

							<!-- OBSERVAÇÕES -->
							<legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Observações</legend>
							<div class="row">
								<div class="form-group col-sm-12">
									<textarea class="form-control" name="PPR_OBS" cols="20" rows="5" onkeyup="this.value = this.value.toUpperCase();"><?= $DADOS[ 'PPR_OBS' ]; ?></textarea>
								</div>
							</div>

							<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

							<div class="submit" align="center">
								<button class="btn btn-danger btn-sm submit_btn" id="btn-updt" name="btn-updt" value="btn-updt"><i class="fas fa-database"></i>&nbsp;Salvar</button>
							</div>

						</div>

					</form>

				</div><!-- /.container-fluid -->

			</div><!-- /.Invoice -->

		</div><!-- /.End Container-fluid -->

	</section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>