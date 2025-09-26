<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

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

                <form class="signin-form" formname="loan" id="loan" action="?pg=loan/loa_insert_resimulation" method="POST">
                <?php
                        if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
                            $EMP_ID = $_POST[ 'EMP_ID' ];
                            $EMP_FK_CLIENTE = $_POST[ 'EMP_FK_CLIENTE' ];
                            $EMP_DT_FINANCIAMENTO = test_input( $_POST[ 'EMP_DT_FINANCIAMENTO' ] );
                            $EMP_PARCELAS = test_input( $_POST[ 'EMP_PARCELAS' ] );
                            $EMP_DT_INICIO_PGTO = test_input( $_POST[ 'EMP_DT_INICIO_PGTO' ] );
                            $EMP_PERCENTUAL_JUROS = $_POST[ 'EMP_PERCENTUAL_JUROS' ];
                            $EMP_VALOR_FINANCIADO = moeda( $_POST[ 'EMP_VALOR_FINANCIADO' ] );
                            $EMP_OBS = $_POST[ 'EMP_OBS' ];
                            $EMP_USER_CREATION = $_SESSION[ 'USR_ID' ];
                        }

                            $C = (float) $EMP_VALOR_FINANCIADO; // VALOR DO CAPITAL
                            $T  = (int) $EMP_PARCELAS;    // TEMPO: MESES OU NUMERO DE PARCELAS
                            $J  = (float) $EMP_PERCENTUAL_JUROS;  // JUROS
                            $J  = (float) $EMP_PERCENTUAL_JUROS / 100; // JUROS

                            // Fórmula completa  C=(((1-(1+j)^-n))/j)*p
                            $RES = ( ( 1 - pow( ( 1 + $J ), ( $T * - 1 ) ) ) / $J );

                            $RES = $C / $RES; // Total de cada parcela
                            $TP = round( $RES, 2 ); // Total de cada parcela
                            $M = $TP * $T; // Total final com juros
                            $TJ = $M - $C; // Total ganho em juros
                    ?>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="EMP_ID">#Contrato</label>
                            <input class="form-control" type="text" id="EMP_ID" name="EMP_ID" value="<?= $EMP_ID; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="EMP_FK_CLIENTE">Cliente</label>
                            <input class="form-control" type="text" name="EMP_FK_CLIENTE" value="<?= $EMP_FK_CLIENTE; ?>" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label>Data do financiamento</label>
                            <input class="form-control" type="date" id="EMP_DT_FINANCIAMENTO" name="EMP_DT_FINANCIAMENTO" value="<?= $EMP_DT_FINANCIAMENTO; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Número de parcelas</label>
                            <input class="form-control" type="text" name="EMP_PARCELAS" id="EMP_PARCELAS" value="<?= $EMP_PARCELAS; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Início do pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_INICIO_PGTO" value="<?= $EMP_DT_INICIO_PGTO; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Fim do Pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_FIM_PGTO" value="<?= dt_fim_pgto( $EMP_DT_INICIO_PGTO, $EMP_PARCELAS ); ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Dia de Vencimento</label>
                            <input class="form-control" type="text" name="EMP_DIA_PGTO" value="<?= $EMP_DIA_PGTO = date( "d", strtotime( $EMP_DT_INICIO_PGTO ) ); ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Percentual de juros</label>
                            <input class="form-control" type="text" name="EMP_PERCENTUAL_JUROS" id="EMP_PERCENTUAL_JUROS" value="<?= $J; ?>" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>Valor financiado</label>
                            <input class="form-control" type="text" name="EMP_VALOR_FINANCIADO" id="EMP_VALOR_FINANCIADO" value="<?= formata_dinheiro( $C ); ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Valor da parcela</label>
                            <input class="form-control" type="text" name="EMP_VALOR_PARCELA" id="EMP_VALOR_PARCELA" value="<?= formata_dinheiro( $TP ); ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Total de juros</label>
                            <input class="form-control" type="text" name="EMP_TOTAL_JUROS" id="EMP_TOTAL_JUROS" value="<?= formata_dinheiro( $TJ ); ?>" readonly />
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Valor total financiado</label>
                            <input class="form-control" type="text" name="EMP_VALOR_TOTAL" id="EMP_VALOR_TOTAL" value="<?= formata_dinheiro( $M ); ?>" readonly />
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Observações</label>
                        <textarea class="form-control" name="EMP_OBS" cols="20" rows="5" style="overflow: hidden; resize: none; text-align: justify;" readonly><?= $EMP_OBS; ?></textarea>
                    </div>

                    <div class="form-group" align="center">
                        <button class="btn btn-light btn-sm" id="btn-atualizar" name="btn-atualizar" value="btn-atualizar" style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'"><i class="fas fa-edit"></i>&nbsp;Atualizar</button>
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