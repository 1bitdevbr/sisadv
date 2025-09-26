<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level > 2;
	require(__DIR__ . '/access/level.php');
  	require(__DIR__ . '/access/conn.php');
	require_once(__DIR__ . '/config.php');
  	require_once(__DIR__ . '/access.php');
	require_once(__DIR__ . '/dist/func/functions.php');
?>

<div class="content-wrapper">

	<section class="finances-content">
		<div class="container-fluid">

            <!-- Dashboard -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-12">
							<h1 class="m-0"><i class="nav-icon fas fa-tachometer-alt"></i>&nbsp;Dashboard</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>	<!-- /.content-header -->

      <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

      <!-- Small boxes -->
      <div class="row">

        <!-- Gestão de Tarefas -->
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color:rgb( 4, 37, 46 );">
            <div class="inner" style="color:rgb( 255, 255, 255 );">
              <?php
                $USR_ACCESS = $_SESSION[ 'USR_ID' ];
                $SQL = mysqli_query( $CONN, " SELECT TAR.*, COUNT( TAR.TAR_ID ) AS TAREFAS, PNA.*, CLI.*, SIT.*, PAS.*
                                                FROM TAR_TAREFAS TAR
                                           LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID        = TAR.TAR_FK_NATUREZA
                                           LEFT JOIN CLI_CLIENTES CLI      ON CLI.CLI_ID        = TAR.TAR_FK_CLIENTE
                                           LEFT JOIN TAR_SITUACAO SIT      ON SIT.TAR_ID_SIT    = TAR.TAR_FK_SITUACAO
                                           LEFT JOIN PAS_PROC_PASTA PAS    ON PAS.PAS_ID        = CLI.CLI_FK_PASTA
                                               WHERE TAR.TAR_FK_STATUS     = 1
                                                 AND TAR.TAR_FK_SITUACAO   <= 2
                                                 AND TAR.TAR_FK_ATRIBUIDO  = '$USR_ACCESS'
                                            ORDER BY TAR.TAR_PZ_FIM ASC
                                            " );

                $ROW  = mysqli_fetch_array( $SQL );
                $TASK = $ROW[ 'TAREFAS' ];

                if( $TASK > 1 ) {
                  echo '<h3>' . $TASK . '</h3>';
                  echo ' <p>Tarefas disponíveis</p>';
                } else {
                  echo '<h3>' . $TASK . '</h3>';
                  echo ' <p>Tarefa disponível</p>';
                };
              ?>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="?pg=tasks/tsk_main" class="small-box-footer" onmouseover="this.style.color='rgb( 255, 255, 255 )'" onmouseout="this.style.color='rgb( 205, 211, 212 )'">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Parcelas Vencidas -->
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color:rgb( 122, 29, 39 );">
            <div class="inner" style="color:rgb( 255, 255, 255 );">
              <?php
                if( $VENCIDOS > 1 ) {
                  echo '<h3>' . $VENCIDOS . '</h3>';
                  echo ' <p>Parcelas de contrato vencidas</p>';
                } else {
                  echo '<h3>' . $VENCIDOS . '</h3>';
                  echo ' <p>Parcela de contrato vencida</p>';
                };
              ?>
            </div>
            <div class="icon">
              <i class="ion ion-social-usd"></i>
            </div>
            <a href="?pg=cases/cas_expired" class="small-box-footer" onmouseover="this.style.color='rgb( 255, 255, 255 )'" onmouseout="this.style.color='rgb( 205, 211, 212 )'">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Assuntos Pendentes -->
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color:rgb( 6, 75, 116 );">
            <div class="inner">
              <?php
                if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) {
                  if( $SITUACAO > 1 ) {
                    echo '<h3>' . $SITUACAO . '</h3>';
                    echo ' <p>Assuntos pendentes</p>';
                  } else {
                    echo '<h3>' . $SITUACAO . '</h3>';
                    echo ' <p>Assunto pendente</p>';
                  };
                } else {
                  echo '<h3>0</h3>';
                  echo '<p>Assunto pendente</p>';
                }
              ?>
            </div>
            <div class="icon">
              <i class="ion ion-android-alarm-clock"></i>
            </div>
            <a href="?pg=matters/mat_main" class="small-box-footer" onmouseover="this.style.color='rgb( 255, 255, 255 )'" onmouseout="this.style.color='rgb( 205, 211, 212 )'">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Total  -->
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color:rgb( 35, 59, 93 );">
            <div class="inner" style="color:rgb( 235, 233, 241 );">
                <span style="font-size: 1.3em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FFF;"><i class="ion ion-android-calendar"></i> Compromissos</span><br />
            <?php
                $HOJE = date('Y-m-d');

                // Total de Tarefas que vencem hoje
                $SQL = mysqli_query( $CONN, " SELECT COUNT(*) AS TOTAL_HOJE
                                                FROM TAR_TAREFAS TAR
                                               WHERE TAR.TAR_FK_STATUS     = 1
                                                 AND TAR.TAR_FK_SITUACAO   <= 2
                                                 AND TAR.TAR_PZ_FIM         = '$HOJE'
                                                 AND TAR.TAR_FK_ATRIBUIDO  = '$USR_ACCESS'
                                            " );

                $R_HOJE = mysqli_fetch_assoc($SQL);
                $T_HOJE = $R_HOJE['TOTAL_HOJE'];

                // Total de Tarefas vencidas
                $SQL = mysqli_query( $CONN, " SELECT COUNT(*) AS TOTAL_VENCIDAS
                                                FROM TAR_TAREFAS TAR
                                               WHERE TAR.TAR_FK_STATUS     = 1
                                                 AND TAR.TAR_FK_SITUACAO   <= 2
                                                 AND TAR.TAR_PZ_FIM         < '$HOJE'
                                                 AND TAR.TAR_FK_ATRIBUIDO  = '$USR_ACCESS'
                                            " );

                $R_VENCIDAS = mysqli_fetch_assoc($SQL);
                $T_VENCIDAS = $R_VENCIDAS['TOTAL_VENCIDAS'];

                // Total de Tarefas para finalizar
                $SQL = mysqli_query( $CONN, " SELECT COUNT(*) AS TOTAL_FINALIZAR
                                                FROM TAR_TAREFAS TAR
                                               WHERE TAR.TAR_FK_STATUS     = 1
                                                 AND TAR.TAR_FK_SITUACAO   = 3
                                                 AND TAR.TAR_USER_CREATION = '$USR_ACCESS'
                                            " );

                $R_FINALIZAR = mysqli_fetch_assoc($SQL);
                $T_FINALIZAR = $R_FINALIZAR['TOTAL_FINALIZAR'];

                // Exibe o Total de Tarefas que vencem hoje
                if( $T_HOJE > 1 )
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_HOJE . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Agendados para hoje</a></span>';
                } else
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_HOJE . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Agendado para hoje</a></span>';
                }

                echo "<br />";

                // Exibe o Total de Tarefas vencidas
                if( $T_VENCIDAS > 1 )
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_VENCIDAS . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Em atraso</a></span>';
                } else
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_VENCIDAS . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Em atraso</a></span>';
                }

                echo "<br />";

                // Exibe o Total de Tarefas pendentes de finalização
                if( $T_FINALIZAR > 1 )
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_FINALIZAR . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main&filter=3" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Aguardando finalização</a></span>';
                } else
                {
                    echo '<span class="mt-0 mb-0" style="font-size: 1.2em; font-weight: 800px; letter-spacing: 0.1em; line-height: 0.9em; color: #FBC11A;">' . $T_FINALIZAR . '</span><span class="mt-0 mb-0" style="font-size: 1.0em; letter-spacing: 0.1em; color: rgb( 255, 255, 255 );"><a href="?pg=tasks/tsk_main&filter=3" style="color: rgb( 255, 255, 255 );" onmouseover="this.style.color=\'rgb( 253, 224, 139 )\'" onmouseout="this.style.color=\'rgb( 255, 255, 255 )\'"> Aguardando finalização</a></span>';
                }
            ?>
            </div>
            <div class="icon">
              <i class="ion ion-android-calendar"></i>
            </div>
            <a href="?pg=schedule/sch_main" class="small-box-footer" onmouseover="this.style.color='rgb( 255, 255, 255 )'" onmouseout="this.style.color='rgb( 205, 211, 212 )'">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
      </div><!-- /.row -->

      <!--// ROW START MODULES //-->
			<div class="row">

				<!--// GESTÃO DE CLIENTES //-->
				<?php if( in_array( $MOD_01, $MODULE ) ) { ?>
				<div class="col-md-4">
					<div class="card card-widget widget-user">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_customer.jpg') center center;">
							<?php
								$SQL = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER By CLI_ID DESC LIMIT 1 ");
								$ROW = mysqli_fetch_array( $SQL );
								if( $ROW > 0 ) {
									$CLI_NOME = $ROW[ 'CLI_NOME' ];
									$SQL = " SELECT * FROM CLI_CLIENTES ";
									if( $T = mysqli_query( $CONN, $SQL ) ) {
										if( mysqli_num_rows( $T ) > 0 ) {
											$TOTAL = mysqli_num_rows( $T );
										} else { echo ""; }
									}
								} else { echo ""; }
							?>
							<h3 class="text-right">Gestão de Clientes</h3>
							<a href="?pg=clients/clien_search" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
								<h5 class="text-right"><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar Cadastros</h5>
							</a>
						</div>
						<div class="widget-user-image">
							<img class="img-circle" src="../dist/img/user1.png" />
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-3 border-right">
									<div class="description-block">
										<h5 class="description-header">TOTAL</h5>
										<span class="description-text"><?= $TOTAL; ?></span>
									</div>
								</div>
								<div class="col-9">
									<div class="description-block text-left">
										<h5 class="description-header">ÚLTIMO CADASTRADO</h5>
										<span class="description-text">
											<a href="?pg=clients/<?php if( $ROW > 0 ) { echo 'clien_view&id=' . $ROW[ 'CLI_ID' ]; } else { echo 'main'; } ?>"
												style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;"
												onmouseover="this.style.color='#FDE08B'" onmouseout="this.style.color='#CDCCCC'"><?= $CLI_NOME; ?>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

				<!--// GESTÃO DE PROCESSOS //-->
				<?php if( in_array( $MOD_02, $MODULE ) ) { ?>
				<div class="col-md-4">
					<div class="card card-widget widget-user-2">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_lawyer.jpg') no-repeat center center; background-size: cover;">
							<?php
								$SQL = mysqli_query( $CONN, " SELECT SUM( PPR_VALOR_TOTAL ) AS TOTAL,
																									SUM( PPR_VALOR_PARCELA ) AS TOTAL_PARCELA,
																									SUM( PPR_SALDO ) AS SALDO
																						FROM PPR_PROC_PROCESSOS
																					WHERE PPR_FK_STATUS = 1 AND PPR_FK_DEFENSORIA = 2
																					" );
								$R = mysqli_fetch_assoc( $SQL );
								$VALOR_TOTAL = $R[ 'TOTAL' ];
								$TOTAL_PARCELA = $R[ 'TOTAL_PARCELA' ];
								$SALDO = $R[ 'SALDO' ];
							?>
							<h3 class="text-left">Gestão de Processos</h3>
							<a href="?pg=cases/cas_main" class="text-left" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
								<h5><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar Contratos</h5>
							</a>
						</div>
						<div class="card-footer p-0">
							<ul class="nav flex-column">
								<li class="nav-item">
									<?php
										$SQL = mysqli_query( $CONN, " SELECT COUNT( PPR_ID ) FROM PPR_PROC_PROCESSOS WHERE PPR_FK_STATUS = 1 AND PPR_FK_DEFENSORIA = 2 AND PPR_SALDO > 0 ");
										$ROW = mysqli_fetch_array( $SQL );
										$DADOS = $ROW[ 0 ];
									?>
									<a class="nav-link" style="color: rgb( 96, 160, 255 ); letter-spacing: 0.1em;">CONTRATOS:&nbsp;<small class="badge badge-pill badge-info" style="font-weight: 500; font-size: 0.8em;"><?= $DADOS; ?></small>
										<span class="float-right badge bg-primary" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $VALOR_TOTAL ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 253, 224, 139 ); letter-spacing: 0.1em;">PARCELA MENSAL
										<span class="float-right badge bg-warning" style="color: rgb( 253, 224, 139 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $TOTAL_PARCELA ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 119, 230, 189 ); letter-spacing: 0.1em;">PARCELA PENDENTE
										<span class="float-right badge bg-success" style="color: rgb( 253, 224, 139 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $SALDO ); ?></span>
									</a>
								</li>
								<li class="nav-item">
								<?php
									$SQL = mysqli_query( $CONN, " SELECT PPP.*, CLI.CLI_NOME, PAS.PAS_NOME, COUNT( PPP.PPP_ID ) AS VENCIDOS, SUM( PPP.PPP_VALOR ) AS TOTAL FROM PPR_PROC_PROCESSOS PPR JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID WHERE PPP.PPP_DT_VENCIMENTO <= NOW() AND PPP.PPP_DT_PGTO = '0000-00-00' AND PPP.PPP_STATUS = 1 AND PPR.PPR_CREDITO_PODRE = 0 ");
									$ROW = mysqli_fetch_array( $SQL );
									$VENCIDOS = $ROW[ 'VENCIDOS' ];
									$TOTAL = $ROW[ 'TOTAL' ];
									if( $VENCIDOS > 0 ) { ?>
									<a class="nav-link" style="color: rgb( 247, 146, 116 ); letter-spacing: 0.1em;">EM ATRASO:&nbsp;<small class="badge badge-pill badge-danger" style="font-weight: 500; font-size: 0.8em;"><?= $VENCIDOS; ?></small>
										<span class="float-right badge bg-danger" style="color:<?php if( $SALDO > 0 ) echo "rgb( 247, 146, 116 )"; else echo "rgb( 255, 0, 0 )"; ?>; font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $TOTAL ); ?></span>
									</a>
								<?php } ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>

				<!--// GESTÃO FINANCEIRA //-->
				<?php if( in_array( $MOD_03, $MODULE ) ) { ?>
				<div class="col-md-4">
					<div class="card card-widget widget-user-2">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_finanças.jpg') no-repeat center center; background-size: cover;">
							<?php
								$QR = mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 1 ");
								$ROW = mysqli_fetch_array( $QR );
								$ENTRADAS = $ROW[ 'TOTAL' ];

								$QR = mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 0 ");
								$ROW = mysqli_fetch_array( $QR );
								$SAIDAS = $ROW[ 'TOTAL' ];

								$RESULTADO_GERAL = $ENTRADAS - $SAIDAS;
							?>
							<h3>Gestão Financeira</h3>
							<a href="?pg=finances/fin_main" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
								<h5><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar Livro Caixa</h5>
							</a>
						</div>
						<div class="card-footer p-0">
							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 96, 160, 255 ); letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-arrow-right" style="color: rgb( 65, 105, 225 )"></i>&nbsp;Entradas
										<span class="float-right badge bg-primary" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 247, 146, 116 ); letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-arrow-left" style="color: rgb( 255, 0, 0 )"></i>&nbsp;Saídas
										<span class="float-right badge bg-danger" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 220, 53, 69 )"; else echo "rgb( 119, 230, 189 )"; ?>; letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-file-invoice-dollar"></i>&nbsp;Resultado
										<span class="float-right badge <?php if( $RESULTADO_GERAL < 0 ) echo "bg-danger"; else echo "bg-success"; ?>" style="color: <?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 220, 53, 69 )"; else echo "rgb( 23, 162, 184 )"; ?>; font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $RESULTADO_GERAL ); ?></span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>

				<!--// GESTÃO DE FUNDOS //-->
				<?php if( in_array( $MOD_04, $MODULE ) ) { ?>
					<div class="col-md-4">
						<div class="card card-widget widget-user-2">
							<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_fundos.jpg') no-repeat center center; background-size: cover;">
								<?php
									$QR = mysqli_query( $CONN, "SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 1 ");
									$ROW = mysqli_fetch_array( $QR );
									$ENTRADAS = $ROW[ 'TOTAL' ];

									$QR = mysqli_query( $CONN, "SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 0 ");
									$ROW = mysqli_fetch_array( $QR );
									$SAIDAS = $ROW[ 'TOTAL' ];

									$RESULTADO_GERAL = $ENTRADAS - $SAIDAS;
								?>
								<h3>Fundos Emergenciais</h3>
								<a href="?pg=funds/fun_main" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
									<h5><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar</h5>
								</a>
							</div>
							<div class="card-footer p-0">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link" style="color: rgb( 96, 160, 255 ); letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-arrow-right" style="color: rgb( 65, 105, 225 )"></i>&nbsp;Entradas
											<span class="float-right badge bg-primary" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" style="color: rgb( 247, 146, 116 ); letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-arrow-left" style="color: rgb( 255, 0, 0 )"></i>&nbsp;Saídas
											<span class="float-right badge bg-danger" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" style="color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 220, 53, 69 )"; else echo "rgb( 119, 230, 189 )"; ?>; letter-spacing: 0.1em; text-transform: uppercase; "><i class="fas fa-file-invoice-dollar"></i>&nbsp;Resultado
											<span class="float-right badge <?php if( $RESULTADO_GERAL < 0 ) echo "bg-danger"; else echo "bg-success"; ?>" style="color: <?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 220, 53, 69 )"; else echo "rgb( 23, 162, 184 )"; ?>; font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $RESULTADO_GERAL ); ?></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>

				<!--// GESTÃO DE CÁLCULOS //-->
				<?php if( in_array( $MOD_05, $MODULE ) ) { ?>
				<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
					<div class="card bg-light d-flex flex-fill small-box" style="background: url('../dist/img/sis/bg_calc.jpg') rgba( 10,23,55,0.5 ) no-repeat center center; background-size: cover;">
						<div class="card-header text-muted border-bottom-0">
							<h4 class="widget-user-username" style="color: rgb( 255, 255, 255 );">Devedores de Cálculos</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-12 text-center">
									<?php
										$SQL = mysqli_query( $CONN, " SELECT SUM( DEV_PRICE ) FROM DEV_CALC_MOV WHERE DEV_FK_STATUS = 1 ");
										$ROW = mysqli_fetch_array( $SQL );
										$DADOS = $ROW[ 0 ];
									?>
									<h2 class="lead mt-4" style="color: rgb( 219, 219, 219 );"><b><i class="fas fa-calculator"></i>&nbsp;Total em Aberto</b></h2>
									<span class="col-12 text-center" style="color: rgb( 253, 224, 139 ); text-transform: uppercase; font-size: 1.2em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $DADOS ); ?></span>
								</div>
								<div class="icon" style="color: rgb( 255, 255, 255 );">
									<i class="ion ion-stats-bars"></i>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="text-right">
								<a href="?pg=debtor/deb_main" class="btn btn-sm btn-primary">
								<i class="fas fa-arrow-alt-circle-right"></i>&nbsp;Acessar
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

				<!--// GESTÃO DE PATRIMÔNIO //-->
				<?php if( in_array( $MOD_06, $MODULE ) ) { ?>
				<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
					<div class="card bg-light d-flex flex-fill small-box" style="background: url('../dist/img/sis/bg_inventario.jpg') rgba( 10,23,55,0.5 ) no-repeat center center; background-size: cover;">
						<div class="card-header text-muted border-bottom-0">
							<h4 class="widget-user-username" style="color: rgb( 255, 255, 255 );">Bens e Patrimônio</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-12 text-center">
									<?php
										$SQL = mysqli_query( $CONN, " SELECT SUM( INV_VR_TOTAL ) FROM INV_INVENTARIO WHERE INV_FK_STATUS = 1 ");
										$ROW = mysqli_fetch_array( $SQL );
										$DADOS = $ROW[ 0 ];
									?>
									<h2 class="lead mt-4" style="color: rgb( 219, 219, 219 );"><b><i class="fa fa-university"></i>&nbsp;Total do Patrimônio</b></h2>
									<span class="col-12 text-center" style="color: rgb( 253, 224, 139 ); text-transform: uppercase; font-size: 1.2em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $DADOS ); ?></span>
								</div>
								<div class="icon" style="color: rgb( 255, 255, 255 );">
									<i class="fa fa-university" style="font-size: 46px;"></i>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="text-right">
								<a href="?pg=inventory/inv_main" class="btn btn-sm btn-primary">
									<i class="fas fa-arrow-alt-circle-right"></i>&nbsp;Acessar
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

				<!--// GESTÃO DE EMPRÉSTIMOS //-->
				<?php if( in_array( $MOD_08, $MODULE ) ) { ?>
				<div class="col-md-4">
					<div class="card card-widget widget-user-2">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_emprestimos.jpg') no-repeat center center; background-size: cover;">
							<?php
								$SQL = " SELECT SUM( EMP_VALOR_FINANCIADO ) AS VLRFINANCIADO, SUM( EMP_TOTAL_JUROS ) AS VLRJUROS, SUM( EMP_VALOR_TOTAL ) AS VLRTOTAL, SUM( EMP_SALDO ) AS VLRSALDO FROM EMP_EMPRESTIMO_MOV ";
								$ROW = mysqli_query( $CONN, $SQL );
								$R = mysqli_fetch_array( $ROW );
								$TOTALCONTRATADO = $R[ 'VLRFINANCIADO' ];
								$TOTALJUROS = $R[ 'VLRJUROS' ];
								$MONTANTEACUMULADO = $R[ 'VLRTOTAL' ];
								$SALDOPENDENTE = $R[ 'VLRSALDO' ];
							?>
							<h3>Gestão de Empréstimos</h3>
							<a href="?pg=loan/loa_main" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
								<h5><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar Contratos</h5>
							</a>
						</div>
						<div class="card-footer p-0">
							<ul class="nav flex-column">
								<li class="nav-item">
									<?php
										$SQL = mysqli_query( $CONN, " SELECT COUNT( PPR_ID ) FROM PPR_PROC_PROCESSOS WHERE PPR_FK_STATUS = 1 AND PPR_FK_DEFENSORIA = 2 AND PPR_SALDO > 0 ");
										$ROW = mysqli_fetch_array( $SQL );
										$DADOS = $ROW[ 0 ];
									?>
									<a class="nav-link" style="color: rgb( 96, 160, 255 ); letter-spacing: 0.1em;">Contratado
										<span class="float-right badge bg-primary" style="color: rgb( 248, 248, 242 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $TOTALCONTRATADO ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 253, 224, 139 ); letter-spacing: 0.1em;">Juros
										<span class="float-right badge bg-warning" style="color: rgb( 253, 224, 139 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $TOTALJUROS ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" style="color: rgb( 119, 230, 189 ); letter-spacing: 0.1em;">Acumulado
										<span class="float-right badge bg-success" style="color: rgb( 253, 224, 139 ); font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $MONTANTEACUMULADO ); ?></span>
									</a>
								</li>
								<li class="nav-item">
								<?php
									$SQL = mysqli_query( $CONN, " SELECT PPP.*, CLI.CLI_NOME, PAS.PAS_NOME, COUNT( PPP.PPP_ID ) AS VENCIDOS, SUM( PPP.PPP_VALOR ) AS TOTAL FROM PPR_PROC_PROCESSOS PPR JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID WHERE PPP.PPP_DT_VENCIMENTO <= NOW() AND PPP.PPP_DT_PGTO = '0000-00-00' AND PPP.PPP_STATUS = 1 ");
									$ROW = mysqli_fetch_array( $SQL );
									$VENCIDOS = $ROW[ 'VENCIDOS' ];
									$TOTAL = $ROW[ 'TOTAL' ];
									if( $VENCIDOS > 0 ) { ?>
									<a class="nav-link" style="color: rgb( 247, 146, 116 ); letter-spacing: 0.1em;">Pendente
										<span class="float-right badge bg-danger" style="color:<?php if( $SALDO > 0 ) echo "rgb( 247, 146, 116 )"; else echo "rgb( 255, 0, 0 )"; ?>; font-size: 1.0em; letter-spacing: 0.1em; font-weight: 600;"><?= formata_dinheiro( $SALDOPENDENTE ); ?></span>
									</a>
								<?php } ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>

			</div><!--// ROW END MODULES //-->

		</div>
  </section>

</div><!-- ./wrapper -->