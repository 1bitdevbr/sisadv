<?php
if (!isset($_SESSION)) session_start();
$required_level = 2;
require_once(__DIR__ . '/../access/level.php');
require_once(__DIR__ . '/../access/conn.php');
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../dist/func/functions.php');
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
					<legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle">Parcelas Vencidas</span></legend>
				</div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid">

					<div class="row">

                            <div class="form-group col-sm text-left" style="color: rgb( 211, 211, 213 );">
                                <?php
                                // COLETANDO O TOTAL DE CONTRATOS VENCIDOS
                                $SQL = mysqli_query($CONN, "	SELECT COUNT( C.PPP_FK_PROCESSO ) AS CONTRATOS
                                                                FROM(
                                                                        SELECT PPP.PPP_FK_PROCESSO
                                                                        FROM PPP_PROC_PROCESSOS_PGTO PPP
                                                                        JOIN PPR_PROC_PROCESSOS PPR ON PPR.PPR_ID = PPP.PPP_FK_PROCESSO
                                                                        WHERE PPP.PPP_DT_VENCIMENTO <= NOW()
                                                                        AND PPP.PPP_DT_PGTO = '0000-00-00'
                                                                        AND PPP.PPP_STATUS = 1
                                                                        AND PPR.PPR_CREDITO_PODRE = 0
                                                                    GROUP BY PPP.PPP_FK_PROCESSO
                                                                    ) AS C
                                                            " );
                                $C = mysqli_fetch_assoc($SQL);
                                $CONTRATOS = $C['CONTRATOS'];

                                // COLETANDO QUANTIDADE E TOTAL DE PARCELAS VENCIDAS
                                $SQL = mysqli_query($CONN, "	SELECT COUNT( PPP.PPP_ID ) AS VENCIDOS,
                                                                    SUM( PPP.PPP_VALOR ) AS TOTAL
                                                                FROM PPP_PROC_PROCESSOS_PGTO PPP
                                                                JOIN PPR_PROC_PROCESSOS PPR ON PPR.PPR_ID = PPP.PPP_FK_PROCESSO
                                                                WHERE PPP.PPP_DT_VENCIMENTO <= NOW()
                                                                AND PPP.PPP_DT_PGTO = '0000-00-00'
                                                                AND PPP.PPP_STATUS = 1
                                                                AND PPR.PPR_CREDITO_PODRE = 0
                                                        " );
                                $R = mysqli_fetch_assoc($SQL);
                                $VENCIDOS = $R['VENCIDOS'];
                                $TOTAL = $R['TOTAL'];
                                ?>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                            <h5 class="description-header"><?= $CONTRATOS; ?></h5>
                                            <span class="description-text">Total de contratos</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                            <h5 class="description-header"><?= $VENCIDOS; ?></h5>
                                            <span class="description-text">Total de Parcelas</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                            <h5 class="description-header"><?= formata_dinheiro($TOTAL); ?></h5>
                                            <span class="description-text">Valor Total Vencido</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>
                            </div>

					</div>

					<!-- /.BLOCO FILTRO -->
					<hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

					<div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
						<div class="col-10 mt-2 mb-0">
							<caption style="color: rgb( 254, 214, 122 );">Filtro por pasta</caption>
						</div>
						<div class="col-2 mt-1 mb-1 text-right">
							<form name="form_filter_cat" action="<?= $_SERVER['REQUEST_URI']; ?>" method="GET">
								<input type="hidden" name="pg" value="cases/cas_expired" />
								<select class="form-control" class="mt-1 mb-1" name="filter_cat" onchange="form_filter_cat.submit()">
									<option value="ALL">TODOS</option>
									<?php
									$QR = mysqli_query($CONN, " SELECT DISTINCT PAS.PAS_ID, PAS.PAS_NOME
                                                                  FROM PAS_PROC_PASTA PAS, CLI_CLIENTES CLI
                                                                 WHERE CLI.CLI_FK_PASTA = PAS.PAS_ID
                                                              " );
									while ($ROW = mysqli_fetch_array($QR)) {
									?>
										<option <?php if (isset($_GET['filter_cat']) && $_GET['filter_cat'] == $ROW['PAS_ID']) echo "selected=selected" ?> value="<?= $ROW['PAS_ID']; ?>"><?= $ROW['PAS_NOME']; ?></option>
									<?php } ?>
								</select>
							</form>
						</div>
					</div>

					<hr class="mt-1 mb-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

					<table id="cas" class="table table-dark table-striped table-hover table-sm">
						<caption>Resultado da consulta</caption>
						<thead class="thead-dark">
							<tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
                                    ID</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Cliente</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Procedimento</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Pasta</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									$ Contrato</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Total Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Nr. Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Valor Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Saldo</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Vencimento</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Ativo</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
									Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$filter = "";
							if (isset($_GET['filter_cat']) && $_GET['filter_cat'] != 'ALL') {
								$filter = "PPR.PPR_FK_PASTA = '" . $_GET['filter_cat'] . "' ";

								$SQL = " SELECT DISTINCT
                                                PPP.*,
                                                PPR.PPR_ID,
                                                PPR.PPR_TIPO_ACAO,
                                                PPR.PPR_VALOR_TOTAL,
                                                PPR.PPR_QTD_PARCELA,
                                                PPR.PPR_VALOR_PARCELA,
                                                PPR.PPR_SALDO,
                                                PPR.PPR_FK_PASTA,
                                                CLI.CLI_NOME,
                                                PAS.PAS_NOME
                                           FROM PPR_PROC_PROCESSOS PPR
                                           JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                           JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                           JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
                                          WHERE PPP.PPP_DT_VENCIMENTO <= NOW()
										    AND PPP.PPP_DT_PGTO = '0000-00-00'
											AND PPP.PPP_STATUS = 1
                                            AND $filter
                                            AND PPR.PPR_CREDITO_PODRE = 0
									   GROUP BY CLI.CLI_NOME, PPP.PPP_DT_VENCIMENTO
									   ORDER BY CLI.CLI_NOME, PPP.PPP_DT_VENCIMENTO DESC
									  ";

								$RESULTADO = mysqli_query($CONN, $SQL);
								$VERIFICA = mysqli_num_rows($RESULTADO);
							} else {

								$SQL = " SELECT DISTINCT
                                                PPP.*,
                                                PPR.PPR_ID,
                                                PPR.PPR_TIPO_ACAO,
                                                PPR.PPR_VALOR_TOTAL,
                                                PPR.PPR_QTD_PARCELA,
                                                PPR.PPR_VALOR_PARCELA,
                                                PPR.PPR_SALDO,
                                                PPR.PPR_FK_PASTA,
                                                CLI.CLI_NOME,
                                                PAS.PAS_NOME
                                           FROM PPR_PROC_PROCESSOS PPR
                                           JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                           JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                           JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
                                          WHERE PPP.PPP_DT_VENCIMENTO <= NOW()
                                            AND PPP.PPP_DT_PGTO = '0000-00-00'
                                            AND PPP.PPP_STATUS = 1
                                            AND PPR.PPR_CREDITO_PODRE = 0
                                       GROUP BY CLI.CLI_NOME, PPP.PPP_DT_VENCIMENTO
                                       ORDER BY CLI.CLI_NOME, PPP.PPP_DT_VENCIMENTO DESC
									   ";

								$RESULTADO = mysqli_query($CONN, $SQL);
								$VERIFICA = mysqli_num_rows($RESULTADO);
							}

							if ($VERIFICA > 0) {
								while ($DADOS = mysqli_fetch_assoc($RESULTADO)) {
							?>
									<tr>
                                        <th scope="row" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
                                            <?= $DADOS['PPR_ID']; ?></th>
										<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= $DADOS['CLI_NOME']; ?></td>
										<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= $DADOS['PPR_TIPO_ACAO']; ?></td>
										<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
											<?php
											if ($DADOS['PPR_FK_PASTA']) {
												$PASTA = $DADOS['PPR_FK_PASTA'];
                        echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</h7>';
											}
											?>
										</td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= formata_dinheiro($DADOS['PPR_VALOR_TOTAL']); ?></td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= $DADOS['PPR_QTD_PARCELA']; ?></td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= $DADOS['PPP_NR_PARCELA']; ?></td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= formata_dinheiro($DADOS['PPR_VALOR_PARCELA']); ?></td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
											<?= formata_dinheiro($DADOS['PPR_SALDO']); ?></td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 239, 163, 170 ); text-transform: uppercase; font-size: 0.8em; font-weight: 700;">
											<?php
											if ($DADOS['PPP_DT_VENCIMENTO'] == "0000-00-00") {
												echo ' --- ';
											} else {
												echo $PPP_DT_VENCIMENTO = date("d/m/Y", strtotime($DADOS['PPP_DT_VENCIMENTO']));
											}
											?>
										</td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
											<?php
											if ($DADOS['PPP_STATUS'] == 1) {
												echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
											} else {
												echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
											}
											?>
										</td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
											<a href="?pg=cases/cas_view&id=<?= $DADOS['PPR_ID']; ?>" class="btn btn-outline-success" title="Ver"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>

				</div><!-- /.container-fluid -->

			</div>

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close($CONN); ?>