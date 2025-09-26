<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];

        $SQL = "SELECT A.*, S.AST_NOME FROM ASS_ASSUNTOS A JOIN AST_ASSUNTOS_SIT S ON A.ASS_FK_SITUACAO = S.AST_ID WHERE A.ASS_ID = '$ID' ORDER By ASS_ID DESC ";
        $RESULTADO = mysqli_query( $CONN, $SQL );
        $DADOS = mysqli_fetch_array( $RESULTADO );
    }
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'mat_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'mat_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $matterSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <form class="signin-form" formname="matters" id="matters" action="?pg=matters/mat_edit" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="label" for="ASS_ID">#ID</label>
                            <input class="form-control" type="text" id="ASS_ID" name="ASS_ID" value="<?= $DADOS[ 'ASS_ID' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="ASS_FK_SITUACAO">Situação</label>
                            <input class="form-control" type="text" id="ASS_FK_SITUACAO" name="ASS_FK_SITUACAO" value="<?= $DADOS[ 'AST_NOME' ]; ?>" readonly />
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="ASS_ASSUNTO">Assunto</label>
                            <input class="form-control" type="text" id="ASS_ASSUNTO" name="ASS_ASSUNTO" value="<?= $DADOS[ 'ASS_ASSUNTO' ]; ?>" readonly />
                        </div>
                    </div>
                    <hr style='width: auto; height:2px; text-align:center; border:0px; color:#ff9999; background:#FBEAD5;' />
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="ASS_RESOLUCAO">Resolução</label>
                            <textarea class="form-control" name="ASS_RESOLUCAO" cols="20" rows="5" style="resize: none; text-align: justify;" readonly><?= $DADOS[ 'ASS_RESOLUCAO' ]; ?></textarea>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group submit" align="center">
                        <a href="?pg=matters/mat_edit&id=<?= $DADOS[ 'ASS_ID' ]; ?>" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i>&nbsp;Editar</a>
                    </div>
                </form>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'mat_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>