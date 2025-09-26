<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 2;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');

  // TRATAMENTO DAS AÇÕES VIA URL
  // ======================================================================================= //
  // SAVE
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'SAVE' ) ) {
    $NOT_FK_CLIENT     = (int) $_POST[ 'NOT_FK_CLIENT' ];
    $NOT_USER_CREATION = (int) $_SESSION[ 'USR_ID' ];
    $NOT_NOTE          = $_POST[ 'NOT_NOTE' ];

    if( !empty($NOT_NOTE) ) {

      $SQL = " INSERT INTO NOT_NOTES( NOT_FK_CLIENT, NOT_NOTE, NOT_DT_CREATION, NOT_USER_CREATION )
                              VALUES( '$NOT_FK_CLIENT', '$NOT_NOTE', NOW(), '$NOT_USER_CREATION' ) ";
  
      if( mysqli_query( $CONN, $SQL ) ) {
        $_SESSION[ 'msg1' ] = "Registro adicionado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>"; // 2 segundos = 2000
      } else {
        $_SESSION[ 'msg2' ] = "Erro ao adicionar o registro!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";
      }

    } else {
      $_SESSION[ 'msg2' ] = "Registro em branco!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";      
    }

  }

  // ======================================================================================= //
  // UPDT
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'UPDT' ) ) {
    $NOT_FK_CLIENT   = $_POST[ 'NOT_FK_CLIENT' ];
    $NOT_ID          = $_POST[ 'NOT_ID' ];
    $NOT_USER_UPDATE = $_SESSION[ 'USR_ID' ];
    $NOT_NOTE        = $_POST[ 'NOT_NOTE' ];  
 
    $SQL = " UPDATE NOT_NOTES
                SET NOT_NOTE = '$NOT_NOTE', NOT_DT_UPDATE = NOW(), NOT_USER_UPDATE = $NOT_USER_UPDATE
              WHERE NOT_ID = '$NOT_ID'
                AND NOT_FK_CLIENT = '$NOT_FK_CLIENT' ";

    if( mysqli_query( $CONN, $SQL ) ) {
      $_SESSION[ 'msg1' ] = "Registro atualizado com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";
    } else {
      $_SESSION[ 'msg2' ] = "Erro ao atualizar o registro!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";
    }

  }

  // ======================================================================================= //
  // DEL
  // ======================================================================================= //
  if( !empty( $_GET[ 'ACTION' ]) && ( $_GET[ 'ACTION' ] == 'DEL' ) ) {
    $NOT_FK_CLIENT = (int) $_GET[ 'NOT_FK_CLIENT' ];
    $NOT_ID        = (int) $_GET[ 'NOT_ID' ];    

    mysqli_query( $CONN, " DELETE FROM NOT_NOTES WHERE NOT_ID = '$NOT_ID' AND NOT_FK_CLIENT = '$NOT_FK_CLIENT' " );

    if( $CONN ) {
      $_SESSION[ 'msg1' ] = "Registro excluído com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";
    } else {
      $_SESSION[ 'msg2' ] = "Erro ao excluir o registro!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$NOT_FK_CLIENT'; }, 0);</script>";
    }    
  }

  // ======================================================================================= //
  // LIST
  // ======================================================================================= //
  if( isset( $_GET[ 'id' ] ) ) {
    $NOT_FK_CLIENT = (int) $_GET[ 'id' ];

    $SQL = " SELECT DISTINCT
                    NTE.NOT_ID, NTE.NOT_NOTE, NTE.NOT_DT_CREATION, NTE.NOT_USER_CREATION,
                    CLI.CLI_ID, CLI.CLI_NOME,
                    PAS.PAS_NOME
               FROM NOT_NOTES NTE
          LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = NTE.NOT_FK_CLIENT
          LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
              WHERE CLI.CLI_ID = '$NOT_FK_CLIENT'
           ORDER BY NOT_DT_CREATION DESC ";

    $RESULTADO    = mysqli_query( $CONN, $SQL );
    $VERIFICA     = mysqli_num_rows( $RESULTADO );
  }  
?>