<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'inv_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'inv_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $invSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <form class="signin-form" formname="inventory" id="inventory" action="?pg=inventory/inv_insert" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="dtAquisicao">Data aquisição</label>
                            <input class="form-control" type="date" id="INV_DT_AQUISICAO" name="INV_DT_AQUISICAO" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Situação</label>
                            <select class="form-control" name="INV_FK_STATUS" id="INV_FK_STATUS">
                                <?php
                                    $SQL = mysqli_query( $CONN, " SELECT STA_ID, STA_NAME FROM STA_STATUS ORDER By STA_NAME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'STA_ID' ]?>"><?= $ROW[ 'STA_NAME' ] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="objeto">Objeto</label>
                            <input class="form-control" type="text" id="INV_OBJETO" name="INV_OBJETO" onkeyup="this.value = this.value.toUpperCase();" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="qtd">Quantidade</label>
                            <input class="form-control" type="text" id="INV_QTD" name="INV_QTD" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label class="label" for="descricao">Descrição</label>
                            <input class="form-control" type="text" id="INV_DESCRICAO" name="INV_DESCRICAO" onkeyup="this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="fk_localizacao">Localização</label>
                            <select class="form-control" name="INV_FK_LOCALIZACAO" id="INV_FK_LOCALIZACAO">
                                <?php
                                    $SQL = mysqli_query( $CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'PAS_ID' ]?>"><?= $ROW[ 'PAS_NOME' ] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="vrEstimado">Valor estimado</label>
                            <input class="form-control money" type="text" style="text-align: center;" id="money" name="INV_VR_ESTIMADO" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" required />
                        </div>
                    </div>
                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: rgb( 248, 152, 152 ); background: rgb( 249, 234, 212 );" />
                    <div class="form-group" align="center">
                        <button class="btn btn-danger btn-sm submit_btn" id="btn-gravar" name="btn-gravar" value="btn-gravar" onclick="return confirm('Confirma o lançamento?')">Cadastrar&nbsp;<i class="fas fa-database"></i></button>                        
                    </div>
                </form>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'inv_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<?php
    mysqli_close( $CONN );
?>