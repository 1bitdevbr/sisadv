<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];
    }

    if( ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) ) {
        $ID = $_POST[ 'id' ];
        $ASS_FK_SITUACAO = $_POST[ 'ASS_FK_SITUACAO' ];
        $ASS_ASSUNTO = corrigir( $_POST[ 'ASS_ASSUNTO' ] );
        $ASS_RESOLUCAO = corrigir( $_POST[ 'ASS_RESOLUCAO' ] );
        $ASS_USER_UPDATE = $_SESSION[ 'USR_ID' ];
      }

    $SQL = " UPDATE ASS_ASSUNTOS SET ASS_FK_SITUACAO = '$ASS_FK_SITUACAO', ASS_ASSUNTO = '$ASS_ASSUNTO', ASS_RESOLUCAO = '$ASS_RESOLUCAO', ASS_DT_UPDATE = NOW(), ASS_USER_UPDATE = '$ASS_USER_UPDATE' WHERE ASS_ID = $ID ";
    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_view&id=$ID'; }, 0);</script>";
    } mysqli_close( $CONN );
?>