<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];
    }

    $SQL = " DELETE FROM ASS_ASSUNTOS WHERE ASS_ID = $ID ";
    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro excluído!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Nenhum registro excluído!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>";
    } mysqli_close( $CONN );
?>