<?php
    if( !isset(  $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( isset(  $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar' ) {
        $ID = $_GET[ 'id' ];

        mysqli_query( $CONN, "DELETE FROM RMO_RES_MOVIMENTO WHERE RMO_ID = '$ID' " );
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_cat' ) {
        $ID = $_POST[ 'id' ];
        $NOME = $_POST[ 'nome' ];

        mysqli_query( $CONN, "UPDATE RCA_RES_CAT SET RCA_NOME = '$NOME' WHERE RCA_ID = '$ID' " );
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&cat_ok=3" );
    }

    if( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar_cat' ) {
        $ID = $_GET[ 'id' ];

        $QR = mysqli_query( $CONN, "SELECT C.RCA_ID FROM RMO_RES_MOVIMENTO M, RCA_RES_CAT C WHERE C.RCA_ID = M.RMO_CAT && C.RCA_ID = $ID " );
        if( mysqli_num_rows( $QR ) > 0 ) {
            header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&cat_err=1" );
        }

        mysqli_query( $CONN, " DELETE FROM RCA_RES_CAT WHERE RCA_ID = '$ID' ");
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&cat_ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_mov' ) {
        $ID = $_POST[ 'id' ];
        $DIA = $_POST[ 'dia' ];
        $TIPO = $_POST[ 'tipo' ];
        $CAT = $_POST[ 'cat' ];
        $DESCRICAO = $_POST[ 'descricao' ];
        $VALOR = moeda( $_POST[ 'valor' ] );

        mysqli_query( $CONN, " UPDATE RMO_RES_MOVIMENTO SET RMO_DIA = '$DIA', RMO_TIPO = '$TIPO', RMO_CAT = '$CAT', RMO_DESCRICAO = '$DESCRICAO', RMO_VALOR = '$VALOR' WHERE RMO_ID = '$ID' " );
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&ok=3" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 2) {

        $NOME = $_POST[ 'nome' ];
        mysqli_query( $CONN, " INSERT INTO RCA_RES_CAT( RCA_NOME ) values( '$NOME' ) " );
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&cat_ok=1" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 1) {

        $DATA = $_POST[ 'data' ];
        $TIPO = $_POST[ 'tipo' ];
        $CAT = $_POST[ 'cat' ];
        $DESCRICAO = $_POST[ 'descricao' ];
        $VALOR = moeda( $_POST[ 'valor' ] );

        $T = explode("/", $DATA);
        $DIA = $T[0];
        $MES = $T[1];
        $ANO = $T[2];

        mysqli_query( $CONN, " INSERT INTO RMO_RES_MOVIMENTO( RMO_DIA, RMO_MES, RMO_ANO, RMO_TIPO, RMO_DESCRICAO, RMO_VALOR, RMO_CAT ) values( '$DIA', '$MES', '$ANO', '$TIPO', '$DESCRICAO', '$VALOR', '$CAT' ) " );
        echo mysqli_error( $CONN );
        header("Location: index.php?pg=funds/fun_main&mes=" . $_GET[ 'RMO_MES' ] . "&ano=" . $_GET[ 'RMO_ANO' ] . "&ok=1" );
    }

    if( isset( $_GET[ 'mes' ] ) )
        $MES_HOJE = $_GET[ 'mes' ];
    else
        $MES_HOJE = date( 'm' );

    if( isset( $_GET[ 'ano' ] ) )
        $ANO_HOJE = $_GET[ 'ano' ];
    else
        $ANO_HOJE = date( 'Y' );
?>