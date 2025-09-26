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
    <?php require 'fun_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'fun_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $fundsSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <legend class="text-center display-6" style="color:rgb(205, 205, 205);">&nbsp;<i class="fas fa-search"></i>&nbsp;Pesquisa Avançada de Registros</legend>

                <!-- PESQUISA AVANÇADA -->
                <div class="container"><!-- /. container -->
                    <form name="form_search" action="?pg=funds/fun_search" method="POST">
                        <div class="row"><!-- /. row -->

                            <div class="col-sm-3 form-group" align="center">
                                <label style="color: rgb( 205, 205, 205 );" for="SEARCH">Termo</label>
                                <input class="form-control" id="SEARCH" name="SEARCH" type="text" value="" style="background-color: #F6F6F6; width: auto; border: 1px solid #C8C8C8;" placeholder="Pesquisar..." name="search" onkeyup="this.value = this.value.toUpperCase();" onmouseover="this.style.backgroundColor = 'rgb(44, 48, 52);'"; onmouseout="this.style.backgroundColor = '' "; autofocus />
                            </div>

                            <div class="col-sm-3 form-group" align="center">
                                <label style="color: rgb( 205, 205, 205 );" for="MES">Mês</label>
                                <select class="form-control" id="MES" name="MES">
                                    <option value="">Selecione...</option>
                                    <?php for( $i = 1; $i <= 12; $i++ ) { ?>                                            
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-3 form-group" align="center">
                                <label style="color: rgb( 205, 205, 205 );" for="ANO">Ano</label>
                                <select class="form-control" id="ANO" name="ANO">
                                    <option selected>Selecione...</option>
                                    <?php for( $i = 2021; $i <= date("Y"); $i++ ) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label style="color: rgb( 51, 51, 51 );" for="submit">Pesquisar</label><br />
                                <button class="btn-light btn-sm" type="submit" style="background: rgb( 255, 255, 255 ); filter: brightness(0.9); color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" border="0" viewBox="0 0 24 24" style="color: rgb( 143, 185, 205 );">
                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                    </svg>&nbsp;Pesquisar
                                </button>
                            </div>

                        </div><!-- /.end row -->
                    </form>
                </div><!-- /.end container -->

                <!-- INÍCIO DO RESULTADO DA PESQUISA -->
                <table class="table table-dark table-striped table-hover table-sm">
                    <caption>Resultado da consulta</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Movimento</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Receber os dados da url
                                if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {                                    
                                    $VERIFICA = 0;
                                    $SEARCH = $_POST[ 'SEARCH' ];
                                    $MES = $_POST[ 'MES' ];
                                    $ANO = $_POST[ 'ANO' ];
                                }

                                //Receber o número da página
                                $pagina_atual = filter_input( INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT );
                                $pagina = ( !empty( $pagina_atual ) ) ? $pagina_atual : 1;

                                //Setar a quantidade de itens por página
                                $qnt_result_pg = 300;

                                //Calcular o início da visualização
                                $inicio = ( $qnt_result_pg * $pagina ) - $qnt_result_pg;

                                // CONSULTA                                
                                if( !empty( $SEARCH ) ) {
                                    $SQL = " SELECT * FROM RMO_RES_MOVIMENTO WHERE RMO_DESCRICAO LIKE '%$SEARCH%' ORDER BY RMO_ID LIMIT $inicio, $qnt_result_pg ";
                                    $RESULTADO = mysqli_query( $CONN, $SQL );
                                    $VERIFICA = mysqli_num_rows( $RESULTADO );
                                } else {
                                    echo '<div class="alert alert-danger" role="alert" align="center"><b style="text-align: center; color: rgb( 255, 255, 255 ); font-size: 1.2em; font-weight: 600;">Digite um termo a ser pesquisado!</b></div>';
                                }
                                if( !empty( $SEARCH ) && !empty( $MES ) && !empty( $ANO ) ) {
                                    $SQL = " SELECT * FROM RMO_RES_MOVIMENTO WHERE RMO_DESCRICAO LIKE '%$SEARCH%' AND RMO_MES = $MES AND RMO_ANO = $ANO ORDER BY RMO_ID LIMIT $inicio, $qnt_result_pg ";
                                    $RESULTADO = mysqli_query( $CONN, $SQL );
                                    $VERIFICA = mysqli_num_rows( $RESULTADO );
                                }

                                if( $VERIFICA > 0 ) {
                                    while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) {
                                    //while( $DADOS = mysqli_fetch_assoc( $result ) ) {
                            ?>
                                <tr>
                                    <th scope="row" style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'RMO_DIA' ] . '/' . $DADOS[ 'RMO_MES' ] . '/' . $DADOS[ 'RMO_ANO' ]; ?></th>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'RMO_DESCRICAO' ] ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'RMO_VALOR' ] ) ?></td>
                                </tr>                                
                                <?php
                                    }
                                } else {
                                    if( !empty( $SEARCH ) ) {
                                        echo '<div class="alert alert-danger" role="alert" align="center"><b style="text-align: center; color: rgb( 255, 255, 255 ); font-size: 1.2em; font-weight: 600;">Nenhum registro encontrado!</b></div>';
                                    }                                    
                                }

                                //Paginação - Somar a quantidade de usuários
                                $result_pg = " SELECT COUNT( RMO_ID ) AS num_result FROM RMO_RES_MOVIMENTO ";
                                $resultado_pg = mysqli_query( $CONN, $result_pg );
                                $ROW_pg = mysqli_fetch_assoc( $resultado_pg );
                                //echo $ROW_pg['num_result'];

                                //Quantidade de página
                                $quantidade_pg = ceil( $ROW_pg[ 'num_result' ] / $qnt_result_pg ); //Comando "ceil" arredonda os valores

                                //Limitar os links antes/depois
                                $max_links = 1;

                                echo "<a href='?pg=finances/fin_search&pagina=1' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-backward'></i>&nbsp;Primeira&nbsp;</a>&nbsp;";

                                $anterior = $pagina - 1;
                                if( $anterior >= 1 ) {
                                        echo "<a href='?pg=finances/fin_search&pagina=$anterior' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-caret-left'></i>&nbsp;Anterior&nbsp;</a>&nbsp;";
                                    }

                                for( $pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                                    if( $pag_ant >= 1 ) {
                                        echo "<a href='?pg=finances/fin_search&pagina=$pag_ant' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_ant&nbsp;</a>&nbsp;";
                                    }
                                }

                                echo "<b style='font-family:Calibri; font-weight: 700; font-size:1.1rem; color: rgb(210, 209, 209); background: rgb(200, 177, 250, 50%); border-radius: 10px 10px 10px 10px;'>&nbsp;$pagina&nbsp;</b>&nbsp;";

                                for( $pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                                    if( $pag_dep <= $quantidade_pg ) {
                                        echo "<a href='?pg=finances/fin_search&pagina=$pag_dep' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_dep&nbsp;</a>&nbsp;";
                                    }
                                }

                                $proxima = $pagina + 1;
                                if( $proxima <= $quantidade_pg ) {
                                        echo "<a href='?pg=finances/fin_search&pagina=$proxima' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;Próxima&nbsp;<i class='fas fa-caret-right'></i>&nbsp;</a>&nbsp;";
                                    }

                                echo "<a href='?pg=finances/fin_search&pagina=$quantidade_pg' style='font-family:Calibri; font-size:1.1rem; color: rgb(205, 205, 205); background:rgb(221, 221, 221, 20%); border-radius: 10px 10px 10px 10px;'>&nbsp;Última&nbsp;<i class='fas fa-forward'></i>&nbsp;</a> ";

                            ?>
                            <tr>
                                <td colspan="3" style="border-top: 0px solid rgb( 252, 200, 47 ); justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle;">
                                    <span style="border-top: 2px solid rgb( 252, 200, 47 );">
                                        <?php                                            
                                            $SQL = mysqli_query( $CONN, " SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_DESCRICAO LIKE '%$SEARCH%' ORDER BY RMO_ID LIMIT $inicio, $qnt_result_pg ");
                                            $ROW = mysqli_fetch_array( $SQL );
                                        ?>
                                        <b style="text-align: right; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">TOTAL:&nbsp;<?php if( !empty( $SEARCH ) ) { echo formata_dinheiro( $ROW[ 'TOTAL' ] ); } else { echo formata_dinheiro( 0.00 ); }?></b>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- FIM DA PESQUISA-->

            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'fin_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<?php
    mysqli_close( $CONN );
?>