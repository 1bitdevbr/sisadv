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

                <!-- INÍCIO DA PESQUISA -->
                <table class="table table-dark table-striped table-hover table-sm">
                    <caption>Resultado da consulta</caption>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Nome</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Cadastro</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Inicio</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Fim</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Contratado</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Montante</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Juros</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Saldo</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ativo</th>
                            <th scope="col" colspan="3" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if( isset( $_POST[ "SEARCH" ] ) ) {
                                $SEARCH = $_POST[ 'SEARCH' ];
                            } else { $SEARCH = ''; }

                            //Receber o número da página
                            $pagina_atual = filter_input( INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT );
                            $pagina = ( !empty ( $pagina_atual ) ) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por página
                            $qnt_result_pg = 20;

                            //Calcular o início da visualização
                            $inicio = ( $qnt_result_pg * $pagina ) - $qnt_result_pg;

                            $result_cliente = "SELECT E.*, C.CLI_NOME
                                                              FROM EMP_EMPRESTIMO_MOV E JOIN CLI_CLIENTES C ON E.EMP_FK_CLIENTE = C.CLI_ID
                                                            WHERE CLI_NOME LIKE '%$SEARCH%'
                                                       ORDER By EMP_DT_FINANCIAMENTO DESC
                                                               LIMIT $inicio, $qnt_result_pg";

                            $CLIENTE = mysqli_query( $CONN, $result_cliente );

                            while( $DADOS = mysqli_fetch_assoc( $CLIENTE ) ) {
                        ?>
                            <tr>
                                <th scope="row" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 255, 255, 255 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_NOME' ] ?></th>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $EMP_DT_FINANCIAMENTO = date("d/m/Y", strtotime( $DADOS[ 'EMP_DT_FINANCIAMENTO' ] ) ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $EMP_DT_INICIO_PGTO = date("d/m/Y", strtotime( $DADOS[ 'EMP_DT_INICIO_PGTO' ] ) ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $EMP_DT_FIM_PGTO = date("d/m/Y", strtotime( $DADOS[ 'EMP_DT_FIM_PGTO' ] ) ); ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'EMP_VALOR_FINANCIADO' ] ) ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'EMP_VALOR_TOTAL' ] ) ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'EMP_TOTAL_JUROS' ] ) ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'EMP_SALDO' ] ) ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'EMP_SALDO' ] > 0 ) {
                                            echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                                        } else {
                                            echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=loan/loa_view&id=<?= $DADOS[ 'EMP_ID' ]; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=loan/loa_launch&id=<?= $DADOS[ 'EMP_ID' ]; ?>" class="btn btn-outline-warning btn-sm" title="Lançar"><i class="fas fa-dollar-sign"></i></a></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=loan/loa_edit&id=<?= $DADOS[ 'EMP_ID' ]; ?>" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php
                            }

                            //Paginação - Somar a quantidade de usuários
                            $result_pg = " SELECT COUNT( EMP_ID ) AS num_result FROM EMP_EMPRESTIMO_MOV ";
                            $resultado_pg = mysqli_query ( $CONN, $result_pg );
                            $row_pg = mysqli_fetch_assoc ( $resultado_pg );
                            //echo $row_pg['num_result'];

                            //Quantidade de página
                            $quantidade_pg = ceil( $row_pg['num_result'] / $qnt_result_pg ); //Comando "ceil" arredonda os valores

                            //Limitar os links antes/depois
                            $max_links = 1;

                            echo "<a href='index.php?pg=loan/loa_main&pagina=1' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-backward'></i>&nbsp;Primeira&nbsp;</a>&nbsp;";

                            $anterior = $pagina - 1;
                            if ( $anterior >= 1 ) {
                                    echo "<a href='index.php?pg=loan/loa_main&pagina=$anterior' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-caret-left'></i>&nbsp;Anterior&nbsp;</a>&nbsp;";
                                }

                            for ( $pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                                if ( $pag_ant >= 1 ) {
                                    echo "<a href='index.php?pg=loan/loa_main&pagina=$pag_ant' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_ant&nbsp;</a>&nbsp;";
                                }
                            }

                            echo "<b style='font-family: Calibri; font-weight: 700; font-size: 1.1rem; color: rgb(210, 209, 209); background: rgb(200, 177, 250, 50%); border-radius: 10px 10px 10px 10px;'>&nbsp;$pagina&nbsp;</b>&nbsp;";

                            for ( $pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                                if ( $pag_dep <= $quantidade_pg ) {
                                    echo "<a href='index.php?pg=loan/loa_main&pagina=$pag_dep' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_dep&nbsp;</a>&nbsp;";
                                }
                            }

                            $proxima = $pagina + 1;
                            if ( $proxima <= $quantidade_pg ) {
                                    echo "<a href='index.php?pg=loan/loa_main&pagina=$proxima' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20); border-radius: 10px 10px 10px 10px;'>&nbsp;Próxima&nbsp;<i class='fas fa-caret-right'></i>&nbsp;</a>&nbsp;";
                                }

                            echo "<a href='index.php?pg=loan/loa_main&pagina=$quantidade_pg' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;Última&nbsp;<i class='fas fa-forward'></i>&nbsp;</a> ";
                        ?>
                    </tbody>
                </table>
                <!-- FIM DA PESQUISA-->

                <hr style='width: auto; height:2px; text-align:center; border:0px; color:#ff9999; background:#FBEAD5;' />

                <div style="font-family:Calibri; font-size:1.0rem; color: rgb( 205, 205, 205 ); display: flex; flex-direction: row; justify-content: center; align-items: center; text-align: center;">
                    <?php
                        $SQL = " SELECT SUM( EMP_VALOR_FINANCIADO ) AS FINANCIADO,
                                                        SUM( EMP_TOTAL_JUROS ) AS JUROS,
                                                        SUM( EMP_VALOR_TOTAL ) AS TOTAL,
                                                        SUM( EMP_SALDO ) AS SALDO
                                            FROM EMP_EMPRESTIMO_MOV ";
                        $ROW = mysqli_query( $CONN, $SQL );
                        $R = mysqli_fetch_array( $ROW );
                        $CONTRATADO = $R[ 'FINANCIADO' ];
                        $JUROS = $R[ 'JUROS' ];
                        $ACUMULADO = $R[ 'TOTAL' ];
                        $PENDENTE = $R[ 'SALDO' ];
                        echo 'Total Contratado:<span style="color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600;">&nbsp;R$ ' . number_format( $CONTRATADO, 2, "," , "." ) . '</span>&nbsp;|&nbsp;';
                        echo 'Total de Juros:<span style="color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600;">&nbsp;R$ ' . number_format( $JUROS, 2, "," , "." ) . '</span>&nbsp;|&nbsp;';
                        echo 'Montante Acumulado:<span style="color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600;">&nbsp;R$ ' . number_format( $ACUMULADO, 2, "," , "." ) . '</span>&nbsp;|&nbsp;';
                        echo 'Saldo Pendente:<span style="color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600;">&nbsp;R$ ' . number_format( $PENDENTE, 2, "," , "." ) . '</span><br />';
                        mysqli_close ( $CONN );
                    ?>
                </div>

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'loa_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>