<?php
if (!isset($_SESSION)) session_start();
$required_level = 1;
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
					<legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $caseRol; ?></span></legend>
				</div>

                <!-- /.BLOCO FILTRO -->
                <hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
                    <div class="col-10 mt-2 mb-0">
                        <caption style="color: rgb( 254, 214, 122 );">Filtro por pasta</caption>
                    </div>
                    <div class="col-2 mt-1 mb-1 text-right">
                        <form name="form_filter_cat" action="<?= $_SERVER['REQUEST_URI']; ?>" method="GET">
                            <input type="hidden" name="pg" value="cases/cas_mainSec" />
                            <select class="form-control" class="mt-1 mb-1" name="filter_cat" onchange="form_filter_cat.submit()">
                                <option value="ALL">TODOS</option>
                                <?php
                                $QR = mysqli_query($CONN, " SELECT DISTINCT PAS.PAS_ID, PAS.PAS_NOME
                                                                                                FROM PAS_PROC_PASTA PAS, CLI_CLIENTES CLI
                                                                                             WHERE CLI.CLI_FK_PASTA = PAS.PAS_ID
                                                                                           ");
                                while ($ROW = mysqli_fetch_array($QR)) {
                                ?>
                                    <option <?php if (isset($_GET['filter_cat']) && $_GET['filter_cat'] == $ROW['PAS_ID']) echo "selected=selected" ?> value="<?= $ROW['PAS_ID']; ?>"><?= $ROW['PAS_NOME']; ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>
                </div>

                <hr class="mt-1 mb-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <div class="container-fluid">

                    <!-- INÍCIO DA PESQUISA -->
                    <form id="par_formulario" name="par_formulario" action="" method="POST" onsubmit="return false;" target="_self">
                        <table id="cas" class="table table-dark table-striped table-hover table-sm">
                            <caption>Resultado da consulta</caption>
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        #Caso</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Cliente</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Cidade</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Procedimento</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Processo</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Pasta</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Ativo</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                        Ações</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $filter = "";
                                if (isset($_GET['filter_cat']) && $_GET['filter_cat'] != 'ALL') {
                                    $filter = "PPR.PPR_FK_PASTA = '" . $_GET['filter_cat'] . "' ";

                                    $SQL = " SELECT PPR.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME
                                                    FROM PPR_PROC_PROCESSOS PPR
                                                    JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                                    JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                                WHERE $filter
                                            ORDER BY PPR.PPR_ID DESC
                                                    ";

                                    $RESULTADO = mysqli_query($CONN, $SQL);
                                    $VERIFICA = mysqli_num_rows($RESULTADO);
                                } else {

                                    $SQL = " SELECT PPR.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME
                                                    FROM PPR_PROC_PROCESSOS PPR
                                                        JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
                                                        JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
                                            ORDER BY PPR.PPR_ID DESC
                                                    ";

                                    $RESULTADO = mysqli_query($CONN, $SQL);
                                    $VERIFICA = mysqli_num_rows($RESULTADO);
                                }

                                if ($VERIFICA > 0) {
                                    while ($DADOS = mysqli_fetch_assoc($RESULTADO)) {
                                ?>
                                        <tr>
                                            <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: auto;"><?= $DADOS['PPR_CASO']; ?></th>
                                            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 30%;"><?= $DADOS['CLI_NOME']; ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: auto;"><?= $DADOS['CLI_CIDADE']; ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 40%;"><?= $DADOS['PPR_TIPO_ACAO']; ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 16%;">
                                                <?php if ($DADOS['PPR_NUM_PROCESSO'] > 0) {
                                                    $NUMPROCESS = processNumber("#######-##.####.#.##.####", $DADOS['PPR_NUM_PROCESSO']); ?>
                                                    <div class="input-group">
                                                        <h7 style="color: rgb( 248, 248, 242 ); font-weight: 600;"><?= $NUMPROCESS; ?></h7>
                                                        <!-- <input class="form-control" type="search" id="par_autorizacaoCaso_autorizacao_numeroProcessoUnificado" name="autorizacaoCaso.autorizacao.numeroProcessoUnificado" value="<?= $NUMPROCESS; ?>" aria-label="Search" readonly /> -->
                                                        <div class="input-group-append">
                                                            <!-- <button name="Consultar Processo" title="Consultar Processo" id="par_3obzrl3jl99o2ussxsslr74e" class="btn btn-outline-danger btn-sm" value="javascript:consultarProcesso();" role="button" aria-disabled="false"><i class="fas fa-search fa-fw" style="color: rgb( 221, 221, 221 );"></i></button> -->
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
                                                <?php
                                                if ($DADOS['PPR_FK_PASTA']) {
                                                    $PASTA = $DADOS['PPR_FK_PASTA'];
                                                    echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</h7>';
                                                }
                                                ?>
                                            </td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                                <?php
                                                if ($DADOS['PPR_FK_STATUS'] == 1) {
                                                    echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                                                } else {
                                                    echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                                                }
                                                ?>
                                            </td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                                <a href="?pg=cases/cas_view&id=<?= $DADOS['PPR_ID']; ?>" class="btn btn-outline-success" title="Ver"><i class="fas fa-eye"></i></a>
                                            </td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                                <a href="?pg=cases/cas_edit&id=<?= $DADOS['PPR_ID']; ?>" class="btn btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>

                </div><!-- /.container-fluid -->

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->

    </section><!-- /.End Section -->

    <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close($CONN); ?>