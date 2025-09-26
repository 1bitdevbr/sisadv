			<!--
                strpos(): A função strpos() é usada para encontrar a primeira ocorrência de uma string secundária em uma string.
                Se a string secundária existir, a função retornará o índice inicial da string secundária, caso contrário, retornará False se a string secundária não for encontrada na string (URL).

                Sintaxe:
                int strpos( $String, $Substring )
                Fonte: https://acervolima.com/como-verificar-se-o-url-contem-determinada-string-usando-php/
            -->
            <?php
                // RECEBENDO DADOS DO GET
                // if( isset( $_GET[ 'id' ] ) ) { $ID = $_GET[ 'id' ]; }
                // if( isset( $_GET[ 'dlv' ] ) ) { $DLV_ID = $_GET[ 'dlv' ]; }
            ?>

            <section class="menu">
                <div class="container col-12">
                    <div class="row callout callout-danger user-panel" style="justify-content: center; align-items: center; display: flex; vertical-align: middle;">
                        <div class="col-sm mb-2">
                            <h4 style="color: rgb( 211, 211, 213 );"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Menu</h4>
                        </div>
                        <div class="col-sm">
                            <div class="menu col-sm text-right">
                                <!--// -----------------------------------------
                                // GERAL: START MENU //
                                // --------------------------------------- //-->
                                <a href="index.php" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Início" style="color: rgb( 204, 193, 226 ); text-decoration: none;"><i class="fa fa-home" aria-hidden="true"></i>Início</a>

                                <!--// -----------------------------------------
                                // CASES //
                                // --------------------------------------- //-->
                                <!-- START mainSEC -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_mainSec' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Contratos" style="text-decoration: none;"><i class="fa fa-folder"></i>Contratos</a>
                                    <a href="?pg=cases/cas_expired" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contratos Vencidos" style="text-decoration: none;">
                                        <?php
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
                                        if( $VENCIDOS > 0 ) { ?>
                                            <span class="badge bg-danger"><?= $VENCIDOS; ?></span>
                                        <?php } ?>
                                        <i class="fas fa-exclamation-triangle" style="color: rgb( 239, 185, 88 );"></i>&nbsp;Vencidos
                                    </a>
                                    <a href="?pg=cases/cas_reg_main" class="btn btn-app bg-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar processo" style="text-decoration: none;"><i class="fas fa-plus"></i>Processo</a>
                                <?php } ?>

                                <!-- START  mainADM-->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_mainAdm' ) ) { ?>
                                    <a href="?pg=cases/cas_expired" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contratos Vencidos" style="text-decoration: none;">
                                        <?php
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
                                        if( $VENCIDOS > 0 ) { ?>
                                            <span class="badge bg-danger"><?= $VENCIDOS; ?></span>
                                        <?php } ?>
                                        <i class="fas fa-exclamation-triangle" style="color: rgb( 239, 185, 88 );"></i>&nbsp;Vencidos
                                    </a>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_report" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Relatórios" style="text-decoration: none;"><i class="fas fa-file-pdf"></i>Relatórios</a>'; } ?>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_mainSec" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>'; } ?>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_history" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Processos Finalizados" style="text-decoration: none;"><i class="fa fa-folder"></i>&nbsp;Finalizados</a>'; } ?>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_lost" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Crédito Perdido" style="text-decoration: none;"><i class="fas fa-dollar-sign" style="color: #FC412F;"></i>&nbsp;Perdido</a>'; } ?>
                                    <a href="?pg=cases/cas_reg_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Processo" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fa fa-folder"></i>[+] Cadastrar</a>
                                    <a href="?pg=clients/clien_cadastro" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Cliente" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fas fa-user"></i>[+] Cliente</a>
                                <?php } ?>
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_lost' ) ) { ?>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_mainSec" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>'; } ?>
                                    <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { echo '<a href="?pg=cases/cas_history" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Processos Finalizados" style="text-decoration: none;"><i class="fa fa-folder"></i>&nbsp;Finalizados</a>'; } ?>
                                    <a href="?pg=cases/cas_reg_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Processo" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fa fa-folder"></i>[+] Cadastrar</a>
                                    <a href="?pg=clients/clien_cadastro" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Cliente" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fas fa-user"></i>[+] Cliente</a>
                                <?php } ?>

                                <!-- REGISTER MENU -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_reg_main' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- VIEW -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_view' ) ) { ?>
                                    <a href="?pg=clients/clien_view&id=<?= $DADOS[ 'PPR_FK_CLIENTE' ]; ?>" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Acessar Cadastro" style="text-decoration: none;"><i class="fas fa-user"></i>Cadastro</a>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- ADD CASE -->
                                <!-- <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_reg' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                    <button form="CAS_ADD" class="btn btn-danger btn-app submit_btn" id="btn-edit" name="btn-edit" value="btn-edit"><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                <?php } ?> -->

                                <!-- ADD CASE DEF -->
                                <!-- <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_reg_def' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                    <button form="CAS_ADD_DEF" class="btn btn-danger btn-app submit_btn" id="btn-edit" name="btn-edit" value="btn-edit"><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                <?php } ?> -->

                                <!-- EDIT -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_edit' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                    <button form="CAS_UPDT" class="btn btn-danger btn-app submit_btn" id="btn-edit" name="btn-edit" value="btn-edit"><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                <?php } ?>

                                <!-- EXPIRED -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_expired' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- HISTORY -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_history' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- REGISTER PAYMENT -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_launch' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- CASES REPORT -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cas_report' ) ) { ?>
                                    <a href="?pg=cases/cas_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Contratos" style="text-decoration: none;"><i class="fa fa-folder"></i>Contratos</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // CLIENTS //
                                // --------------------------------------- //-->
                                <!-- SEARCH -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'clien_search' ) ) { ?>
                                    <a href="?pg=clients/clien_cadastro" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Cliente" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fas fa-user"></i>[+] Cliente</a>
                                    <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Pasta" onclick="abreFecha('add_pasta')" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fa fa-folder"></i>[+] Pasta</a>
                                    <a href="?pg=cases/cas_reg_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Menu" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fa fa-folder"></i>[+] Processo</a>
                                    <a href="?pg=cases/cas_mainSec" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Processos" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                <?php } ?>

                                <!-- NEW -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'clien_cadastro' ) ) { ?>
                                    <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Pasta" onclick="abreFecha('add_pasta')" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fa fa-folder"></i>[+] Pasta</a>
                                <?php } ?>

                                <!-- VIEW -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'clien_view' ) ) { ?>
                                  <a href="?pg=clients/clien_editar&id=<?= $DADOS[ 'CLI_ID' ]; ?>" class="btn btn-app bg-info" title="Editar Cliente" style="text-decoration: none;"><i class="fas fa-edit"></i>Editar</a>
                                  <a href="?pg=clients/clien_search" class="btn btn-app" title="Listar Clientes" style="text-decoration: none;"><i class="fa fa-search"></i>Listar</a>
                                  <a href="?pg=cases/cas_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fa fa-folder"></i>Processos</a>
                                  <a href="?pg=clients/clien_cadastro" class="btn btn-app bg-success" title="Cadastrar Cliente" style="text-decoration: none;"><i class="fas fa-plus"></i>Cadastrar</a>
                                  <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="?pg=clients/clien_deletar&id=<?= $DADOS['CLI_ID']; ?>" class="btn btn-app bg-danger" title="Excluir Cliente" style="text-decoration: none;" onclick="return confirm('Tem certeza que deseja deletar este Cliente?')"><i class="fas fa-trash-alt"></i>Excluir</a><?php } ?>
                                  <a href="?pg=clients/main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fa fa-bars"></i>Menu</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // ADD LAWYER //
                                // --------------------------------------- //-->
                                <!-- MAIN -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'law_main' ) ) { ?>
                                    <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Advogado" onclick="abreFecha('new')" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fas fa-user"></i>[+] Advogado</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // FINANCES //
                                // --------------------------------------- //-->
                                <!-- MAIN -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'fin_main' ) ) { ?>
                                    <a href="?pg=finances/fin_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mês atual" style="color: rgb( 253, 224, 139 ); text-decoration: none;"><i class="icon fas fa-calendar"></i>Mês atual</a>
                                    <a href="?pg=finances/fin_search" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Busca avançada" style="color: rgb( 246, 173, 167 ); text-decoration: none;"><i class="fas fa-search"></i>Avançada</a>
                                    <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="javascript:;" onclick="abreFecha('add_movimento')" class="btn btn-app bg-info" title="Adicionar Movimento" style="text-decoration: none;" style="color: rgb( 255, 255, 255);"><i class="fas fa-plus"></i>Movimento</a><?php } ?>
                                    <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="javascript:;" onclick="abreFecha('add_cat')" class="btn btn-app" title="Adicionar Categoria" style="text-decoration: none;"style="color:rgb( 255, 255, 255);"><i class="fas fa-plus"></i>Categoria</a><?php } ?>
                                <?php } ?>

                                <!-- ADVANCED SEARCH -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'fin_search' ) ) { ?>
                                    <a href="?pg=finances/fin_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mês atual" style="color: rgb( 253, 224, 139 ); text-decoration: none;"><i class="icon fas fa-calendar"></i>Mês atual</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // DEBTOR //
                                // --------------------------------------- //-->
                                <!-- MAIN -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'deb_main' ) ) { ?>
                                    <a href="?pg=debtor/deb_register" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar" style="text-decoration: none;"><i class="fas fa-plus"></i>Cadastrar</a>
                                <?php } ?>
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'deb_register' ) ) { ?>
                                    <a href="?pg=debtor/deb_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fas fa-file-invoice-dollar"></i>Menu</a>
                                <?php } ?>
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'deb_view' ) ) { ?>
                                    <a href="?pg=debtor/deb_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fas fa-file-invoice-dollar"></i>Menu</a>
                                <?php } ?>
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'deb_edit' ) ) { ?>
                                    <a href="?pg=debtor/deb_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fas fa-file-invoice-dollar"></i>Menu</a>
                                <?php } ?>
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'deb_payment' ) ) { ?>
                                    <a href="?pg=debtor/deb_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fas fa-file-invoice-dollar"></i>Menu</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // TASKS //
                                // --------------------------------------- //-->
                                <!-- MAIN -->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'tsk_main' ) ) { ?>
                                  <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Tarefa" onclick="abreFecha('add_task')" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="fas fa-tasks"></i>[+] Tarefa</a>
                                  <a href="?pg=schedule/sch_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Calendário" style="color: rgb( 193, 214, 243 ); text-decoration: none;"><i class="ion ion-android-calendar"></i>Calendário</a>
                                  <a href="?pg=tasks/tsk_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Listar Tarefas" style="text-decoration: none;"><i class="fa fa-search"></i>Listar</a>
                                <?php } ?>

                                <!--// -----------------------------------------
                                // SCHEDULE //
                                // --------------------------------------- //-->
                                <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'sch_main' ) ) { ?>
                                  <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar Evento" onclick="abreFecha('add_event')" style="color: rgb( 255, 229, 192 ); text-decoration: none;"><i class="ion ion-android-calendar"></i>[+] Evento</a>
                                  <a href="?pg=tasks/tsk_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Tarefas" style="text-decoration: none;"><i class="fa fa-folder"></i>Tarefas</a>
                                <?php } ?>
                                <!--// -----------------------------------------
                                // GERAL: END MENU //
                                // --------------------------------------- //-->
                                <a href="#fim" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fim da página" style="text-decoration: none;"><i class="fas fa-arrow-circle-down"></i>Fim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>