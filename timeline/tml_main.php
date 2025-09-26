<?php
if (!isset($_SESSION)) session_start();
$required_level = 2;
require_once(__DIR__ . '/../access/level.php');
require_once(__DIR__ . '/../access/conn.php');
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../dist/func/functions.php');

if (isset($_GET['id'])) {
    $ID = $_GET['id'];

    $SQL = " SELECT DISTINCT CLI.CLI_ID, CLI.CLI_NOME, CLI.CLI_DT_CREATION, CLI.CLI_USER_CREATION, CLI.CLI_FK_STATUS,
                                 NTE.NOT_NOTE, NTE.NOT_DT_CREATION, NTE.NOT_USER_CREATION,
                                 DEV.DEV_DATE, DEV.DEV_DESCRIPTION, DEV.DEV_DT_CREATION, DEV.DEV_USER_CREATION,
                                 PPR.PPR_PARTE_CONTRARIA, PPR.PPR_TIPO_ACAO, PPR.PPR_NUM_PROCESSO, PPR.PPR_DT_CREATION, PPR.PPR_USER_CREATION,
                                 EMP.EMP_DT_FINANCIAMENTO, EMP.EMP_VALOR_FINANCIADO, EMP.EMP_DT_INICIO_PGTO, EMP.EMP_DT_FIM_PGTO, EMP.EMP_DT_CREATION, EMP.EMP_USER_CREATION,
                                 PAS.PAS_NOME
                     FROM CLI_CLIENTES CLI
              LEFT JOIN NOT_NOTES NTE ON NTE.NOT_FK_CLIENT = CLI.CLI_ID
              LEFT JOIN DEV_CALC_MOV DEV ON DEV.DEV_FK_CLIENT = CLI.CLI_ID
              LEFT JOIN PPR_PROC_PROCESSOS PPR ON PPR.PPR_FK_CLIENTE = CLI.CLI_ID
              LEFT JOIN EMP_EMPRESTIMO_MOV EMP ON EMP.EMP_FK_CLIENTE = CLI.CLI_ID
              LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                  WHERE CLI.CLI_ID = '$ID'
             GROUP By CLI.CLI_NOME, NTE.NOT_NOTE, DEV.DEV_DESCRIPTION, PPR.PPR_NUM_PROCESSO, EMP.EMP_VALOR_FINANCIADO
             ORDER By CLI.CLI_DT_CREATION DESC, NOT_DT_CREATION DESC, DEV_DT_CREATION DESC, PPR_DT_CREATION DESC, EMP_DT_CREATION DESC
                 ";
}
$RESULT = mysqli_query($CONN, $SQL);
$ROW = mysqli_fetch_array($RESULT);
$ID = $ROW['CLI_ID'];
$CLIENTE = $ROW['CLI_NOME'];
$PASTA = $ROW['PAS_NOME'];
?>

<a name="topo"></a>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <?php require './menuh.php'; ?>

            <div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $tmlTitle; ?><span class="subtitle"><?= $tmlSubtitle; ?></span></legend>
                </div>

                <hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <!-- /.CLIENTE -->
                <div class="row" style="background-color: rgb( 63, 71, 78 );">
                    <div class="col-auto">
                        <span>Código: <?= $ID; ?></span>
                    </div>
                    <div class="col-auto">
                        <span>Cliente: <?= $CLIENTE; ?></span>
                    </div>
                    <div class="col-auto">
                        <span>Pasta: <?= $PASTA; ?></span>
                    </div>
                </div>

                <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <?php
                while ($ROW = mysqli_fetch_assoc($RESULT)) {
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline">

                                <?php while ($DADOS = mysqli_fetch_assoc($RESULT)) { ?><!-- START of While Loop -->

                                    <?php if (isset($DADOS['DEV_DESCRIPTION'])) { ?>
                                        <!-- // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                        // EVENT //
                                        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- // -->
                                        <div class="time-label"><!-- timeline DATA item -->
                                            <span class="bg-blue">
                                                <?php
                                                if ($DADOS['DEV_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                    echo "$DEV_DT_CREATION = '2021-01-01'";
                                                } else {
                                                    $DEV_DT_CREATION = date("d/m/Y", strtotime($DADOS['DEV_DT_CREATION']));
                                                    echo $DEV_DT_CREATION;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-star bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i><!-- HOUR -->
                                                    <?php
                                                    if ($DADOS['DEV_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                        echo "$DEV_DT_CREATION = '00:00:00'";
                                                    } else {
                                                        $DEV_DT_CREATION = date("H:m:s", strtotime($DADOS['DEV_DT_CREATION']));
                                                        echo $DEV_DT_CREATION;
                                                    }
                                                    ?>
                                                </span>
                                                <h3 class="timeline-header no-border">Evento:</h3>
                                                <div class="timeline-body"><!-- MESSAGE -->
                                                    <?= $DADOS['DEV_DESCRIPTION']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // END timeline item---------------------------------------------------------------------------------------------------------------------------------------------------- // -->
                                    <?php } ?>

                                    <?php if (isset($DADOS['NOT_NOTE'])) { ?>
                                        <!-- // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                        // NOTE //
                                        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- // -->
                                        <div class="time-label"><!-- timeline DATA item -->
                                            <span class="bg-blue">
                                                <?php
                                                if ($DADOS['NOT_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                    echo "$NOT_DT_CREATION = '2021-01-01'";
                                                } else {
                                                    $NOT_DT_CREATION = date("d/m/Y", strtotime($DADOS['NOT_DT_CREATION']));
                                                    echo $NOT_DT_CREATION;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i><!-- HOUR -->
                                                    <?php
                                                    if ($DADOS['NOT_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                        echo "$NOT_DT_CREATION = '00:00:00'";
                                                    } else {
                                                        $NOT_DT_CREATION = date("H:m:s", strtotime($DADOS['NOT_DT_CREATION']));
                                                        echo $NOT_DT_CREATION;
                                                    }
                                                    ?>
                                                </span>
                                                <h3 class="timeline-header">Nota:</h3><!-- TITLE -->
                                                <div class="timeline-body"><!-- MESSAGE -->
                                                    <?= $DADOS['NOT_NOTE']; ?>
                                                </div>
                                                <div class="timeline-footer text-right">
                                                    <a class="btn btn-primary btn-sm">Read more</a>&nbsp;&nbsp;
                                                    <a class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // END timeline item---------------------------------------------------------------------------------------------------------------------------------------------------- // -->
                                    <?php } ?>

                                <?php } ?><!-- END of While Loop -->

                                <!-- // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                        // CREATE USER //
                                        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- // -->
                                <div class="time-label"><!-- timeline DATA item -->
                                    <span class="bg-blue">
                                        <?php
                                            if ($ROW['CLI_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                echo "$CLI_DT_CREATION = '2021-01-01'";
                                            } else {
                                                $CLI_DT_CREATION = date("d/m/Y", strtotime($ROW['CLI_DT_CREATION']));
                                                echo $CLI_DT_CREATION;
                                            }
                                        ?>
                                    </span>
                                </div>
                                <div>
                                    <i class="fas fa-user bg-gray"></i><!-- timeline item -->

                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i><!-- HOUR -->
                                            <?php
                                                if ($ROW['CLI_DT_CREATION'] == "0000-00-00 00:00:00") {
                                                    echo "$CLI_DT_CREATION = '00:00:00'";
                                                } else {
                                                    $CLI_DT_CREATION = date("H:m:s", strtotime($ROW['CLI_DT_CREATION']));
                                                    echo $CLI_DT_CREATION;
                                                }
                                            ?>
                                        </span>
                                        <h3 class="timeline-header">Cadastrado no sistema</h3><!-- LEGEND -->
                                    </div>
                                </div>
                                <!-- // END timeline item---------------------------------------------------------------------------------------------------------------------------------------------------- // -->

                            </div><!-- /.End TimeLine -->
                        </div><!-- /.End Col -->
                    </div><!-- /.End Row -->

                <?php } ?>

            </div><!-- /.End Invoice -->

        </div><!-- /.End Container-Fluid -->
    </section><!-- /.End Section Content -->

    <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close($CONN); ?>