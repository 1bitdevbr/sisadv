<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $INV_DT_AQUISICAO = test_input( $_POST[ 'INV_DT_AQUISICAO' ] );
        $INV_OBJETO = corrigir( $_POST[ 'INV_OBJETO' ] );
        $INV_QTD = corrigir( $_POST[ 'INV_QTD' ] );
        $INV_DESCRICAO = corrigir( $_POST[ 'INV_DESCRICAO' ] );
        $INV_FK_LOCALIZACAO = $_POST[ 'INV_FK_LOCALIZACAO' ];
        $INV_VR_ESTIMADO = moeda( $_POST[ 'INV_VR_ESTIMADO' ] );
        $INV_FK_STATUS = $_POST[ 'INV_FK_STATUS' ];
        $INV_DT_BAIXA = test_input( $_POST[ 'INV_DT_BAIXA' ] );
        $INV_MOTIVO_BAIXA = test_input( $_POST[ 'INV_MOTIVO_BAIXA' ] );
        $INV_USER_UPDATE = $_SESSION[ 'USR_ID' ];
        $ID = $_POST[ 'INV_ID' ];
        $INV_VR_TOTAL = $INV_QTD * $INV_VR_ESTIMADO;

        $SQL = " UPDATE INV_INVENTARIO
                                SET INV_DT_AQUISICAO = '$INV_DT_AQUISICAO', INV_OBJETO = '$INV_OBJETO', INV_QTD = '$INV_QTD', INV_DESCRICAO = '$INV_DESCRICAO',
                                       INV_FK_LOCALIZACAO = '$INV_FK_LOCALIZACAO', INV_VR_ESTIMADO = '$INV_VR_ESTIMADO', INV_VR_TOTAL = '$INV_VR_TOTAL',
                                       INV_FK_STATUS = '$INV_FK_STATUS', INV_DT_BAIXA = '$INV_DT_BAIXA', INV_MOTIVO_BAIXA = '$INV_MOTIVO_BAIXA', INV_DT_UPDATE = NOW(),
                                       INV_USER_UPDATE = '$INV_USER_UPDATE'
                        WHERE INV_ID = '$ID' ";

        $RESULTADO = mysqli_query( $CONN, $SQL );

        if( $RESULTADO ) {
            $_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=inventory/inv_main'; }, 0);</script>";
        } else {
            $_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=inventory/view&id=$ID'; }, 0);</script>";
        } mysqli_close( $CONN );
    }
?>