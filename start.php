<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
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
            <?php
              if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) {
                echo '<a href="?pg=matters/mat_main" class="small-box-footer" onmouseover="this.style.color=\'rgb( 255, 255, 255 )\'" onmouseout="this.style.color=\'rgb( 205, 211, 212 )\'">Acessar <i class="fas fa-arrow-circle-right"></i></a>';
              } else {
                echo '<a href="#" class="small-box-footer" onmouseover="this.style.color=\'rgb( 255, 255, 255 )\'" onmouseout="this.style.color=\'rgb( 205, 211, 212 )\'">Acessar <i class="fas fa-arrow-circle-right"></i></a>';
              }
            ?>
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
                                                 AND TAR.TAR_PZ_FIM        = '$HOJE'
                                                 AND TAR.TAR_FK_ATRIBUIDO  = '$USR_ACCESS'
                                            " );

                $R_HOJE = mysqli_fetch_assoc($SQL);
                $T_HOJE = $R_HOJE['TOTAL_HOJE'];

                // Total de Tarefas vencidas
                $SQL = mysqli_query( $CONN, " SELECT COUNT(*) AS TOTAL_VENCIDAS
                                                FROM TAR_TAREFAS TAR
                                               WHERE TAR.TAR_FK_STATUS     = 1
                                                 AND TAR.TAR_FK_SITUACAO   <= 2
                                                 AND TAR.TAR_PZ_FIM        < '$HOJE'
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
					<div class="card card-widget widget-user">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_proc.png') no-repeat center center; background-size: cover;">
							<?php
                $SQL = mysqli_query( $CONN, " SELECT COUNT( PPR.PPR_ID ) AS ATIVOS, MAX(PPR.PPR_ID) AS LAST_PROC
                                                FROM PPR_PROC_PROCESSOS PPR
                                           LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                               WHERE PPR.PPR_FK_STATUS = 1
                                                 AND PPR.PPR_FK_DEFENSORIA = 2
                                            ORDER BY PPR.PPR_ID DESC
                                              LIMIT 1
                                            " );
                $ROW = mysqli_fetch_array( $SQL );
                if( $ROW ) {
                  $LAST_PROC  = $ROW[ 'LAST_PROC' ];
                  $ATIVOS     = $ROW[ 'ATIVOS' ];
                } else { echo ""; }

                $SQL = mysqli_query( $CONN, " SELECT PPR.PPR_FK_CLIENTE, CLI.CLI_NOME
                                                FROM PPR_PROC_PROCESSOS PPR
                                           LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                               WHERE PPR.PPR_FK_STATUS = 1
                                                 AND PPR.PPR_FK_DEFENSORIA = 2
                                            ORDER BY PPR.PPR_ID DESC
                                               LIMIT 1
                                            " );
                $ROW1 = mysqli_fetch_array( $SQL );
                if( $ROW1 ) {
                  $PPR_FK_CLIENTE  = $ROW1[ 'PPR_FK_CLIENTE' ];
                  $PPR_NOME        = $ROW1[ 'CLI_NOME' ];
                } else { echo ""; }
							?>
							<h3 class="text-right">Gestão de Processos</h3>
							<a href="?pg=cases/cas_main" class="text-right" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.1em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#FFF'">
								<h5 class="text-right"><i class="fas fa-arrow-alt-circle-right"></i>&nbsp;&nbsp;Acessar Contratos</h5>
							</a>
						</div>
						<div class="widget-user-image">
              <img class="img-circle" src="../dist/img/sis/folder.png" />
						</div>
            <div class="card-footer">
							<div class="row">
								<div class="col-3 border-right">
									<div class="description-block">
										<h5 class="description-header">ATIVOS</h5>
										<span class="description-text"><?= $ATIVOS; ?></span>
									</div>
								</div>
								<div class="col-9">
									<div class="description-block text-left">
										<h5 class="description-header">ÚLTIMO CADASTRADO</h5>
										<span class="description-text">
											<a href="?pg=cases/cas_view&id=<?= $LAST_PROC; ?>" style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#FDE08B'" onmouseout="this.style.color='#CDCCCC'">
                        <?= $PPR_NOME; ?>
                      </a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

				<div class="col-md-4">
					<div class="card card-widget widget-user">
						<div class="widget-user-header text-white" style="background: url('../dist/img/sis/bg_exit.jpg') no-repeat center center; background-size: cover;">
							<?php
								$SQL = mysqli_query( $CONN, " SELECT CLI.CLI_NOME AS NOME, COUNT( PPR.PPR_ID ) AS TOTAL
																						    FROM PPR_PROC_PROCESSOS PPR
                                                JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
																					     WHERE PPR.PPR_FK_STATUS = 1
                                                 AND PPR.PPR_FK_DEFENSORIA = 2
                                            ORDER BY PPR.PPR_ID DESC
                                               LIMIT 1
																					" );
								$R = mysqli_fetch_assoc( $SQL );
								$PPR_NOME  = $R[ 'NOME' ];
								$PPR_TOTAL = $R[ 'TOTAL' ];
							?>
							<h3 class="text-right">Encerrar o Sistema</h3>
						</div>
						<div class="widget-user-image">
              <img class="img-circle" src="../dist/img/sis/exit.png" />
						</div>
            <div class="card-footer">
							<div class="row">
								<div class="col text-center">
									<div class="description-block">
										<h5 class="description-header"><a href="logout.php?sair" class="btn btn-light btn-sm" style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;SAIR COM SEGURANÇA</a></h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

      </div><!--// ROW END MODULES //-->

		</div>
  </section>

</div><!-- ./wrapper -->