<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 4;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

    // Verifique se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Verifique o valor do checkbox
        $main_active = isset($_POST['main_active']) ? 1 : 0;

        // Prepare e execute a query de atualização
        $sql = "UPDATE SYS_MAINTENANCE SET MAIN_ACTIVE = ?";

        if ($stmt = $CONN1->prepare($sql))
        {
            $stmt->bind_param("i", $main_active);

            // Execute a query
            if ($stmt->execute()) {
                echo "Status atualizado com sucesso.";
            }
            else
            {
                echo "Erro ao atualizar o status: " . $stmt->error;
            }

            // Fechar a declaração
            $stmt->close();
        }
        else
        {
            echo "Erro na preparação da query: " . $CONN1->error;
        }

        // Fechar a conexão, se necessário
        // $CONN1->close();
    }
    else
    {
        echo "Método de requisição inválido.";
    }

    // Consulta o valor de MAIN_ACTIVE para determinar se é verdadeiro o status de manutenção
    $sql = "SELECT MAIN_ACTIVE FROM SYS_MAINTENANCE LIMIT 1";
    $result = $CONN1->query($sql);

    if ($result->num_rows > 0) {
        // Obter o valor de MAIN_ACTIVE
        $row = $result->fetch_assoc();
        $main_active = $row['MAIN_ACTIVE'];
    } else {
        // Valor padrão caso não exista um registro
        $main_active = 0;
    }

    // Fechar a conexão, se necessário
    $CONN1->close();
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!--// MENU //-->
            <?php require './menuh.php'; ?>

			<div class="invoice p-3 mb-3 card card-danger card-outline">

				<!-- title row -->
                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $maintenanceTitle; ?><span class="subtitle"><?= $maintenanceSubtitle; ?></span></legend>
                </div>

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

				<div class="container-fluid table-responsive">

                    <div class="card card-secondary text-center">
                        <div class="card-header">
                            <h3 class="card-title">Sistema suspenso</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
                                <input type="checkbox" name="main_active" <?php echo $main_active == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>

				</div><!-- /.container-fluid -->

				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <?php require './footerInt.php'; ?>

			</div><!-- /.Invoice -->
			<!-- FIM DA PESQUISA-->

		</div><!-- /.End Container-fluid -->
	</section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<!-- JS do Bootstrap Switch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<script>
    $(document).ready(function(){
        $("[data-bootstrap-switch]").bootstrapSwitch();
    });
</script>