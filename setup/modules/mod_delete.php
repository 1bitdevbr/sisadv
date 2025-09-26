<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 4;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];

        $SQL = " DELETE FROM SYS_MODULES WHERE MOD_ID = '$ID' ";
        $RESULTADO = mysqli_query( $CONN1, $SQL );

        if( $RESULTADO ) {
            $_SESSION[ 'msg1' ] = "Registro excluído!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
        } else {
            $_SESSION[ 'msg2' ] = "Erro: Nenhum registro excluído!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
        } mysqli_close( $CONN1 );
    }
?>