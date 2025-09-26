<?php
if (!isset($_SESSION)) session_start();
$required_level = 2;
require_once(__DIR__ . '/../access/level.php');
require_once(__DIR__ . '/../access/conn.php');
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../dist/func/functions.php');

if( isset( $_GET[ 'mes' ] ) )
$MES_HOJE = $_GET[ 'mes' ];
else
$MES_HOJE = date( 'm' );

if( isset( $_GET[ 'ano' ] ) )
$ANO_HOJE = $_GET[ 'ano' ];
else
$ANO_HOJE = date( 'Y' );
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
					<legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle">Relatório de pagamentos</span></legend>
				</div>

                <!-- Área do Gráfico -->
                <div style="background-color: #212529; padding: 10px; border: 1px solid rgb( 69, 103, 147 );">
                    <?php
                        // Consulta para obter os valores
                        // $SQL = "SELECT CONCAT(MONTHNAME(PPP.PPP_DT_PGTO), ' ', YEAR(PPP.PPP_DT_PGTO)) AS mes_ano,
                        //                SUM(PPP.PPP_VALOR) AS total
                        //           FROM PPP_PROC_PROCESSOS_PGTO PPP
                        //          WHERE PPP.PPP_DT_PGTO >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
                        //       GROUP BY mes_ano
                        //       ORDER BY PPP.PPP_DT_PGTO ASC
                        //        ";

                        $SQL = "SELECT CONCAT(UPPER(DATE_FORMAT(PPP.PPP_DT_PGTO, '%b')), ' ', YEAR(PPP.PPP_DT_PGTO)) AS mes_ano,
                                       YEAR(PPP.PPP_DT_PGTO) AS ano,
                                       SUM(PPP.PPP_VALOR) AS total
                                  FROM PPP_PROC_PROCESSOS_PGTO PPP
                                 WHERE PPP.PPP_DT_PGTO >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
                              GROUP BY mes_ano
                              ORDER BY PPP.PPP_DT_PGTO ASC
                               ";

                        $result = $CONN->query($SQL);

                        $dados = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $dados[] = [
                                    'mes' => $row['mes_ano'],
                                    'valor' => (float)$row['total']
                                ];
                            }
                        }

                        // Consulta para calcular a média mensal dos recebimentos
                        $SQL = " SELECT AVG(total) AS media_mensal
                                   FROM (
                                          SELECT SUM(PPP.PPP_VALOR) AS total
                                            FROM PPP_PROC_PROCESSOS_PGTO PPP
                                           WHERE PPP.PPP_DT_PGTO >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
                                        GROUP BY MONTH(PPP.PPP_DT_PGTO), YEAR(PPP.PPP_DT_PGTO)
                                        ) AS subconsulta;
                               ";

                        $result_media = $CONN->query($SQL);
                        $row = $result_media->fetch_assoc();
                        $media_mensal = $row['media_mensal'];
                    ?>
                    <style>
                        /* Tamanho do Gráfico */
                        canvas {
                            max-width: 100%;
                            max-height: 80%;
                        }
                    </style>

                    <span class="text-fmt border-right" style="color: rgb( 90, 158, 247 );">Total Recebido Mês a Mês </span>&nbsp;
                    <span class="text-fmt" style="color: rgb( 212, 228, 247 );">Média mensal: <?= formata_dinheiro($media_mensal); ?></span>

                    <canvas class="text-fmt-normal" id="grafico"></canvas>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Plugin para exibir valores -->
                    <script>
                        // Dados do PHP inseridos diretamente no JavaScript
                        const dadosPHP = <?php echo json_encode($dados); ?>;

                        // Extrai os rótulos (meses) e valores
                        const meses = dadosPHP.map(item => item.mes);
                        const valores = dadosPHP.map(item => item.valor);

                        // Configuração do gráfico
                        const ctx = document.getElementById('grafico').getContext('2d');
                        const grafico = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: meses,
                                datasets: [{
                                    label: 'Valor Recebido (R$)',
                                    data: valores,
                                    backgroundColor: 'rgb( 69, 103, 147 )', /* Cor das barras */
                                    borderColor: 'rgb( 69, 103, 147 )',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `R$ ${context.raw.toFixed(2)}`;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        color: 'rgb( 212, 228, 247 )', // Cor do texto acima da barra
                                        anchor: 'end',    // Posicionamento
                                        align: 'top',     // Alinhamento
                                        formatter: function(value) {
                                            return `R$ ${value.toFixed(2)}`;
                                        },
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: 'rgb( 211, 209, 193 )', /* Cor das legendas no eixo X */
                                            font: {
                                                size: 12
                                            }
                                        },
                                        grid: {
                                            color: 'rgb( 65, 69, 76 )', // Cor da grade no eixo X
                                            lineWidth: 1 // Largura da linha da grade
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: 'rgb( 211, 209, 193 )', /* Cor das legendas no eixo Y */
                                            font: {
                                                size: 12
                                            },
                                            callback: function(value) {
                                                return `R$ ${value}`;
                                            }
                                        },
                                        grid: {
                                            color: 'rgb( 65, 69, 76 )', // Cor da grade no eixo Y
                                            lineWidth: 1 // Largura da linha da grade
                                        }
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] // Habilitando o plugin de exibição dos valores
                        });
                    </script>
                </div>

				<div class="container-fluid text-fmt-normal">

					<div class="row mt-1 mb-1" style="background-color: rgb( 63, 71, 78 );">

                        <!-- /.FAIXA DO MES -->
                        <div class="col-auto mt-1 mb-1 text-left">
                            <select class="form-control" onchange="location.replace('?pg=cases/cas_report&ano=<?= $ANO_HOJE; ?>&mes='+this.value)">
                                <?php for( $i = 1; $i <= 12; $i++  ) { ?>
                                    <option value="<?= $i; ?>" <?php if( $i == $MES_HOJE ) echo "selected=selected"?> ><?= mostraMes( $i ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-auto mt-1 mb-1 text-left">
                            <select class="form-control" onchange="location.replace('?pg=cases/cas_report&mes=<?= $MES_HOJE; ?>&ano='+this.value)">
                                <?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
                                    <option value="<?= $i; ?>" <?php if( $i == $ANO_HOJE ) echo "selected=selected"?> ><?= $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-auto mt-1 mb-1 text-left border-right">
                            <h3 style="color: rgb( 253, 224, 139 );"><i class="icon fas fa-calendar"></i>&nbsp;<?= mostraMes( $MES_HOJE ) . '/' . $ANO_HOJE; ?></h3>
                        </div>
                        <div class="col-auto mt-1 mb-1 text-left">
                            <a href="?pg=cases/cas_report"><h3 style="color: rgb( 122, 194, 255 );"><i class="icon fas fa-calendar"></i>&nbsp;Mês atual</h3></a>
                        </div>

					</div>

                    <div class="row card-footer mt-1 mb-1" style="color: rgb( 211, 211, 213 ); border: 1px solid rgb( 64, 69, 76 );">

                        <div class="col-sm text-left">
                            <?php
                            // COLETANDO O TOTAL DE CONTRATOS VENCIDOS
                            $SQL = mysqli_query($CONN, "	SELECT  COUNT( C.PPP_FK_PROCESSO ) AS CONTRATOS
                                                            FROM(
                                                                    SELECT  CLI.CLI_NOME,
                                                                            MAX(PPP.PPP_DT_VENCIMENTO) AS CONTRATOS,
                                                                            PPP_FK_PROCESSO,
                                                                            MAX(PPR.PPR_ID) AS PPR_ID,
                                                                            MAX(PPR.PPR_TIPO_ACAO) AS PPR_TIPO_ACAO,
                                                                            MAX(PPR.PPR_VALOR_TOTAL) AS PPR_VALOR_TOTAL,
                                                                            MAX(PPR.PPR_QTD_PARCELA) AS PPR_QTD_PARCELA,
                                                                            MAX(PPR.PPR_VALOR_PARCELA) AS PPR_VALOR_PARCELA,
                                                                            MAX(PPR.PPR_SALDO) AS PPR_SALDO,
                                                                            MAX(PAS.PAS_NOME) AS PAS_NOME
                                                                    FROM    PPR_PROC_PROCESSOS PPR
                                                                    JOIN    PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                                                    JOIN    CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                                                    JOIN    PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
                                                                    WHERE   MONTH(PPP.PPP_DT_PGTO) = '$MES_HOJE'
                                                                    AND     YEAR(PPP.PPP_DT_PGTO) = '$ANO_HOJE'
                                                                GROUP BY CLI.CLI_NOME
                                                                ORDER BY CONTRATOS DESC
                                                                ) AS C
                                                        " );
                            $C = mysqli_fetch_assoc($SQL);
                            $CONTRATOS = $C['CONTRATOS'];

                            // COLETANDO QUANTIDADE E TOTAL DE PARCELAS VENCIDAS
                            $SQL = mysqli_query($CONN, "	SELECT COUNT( PPP.PPP_ID ) AS VENCIDOS,
                                                                SUM( PPP.PPP_VALOR ) AS TOTAL,
                                                                PPR.PPR_ID,
                                                                PPR.PPR_TIPO_ACAO,
                                                                PPR.PPR_VALOR_TOTAL,
                                                                PPR.PPR_QTD_PARCELA,
                                                                PPR.PPR_VALOR_PARCELA,
                                                                PPR.PPR_SALDO,
                                                                PPR.PPR_FK_PASTA,
                                                                PPR.PPR_FK_STATUS,
                                                                CLI.CLI_NOME,
                                                                PAS.PAS_NOME
                                                            FROM PPR_PROC_PROCESSOS PPR
                                                            JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                                            JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                                            JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
                                                            WHERE MONTH(PPP.PPP_DT_PGTO) = '$MES_HOJE'
                                                            AND YEAR(PPP.PPP_DT_PGTO) = '$ANO_HOJE'
                                                        ORDER BY PPP.PPP_DT_VENCIMENTO DESC
                                                    " );
                            $R = mysqli_fetch_assoc($SQL);
                            $VENCIDOS = $R['VENCIDOS'];
                            $TOTAL = $R['TOTAL'];
                            ?>

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
                                    <span class="description-text">Valor Total</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                        </div>

                    </div>

					<table id="cas" class="table table-dark table-striped table-hover table-sm text-fmt-normal">
						<caption>Resultado da consulta</caption>
						<thead class="thead-dark">
							<tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
                                    ID</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Cliente</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Procedimento</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Pasta</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Valor Contrato</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Total Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Nr. Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Valor Parc</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Saldo</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Vencimento</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Pagamento</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Ativo</th>
								<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
									Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$SQL = " SELECT DISTINCT
                                                PPP.*,
                                                PPR.PPR_ID,
                                                PPR.PPR_TIPO_ACAO,
                                                PPR.PPR_VALOR_TOTAL,
                                                PPR.PPR_QTD_PARCELA,
                                                PPR.PPR_VALOR_PARCELA,
                                                PPR.PPR_SALDO,
                                                PPR.PPR_FK_PASTA,
                                                PPR.PPR_FK_STATUS,
                                                CLI.CLI_NOME,
                                                PAS.PAS_NOME
                                           FROM PPR_PROC_PROCESSOS PPR
                                           JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                           JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                           JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
                                          WHERE MONTH(PPP.PPP_DT_PGTO) = '$MES_HOJE'
                                            AND YEAR(PPP.PPP_DT_PGTO) = '$ANO_HOJE'
                                       ORDER BY PPP.PPP_DT_VENCIMENTO DESC
									   ";

								$RESULTADO = mysqli_query($CONN, $SQL);
								$VERIFICA = mysqli_num_rows($RESULTADO);

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
                                                echo '<span style="color: ' . colorItem( $PASTA ) . '; font-size: 0.8em; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</span>';
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
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 239, 163, 170 ); text-transform: uppercase; font-size: 0.8em; font-weight: 700;">
											<?php
											if ($DADOS['PPP_DT_PGTO'] == "0000-00-00") {
												echo ' --- ';
											} else {
												echo $PPP_DT_PGTO = date("d/m/Y", strtotime($DADOS['PPP_DT_PGTO']));
											}
											?>
										</td>
										<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
											<?php
											if ($DADOS['PPR_FK_STATUS'] == 1) {
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