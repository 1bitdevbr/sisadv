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

        $ROW = mysqli_query( $CONN, $SQL );
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

                <form class="signin-form" formname="inventario" id="inventario" action="?pg=inventory/inv_inserir" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="dtAquisicao">Data aquisição</label>
                            <input class="form-control" type="hidden" id="INV_ID" name="INV_ID" value="<?= $DADOS[ 'INV_ID' ]; ?>" readonly />
                            <input class="form-control" type="date" id="INV_DT_AQUISICAO" name="INV_DT_AQUISICAO"  value="<?= $DADOS[ 'INV_DT_AQUISICAO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Situação</label>
                            <input class="form-control" type="text" id="INV_FK_STATUS" name="INV_FK_STATUS" value="<?= $DADOS[ 'INV_FK_STATUS' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="objeto">Objeto</label>
                            <input class="form-control" type="text" id="INV_OBJETO" name="INV_OBJETO" value="<?= $DADOS[ 'INV_OBJETO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="qtd">Quantidade</label>
                            <input class="form-control" type="text" id="INV_QTD" name="INV_QTD" value="<?= $DADOS[ 'INV_QTD' ]; ?>" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label class="label" for="descricao">Descrição</label>
                            <input class="form-control" type="text" id="INV_DESCRICAO" name="INV_DESCRICAO" value="<?= $DADOS[ 'INV_DESCRICAO' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="fk_localizacao">Localização</label>
                            <input class="form-control" type="text" id="INV_FK_LOCALIZACAO" name="INV_FK_LOCALIZACAO" value="<?= $DADOS[ 'PAS_NOME' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="vrEstimado">Valor estimado</label>
                            <input class="form-control" type="text" id="INV_VR_ESTIMADO" name="INV_VR_ESTIMADO"  value="<?= formata_dinheiro( $DADOS[ 'INV_VR_ESTIMADO' ] ); ?>" readonly />
                        </div>
                    </div>
                    <hr style='width: auto; height:2px; text-align:center; border:0px; color:#ff9999; background:#FBEAD5;' />
                    <div class="form-group" align="center">
                        <a href="?pg=inventory/inv_register" class="btn btn-info btn-md" title="Cadastrar"><i class="fas fa-plus"></i>&nbsp;Cadastrar</a>
                        <a href="?pg=inventory/inv_edit&id=<?= $DADOS[ 'INV_ID' ]; ?>" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i>&nbsp;Editar</a>
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