<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $MAN_FK_STATUS = $_POST[ 'MAN_FK_STATUS' ];
        $MAN_FK_CLIENT = $_POST[ 'MAN_FK_CLIENT' ];
        $MAN_FK_PLAN = $_POST[ 'MAN_FK_PLAN' ];
        $MAN_FK_MODULE = $_POST[ 'MAN_FK_MODULE' ];
        $MAN_DT_CONTRACT = $_POST[ 'MAN_DT_CONTRACT' ];
        $MAN_DT_VALIDITY = $_POST[ 'MAN_DT_VALIDITY' ];
        $MAN_USER_CREATION = $_SESSION[ 'USR_ID' ];

        $SQL = " INSERT INTO SYS_MANAGER( MAN_FK_STATUS, MAN_FK_CLIENT, MAN_FK_PLAN, MAN_FK_MODULE, MAN_DT_CONTRACT,
                                                MAN_DT_VALIDITY, MAN_DT_CREATION, MAN_USER_CREATION )
                                VALUES( '$MAN_FK_STATUS', '$MAN_FK_CLIENT', '$MAN_FK_PLAN', '$MAN_FK_MODULE',  '$MAN_DT_CONTRACT',
                                                '$MAN_DT_VALIDITY', NOW(), '$MAN_USER_CREATION' ) ";

        $RESULTADO = mysqli_query( $CONN1, $SQL );

        if( $RESULTADO ) {
            $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/manager/man_main'; }, 0);</script>";
        } else {
            $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/manager/man_main'; }, 0);</script>";
        } mysqli_close( $CONN1 );
    }
?>