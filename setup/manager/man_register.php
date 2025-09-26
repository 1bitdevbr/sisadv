<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../config.php');
    require_once(__DIR__ . '/../../dist/func/functions.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'man_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'man_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3 card card-danger card-outline">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $manSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <form class="signin-form" formname="manager" id="manager" action="?pg=setup/manager/man_insert" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_FK_STATUS">Status</label>
                            <select class="form-control" name="MAN_FK_STATUS" id="MAN_FK_STATUS">
                                <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT STA_ID, STA_NAME FROM SYS_STATUS ORDER By STA_NAME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'STA_ID' ]; ?>"><?= $ROW[ 'STA_NAME' ]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_FK_CLIENT">Cliente</label>
                            <select class="form-control" name="MAN_FK_CLIENT" id="MAN_FK_CLIENT">
                                <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT CLI_ID, CLI_OFFICE FROM SYS_CLIENTS ORDER By CLI_OFFICE ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'CLI_ID' ]?>"><?= $ROW[ 'CLI_OFFICE' ] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_FK_PLAN">Plano</label>
                            <select class="form-control" name="MAN_FK_PLAN" id="MAN_FK_PLAN">
                                <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT PLN_ID, PLN_NAME FROM SYS_PLANS ORDER By PLN_NAME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'PLN_ID' ]?>"><?= $ROW[ 'PLN_NAME' ] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_FK_MODULE">Módulo</label>
                            <select class="form-control" name="MAN_FK_MODULE" id="MAN_FK_MODULE">
                                <?php
                                    $SQL = mysqli_query( $CONN1, " SELECT MOD_ID, MOD_NAME FROM SYS_MODULES ORDER By MOD_NAME ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                    <option value="<?= $ROW[ 'MOD_ID' ]?>"><?= $ROW[ 'MOD_NAME' ] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_DT_CONTRACT">Data Contrato</label>
                            <input class="form-control" type="date" id="MAN_DT_CONTRACT" name="MAN_DT_CONTRACT" required />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="label" for="MAN_DT_VALIDITY">Validade</label>
                            <input class="form-control" type="date" id="MAN_DT_VALIDITY" name="MAN_DT_VALIDITY" required />
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <button class="btn btn-danger btn-sm submit_btn" id="btn-gravar" name="btn-gravar" value="btn-gravar" onclick="return confirm('Confirma o lançamento?')">Salvar&nbsp;<i class="fas fa-database"></i></button>
                    </div>
                </form>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'man_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<?php
    mysqli_close( $CONN1 );
?>