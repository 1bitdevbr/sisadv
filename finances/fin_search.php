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
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $financesTitle; ?><span class="subtitle"><?= $financesSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<!-- BASIC SEARCH -->
				<legend class="text-center display-6" style="color:rgb(205, 205, 205);"><i class="fas fa-search"></i>&nbsp;Pesquisa Simples de Registros</legend>
				<form name="form_search" action="?pg=finances/fin_search" method="POST">
					<div class="row text-center justify-content-center align-items-center">
						<div class="col-3 input-group">
							<input type="search" name="SEARCH" class="form-control" placeholder="Pesquisar">
							<div class="input-group-append mb-3 text-center">
								<button type="submit" class="btn btn-default" name="btn-search">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</div>
				</form>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<!-- ADVANCED SEARCH -->
				<legend class="text-center display-6" style="color:rgb(205, 205, 205);"><i class="fas fa-search"></i>&nbsp;Pesquisa Avançada de Registros</legend>
				<div class="container"><!-- /. container -->
					<form name="form_search" action="?pg=finances/fin_search" method="POST">

						<div class="row text-center justify-content-center align-items-center"><!-- /. row -->

							<div class="col-sm-3 form-group">
								<label style="color: rgb( 205, 205, 205 );" for="MES">Mês</label>
								<select class="form-control" id="MES" name="MES">
									<option value="">Selecione...</option>
									<?php for( $i = 1; $i <= 12; $i++ ) { ?>
									<option value="<?= $i; ?>"><?= mostraMes( $i ); ?></option>
									<?php } ?>
								</select>
							</div>

									<?php for( $i = 1; $i <= 12; $i++  ) { ?>

									<?php } ?>

							<div class="col-sm-3 form-group">
								<label style="color: rgb( 205, 205, 205 );" for="ANO">Ano</label>
								<select class="form-control" id="ANO" name="ANO">
									<option selected>Selecione...</option>
									<?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
									<option value="<?= $i; ?>"><?= $i; ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-3 form-group">
								<label style="color: rgb( 205, 205, 205 );" for="SEARCH">Termo</label>
								<div class="input-group">
										<input class="form-control" type="search" name="SEARCH" value="" id="SEARCH" placeholder="Pesquisar" onkeyup="this.value = this.value.toUpperCase();" style="width: auto;" autofocus />
										<div class="input-group-append">
												<button type="submit" class="btn btn-default" name="btn-advsearch">
														<i class="fa fa-search"></i>
												</button>
										</div>
								</div>
							</div>

						</div><!-- /.end row -->

					</form>
				</div><!-- /.end container -->

				<!-- INÍCIO DO RESULTADO DA PESQUISA -->
				<table id="fin" class="table table-dark table-striped table-hover table-sm">
					<caption>Resultado da consulta</caption>
					<thead class="thead-dark">
							<tr>
									<th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Movimento</th>
									<th scope="col" style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
							</tr>
					</thead>
					<tbody>
						<?php
							// Receber os dados da url
							if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

								if( isset( $_POST[ 'btn-search' ] ) ) {
									$SEARCH = $_POST[ 'SEARCH' ];
									$VERIFICA = 0;

									// CONSULT SEARCH
									if( !empty( $SEARCH ) ) {
										$SQL = " SELECT * FROM LCM_LC_MOVIMENTO WHERE LCM_DESCRICAO LIKE '%$SEARCH%' ORDER BY LCM_ANO DESC, LCM_MES DESC, LCM_DIA DESC ";

										$RESULTADO = mysqli_query( $CONN, $SQL );
										$VERIFICA = mysqli_num_rows( $RESULTADO );
									} else {
										echo '<div class="alert alert-danger" role="alert" align="center"><b style="text-align: center; color: rgb( 255, 255, 255 ); font-size: 1.2em; font-weight: 600;">Digite um termo a ser pesquisado!</b></div>';
									}
								}

								if( isset( $_POST[ 'btn-advsearch'] ) ) {
									if( isset( $_POST[ 'MES' ] ) && isset( $_POST[ 'ANO' ] ) ) {
										$SEARCH = $_POST[ 'SEARCH' ];
										$VERIFICA = 0;
										$MES = $_POST[ 'MES' ];
										$ANO = $_POST[ 'ANO' ];

										// CONSULT ADVANCED SEARCH
										if( !empty( $SEARCH ) && !empty( $MES ) && !empty( $ANO ) ) {
											$SQL = " SELECT * FROM LCM_LC_MOVIMENTO
														    WHERE LCM_DESCRICAO LIKE '%$SEARCH%' AND LCM_MES = $MES AND LCM_ANO = $ANO
													   ORDER BY LCM_ANO DESC, LCM_MES DESC, LCM_DIA DESC ";

											$RESULTADO = mysqli_query( $CONN, $SQL );
											$VERIFICA = mysqli_num_rows( $RESULTADO );
										}
									}
								}

								if( $VERIFICA > 0 ) {
									while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) {

                  $CAT = $DADOS[ 'LCM_CAT' ];
                  $QR2 = mysqli_query( $CONN, " SELECT LCA_NOME FROM LCA_LC_CAT WHERE LCA_ID = '$CAT' ");
                  $ROW2 = mysqli_fetch_array( $QR2 );
                  $CATEGORIA = $ROW2[ 'LCA_NOME' ];

                  ?>
										<tr>
											<th scope="row" style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'LCM_DIA' ] . '/' . $DADOS[ 'LCM_MES' ] . '/' . $DADOS[ 'LCM_ANO' ]; ?></th>
											<td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'LCM_DESCRICAO' ] ?>
                        <?php
                          if( $CAT > 0 ) {
                            echo '<em><span class="badge badge-pill" style="background-color: ' . colorItem( $CAT ) . '; color: rgb( 244, 244, 244 ); font-weight: 600; font-size: 1em;">' . $CATEGORIA . '</span></em>';
                          }
                        ?>
                      </td>
											<td align="right" width="15%"><strong style="color:<?php if( $DADOS[ 'LCM_TIPO' ] == 0 ) echo "rgb( 231, 185, 184 )"; else echo "rgb( 197, 237, 255 )"?>"><?php if( $DADOS[ 'LCM_TIPO' ] == 0 ) echo "-"; else echo "+"?><?= formata_dinheiro( $DADOS[ 'LCM_VALOR' ] ); ?></strong></td>
										</tr>
						<?php }
								}
							} else {
									if( !empty( $SEARCH ) ) {
											echo '<div class="alert alert-danger" role="alert" align="center"><b style="text-align: center; color: rgb( 255, 255, 255 ); font-size: 1.2em; font-weight: 600;">Nenhum registro encontrado!</b></div>';
									}
								}
						?>
					</tbody>
				</table>

			</div><!-- /.container-fluid -->

		</div><!-- /.Invoice -->

	</div><!-- /.End Container-fluid -->
</section><!-- /.End Section -->

<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>