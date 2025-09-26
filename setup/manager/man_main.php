<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!--// CLIENT HEADER //-->
	<?php require 'man_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!--// CLIENT MENU //-->
			<?php require 'man_menu.php'; ?>

			<!-- INÍCIO DA PESQUISA -->
			<div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->
				<!-- title row -->
				<div class="container">
					<div class="row col-12">
						<div class="form-group col-sm-2">

						</div>
						<div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
							<legend><?= $manSubtitle; ?></legend>
						</div>
						<div class="form-group col-sm-2">

						</div>
					</div>
					<!-- /.col -->
				</div>

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid table-responsive">

				<?php

                // Conectar ao banco de dados
                $host = 'localhost';
                $dbname = 'sisadv_system';
                $username = 'sisadv_system';
                $password = 'GPv%YpLH7@';

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erro na conexão: " . $e->getMessage());
                }

				// Consultar todos os clientes, planos e inscrições
				$query = " SELECT MAN.*, MD.*, CLI.CLI_ID, CLI.CLI_OFFICE, PLN.PLN_NAME
					  		 FROM SYS_MANAGER MAN
                        LEFT JOIN SYS_MODULES MD    ON MD.MOD_ID  = MAN.MAN_FK_MODULE
                        LEFT JOIN SYS_CLIENTS CLI   ON CLI.CLI_ID = MAN.MAN_FK_CLIENT
                        LEFT JOIN SYS_PLANS PLN     ON PLN.PLN_ID = MAN.MAN_FK_PLAN
                            WHERE MAN.MAN_FK_STATUS = 1
                         GROUP BY MAN.MAN_FK_MODULE, CLI.CLI_OFFICE
                         ORDER By CLI.CLI_OFFICE
						 ";

                $stmt = $pdo->prepare($query);
                $stmt->execute();

                // Obter os resultados
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Processar os dados para exibir os modulos como colunas
                $clientes = [];
                $modulos = [];

                // Organizar os resultados em uma estrutura por cliente e modulos
                foreach ($resultados as $row) {
                  $id_cliente   = $row['MAN_FK_CLIENT'];
                  $nome_cliente = $row['CLI_OFFICE'];
                  $id_modulo    = $row['MAN_FK_MODULE'];
                  $nome_modulo  = $row['MOD_NAME'];
                  $inscrito     = $row['MAN_FK_MODULE'] ? '<i class="fas fa-check" style="color: rgb( 255, 0, 0 );"></i>' : 'X'; // Marca com '✓' se estiver inscrito, caso contrário, 'X'

                  // Armazena os modulos para as colunas
                  if (!in_array($nome_modulo, $modulos)) {
                      $modulos[] = $nome_modulo;
                  }

                  // Armazena as inscrições por cliente
                  if (!isset($clientes[$id_cliente])) {
                      $clientes[$id_cliente] = ['nome' => $nome_cliente, 'modulos' => []];
                  }

                  $clientes[$id_cliente]['modulos'][$nome_modulo] = $inscrito;
                }

                // Exibir a tabela
                echo "<table id='table' class='table table-dark table-striped table-hover table-sm'>";
                echo "<tr>";
                echo "<th scope='col' style='justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 700;'>Cliente</th>";

                // Cabeçalhos com o nome dos modulos
                foreach ($modulos as $modulo) {
                    echo "<th scope='col' style='justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 0.8em; font-weight: 700;'>" . htmlspecialchars($modulo) . "</th>";
                }
                echo "</tr>";

                // Exibir cada cliente e seus modulos
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td style='justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;'>" . htmlspecialchars($cliente['nome']) . "</td>";

                    // Exibir se o cliente está inscrito em cada modulo
                    foreach ($modulos as $modulo) {
                        echo "<td style='justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;'>" . (isset($cliente['modulos'][$modulo]) ? $cliente['modulos'][$modulo] : '<i class="fas fa-times" style="color: rgb( 255, 255, 255 );"></i>') . "</td>";
                    }

                    echo "</tr>";
                }
                echo "</table>";

              ?>

					<!-- FIM DA PESQUISA-->

				</div><!-- /.container-fluid -->

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<?php require 'man_footer.php'; ?>

			</div><!-- /.Invoice -->
			<!-- FIM DA PESQUISA-->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<?php
	mysqli_close( $CONN1 );
?>