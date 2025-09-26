<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');

    if( isset( $_GET[ 'id' ] ) ) {
		$ID = $_GET[ 'id' ];

		$SQL = " SELECT * FROM EMP_EMPRESTIMO_MOV WHERE EMP_ID = '$ID' ";
		$RESULTADO = mysqli_query( $CONN, $SQL );
		$DADOS = mysqli_fetch_array( $RESULTADO );
	}
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'loa_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'loa_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $loanSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <form class="signin-form" formname="loan" id="loan" action="?pg=loan/loa_resimulation" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="EMP_ID">#Contrato</label>
                            <input class="form-control" type="text" id="EMP_ID" name="EMP_ID" value="<?= $DADOS[ 'EMP_ID' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="EMP_FK_CLIENTE">Cliente</label>
                            <?php
                                $CLIENTE = $DADOS[ 'EMP_FK_CLIENTE' ];
                                if( $CLIENTE ) {
                                    $SQL = "SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES WHERE CLI_ID = '$CLIENTE' ";
                                    $ROW = mysqli_query( $CONN, $SQL );
                                    $R = mysqli_fetch_array( $ROW );
                                    $EMP_FK_CLIENTE = $R[ 'CLI_NOME' ];
                                    echo " <input class=\"form-control\" type=\"text\" name=\"EMP_FK_CLIENTE\" value=\"$EMP_FK_CLIENTE\" readonly /> ";
                                } else {
                                    echo " Erro ";
                                }
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label>Data do financiamento</label>
                            <input class="form-control" type="date" name="EMP_DT_FINANCIAMENTO" id="EMP_DT_FINANCIAMENTO" value="<?= $DADOS[ 'EMP_DT_FINANCIAMENTO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Número de parcelas</label>
                            <input class="form-control" type="text" name="EMP_PARCELAS" id="EMP_PARCELAS" value="<?= $DADOS[ 'EMP_PARCELAS' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Início do pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_INICIO_PGTO" value="<?= $DADOS[ 'EMP_DT_INICIO_PGTO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Fim do Pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_FIM_PGTO" value="<?= $DADOS[ 'EMP_DT_FIM_PGTO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Dia de Vencimento</label>
                            <input class="form-control" type="text" name="EMP_DIA_PGTO" value="<?= $DADOS[ 'EMP_DIA_PGTO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Percentual de juros</label>
                            <input class="form-control" type="text" name="EMP_PERCENTUAL_JUROS" id="EMP_PERCENTUAL_JUROS" value="<?= $DADOS[ 'EMP_PERCENTUAL_JUROS' ]; ?>" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>Valor financiado</label>
                            <input class="form-control" type="text" name="EMP_VALOR_FINANCIADO" id="EMP_VALOR_FINANCIADO" value="<?= formata_dinheiro( $DADOS[ 'EMP_VALOR_FINANCIADO' ] ) ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Valor da parcela</label>
                            <input class="form-control" type="text" name="EMP_VALOR_PARCELA" id="EMP_VALOR_PARCELA" value="<?= formata_dinheiro( $DADOS[ 'EMP_VALOR_PARCELA' ] ) ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Total de juros</label>
                            <input class="form-control" type="text" name="EMP_TOTAL_JUROS" id="EMP_TOTAL_JUROS" value="<?= formata_dinheiro( $DADOS[ 'EMP_TOTAL_JUROS' ] ) ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Valor total financiado</label>
                            <input class="form-control" type="text" name="EMP_VALOR_TOTAL" id="EMP_VALOR_TOTAL" value="<?= formata_dinheiro( $DADOS[ 'EMP_VALOR_TOTAL' ] ) ?>" readonly />
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Observações</label>
                        <textarea class="form-control" name="obs" cols="20" rows="5" style="overflow: hidden; resize: none; text-align: justify;" readonly><?= $DADOS[ 'EMP_OBS' ]; ?></textarea>
                    </div>

                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: rgb( 248, 152, 152 ); background: rgb( 249, 234, 212 );" />

                    <div class="row justify-content-center align-items-center">
                        <h5 style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Histórico de pagamentos</h5>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <table class="table table-dark table-striped table-hover table-sm" style="width: 25%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data do pagamento</th>
                                    <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $CONTRATO = $_GET[ 'id' ]; //emprestimo_mov - Numero do Contrato
                                    $SQL = " SELECT EP.*, EM.EMP_PARCELAS, EM.EMP_SALDO FROM EPG_EMPRESTIMO_PGTO EP JOIN EMP_EMPRESTIMO_MOV EM ON EP.EPG_FK_CONTRATO = EM.EMP_ID AND EM.EMP_ID = '$CONTRATO' ";
                                    $R = mysqli_query( $CONN, $SQL );
                                    while( $ROW = mysqli_fetch_assoc( $R ) ) {
                                ?>
                                    <tr>
                                        <th scope="row" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= $DT = date("d/m/Y", strtotime( $ROW[ 'EPG_DT_PGTO' ] ) ); ?></th>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;"><?= formata_dinheiro( $ROW[ 'EPG_VALOR' ] ) ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: rgb( 248, 152, 152 ); background: rgb( 249, 234, 212 );" />

                    <div class="form-group" align="center">
                        <a href="?pg=loan/loa_edit&id=<?= $DADOS[ 'EMP_ID' ]; ?>" class="btn btn-light btn-sm"
                            style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;"
                            onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                            <i class="fas fa-edit"></i>&nbsp;Alterar
                        </a >
                    </div>
                </form>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'loa_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>