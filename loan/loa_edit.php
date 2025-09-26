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
                            <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Data do financiamento</label>
                            <input class="form-control" type="date" id="EMP_DT_FINANCIAMENTO" name="EMP_DT_FINANCIAMENTO" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); font-weight: 600;" value="<?= $DADOS[ 'EMP_DT_FINANCIAMENTO' ]; ?>" autofocus required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Número de parcelas</label>
                            <input class="form-control" type="text" name="EMP_PARCELAS" id="EMP_PARCELAS" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); font-weight: 600;" value="<?= $DADOS[ 'EMP_PARCELAS' ]; ?>" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Início do pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_INICIO_PGTO" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); font-weight: 600;" value="<?= $DADOS[ 'EMP_DT_INICIO_PGTO' ]; ?>" required />
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
                            <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Percentual de juros</label>
                            <select class="form-control" name="EMP_PERCENTUAL_JUROS" id="EMP_PERCENTUAL_JUROS" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); font-weight: 600;" required>
                        <?php
                            $PERCENTUAL_JUROS = $DADOS[ 'EMP_PERCENTUAL_JUROS' ];
                            $EMP_PERCENTUAL_JUROS = $PERCENTUAL_JUROS * 100;
                            if( $EMP_PERCENTUAL_JUROS ) { ?>
                                <option value="">Selecione...</option>
                        <?php
                            for( $i = 0.5; $i <= 10; $i += 0.5 ) { ?>
                                <option <?= ( $EMP_PERCENTUAL_JUROS == $i ) ? 'selected' : ''; ?>><?= $i ?>&nbsp;% ao mês</option>
                <?php }
                        } else { ?>
                                <option value="">Selecione...</option>
                        <?php
                            for( $i = 0.5; $i <= 10; $i += 0.5 ) { ?>
                                <option value="<?= $i; ?>"><?= $i ?>&nbsp;% ao mês</option>
                <?php }
                        } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Valor financiado</label>
                            <input class="form-control" type="text" name="EMP_VALOR_FINANCIADO" id="EMP_VALOR_FINANCIADO" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); font-weight: 600;" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" value="<?= formata_dinheiro( $DADOS[ 'EMP_VALOR_FINANCIADO' ] ) ?>" required />
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
                        <label class="badge table-danger" style="font-size: 1.0rem; font-weight: 600; color: rgb( 187, 0, 0 );">Observações</label>
                        <textarea class="form-control" name="EMP_OBS" cols="20" rows="5" style="border-color: rgb( 108, 117, 125 ); background-color: rgb( 250, 250, 208 ); color: rgb( 195, 115, 100 ); overflow: hidden; resize: none; text-align: justify; font-weight: 600;" value="<?= $DADOS[ 'EMP_OBS' ]; ?>"><?= $DADOS[ 'EMP_OBS' ]; ?></textarea>
                    </div>

                    <div class="form-group" align="center">
                        <button class="btn btn-light btn-sm" id="btn-atualizar" name="btn-atualizar" value="btn-atualizar" style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'"><i class="fas fa-edit"></i>&nbsp;Editar Contrato</button>
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