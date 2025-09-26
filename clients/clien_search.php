<?php
  if (!isset($_SESSION)) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/clien_proc.php');
?>

<a name="topo"></a>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <?php require './menuh.php'; ?>

            <div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $clientManagement; ?><span class="subtitle"><?= $clientSubtitle; ?></span></legend>
                </div>

                <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <!-- /.CADASTRO DE PASTA -->
                <div class="row justify-content-md-center">
                    <!-- /.BLOCO ADD/REMOV CAT./MOV. -->
                    <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_pasta">
                        <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Pasta</h3>
                        <table class="table" width="100%" style="background-color: rgb( 69, 77, 85 );">
                            <tr>
                                <td valign="top">
                                    <form method="POST" action="<?= $_SERVER['REQUEST_URI']; ?>">
                                        <div class="container" style="text-align: center;">
                                            <div class="row justify-content-md-center">
                                                <div class="col" style="text-align: center;">
                                                    <input type="hidden" name="acao" value="2" />
                                                    <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Nome:</strong><br />
                                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="PAS_NOME" size="20" maxlength="50" required />
                                                    <br /><br />
                                                    <button type="submit" value="Enviar" class="btn input btn-light btn-sm" style="color: rgb( 205, 204, 204 ); font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td valign="top" align="right">
                                    <b>Editar/Remover Pastas:</b><br/><br/>
                                    <?php
                                        $QR = mysqli_query( $CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ");
                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                    ?>
                                    <div id="editar2_pasta_<?= $ROW[ 'PAS_ID' ]; ?>"><?= $ROW[ 'PAS_NOME' ]; ?>
                                        <a style="font-size: 1.0em; color: rgb( 227, 164, 164 )" onclick="return confirm('Tem certeza que deseja remover esta pasta?\nAtenção: Apenas pastas sem movimentos associados poderão ser removidas.')" href="?pg=clients/clien_search&acao=apagar_pasta&id=<?= $ROW[ 'PAS_ID' ]; ?>" title="Remover">[remover]</a>
                                        <a href="javascript:;" style="font-size: 1.0em; color: rgb( 119, 230, 189 )" onclick="document.getElementById('editar_pasta_<?= $ROW[ 'PAS_ID' ]; ?>').style.display=''; document.getElementById('editar2_pasta_<?= $ROW[ 'PAS_ID' ]; ?>').style.display='none'" title="Editar">[editar]</a>
                                    </div>
                                    <div style="display: none" id="editar_pasta_<?= $ROW[ 'PAS_ID' ]; ?>">
                                        <form method="POST" action="<?= $_SERVER['REQUEST_URI']; ?>">
                                            <input type="hidden" name="acao" value="editar_pasta" />
                                            <input type="hidden" name="PAS_ID" value="<?= $ROW[ 'PAS_ID' ]; ?>" />
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="PAS_NOME" value="<?= $ROW[ 'PAS_NOME' ]; ?>" size="20" maxlength="50" />
                                            <input type="submit" class="input" value="Alterar" />
                                        </form>
                                    </div>

                                    <?php }?>

                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

                <div class="row table-responsive" style="overflow: hidden;">

                    <!-- /.BLOCO FILTRO -->
                    <hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                    <div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
                        <div class="col-10 mt-2 mb-0">
                            <caption style="color: rgb( 254, 214, 122 );">Filtro por pasta</caption>
                        </div>
                        <div class="col-2 mt-1 mb-1 text-right">
                            <form name="form_filter_cat" action="<?= $_SERVER['REQUEST_URI']; ?>" method="GET">
                                <input type="hidden" name="pg" value="clients/clien_search" />
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

                    <table id="cli" class="table table-dark table-striped table-hover table-sm overflow-hidden" style="overflow: hidden;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Cód</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Ativo</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Nome</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Telefone</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Celular</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Cidade</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">
                                    Pasta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $filter = "";
                            if (isset($_GET['filter_cat']) && $_GET['filter_cat'] != 'ALL') {
                                $filter = "CLI.CLI_FK_PASTA = '" . $_GET['filter_cat'] . "' ";

                                $SQL = " SELECT CLI.*, STA.*, PAS.*
                                                  FROM CLI_CLIENTES CLI
                                                    JOIN STA_STATUS STA ON CLI.CLI_FK_STATUS = STA.STA_ID
                                                    JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                                               WHERE $filter
                                          ORDER By CLI.CLI_ID DESC
                                             ";

                                $RESULTADO = mysqli_query($CONN, $SQL);
                                $VERIFICA = mysqli_num_rows($RESULTADO);
                            } else {
                                $SQL = " SELECT CLI.*, STA.*, PAS.*
                                                  FROM CLI_CLIENTES CLI
                                                    JOIN STA_STATUS STA ON CLI.CLI_FK_STATUS = STA.STA_ID
                                                    JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                                          ORDER By CLI.CLI_ID DESC
                                             ";

                                $RESULTADO = mysqli_query($CONN, $SQL);
                                $VERIFICA = mysqli_num_rows($RESULTADO);
                            }

                            if ($VERIFICA > 0) {
                                while ($DADOS = mysqli_fetch_assoc($RESULTADO)) {
                            ?>
                                    <tr>
                                        <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?= $DADOS['CLI_ID'] ?></th>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?php
                                            if ($DADOS['CLI_FK_STATUS'] == 1) {
                                                echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                                            } else {
                                                echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                                            }
                                            ?>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                          <a href="?pg=clients/clien_view&id=<?= $DADOS['CLI_ID']; ?>" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><?= $DADOS['CLI_NOME'] ?></a>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?php
                                            if ($DADOS['CLI_TELEFONE'] == "") {
                                                echo ' --- ';
                                            } else {
                                                echo mask($DADOS['CLI_TELEFONE'], '(##) ####-####');
                                            }
                                            ?>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?php
                                            if ($DADOS['CLI_CELULAR'] == "") {
                                                echo ' --- ';
                                            } else {
                                                echo mask($DADOS['CLI_CELULAR'], '(##) #####-####');
                                            }
                                            ?>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?= $DADOS['CLI_CIDADE'] ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
                                            <?php
                                            $SQL = mysqli_query($CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
                                            while ($ROW = mysqli_fetch_array($SQL)) {
                                                if ($DADOS['CLI_FK_PASTA'] == $ROW['PAS_ID']) {
                                                    $PASTA = $DADOS['CLI_FK_PASTA'];
                                                    echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $ROW['PAS_NOME'] . '</h7>';
                                                }
                                            }
                                            ?>
                                        </td>
                                <?php }
                            } ?>
                                    </tr>
                        </tbody>
                    </table>
                </div><!-- /.row -->

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

    <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close($CONN); ?>