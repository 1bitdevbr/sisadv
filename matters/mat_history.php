<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');	
?>

    <!-- INÍCIO DO HISTÓRICO -->
    <table class="table table-dark table-striped table-hover table-sm">
        <div class="row">
            <div class="col-sm-6">
                <h4 style='color: #ff9999;'>HISTÓRICO</h4>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Assunto</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Resolução</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if( isset( $_POST[ "SEARCH" ] ) ) {
                    $SEARCH = $_POST[ 'SEARCH' ];
                } else { $SEARCH = ''; }

                $pagina_atual = filter_input( INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT );
                $pagina = ( !empty ( $pagina_atual ) ) ? $pagina_atual : 1;

                $qnt_result_pg = 20;
                $inicio = ( $qnt_result_pg * $pagina ) - $qnt_result_pg;

                // CONSULTA
                if( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
                    if( $_POST[ 'SEARCH' ] ) {
                        $SQL = "SELECT A.*, S.AST_NOME FROM ASS_ASSUNTOS A JOIN AST_ASSUNTOS_SIT S ON A.ASS_FK_SITUACAO = S.AST_ID WHERE A.ASS_FK_SITUACAO = 3 AND A.ASS_ASSUNTO LIKE '%$SEARCH%' ORDER By ASS_ID DESC LIMIT $inicio, $qnt_result_pg";
                        $RESULTADO = mysqli_query( $CONN, $SQL );
                        $VERIFICA = mysqli_num_rows( $RESULTADO );
                    } else {
                        $_SESSION[ 'msg2' ] = "Digite um termo a ser pesquisado!";
                        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>";
                    }
                } else {
                    $SQL = "SELECT A.*, S.AST_NOME FROM ASS_ASSUNTOS A JOIN AST_ASSUNTOS_SIT S ON A.ASS_FK_SITUACAO = S.AST_ID WHERE A.ASS_FK_SITUACAO = 3 AND A.ASS_ASSUNTO LIKE '%$SEARCH%' ORDER By ASS_ID DESC LIMIT $inicio, $qnt_result_pg";
                    $RESULTADO = mysqli_query( $CONN, $SQL );
                    $VERIFICA = mysqli_num_rows( $RESULTADO );
                }
                if( $VERIFICA > 0 ) {
                    while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) {
            ?>
                <tr>
                    <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.9em; font-weight: 600;"><?php echo $dt_abertura = date("d/m/Y", strtotime( $DADOS[ 'ASS_DT_ABERTURA' ] ) ); ?></th>
                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.9em; font-weight: 600;"><?php echo $DADOS[ 'ASS_ASSUNTO' ]; ?></td>
                    <td style="justify-content: center; align-items: center; text-align: justify; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.9em; font-weight: 600;"><?php echo $DADOS[ 'ASS_RESOLUCAO' ]; ?></td>
                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.9em; font-weight: 600;"><a href="?pg=matters/mat_view&id=<?php echo $DADOS[ 'ASS_ID' ]; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a></td>
                </tr>
            <?php
                }
            } else {
                if( !empty( $SEARCH ) ) {
                    $_SESSION[ 'msg2' ] = "Nenhum registro encontrado!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>";
                }
            }

                //Paginação - Somar a quantidade de usuários
                $result_pg = " SELECT COUNT( ASS_ID ) AS num_result FROM ASS_ASSUNTOS ";
                $resultado_pg = mysqli_query ( $CONN, $result_pg );
                $row_pg = mysqli_fetch_assoc ( $resultado_pg );
                //echo $row_pg['num_result'];

                //Quantidade de página
                $quantidade_pg = ceil( $row_pg['num_result'] / $qnt_result_pg ); //Comando "ceil" arredonda os valores

                //Limitar os links antes/depois
                $max_links = 1;

                echo "<a href='?pg=matters/mat_main&pagina=1' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-backward'></i>&nbsp;Primeira&nbsp;</a>&nbsp;";

                $anterior = $pagina - 1;
                if ( $anterior >= 1 ) {
                        echo "<a href='?pg=matters/mat_main&pagina=$anterior' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;<i class='fas fa-caret-left'></i>&nbsp;Anterior&nbsp;</a>&nbsp;";
                    }

                for ( $pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                    if ( $pag_ant >= 1 ) {
                        echo "<a href='?pg=matters/mat_main&pagina=$pag_ant' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_ant&nbsp;</a>&nbsp;";
                    }
                }

                echo "<b style='font-family: Calibri; font-weight: 700; font-size: 1.1rem; color: rgb(210, 209, 209); background: rgb(200, 177, 250, 50%); border-radius: 10px 10px 10px 10px;'>&nbsp;$pagina&nbsp;</b>&nbsp;";

                for ( $pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                    if ( $pag_dep <= $quantidade_pg ) {
                        echo "<a href='?pg=matters/mat_main&pagina=$pag_dep' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;$pag_dep&nbsp;</a>&nbsp;";
                    }
                }

                $proxima = $pagina + 1;
                if ( $proxima <= $quantidade_pg ) {
                        echo "<a href='?pg=matters/mat_main&pagina=$proxima' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20); border-radius: 10px 10px 10px 10px;'>&nbsp;Próxima&nbsp;<i class='fas fa-caret-right'></i>&nbsp;</a>&nbsp;";
                    }

                echo "<a href='?pg=matters/mat_main&pagina=$quantidade_pg' style='font-family: Calibri; font-size: 1.1rem; color: rgb( 51, 51, 51 ); background: rgb( 221, 221, 221, 20 ); border-radius: 10px 10px 10px 10px;'>&nbsp;Última&nbsp;<i class='fas fa-forward'></i>&nbsp;</a> ";
            ?>
        </tbody>
    </table>
    <!-- FIM DO HISTÓRICO -->