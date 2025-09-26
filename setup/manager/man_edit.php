<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];

        $SQL = " SELECT I.*, S.STA_NAME, P.PAS_NOME
                          FROM INV_INVENTARIO I
                             JOIN STA_STATUS S ON S.STA_ID = I.INV_FK_STATUS
                             JOIN PAS_PROC_PASTA P ON P.PAS_ID = I.INV_FK_LOCALIZACAO
                        WHERE I.INV_ID = '$ID'
                    ORDER By I.INV_ID DESC ";

        $ROW = mysqli_query( $CONN1, $SQL );
        $DADOS = mysqli_fetch_array( $ROW );
    }
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
            <div class="invoice p-3 mb-3 card card-danger card-outline">
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

                <form class="signin-form" formname="inventory" id="inventory" action="?pg=inventory/inv_update" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_DT_AQUISICAO">Data aquisição</label>
                            <input class="form-control" type="hidden" id="INV_ID" name="INV_ID" value="<?= $DADOS[ 'INV_ID' ]; ?>" readonly />
                            <input class="form-control" type="date" id="INV_DT_AQUISICAO" name="INV_DT_AQUISICAO" value="<?= $DADOS[ 'INV_DT_AQUISICAO' ]; ?>"/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_FK_STATUS">Situação</label>
                            <select class="form-control" name="INV_FK_STATUS" id="INV_FK_STATUS">
                              <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT STA_ID, STA_NAME FROM STA_STATUS ORDER By STA_NAME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'STA_ID' ]; ?>"<?php if( $DADOS[ 'INV_FK_STATUS' ] == $ROW[ 'STA_ID' ] ){?>selected<?php } ?>> <?= $ROW[ 'STA_NAME' ]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_DT_BAIXA">Data baixa</label>
                            <input class="form-control" type="date" id="INV_DT_BAIXA" name="INV_DT_BAIXA" value="<?= $DADOS[ 'INV_DT_BAIXA' ]; ?>" autofocus />
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="label" for="INV_OBJETO">Objeto</label>
                            <input class="form-control" type="text" id="INV_OBJETO" name="INV_OBJETO" value="<?= $DADOS[ 'INV_OBJETO' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_QTD">Quantidade</label>
                            <input class="form-control" type="text" id="INV_QTD" name="INV_QTD" value="<?= $DADOS[ 'INV_QTD' ]; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label class="label" for="INV_DESCRICAO">Descrição</label>
                            <input class="form-control" type="text" id="INV_DESCRICAO" name="INV_DESCRICAO" value="<?= $DADOS[ 'INV_DESCRICAO' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_FK_LOCALIZACAO">Localização</label>
                            <select class="form-control" name="INV_FK_LOCALIZACAO" id="INV_FK_LOCALIZACAO">
                               <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'PAS_ID' ]; ?>"<?php if( $DADOS[ 'INV_FK_LOCALIZACAO' ] == $ROW[ 'PAS_ID' ] ){?>selected<?php } ?>> <?= $ROW[ 'PAS_NOME' ]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="INV_VR_ESTIMADO">Valor estimado</label>
                            <input class="form-control" type="text" id="INV_VR_ESTIMADO" name="INV_VR_ESTIMADO" value="<?= formata_dinheiro( $DADOS[ 'INV_VR_ESTIMADO' ] ); ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Motivo da baixa</label>
                            <input class="form-control" type="text" id="INV_MOTIVO_BAIXA" name="INV_MOTIVO_BAIXA" value="<?php if( !empty( $DADOS[ 'INV_MOTIVO_BAIXA' ] ) ) { echo $INV_MOTIVO_BAIXA; } else {  } ?>" onkeyup="this.value = this.value.toUpperCase();" />
                        </div>
                    </div>
                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: rgb( 248, 152, 152 ); background: rgb( 249, 234, 212 );" />
                    <div class="form-group" align="center">
                        <button class="btn btn-danger btn-sm submit_btn" id="btn-atualizar" name="btn-atualizar" value="btn-atualizar" onclick="return confirm('Confirma o lançamento?')">Salvar&nbsp;<i class="fas fa-database"></i></button>
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
    mysqli_close( $CONN1 );
?>