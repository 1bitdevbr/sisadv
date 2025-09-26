<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

	<?php
        /**
         * Nível Mínimo Requerido: (sisadv_system/SYS_LEVEL)
         * 1 - Usuário
         * 2 - Editor
         * 3 - Administrador
         * 4 - Desenvolvedor
         */
		$required_level = 1;

        // Arquivos necessários para o carregamento
		require(__DIR__ . '/config.php');
		require(__DIR__ . '/access.php');
		require(__DIR__ . '/access/level.php');
		require(__DIR__ . '/access/session.php');
		require(__DIR__ . '/dist/func/functions.php');
	?>

	<head>
        <!-- Requer o arquivo head.php que contém as diretivas de cabeçalho -->
		<?php require 'head.php'; ?>
	</head>

	<body class="hold-transition dark-mode sidebar-mini layout-fixed" style="padding-top: 75px;">

		<div id="wrapper" class="wrapper">

            <!-- Arquiros requeridos -->
			<?php require 'top.php'; ?> <!-- Topo da página -->
			<?php require 'menu.php'; ?> <!-- Menu lateral -->

			<div class="animated fadeIn myForm"> <!-- ./class="card-body card animated fadeIn myForm" -->
				<?php

                    /**
                     * Regras em caso de manutenção do sistema
                     */

                    // Consulta para verificar se o modo manutenção está ativo
                    $SQL    = " SELECT * FROM SYS_MAINTENANCE ";
                    $RESULT = mysqli_query($CONN1, $SQL);

                    // Verifique se há dados retornados
                    if (mysqli_num_rows($RESULT) > 0)
                    {

                        $ROW = mysqli_fetch_array($RESULT);
                        $MODO_MANUTENCAO = $ROW['MAIN_ACTIVE'];

                        // Se o Modo Manutenção for igual a 0, carregar o sistema
                        if ($MODO_MANUTENCAO == 0)
                        {
                            // Limpa da Sessão, se houver, a mensagem do Modo de Manutenção Ativo
                            unset($_SESSION['msg3']);

                            if ($_SESSION['USR_FK_LEVEL'] > 1)
                            { // Acesso a nível de Editor, Administrador e Desenvolvedor

                                if (isset($_GET['pg']) == "")
                                {
                                    $_GET['pg'] = "finances";
                                }
                                else if ((substr($_GET['pg'], 0, 4) == "http" || substr($_GET['pg'], 0, 3) == "ftp"))
                                {
                                    $_GET['pg'] = "deny";
                                }
                                $_GET['pg'] .= ".php";
                                include($_GET['pg']);

                            }
                            else
                            { // Acesso a nível de usuário comum

                                if (isset($_GET['pg']) == "")
                                {
                                    $_GET['pg'] = "start";
                                } else if ((substr($_GET['pg'], 0, 4) == "http" || substr($_GET['pg'], 0, 3) == "ftp"))
                                {
                                    $_GET['pg'] = "deny";
                                }
                                $_GET['pg'] .= ".php";
                                include($_GET['pg']);

                            }

                        }
                        else if (($MODO_MANUTENCAO == 1) && ($_SESSION[ 'USR_FK_LEVEL' ] == 4))
                        { // Se o Modo Manutenção for igual a 1, e o usuário for nível 4 (DESENVOLVEDOR), acessar o sistema

                            if (isset($_GET['pg']) == "")
                            {
                                // Carrega na Sessão a Mensagem de Alerta para o Modo de Manutenção Ativo
                                $_SESSION[ 'msg3' ] = "MODO DE MANUTENÇÃO ATIVO!";
                                $_GET['pg'] = "finances";
                            }
                            else if((substr($_GET['pg'], 0, 4) == "http" || substr($_GET['pg'], 0, 3) == "ftp"))
                            {
                                $_GET['pg'] = "deny";
                            }
                            $_GET['pg'] .= ".php";
                            include($_GET['pg']);

                        }
                        else
                        { // Se o Modo Manutenção for igual a 1, e o usuário for nível 1 (USUÁRIO), redirecionar para a página de Manutenção

                            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = 'maintenance/index.php'; }, 0);</script>";

                        }

                    }

				?>
			</div> <!-- /.card-body -->

			<aside class="control-sidebar control-sidebar-dark"></aside>

		</div> <!-- ./wrapper -->

		<?php require 'js.php'; ?>

	</body>

</html>