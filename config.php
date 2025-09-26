<?php
	if( !isset( $_SESSION ) ) session_start();
    ob_start(); // Inicia o buffer de saída
    require_once(__DIR__ . '/access/conn.php');
    require_once(__DIR__ . '/access.php');

    /**
     * START SYSTEM FUNCTIONS
     */

	// ======================================================================================= //
	// TIMEZONE
	// ======================================================================================= //
	setlocale( LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese" );
	date_default_timezone_set("America/Sao_Paulo");
	$PADRAO = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

    // ======================================================================================= //
	// MODULES
	// ======================================================================================= //
	$MOD_01 = 1; // clients - GESTÃO DE CLIENTES
	$MOD_02 = 2; // cases - GESTÃO DE PROCESSOS
	$MOD_03 = 3; // finances - LIVRO CAIXA
	$MOD_04 = 4; // funds - FUNDOS DE EMERGÊNCIA
	$MOD_05 = 5; // devcalc - DEVEDORES DE CÁLCULOS
	$MOD_06 = 6; // inventory - GESTÃO DE BENS E PATRIMÔNIO
	$MOD_07 = 7; // matters - ASSUNTOS PENDENTES
	$MOD_08 = 8; // loan - CAPTAÇÃO DE RECURSOS
    $MOD_09 = 9; // tasks - GESTÃO DE TAREFAS
    $MOD_10 = 10; // schedule - GESTÃO DE COMPROMISSOS

	// -- VERIFICANDO MODULOS DO CLIENTE -- //
	if( isset( $_SESSION[ 'USR_FK_CLIENT' ] ) && !empty( $_SESSION[ 'USR_FK_CLIENT' ] ) ) {

		$USR_FK_CLIENT = $_SESSION[ 'USR_FK_CLIENT' ];

		$SQL = mysqli_query( $CONN1, " SELECT DISTINCT MAN.MAN_FK_CLIENT, MAN.MAN_FK_MODULE, MD.MOD_NAME
                                         FROM SYS_MANAGER MAN
                                         JOIN SYS_STATUS STA ON STA.STA_ID = MAN.MAN_FK_STATUS
                                         JOIN SYS_CLIENTS CLI ON CLI.CLI_ID = MAN.MAN_FK_CLIENT
                                         JOIN SYS_PLANS PLN ON PLN.PLN_ID = MAN.MAN_FK_PLAN
                                         JOIN SYS_MODULES MD ON MD.MOD_ID = MAN.MAN_FK_MODULE
                                        WHERE MAN.MAN_FK_CLIENT = '$USR_FK_CLIENT' AND MAN.MAN_FK_STATUS = 1
                                     GROUP BY MAN.MAN_FK_MODULE ASC
                                     " );

		while( $ROW = mysqli_fetch_array( $SQL ) )
        {
			$MODULE[] = $ROW[ 'MAN_FK_MODULE' ];
		}

	}

    // ======================================================================================= //
	// TITLES AND SUBTITLES
	// ======================================================================================= //
	$title                         = "SiSADv";
	$clientManagement              = "Gestão de Clientes";
		$clientSubtitle               = "Cadastros";
	$financesTitle                 = "Gestão Financeira";
		$financesSubtitle             = "Livro Caixa";
	$fundsTitle                    = "Gestão de Fundos";
		$fundsSubtitle                = "Emergencial & Imobiliário";
	$caseTitle                     = "Gestão de Processos";
		$caseSubtitle                 = "Relação de Contratos";
		$caseRol                      = "Relação Geral de Processos";
		$caseAdd                      = "Cadastro";
		$caseUpdt                     = "Edição de Contrato";
		$caseHistory                  = "Histórico de Contratos Finalizados";
		$casePayment                  = "Registrar Pagamento";
	$debTitle                      = "Devedores de Cálculos";
		$debSubtitle                  = "Relação de Devedores";
		$debRegister                  = "Cadastro";
		$debPayment                   = "Lançamento";
	$matterTitle                   = "Assuntos Pendentes";
		$matterSubtitle               = "Assuntos";
	$devTitle                      = "Configurações";
		$devSubtitle                  = "Ambiente de Desenvolvedor";
	$loanTitle                     = "Gestão de Empréstimos";
		$loanSubtitle                 = "Relação de Contratos";
	$invTitle                      = "Inventário de Bens e Patrimônio";
		$invSubtitle                  = "Relação dos Bens";
	$devTitle                      = "Ambiente de Desenvolvedor";
		$sysSubtitle                  = "Administração do Sistema";
		$dbaSubtitle                  = "Gerenciamento de Banco de Dados";
		$cliSubtitle                  = "Gerenciamento de Clientes";
		$manSubtitle                  = "Gerenciamento de Contas";
		$modSubtitle                  = "Gerenciamento de Módulos";
		$plnSubtitle                  = "Gerenciamento de Planos";
		$usrSubtitle                  = "Gerenciamento de Usuários";
		$logSubtitle                  = "Registros de Acesso";
	$tmlTitle                      = "Histórico";
		$tmlSubtitle                  = "Linha o Tempo";
    $notTitle                      = "Anotações";
        $notSubtitle                  = "Registro";
    $advTitle                      = "Gestão de Advogados";
        $advSubtitle                  = "Informações";
    $scheduleTitle                 = "Agenda";
        $scheduleSubtitle             = "Compromissos";
    $tasksTitle                    = "Fluxo de Trabalho";
        $tasksSubtitle                = "Gestão de Tarefas";
    $maintenanceTitle              = "Manutenção do Sistema";
        $maintenanceSubtitle          = "Suspender para Atualizações e Correções";

    /**
     * END SYSTEM FUNCTIONS
     */
    ob_end_flush(); // Envia e limpa o buffer de saída