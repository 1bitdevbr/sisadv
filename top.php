<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
	require(__DIR__ . '/access/level.php');
    //require_once(__DIR__ . '/access/conn.php');
	require_once(__DIR__ . '/config.php');
    require_once(__DIR__ . '/access.php');
	require_once(__DIR__ . '/dist/func/functions.php');

    // Verifica se está setado usuário na Session
    if (isset($_SESSION[ 'USR_ID' ]))
    {
        $USERS = $_SESSION[ 'USR_ID' ];
        $SQL = mysqli_query( $CONN1, " SELECT C.CLI_OFFICE FROM SYS_USERS U JOIN SYS_CLIENTS C ON C.CLI_ID = U.USR_FK_CLIENT WHERE U.USR_ID = '$USERS' ");
        $R = mysqli_fetch_array( $SQL );
    } else
    {
        $_SESSION[ 'msg2' ] = "Usuário não identificado!";
        exit; // Para garantir que o header não será enviado após o erro
    }
?>

	<nav class="main-header fixed-top navbar navbar-expand navbar-dark" style="margin-bottom: 10px; border-top: 3px solid rgba( 255, 164, 64, 0.7 ); border-bottom: 1px solid rgb( 52, 58, 64 ); box-shadow: 0 5px 5px -2px rgb( 52, 58, 64 ); -moz-box-shadow: 0 5px 5px -2px rgb( 52, 58, 64 ); -webkit-box-shadow: 0 5px 5px -2px rgb( 52, 58, 64 );">

        <!-- Home - Left Panel -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="index.php" class="nav-link">Home</a>
			</li>
		</ul>

        <!-- Client name - Center Panel  -->
		<div class="top">
			<span style="color: rgb( 253, 224, 139 ); font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase;"><?= $R[ 'CLI_OFFICE' ]; ?></span>
		</div>

        <!-- Notifications - Right Panel  -->
		<ul class="navbar-nav ml-auto">

			<!-- Notifications Expired Contracts Dropdown Menu -->
			<li class="nav-item dropdown" id="notifications-dropdown">
				<?php
					/**
                     * Parcelas de Contratos Vencidos
                     */
					$SQL = mysqli_query( $CONN, " SELECT COUNT( PPP.PPP_ID ) AS VENCIDOS
													FROM PPR_PROC_PROCESSOS PPR
													JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
													JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
													JOIN PPP_PROC_PROCESSOS_PGTO PPP ON PPP.PPP_FK_PROCESSO = PPR.PPR_ID
												   WHERE PPP.PPP_DT_VENCIMENTO <= NOW()
													 AND PPP.PPP_DT_PGTO = '0000-00-00'
													 AND PPP.PPP_STATUS = 1
                                                     AND PPR.PPR_CREDITO_PODRE = 0
												 " );
					$ROW = mysqli_fetch_array( $SQL );
					$VENCIDOS = $ROW[ 'VENCIDOS' ];
					if( $VENCIDOS > 0 ) { $VENCIDOS; $VNC_QTD = 1; } else { $VENCIDOS = 0; $VNC_QTD = 0; }

                    /**
                     * Assuntos Pendentes
                     */
					$SQL = mysqli_query( $CONN, " SELECT COUNT( ASS.ASS_FK_SITUACAO ) AS SITUACAO
                                                    FROM ASS_ASSUNTOS ASS
                                                    JOIN AST_ASSUNTOS_SIT AST ON AST.AST_ID = ASS.ASS_FK_SITUACAO
                                                   WHERE ASS.ASS_FK_SITUACAO <> 3
                                                " );
					$ROW = mysqli_fetch_array( $SQL );
					$SITUACAO = $ROW[ 'SITUACAO' ];
					if( $SITUACAO > 0 && $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { $SITUACAO; $SIT_QTD = 1; } else { $SITUACAO = 0; $SIT_QTD = 0; }

                    /**
                     * Tarefas Ativas
                     */
                    $USR_ACCESS = $_SESSION[ 'USR_ID' ];

                    $SQL = mysqli_query( $CONN, " SELECT TAR.*, COUNT( TAR.TAR_ID ) AS TAREFAS, PNA.*, CLI.*, SIT.*, PAS.*
                                                    FROM TAR_TAREFAS TAR
                                               LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID        = TAR.TAR_FK_NATUREZA
                                               LEFT JOIN CLI_CLIENTES CLI      ON CLI.CLI_ID        = TAR.TAR_FK_CLIENTE
                                               LEFT JOIN TAR_SITUACAO SIT      ON SIT.TAR_ID_SIT    = TAR.TAR_FK_SITUACAO
                                            --    LEFT JOIN TAR_STATUS STA        ON STA.TAR_ID_STA    = TAR.TAR_FK_STATUS
                                               LEFT JOIN PAS_PROC_PASTA PAS    ON PAS.PAS_ID        = CLI.CLI_FK_PASTA
                                                   WHERE TAR.TAR_FK_STATUS     = 1
                                                     AND TAR.TAR_FK_SITUACAO   <= 2
                                                     AND TAR.TAR_FK_ATRIBUIDO  = '$USR_ACCESS'
                                                ORDER BY TAR.TAR_PZ_FIM ASC
                                                " );

                    $ROW  = mysqli_fetch_array( $SQL );
					$TAREFAS = $ROW[ 'TAREFAS' ];

					if( $TAREFAS > 0 ) { $TAREFAS; $TAR_QTD = 1; } else { $TAREFAS = 0; $TAR_QTD = 0; }

                    /**
                     * Contador
                     */
					$COUNT = [ $VNC_QTD, $SIT_QTD, $TAR_QTD ];
					$SOMA = 0;
					for($I = 0, $J = count($COUNT); $I < $J; $I++ ) {
						$SOMA += $COUNT[ $I ];
					}
					$SOMA;
				?>

                <style>
                    #notifications-toggle {
                        cursor: pointer;
                        transition: all 0.2s ease;
                    }

                    #notifications-toggle:hover {
                        transform: scale(1.1);
                    }
                </style>

                <a class="nav-link" href="#" id="notifications-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge"><?= $SOMA; ?></span>
                </a>

                <!-- Total de Notificações -->
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="notifications-toggle">
                    <span class="dropdown-item dropdown-header"><?php if( $SOMA > 1 ) { echo $SOMA . ' Notificações'; } else { echo $SOMA . ' Notificação'; }; ?>

                    <!-- Total de Parcelas Vencidas -->
                    <div style="<?php if( $VENCIDOS == 0 ) { echo 'display: none;'; } ?>">
                        <div class="dropdown-divider"></div>
                        <a href="?pg=cases/cas_expired" class="dropdown-item text-left" onmouseover="this.style.color='#FDE08B'" onmouseout="this.style.color='#CDCCCC'">
                        <i class="fas fa-arrow-alt-circle-right mr-2"></i> <?php if( $VENCIDOS > 1 ) { echo $VENCIDOS . ' parcelas de contrato vencidas'; } else { echo $VENCIDOS . ' parcela de contrato vencida'; }; ?>
                        <span class="float-right text-muted text-sm"></span>
                        </a>
                    </div>

                    <!-- Total de Assuntos Pendentes -->
                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?>
                    <div style="<?php if( $SITUACAO == 0 ) { echo 'display: none;'; } ?>">
                        <div class="dropdown-divider"></div>
                        <a href="?pg=matters/mat_main" class="dropdown-item text-left" onmouseover="this.style.color='#FDE08B'" onmouseout="this.style.color='#CDCCCC'">
                        <i class="fas fa-arrow-alt-circle-right mr-2"></i> <?php if( $SITUACAO > 1 ) { echo $SITUACAO . ' assuntos pendentes'; } else { echo $SITUACAO . ' assunto pendente'; }; ?>
                        <span class="float-right text-muted text-sm"></span>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- Total de Tarefas -->
                    <div style="<?php if( $TAREFAS == 0 ) { echo 'display: none;'; } ?>">
                        <div class="dropdown-divider"></div>
                        <a href="?pg=tasks/tsk_main" class="dropdown-item text-left" onmouseover="this.style.color='#FDE08B'" onmouseout="this.style.color='#CDCCCC'">
                        <i class="fas fa-arrow-alt-circle-right mr-2"></i> <?php if( $TAREFAS > 1 ) { echo $TAREFAS . ' tarefas disponíveis'; } else { echo $TAREFAS . ' tarefa disponível'; }; ?>
                        <span class="float-right text-muted text-sm"></span>
                        </a>
                    </div>

                </div>
			</li>

            <script>
                $(document).ready(function() {
                    // Referências aos elementos
                    var $toggle = $('#notifications-toggle');
                    var $dropdown = $('#notifications-dropdown .dropdown-menu');
                    var isProgrammaticHide = false;

                    // Inicialização do dropdown
                    $toggle.dropdown({
                        display: 'dynamic'
                    });

                    // Abre/fecha com um clique
                    $toggle.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Verifica se o dropdown está visível
                        if ($dropdown.hasClass('show')) {
                            isProgrammaticHide = true;
                            $toggle.dropdown('hide');
                        } else {
                            $toggle.dropdown('show');
                        }
                        return false;
                    });

                    // Fecha ao clicar fora - Solução robusta
                    $(document).on('click', function(e) {
                        if (!$dropdown.is(e.target) &&
                            $dropdown.has(e.target).length === 0 &&
                            !$toggle.is(e.target) &&
                            $toggle.has(e.target).length === 0) {

                            isProgrammaticHide = true;
                            $toggle.dropdown('hide');
                        }
                    });

                    // Evento quando o dropdown é escondido
                    $dropdown.on('hidden.bs.dropdown', function() {
                        if (!isProgrammaticHide) {
                            $toggle.dropdown('show');
                        }
                        isProgrammaticHide = false;
                    });

                    // Fecha ao pressionar Esc
                    $(document).on('keydown', function(e) {
                        if (e.key === 'Escape') {
                            isProgrammaticHide = true;
                            $toggle.dropdown('hide');
                        }
                    });

                    // Impede que o dropdown feche ao clicar dentro
                    $dropdown.on('click', function(e) {
                        e.stopPropagation();
                    });
                });
            </script>

            <!-- User login name -->
			<div class="user-panel mobile-none">
				<li class="nav-item" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
					<div class="image">
						<?php
							$SQL    = " SELECT SU.USR_PHOTO, SU.USR_NAME, SL.LVL_NAME FROM SYS_USERS SU JOIN SYS_LEVEL SL ON SU.USR_FK_LEVEL = SL.LVL_ID WHERE USR_ID = '$USERS' ";
							$RESULT = mysqli_query( $CONN1, $SQL );

							if( mysqli_num_rows( $RESULT ) > 0 ) {
								while( $PHOTO = mysqli_fetch_array( $RESULT ) ) {
									if( empty( $PHOTO[ 'USR_PHOTO' ] ) ) {
										$IMG = 'dist/img/user.png';
									} else {
										$IMG = 'dist/img/' . $PHOTO[ 'USR_PHOTO' ] . '';
									}
						?>

						<div class="container" style="width: 260px;">
							<div class="row" style="align-items: middle;">
								<div class="col-sm-2">
									<img class="img-circle mt-1" src="<?= $IMG; ?>" />
								</div>
								<div class="col-sm-10">
									<span class="d-none d-sm-block" style="color: rgb( 255, 255, 255 ); letter-spacing: 0.03em;"><?= $PHOTO[ 'USR_NAME' ]; ?></span>
									<span class="d-none d-sm-block" style="font-size: 0.8em; font-weight: 500; color: rgb( 205, 204, 204 ); letter-spacing: 0.03em;">Nível de acesso:&nbsp;<b><?= $PHOTO[ 'LVL_NAME' ]; ?></b></span>
								</div>
							</div>
						</div>

						<?php
								}
							}
						?>
					</div>
				</li>
			</div>

			<!-- Exit -->
			<li class="nav-item mt-0" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
				<a class="nav-link" href="logout.php" style="color: #CDCCCC; font-size: 1.0em;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'" title="Sair"><i class="fas fa-sign-out-alt"></i></a>
			</li>

		</ul>

	</nav><!-- /.navbar -->

    <?php
        /**
         * Header SESSION MSG
         *
         * msg1 - Mensagem de Sucesso;
         * msg2 - Mensagem de Erro; e,
         * msg3 - Mensagem de Alerta.
         *
         */

         // Script para exibir mensagens com SweetAlert2
         echo '<script>';

         // Verifica se existe uma mensagem tipo 1 armazenada na sessão (sucesso)
         if (isset($_SESSION['msg1'])) {
            echo "
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: '" . addslashes($_SESSION['msg1']) . "'
                });
            });
            ";
            // Remove a mensagem da sessão
            unset($_SESSION['msg1']);
        }
        // Verifica se existe uma mensagem tipo 2 armazenada na sessão (erro/aviso)
        else if (isset($_SESSION['msg2'])) {
            echo "
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'error',
                    title: '" . addslashes($_SESSION['msg2']) . "'
                });
            });
            ";
            // Remove a mensagem da sessão
            unset($_SESSION['msg2']);
        }
        // Verifica se existe uma mensagem tipo 3 armazenada na sessão (modo manutenção)
        else if (isset($_SESSION['msg3'])) {
            echo "
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'warning',
                    title: '" . addslashes($_SESSION['msg3']) . "'
                });
            });
            ";
            // Não remove a mensagem de manutenção.
        }

         echo '</script>';
    ?>