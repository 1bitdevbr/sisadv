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
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $debTitle; ?><span class="subtitle"><?= $debSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="row">
					<div class="col-sm-6" style="color: rgb( 248, 152, 152 );">
						<h4>LISTAGEM GERAL</h4>
					</div>
					<div class="col-sm-6" style='color: #FFF;'>
						<?php
							$SQL = mysqli_query( $CONN, " SELECT SUM( DEV_PRICE ) FROM DEV_CALC_MOV WHERE DEV_FK_STATUS = 1 ");
							$ROW = mysqli_fetch_array( $SQL );
							$DADOS = $ROW[ 0 ];
							echo '<h4  style="text-align: right;">SALDO TOTAL:&nbsp; '. formata_dinheiro( $DADOS ) .'</h4>';
						?>
					</div>
				</div>

				<table id="deb" class="table table-dark table-striped table-hover table-sm">
					<caption>Resultado da consulta</caption>
					<thead class="thead-dark">
							<tr>
									<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: cleftenter; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Pasta</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Processo</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Cliente</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Cidade</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Status</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
							</tr>
					</thead>
					<tbody>
						<?php
							$SQL = "SELECT DEV.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME, STA.STA_NAME
											FROM DEV_CALC_MOV DEV
											  JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = DEV.DEV_FK_CLIENT
											  JOIN STA_STATUS STA ON STA.STA_ID = DEV.DEV_FK_STATUS
											  JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = DEV.DEV_FK_FOLDER
									 	 WHERE DEV.DEV_FK_STATUS = 1
									ORDER BY DEV.DEV_FK_FOLDER ASC, DEV.DEV_DATE DESC
										 ";

							$RESULTADO = mysqli_query( $CONN, $SQL );
							$VERIFICA = mysqli_num_rows( $RESULTADO );

							if( $VERIFICA > 0 ) {
									while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>

							<tr>
									<th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DEV_DATE = date("d/m/Y", strtotime( $DADOS[ 'DEV_DATE' ] ) ); ?></th>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
										<?php
											if( $DADOS[ 'DEV_FK_FOLDER' ] ) {
												$PASTA = $DADOS[ 'DEV_FK_FOLDER' ];
												switch( $PASTA ) {
													case '1':
															echo '<h7 style="color: rgb( 255, 149, 35 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '2':
															echo '<h7 style="color: rgb( 72,209,204 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '3':
															echo '<h7 style="color: rgb( 30,144,255 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '4':
															echo '<h7 style="color: rgb( 100,149,237 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '5':
															echo '<h7 style="color: rgb( 95,158,160 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '6':
															echo '<h7 style="color: rgb( 0,139,139 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '7':
															echo '<h7 style="color: rgb( 70,130,180 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '8':
															echo '<h7 style="color: rgb( 255, 199, 240 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '9':
															echo '<h7 style="color: rgb( 86, 239, 141 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '10':
															echo '<h7 style="color: rgb( 72,61,139 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '11':
															echo '<h7 style="color: rgb( 170, 211, 251 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '12':
															echo '<h7 style="color: rgb( 100,149,237 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '13':
															echo '<h7 style="color: rgb( 135,206,235 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '14':
															echo '<h7 style="color: rgb( 173,216,230 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '15':
															echo '<h7 style="color: rgb( 65,105,225 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '16':
															echo '<h7 style="color: rgb( 195, 255, 218 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '17':
															echo '<h7 style="color: rgb( 252, 207, 73 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '18':
															echo '<h7 style="color: rgb( 135,206,250 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '20':
															echo '<h7 style="color: rgb( 112,128,144 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '21':
															echo '<h7 style="color: rgb( 176,196,222 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '22':
															echo '<h7 style="color: rgb( 30,144,255 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													case '23':
															echo '<h7 style="color: rgb( 242, 182, 38 ); font-weight: 600;"> ' . $DADOS[ 'PAS_NOME' ] . '</h7>'; break;
													default:
															//header( 'Location: ' );
													break;
												}
											}
										?>
									</td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= processNumber( "#######-##.####.#.##.####" , $DADOS[ 'DEV_PROCESS' ] ); ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_NOME' ]; ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_CIDADE' ]; ?></td>
									<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'DEV_PRICE' ] ) ?></td>
									<td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
											<?php
													if( $DADOS[ 'DEV_FK_STATUS' ] == 1 ) { // Ativo
															echo '<h7 style="color:#FFC107;">'  . $DADOS[ 'STA_NAME' ] . '</h7>';
													} else { // Baixado
															echo '<h7 style="color:#71E828;">'  . $DADOS[ 'STA_NAME' ] . '</h7>';
													}
											?>
									</td>
									<td class="text-center">
										<a href="?pg=debtor/deb_view&id=<?= $DADOS[ 'DEV_ID' ]; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
										<a href="?pg=debtor/deb_edit&id=<?= $DADOS[ 'DEV_ID' ]; ?>" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
										<a href="?pg=debtor/deb_payment&id=<?= $DADOS[ 'DEV_ID' ]; ?>" class="btn btn-outline-warning btn-sm" title="Lançar"><i class="fas fa-money-bill-wave"></i></a>&nbsp;&nbsp;
										<a href="?pg=debtor/deb_delete&id=<?= $DADOS[ 'DEV_ID' ]; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este registro?')"><i class="fas fa-trash"></i></a>
									</td>
							</tr>

						<?php } } ?>

					</tbody>
				</table>

            	<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>