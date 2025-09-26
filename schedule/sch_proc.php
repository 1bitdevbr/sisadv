<?php
    if (!isset($_SESSION)) session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    $USR_ACCESS = $_SESSION[ 'USR_ID' ];

    // TRATAMENTO DAS AÇÕES VIA URL
    // ======================================================================================= //
    // SAVE
    // ======================================================================================= //
    if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'SAVE' ) ) {
        $TAR_TIPO          = 1; // 1 PARA EVENTOS - 0 PARA TAREFAS
        $TAR_FK_CLIENTE    = 0;
        $TAR_FK_NATUREZA   = 0;
        $TAR_DESCRICAO     = $_POST[ 'TAR_DESCRICAO' ];
        $TAR_FK_ATRIBUIDO  = 0;
        $TAR_PZ_INICIO     = $_POST[ 'TAR_PZ_INICIO' ];
        $TAR_PZ_FIM        = $_POST[ 'TAR_PZ_FIM' ];
        $TAR_FK_SITUACAO   = 0;
        $TAR_FK_STATUS     = 1;
        $TAR_DIATODO       = 0;
        $TAR_BGCOLOR       = '#FFF';
        $TAR_BDCOLOR       = '#FFF';
        $TAR_USER_CREATION = (int) $_SESSION[ 'USR_ID' ];

        if( !empty($TAR_DESCRICAO) ) {

            $SQL = " INSERT INTO TAR_TAREFAS( TAR_TIPO, TAR_FK_CLIENTE, TAR_FK_NATUREZA, TAR_DESCRICAO, TAR_FK_ATRIBUIDO,
                                              TAR_PZ_INICIO, TAR_PZ_FIM, TAR_FK_SITUACAO, TAR_FK_STATUS, TAR_DIATODO, TAR_BGCOLOR,
                                              TAR_BDCOLOR, TAR_DT_CREATION, TAR_USER_CREATION )
                                      VALUES( '$TAR_TIPO', '$TAR_FK_CLIENTE', '$TAR_FK_NATUREZA', '$TAR_DESCRICAO', '$TAR_FK_ATRIBUIDO',
                                              '$TAR_PZ_INICIO', '$TAR_PZ_FIM', '$TAR_FK_SITUACAO', '$TAR_FK_STATUS', '$TAR_DIATODO', '$TAR_BGCOLOR', '$TAR_BDCOLOR', NOW(), '$TAR_USER_CREATION' ) ";

            if( mysqli_query( $CONN, $SQL ) ) {
                $_SESSION[ 'msg1' ] = "Evento adicionado com sucesso!";
                echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
            } else {
                $_SESSION[ 'msg2' ] = "Erro ao adicionar o evento!";
                echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
            }

        } else {
            $_SESSION[ 'msg2' ] = "Evento em branco!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
        }
    }

    // ======================================================================================= //
    // UPDT
    // ======================================================================================= //
    if( !empty( $_POST[ 'ACTION' ] ) && ( $_POST[ 'ACTION' ] == 'UPDT' ) ) {
        $TAR_ID          = $_POST[ 'TAR_ID' ];
        $TAR_PZ_INICIO   = $_POST[ 'TAR_PZ_INICIO' ];
        $TAR_PZ_FIM      = $_POST[ 'TAR_PZ_FIM' ];
        $TAR_DESCRICAO   = $_POST[ 'TAR_DESCRICAO' ];
        $TAR_USER_UPDATE = $_SESSION[ 'USR_ID' ];

        $SQL = " UPDATE TAR_TAREFAS
                    SET TAR_PZ_INICIO    = '$TAR_PZ_INICIO',
                        TAR_PZ_FIM       = '$TAR_PZ_FIM',
                        TAR_DESCRICAO    = '$TAR_DESCRICAO',
                        TAR_DT_UPDATE    = NOW(),
                        TAR_USER_UPDATE  = '$TAR_USER_UPDATE'
                  WHERE TAR_ID           = '$TAR_ID'
               ";

        if( mysqli_query( $CONN, $SQL ) ) {
            $_SESSION[ 'msg1' ] = "Evento atualizado com sucesso!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
        } else {
            $_SESSION[ 'msg2' ] = "Erro ao atualizar o evento!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
        }

    }

    // ======================================================================================= //
    // DELETE
    // ======================================================================================= //
    if( !empty( $_GET[ 'action' ] ) && ( $_GET[ 'action' ] == 'delete' ) ) {
        $ID = $_GET[ 'id' ];

        $SQL = " DELETE FROM TAR_TAREFAS WHERE TAR_ID = '$ID' LIMIT 1 ";

        if( mysqli_query( $CONN, $SQL ) ) {
            $_SESSION[ 'msg1' ] = "Evento excluído com sucesso!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
        } else {
            $_SESSION[ 'msg2' ] = "Erro ao excluir o evento!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=schedule/sch_main'; }, 0);</script>";
        }

    }