<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');

    if( isset( $_SESSION[ 'EMP_FK_CLIENTE' ] ) OR
         isset( $_SESSION[ 'EMP_DT_FINANCIAMENTO' ] ) OR
         isset( $_SESSION[ 'EMP_PARCELAS' ] ) OR
         isset( $_SESSION[ 'EMP_DT_INICIO_PGTO' ] ) OR
         isset( $_SESSION[ 'EMP_PERCENTUAL_JUROS' ] ) OR
         isset( $_SESSION[ 'EMP_VALOR_FINANCIADO' ] ) OR
         isset( $_SESSION[ 'EMP_OBS' ] ) ) {
        $EMP_FK_CLIENTE = $_SESSION[ 'EMP_FK_CLIENTE' ];
        $EMP_DT_FINANCIAMENTO = $_SESSION[ 'EMP_DT_FINANCIAMENTO' ];
        $EMP_PARCELAS = $_SESSION[ 'EMP_PARCELAS' ];
        $EMP_DT_INICIO_PGTO = $_SESSION[ 'EMP_DT_INICIO_PGTO' ];
        $EMP_PERCENTUAL_JUROS = $_SESSION[ 'EMP_PERCENTUAL_JUROS' ];
        $EMP_VALOR_FINANCIADO = $_SESSION[ 'EMP_VALOR_FINANCIADO' ];
        $EMP_OBS = $_SESSION[ 'EMP_OBS' ];
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

                <form class="signin-form" formname="loan" id="loan" action="?pg=loan/loa_simulation" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="id">#Contrato</label>
                            <input class="form-control" type="text" id="id" name="id" disabled />
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="EMP_FK_CLIENTE">Cliente:</label>
                            <select class="form-control" name="EMP_FK_CLIENTE" id="EMP_FK_CLIENTE" required>
                            <?php
                                if( !empty( $EMP_FK_CLIENTE ) ) {
                                    $SQL = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER By CLI_NOME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'CLI_NOME' ]; ?>" <?php if( $EMP_FK_CLIENTE == $ROW[ 'CLI_NOME' ] ) {?>selected<?php } ?> ><?= $ROW[ 'CLI_NOME' ]; ?></option>
                        <?php }
                                } else { ?>
                                <option value="">Selecione...</option>
                            <?php
                                $QR = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER By CLI_NOME ");
                                while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                <option value="<?= $ROW[ 'CLI_NOME' ]; ?>"><?= $ROW[ 'CLI_NOME' ]; ?></option>
                        <?php }
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="text-align: center;">
                        <div class="form-group col-sm-2">
                            <label>Data do financiamento</label>
                            <input class="form-control" type="date" id="EMP_DT_FINANCIAMENTO" name="EMP_DT_FINANCIAMENTO" value="<?php if( !empty( $EMP_DT_FINANCIAMENTO ) ) { echo $EMP_DT_FINANCIAMENTO; } else { echo date('Y-m-d'); } ?>" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Número de parcelas</label>
                            <input class="form-control" type="text" style="text-align: center;" name="EMP_PARCELAS" id="EMP_PARCELAS" value="<?php if( !empty( $EMP_PARCELAS ) ) { echo $EMP_PARCELAS; } else {  } ?>" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Início do pagamento</label>
                            <input class="form-control" type="date" name="EMP_DT_INICIO_PGTO" value="<?php if( !empty( $EMP_DT_INICIO_PGTO ) ) { echo $EMP_DT_INICIO_PGTO; } else {  } ?>" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Percentual de juros</label>                            
                            <select class="form-control" name="EMP_PERCENTUAL_JUROS" id="EMP_PERCENTUAL_JUROS" required>
                        <?php
                            if( !empty( $EMP_PERCENTUAL_JUROS ) ) { ?>
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
                        <div class="form-group col-sm-2">
                            <label>Valor financiado</label>
                            <input class="form-control money" type="text" style="text-align: center;" id="money" name="EMP_VALOR_FINANCIADO" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" value="<?php if( !empty( $EMP_VALOR_FINANCIADO ) ) { echo $EMP_VALOR_FINANCIADO; } else {  } ?>" required />
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Observações</label>
                        <textarea class="form-control" name="EMP_OBS" cols="20" rows="5" onkeyup="this.value = this.value.toUpperCase();"><?php if( !empty( $EMP_OBS ) ) { echo $EMP_OBS; } else {  } ?></textarea>
                    </div>

                    <div class="submit" align="center">
                        <button type="submit" class="btn btn-light btn-sm"
                            style="color: #CDCCCC; font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;"
                            onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                            <i class="fas fa-sync-alt"></i>&nbsp;Simular empréstimo
                        </button >
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

<?php
    unset( $_SESSION[ 'EMP_FK_CLIENTE' ] );
    unset( $_SESSION[ 'EMP_DT_FINANCIAMENTO' ] );
    unset( $_SESSION[ 'EMP_PARCELAS' ] );
    unset( $_SESSION[ 'EMP_DT_INICIO_PGTO' ] );
    unset( $_SESSION[ 'EMP_PERCENTUAL_JUROS' ] );
    unset( $_SESSION[ 'EMP_VALOR_FINANCIADO' ] );
    unset( $_SESSION[ 'EMP_OBS' ] );
?>