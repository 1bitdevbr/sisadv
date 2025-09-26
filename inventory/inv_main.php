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

                <!-- INÍCIO DO RESULTADO DA PESQUISA -->
                <div class="row">
                    <div class="col-sm-6" style="color: rgb( 248, 152, 152 );">
                        <h4>PATRIMÔNIO ATUAL</h4>
                    </div>
                    <div class="col-sm-6" style='color: #FFF;'>
                        <?php
                            $SQL = mysqli_query( $CONN, " SELECT SUM( INV_VR_TOTAL ) FROM INV_INVENTARIO WHERE INV_FK_STATUS = 1 ");
                            $ROW = mysqli_fetch_array( $SQL );
                            $DADOS = $ROW[ 0 ];
                            echo '<h4  style="text-align: right;">SALDO TOTAL ESTIMADO DO PATRIMÔNIO:&nbsp; '. formata_dinheiro( $DADOS ) .'</h4>';
                        ?>
                    </div>
                </div>
                <table id="inventory" class="table table-dark table-striped table-hover table-sm">
                    <caption>Resultado da consulta</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data aquisição</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Objeto</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Qtd</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Descrição</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Localização</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: cleftenter; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor unitário</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor total</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Status</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // CONSULTA
                                    $SQL = "SELECT I.*, S.STA_NAME, P.PAS_NOME
                                              FROM INV_INVENTARIO I
                                              JOIN STA_STATUS S ON S.STA_ID = I.INV_FK_STATUS
                                              JOIN PAS_PROC_PASTA P ON P.PAS_ID = I.INV_FK_LOCALIZACAO
                                             WHERE I.INV_FK_STATUS = 1
                                          ORDER By I.INV_DT_AQUISICAO DESC ";

                                    $RESULTADO = mysqli_query( $CONN, $SQL );
                                    $VERIFICA = mysqli_num_rows( $RESULTADO );

                                    if( $VERIFICA > 0 ) {
                                        while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>

                                    <tr>
                                        <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DTAQUISICAO = date("d/m/Y", strtotime( $DADOS[ 'INV_DT_AQUISICAO' ] ) ); ?></th>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'INV_OBJETO' ]; ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'INV_QTD' ]; ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=inventory/inv_view&id=<?= $DADOS[ 'INV_ID' ]; ?>"><?= $DADOS[ 'INV_DESCRICAO' ]; ?></a></td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'PAS_NOME' ]; ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'INV_VR_ESTIMADO' ] ) ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?php
                                                $QTD = $DADOS[ 'INV_QTD' ];
                                                $VLRUNIT = $DADOS[ 'INV_VR_ESTIMADO' ];
                                                $TOTAL = $QTD * $VLRUNIT;
                                                echo formata_dinheiro( $TOTAL );
                                            ?>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                            <?php
                                                if( $DADOS[ 'INV_FK_STATUS' ] == 1 ) { // Ativo
                                                    echo '<h7 style="color:#FFC107;">'  . $DADOS[ 'STA_NAME' ] . '</h7>';
                                                } else { // Baixado
                                                    echo '<h7 style="color:#71E828;">'  . $DADOS[ 'STA_NAME' ] . '</h7>';
                                                }
                                            ?>
                                        </td>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                          <a href="?pg=inventory/inv_delete&id=<?= $DADOS[ 'INV_ID' ]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este registro?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <!-- FIM DA PESQUISA-->
                    <hr style="width: auto; height: 2px; text-align: center; border: 0px; color: rgb( 248, 152, 152 ); background: rgb( 249, 234, 212 );" />
                    <div class=" ">
                        <?php include 'inv_history.php'; ?>
                    </div>

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