<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');

  // TRATAMENTO DAS AÇÕES VIA URL
  // ======================================================================================= //
  // SAVE
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'SAVE' ) ) {
    $TAR_FK_NATUREZA   = (int) $_POST[ 'PNA_PROC_NATUREZA' ];
    $TAR_FK_CLIENTE    = (int) $_POST[ 'CLI_CLIENTES' ];
    $TAR_DESCRICAO     = $_POST[ 'DESCRICAO' ];
    $TAR_FK_ATRIBUIDO  = (int) $_POST[ 'USR_FK_CLIENT' ];
    $TAR_PZ_FIM        = $_POST[ 'TAR_PZ_FIM' ];
    $TAR_DIATODO       = 1;
    $TAR_FK_SITUACAO   = 1;
    $TAR_FK_STATUS     = 1;
    $TAR_BGCOLOR       = '#0073b7';
    $TAR_BDCOLOR       = '#0073b7';
    $TAR_USER_CREATION = (int) $_SESSION[ 'USR_ID' ];

    if( !empty($TAR_DESCRICAO) ) {

      $SQL = " INSERT INTO TAR_TAREFAS( TAR_FK_CLIENTE, TAR_FK_NATUREZA, TAR_DESCRICAO, TAR_FK_ATRIBUIDO, TAR_PZ_FIM, TAR_FK_SITUACAO,
                                        TAR_FK_STATUS, TAR_DIATODO, TAR_BGCOLOR, TAR_BDCOLOR, TAR_DT_CREATION, TAR_USER_CREATION )
                                VALUES( '$TAR_FK_CLIENTE', '$TAR_FK_NATUREZA', '$TAR_DESCRICAO', '$TAR_FK_ATRIBUIDO', '$TAR_PZ_FIM',
                                        '$TAR_FK_SITUACAO', '$TAR_FK_STATUS', '$TAR_DIATODO', '$TAR_BGCOLOR', '$TAR_BDCOLOR', NOW(), '$TAR_USER_CREATION' ) ";

      if( mysqli_query( $CONN, $SQL ) ) {
        $_SESSION[ 'msg1' ] = "Registro adicionado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>"; // 2 segundos = 2000
      } else {
        $_SESSION[ 'msg2' ] = "Erro ao adicionar o registro!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>";
      }

    } else {
      $_SESSION[ 'msg2' ] = "Registro em branco!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>";
    }

  }

  // ======================================================================================= //
  // UPDT
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ] ) && ( $_POST[ 'ACTION' ] == 'UPDT' ) ) {
    $TAR_ID           = $_POST[ 'TAR_ID' ];
    $TAR_FK_NATUREZA  = $_POST[ 'PNA_PROC_NATUREZA' ];
    $TAR_FK_CLIENTE   = $_POST[ 'CLI_CLIENTES' ];
    $TAR_DESCRICAO    = $_POST[ 'DESCRICAO' ];
    $TAR_FK_ATRIBUIDO = $_POST[ 'USR_FK_CLIENT' ];
    $TAR_PZ_FIM       = $_POST[ 'TAR_PZ_FIM' ];
    $TAR_FK_SITUACAO  = $_POST[ 'TAR_FK_SITUACAO' ];
    $TAR_FK_STATUS    = $_POST[ 'TAR_FK_STATUS' ];

    if( isset( $TAR_FK_STATUS ) && ( $TAR_FK_STATUS == 0 ) ) {
        if( $TAR_FK_SITUACAO == 3 ) {
            $TAR_FK_STATUS = 0;
        } else {
            $TAR_FK_STATUS = 1;
            $_SESSION[ 'msg2' ] = "Para finalizar uma tarefa, o campo SITUAÇÃO precisa estar CONCLUÍDO!";
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>";
            exit;
        }
    } else {
        $TAR_FK_STATUS  = 1;
    }

    $TAR_USER_UPDATE  = $_SESSION[ 'USR_ID' ];

    $SQL = " UPDATE TAR_TAREFAS
                SET TAR_FK_NATUREZA  = '$TAR_FK_NATUREZA',
                    TAR_FK_CLIENTE   = '$TAR_FK_CLIENTE',
                    TAR_DESCRICAO    = '$TAR_DESCRICAO',
                    TAR_FK_ATRIBUIDO = '$TAR_FK_ATRIBUIDO',
                    TAR_PZ_FIM       = '$TAR_PZ_FIM',
                    TAR_FK_SITUACAO  = '$TAR_FK_SITUACAO',
                    TAR_FK_STATUS    = '$TAR_FK_STATUS',
                    TAR_DT_UPDATE    = NOW(),
                    TAR_USER_UPDATE  = '$TAR_USER_UPDATE'
              WHERE TAR_ID           = '$TAR_ID'
           ";

    if( mysqli_query( $CONN, $SQL ) ) {
      $_SESSION[ 'msg1' ] = "Registro atualizado com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>";
    } else {
      $_SESSION[ 'msg2' ] = "Erro ao atualizar o registro!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=tasks/tsk_main'; }, 0);</script>";
    }

  }