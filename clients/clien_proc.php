
<?php
  //  ====================================================================================== //
  // CRIAÇÃO DE PASTAS
  // ======================================================================================= //
  if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

  if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_pasta' ) {
    $ID = $_POST[ 'PAS_ID' ];
    $PAS_NOME = $_POST[ 'PAS_NOME' ];

    mysqli_query( $CONN, " UPDATE PAS_PROC_PASTA SET PAS_NOME = '$PAS_NOME' WHERE PAS_ID = '$ID' " );
    echo mysqli_error( $CONN );
    $_SESSION[ 'msg1' ] = "Pasta atualizada com sucesso!";
    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search&pasta_ok=3'; }, 0);</script>";
  }

  if( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar_pasta' ) {
    $ID = $_GET[ 'id' ];

    $QR = mysqli_query( $CONN, " SELECT PAS_ID FROM PAS_PROC_PASTA WHERE PAS_ID = '$ID' " );
    if( mysqli_num_rows( $QR ) > 0 ) {
      $_SESSION[ 'msg2' ] = "Erro: Esta categoria não pode ser removida! Há movimentos associados a ela.";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search&pasta_err=1'; }, 0);</script>";
    }

    mysqli_query( $CONN, " DELETE FROM PAS_PROC_PASTA WHERE PAS_ID = '$ID' ");
    echo mysqli_error( $CONN );
    $_SESSION[ 'msg1' ] = "Pasta excluída com sucesso!";
    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search&pasta_ok=2'; }, 0);</script>";
  }

  if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 2) {
    $PAS_NOME = $_POST[ 'PAS_NOME' ];
    mysqli_query( $CONN, " INSERT INTO PAS_PROC_PASTA( PAS_NOME ) values( '$PAS_NOME' ) " );
    echo mysqli_error( $CONN );
    $_SESSION[ 'msg1' ] = "Pasta criada com sucesso!";
    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search&pasta_ok=1'; }, 0);</script>";
  }
  ?>