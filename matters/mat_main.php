<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');	
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

                <!-- INÍCIO DA PESQUISA -->
                <table class="table table-dark table-striped table-hover table-sm">
                        <h4 style="color: #ff9999;">PENDENTES</h4>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Assunto</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Situação</th>
                                <th scope="col" colspan="3" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $SQL = "SELECT A.*, S.AST_NOME FROM ASS_ASSUNTOS A JOIN AST_ASSUNTOS_SIT S ON A.ASS_FK_SITUACAO = S.AST_ID WHERE A.ASS_FK_SITUACAO <> 3 ORDER By ASS_ID DESC";
                                $RESULTADO = mysqli_query( $CONN, $SQL );
                                while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) {
                            ?>
                                <tr>
                                    <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $dt_abertura = date("d/m/Y", strtotime( $DADOS[ 'ASS_DT_ABERTURA' ] ) ); ?></th>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'ASS_ASSUNTO' ]; ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                        <?php
                                            if( $DADOS[ 'ASS_FK_SITUACAO' ] == 1 ) { // Discussão futura
                                                echo '<h7 style="color: #FFC107;">'  . $DADOS[ 'AST_NOME' ] . '</h7>';
                                            } elseif ( $DADOS[ 'ASS_FK_SITUACAO' ] == 2 ) { // Em análise
                                                echo '<h7 style="color: #71E828;">'  . $DADOS[ 'AST_NOME' ] . '</h7>';
                                            } elseif ( $DADOS[ 'ASS_FK_SITUACAO' ] == 6 ) { // Pendente
                                                echo '<h7 style="color: #17A2B8;">'  . $DADOS[ 'AST_NOME' ] . '</h7>';
                                            } else { // Finalizado
                                                echo '<h7 style="color: #17A2B8;">'  . $DADOS[ 'AST_NOME' ] . '</h7>';
                                            }
                                        ?>
                                    </td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=matters/mat_view&id=<?= $DADOS[ 'ASS_ID' ]; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a></td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=matters/mat_edit&id=<?= $DADOS[ 'ASS_ID' ]; ?>" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></a></td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=matters/mat_delete&id=<?= $DADOS[ 'ASS_ID' ]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este Assunto?')"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- FIM DA PESQUISA-->
                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: #ff9999; background: #FBEAD5;" />
                    <div class=" ">
                        <?php include 'mat_history.php'; ?>
                    </div>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'mat_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>