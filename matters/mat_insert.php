<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $ASS_FK_SITUACAO = $_POST[ 'ASS_FK_SITUACAO' ];
        $ASS_ASSUNTO = corrigir( $_POST[ 'ASS_ASSUNTO' ] );
        $ASS_RESOLUCAO = corrigir( $_POST[ 'ASS_RESOLUCAO' ] );
        $ASS_USER_CREATION = $_SESSION[ 'USR_ID' ];
      }

    $SQL = " INSERT INTO ASS_ASSUNTOS( ASS_DT_ABERTURA, ASS_ASSUNTO, ASS_FK_SITUACAO, ASS_RESOLUCAO, ASS_DT_CREATION, ASS_USER_CREATION )
                             VALUES( NOW(), '$ASS_ASSUNTO', '$ASS_FK_SITUACAO', '$ASS_RESOLUCAO', NOW(), '$ASS_USER_CREATION' ) ";
    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=matters/mat_main'; }, 0);</script>";
    } mysqli_close( $CONN );
?>