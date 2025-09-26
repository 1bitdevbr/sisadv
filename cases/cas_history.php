<?php
    if( !isset( $_SESSION ) ) session_start();
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
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $caseHistory; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <div class="container-fluid">

                    <div class="row">
						<div class="form-group col-sm text-left" style="color: rgb( 211, 211, 213 );">
							<?php
                                $SQL = mysqli_query( $CONN, " SELECT SUM( PPR_VALOR_TOTAL ) AS TOTAL,
                                                                                                     SUM( PPR_TOTAL_JUROS ) AS JUROS,
                                                                                                     SUM( PPR_SALDO ) AS SALDO
                                                                                         FROM PPR_PROC_PROCESSOS
                                                                                      WHERE PPR_FK_STATUS = 2 AND
                                                                                                     PPR_FK_DEFENSORIA = 2 AND
                                                                                                     PPR_SALDO = 0
                                                                                     " );
                                $R = mysqli_fetch_assoc( $SQL );
                                $PPR_VALOR_TOTAL = $R[ 'TOTAL' ];
                                $TOTAL_JUROS = $R[ 'JUROS' ];
                                $SALDO = $R[ 'SALDO' ];
								?>
								<span style="text-align: left; color: rgb( 254, 214, 122 );">Total de contratos: <b><?= numfmt_format_currency( $PADRAO, $PPR_VALOR_TOTAL, "BRL" ); ?></b></span><br />
								<span style="text-align: left;">Total de juros: <b><?= numfmt_format_currency( $PADRAO, $TOTAL_JUROS, "BRL" ); ?></b></span><br />
								<span style="text-align: left;">Saldo pendente: <b><?= numfmt_format_currency( $PADRAO, $SALDO, "BRL" ); ?></b></span>
						</div>
					</div>

					<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                    <!-- INÍCIO DA PESQUISA -->
                    <table id="default" class="table table-dark table-striped table-hover table-sm">
                        <caption>Resultado da consulta</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Cliente</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Procedimento</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Pasta</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">$ Devido</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Parc</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Início</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Fim</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">$ Parc</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">$ Pago</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Saldo</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ativo</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $SQL = " SELECT PPR.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME
                                                  FROM PPR_PROC_PROCESSOS PPR
                                                    JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                                    JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                               WHERE PPR.PPR_FK_DEFENSORIA = 2
                                                    AND PPR.PPR_SALDO = 0
                                          ORDER By CLI.CLI_NOME
                                             ";
                                $RESULTADO = mysqli_query( $CONN, $SQL );
                                $VERIFICA = mysqli_num_rows( $RESULTADO );
                                if( $VERIFICA > 0 ) {
                                    while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) { ?>
                            <tr>
                                <th scope="row" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= $DADOS[ 'CLI_NOME' ]; ?></th>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= $DADOS[ 'PPR_TIPO_ACAO' ]; ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
                                    <?php
                                        if( $DADOS[ 'PPR_FK_PASTA' ] ) {
                                            $PASTA = $DADOS[ 'PPR_FK_PASTA' ];
                                            echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</h7>';
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'PPR_VALOR_TOTAL' ] ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= $DADOS[ 'PPR_QTD_PARCELA' ]; ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'PPR_DT_INICIO_PGTO' ] == "0000-00-00" ) {
                                            echo ' --- ';
                                        } else {
                                            echo $dt_inicio_pgto = date("d/m/Y", strtotime( $DADOS[ 'PPR_DT_INICIO_PGTO' ] ) );
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'PPR_DT_INICIO_PGTO' ] == "0000-00-00" ) {
                                            echo ' --- ';
                                        } else {
                                            echo $PPR_DT_FIM_PGTO = date("d/m/Y", strtotime( $DADOS[ 'PPR_DT_FIM_PGTO' ] ) );
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'PPR_VALOR_PARCELA' ] ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'PPR_VALOR_PAGO' ] ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'PPR_SALDO' ] ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                    <?php
                                        if( $DADOS[ 'PPR_FK_STATUS' ] != 2 ) {
                                            echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                                        } else {
                                            echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;"><a href="?pg=cases/cas_view&id=<?= $DADOS[ 'PPR_ID' ]; ?>" class="btn btn-outline-success" title="Ver"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    </fieldset>

                </div><!-- /.container-fluid -->

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

    <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>