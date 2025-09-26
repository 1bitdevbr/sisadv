<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');    
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $INV_DT_AQUISICAO = test_input( $_POST[ 'INV_DT_AQUISICAO' ] );
        $INV_FK_STATUS = $_POST[ 'INV_FK_STATUS' ];
        $INV_OBJETO = corrigir( $_POST[ 'INV_OBJETO' ] );
        $INV_QTD = corrigir( $_POST[ 'INV_QTD' ] );
        $INV_DESCRICAO = corrigir( $_POST[ 'INV_DESCRICAO' ] );
        $INV_FK_LOCALIZACAO = $_POST[ 'INV_FK_LOCALIZACAO' ];
        $INV_VR_ESTIMADO = moeda( $_POST[ 'INV_VR_ESTIMADO' ] );
        $INV_USER_CREATION = $_SESSION[ 'USR_ID' ];
    }

    $INV_VR_TOTAL = $INV_QTD * $INV_VR_ESTIMADO;

    $SQL = " INSERT INTO INV_INVENTARIO( INV_DT_AQUISICAO, INV_OBJETO, INV_QTD, INV_DESCRICAO, INV_FK_LOCALIZACAO,
                                            INV_VR_ESTIMADO, INV_VR_TOTAL, INV_FK_STATUS, INV_DT_CREATION, INV_USER_CREATION )
                            VALUES( '$INV_DT_AQUISICAO', '$INV_OBJETO', '$INV_QTD', '$INV_DESCRICAO',  '$INV_FK_LOCALIZACAO',
                                            '$INV_VR_ESTIMADO', '$INV_VR_TOTAL', '$INV_FK_STATUS', NOW(), '$INV_USER_CREATION' ) ";

    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=inventory/inv_main'; }, 0);</script>";
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=inventory/inv_main'; }, 0);</script>";
    } mysqli_close( $CONN );
?>