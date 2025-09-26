<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 2;
  require_once(__DIR__ . '/../../access/level.php');
  require_once(__DIR__ . '/../../access/conn.php');
  require_once(__DIR__ . '/../../config.php');
  require_once(__DIR__ . '/../../dist/func/functions.php');

  // TRATAMENTO DAS AÇÕES VIA URL
  // ======================================================================================= //
  // SAVE
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'SAVE' ) ) {
    $ADV_ID               = (int) $_POST[ 'ADV_ID' ];
    $ADV_SOCIEDADE        = corrigir( strtoupper( $_POST[ 'ADV_SOCIEDADE' ] ) );
    if( isset( $_POST[ 'ADV_CNPJ' ] ) ) {
      $ADV_CNPJ = $_POST[ 'ADV_CNPJ' ];
      $ADV_CNPJ = preg_replace( "/[^0-9]/", "", $ADV_CNPJ );
    } else { $ADV_CNPJ = ''; }
    $ADV_NR_OAB_SOCIEDADE = number( $_POST[ 'ADV_NR_OAB_SOCIEDADE' ] );
    $ADV_NOME             = corrigir( strtoupper( $_POST[ 'ADV_NOME' ] ) );
    $ADV_NACIONALIDADE    = corrigir( strtoupper( $_POST[ 'ADV_NACIONALIDADE' ] ) );
    $ADV_NR_OAB           = number( $_POST[ 'ADV_NR_OAB' ] );
    $ADV_FK_OAB_UF        = (int) $_POST[ 'ADV_FK_OAB_UF' ];
    $ADV_FK_TIPO          = (int) $_POST[ 'ADV_FK_TIPO' ];
    $ADV_FK_EST_CIVIL     = (int) $_POST[ 'ADV_FK_EST_CIVIL' ];
    $ADV_EMAIL            = filter_var( $_POST[ 'ADV_EMAIL' ] );
    if( filter_var( $ADV_EMAIL, FILTER_VALIDATE_EMAIL ) ) {
      $ADV_EMAIL;
    } else { $_SESSION[ 'msg1' ] = "$ADV_EMAIL não é um e-mail válido!"; }
    $ADV_ENDERECO         = corrigir( strtoupper( $_POST[ 'ADV_ENDERECO' ] ) );
    $ADV_NR               = corrigir( strtoupper( $_POST[ 'ADV_NR' ] ) );
    $ADV_BAIRRO           = corrigir( strtoupper( $_POST[ 'ADV_BAIRRO' ] ) );
    $ADV_CIDADE           = corrigir( strtoupper( $_POST[ 'ADV_CIDADE' ] ) );
    $ADV_FK_UF            = (int) $_POST[ 'ADV_FK_UF' ];
    $ADV_CEP              = number( $_POST[ 'ADV_CEP' ] );
    if( isset( $_POST[ 'ADV_TELEFONE' ] ) ) {
      $ADV_TELEFONE = $_POST[ 'ADV_TELEFONE' ];
      $ADV_TELEFONE = preg_replace( "/[^0-9]/", "", $ADV_TELEFONE );
    } else { $ADV_TELEFONE = ''; }
    if( isset( $_POST[ 'ADV_CELULAR' ] ) ) {
      $ADV_CELULAR = $_POST[ 'ADV_CELULAR' ];
      $ADV_CELULAR = preg_replace( "/[^0-9]/", "", $ADV_CELULAR );
    } else { $ADV_CELULAR = ''; }
    $ADV_FK_STATUS        = (int) $_POST[ 'ADV_FK_STATUS' ];
    $NOT_USER_CREATION    = (int) $_SESSION[ 'USR_ID' ];

    if( empty( $ADV_ID ) ) {

      $SQL = " INSERT INTO ADV_ADVOGADOS( ADV_SOCIEDADE, ADV_NR_OAB_SOCIEDADE, ADV_NOME, ADV_NACIONALIDADE, ADV_FK_EST_CIVIL, ADV_NR_OAB, ADV_FK_TIPO,
                                          ADV_FK_OAB_UF, ADV_CNPJ, ADV_ENDERECO, ADV_NR, ADV_COMPLEMENTO, ADV_BAIRRO, ADV_CIDADE, ADV_FK_UF, ADV_CEP,
                                          ADV_EMAIL, ADV_TELEFONE, ADV_CELULAR, ADV_DT_CREATION, ADV_USER_CREATION, ADV_FK_STATUS )
                                  VALUES( '$ADV_SOCIEDADE', '$ADV_NR_OAB_SOCIEDADE', '$ADV_NOME', '$ADV_NACIONALIDADE', '$ADV_FK_EST_CIVIL', '$ADV_NR_OAB',
                                          '$ADV_FK_TIPO', '$ADV_FK_OAB_UF', '$ADV_CNPJ', '$ADV_ENDERECO', '$ADV_NR', '$ADV_COMPLEMENTO', '$ADV_BAIRRO', '$ADV_CIDADE',
                                          '$ADV_FK_UF', '$ADV_CEP', '$ADV_EMAIL', '$ADV_TELEFONE', '$ADV_CELULAR', NOW(), '$ADV_USER_CREATION', '$ADV_FK_STATUS' ) ";

      if( mysqli_query( $CONN, $SQL ) ) {
        $_SESSION[ 'msg1' ] = "Registro adicionado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main; }, 0);</script>"; // 2 segundos = 2000
      } else {
        $_SESSION[ 'msg2' ] = "Erro ao adicionar o registro!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main'; }, 0);</script>";
      }

    }
  }

  // ======================================================================================= //
  // UPDT
  // ======================================================================================= //
  if( !empty( $_POST[ 'ACTION' ]) && ( $_POST[ 'ACTION' ] == 'UPDT' ) ) {
    $ADV_ID               = (int) $_POST[ 'ADV_ID' ];
    $ADV_SOCIEDADE        = corrigir( $_POST[ 'ADV_SOCIEDADE' ] );
    if( isset( $_POST[ 'ADV_CNPJ' ] ) ) {
      $ADV_CNPJ = $_POST[ 'ADV_CNPJ' ];
      $ADV_CNPJ = preg_replace( "/[^0-9]/", "", $ADV_CNPJ );
    } else { $ADV_CNPJ = ''; }
    $ADV_NR_OAB_SOCIEDADE = number( $_POST[ 'ADV_NR_OAB_SOCIEDADE' ] );
    $ADV_NOME             = corrigir( $_POST[ 'ADV_NOME' ] );
    $ADV_NACIONALIDADE    = corrigir( strtoupper( $_POST[ 'ADV_NACIONALIDADE' ] ) );
    $ADV_NR_OAB           = number( $_POST[ 'ADV_NR_OAB' ] );
    $ADV_FK_OAB_UF        = (int) $_POST[ 'ADV_FK_OAB_UF' ];
    $ADV_FK_TIPO          = (int) $_POST[ 'ADV_FK_TIPO' ];
    $ADV_FK_EST_CIVIL     = (int) $_POST[ 'ADV_FK_EST_CIVIL' ];
    $ADV_EMAIL            = filter_var( $_POST[ 'ADV_EMAIL' ] );
    if( filter_var( $ADV_EMAIL, FILTER_VALIDATE_EMAIL ) ) {
      $ADV_EMAIL;
    } else { $_SESSION[ 'msg1' ] = "$ADV_EMAIL não é um e-mail válido!"; }
    $ADV_ENDERECO         = corrigir( $_POST[ 'ADV_ENDERECO' ] );
    $ADV_NR               = corrigir( $_POST[ 'ADV_NR' ] );
    $ADV_BAIRRO           = corrigir( $_POST[ 'ADV_BAIRRO' ] );
    $ADV_CIDADE           = corrigir( $_POST[ 'ADV_CIDADE' ] );
    $ADV_FK_UF            = (int) $_POST[ 'ADV_FK_UF' ];
    $ADV_CEP              = number( $_POST[ 'ADV_CEP' ] );
    if( isset( $_POST[ 'ADV_TELEFONE' ] ) ) {
      $ADV_TELEFONE = $_POST[ 'ADV_TELEFONE' ];
      $ADV_TELEFONE = preg_replace( "/[^0-9]/", "", $ADV_TELEFONE );
    } else { $ADV_TELEFONE = ''; }
    if( isset( $_POST[ 'ADV_CELULAR' ] ) ) {
      $ADV_CELULAR = $_POST[ 'ADV_CELULAR' ];
      $ADV_CELULAR = preg_replace( "/[^0-9]/", "", $ADV_CELULAR );
    } else { $ADV_CELULAR = ''; }
    $ADV_FK_STATUS        = (int) $_POST[ 'ADV_FK_STATUS' ];
    $ADV_USER_UPDATE      = $_SESSION[ 'USR_ID' ];
 
    $SQL = " UPDATE ADV_ADVOGADOS
                SET ADV_SOCIEDADE = '$ADV_SOCIEDADE', ADV_NR_OAB_SOCIEDADE = '$ADV_NR_OAB_SOCIEDADE', ADV_NOME = '$ADV_NOME', ADV_NACIONALIDADE = '$ADV_NACIONALIDADE',
                    ADV_FK_EST_CIVIL  = '$ADV_FK_EST_CIVIL ', ADV_NR_OAB = '$ADV_NR_OAB', ADV_FK_TIPO = '$ADV_FK_TIPO', ADV_FK_OAB_UF = '$ADV_FK_OAB_UF',
                    ADV_CNPJ = '$ADV_CNPJ', ADV_ENDERECO = '$ADV_ENDERECO', ADV_NR = '$ADV_NR', ADV_COMPLEMENTO = '$ADV_COMPLEMENTO', ADV_BAIRRO = '$ADV_BAIRRO',
                    ADV_CIDADE = '$ADV_CIDADE', ADV_FK_UF = '$ADV_FK_UF', ADV_CEP = '$ADV_CEP', ADV_EMAIL = '$ADV_EMAIL', ADV_TELEFONE = '$ADV_TELEFONE',
                    ADV_CELULAR = '$ADV_CELULAR', ADV_DT_UPDATE = NOW(), ADV_USER_UPDATE = '$ADV_USER_UPDATE', ADV_FK_STATUS = '$ADV_FK_STATUS'
              WHERE ADV_ID = '$ADV_ID' ";

    if( mysqli_query( $CONN, $SQL ) ) {
      $_SESSION[ 'msg1' ] = "Registro atualizado com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main&id=$ADV_ID'; }, 0);</script>";
    } else {
      $_SESSION[ 'msg2' ] = "Erro ao atualizar o registro!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main&id=$ADV_ID'; }, 0);</script>";
    }

  }

  // ======================================================================================= //
  // DEL
  // ======================================================================================= //
  if( !empty( $_GET[ 'ACTION' ] ) && ( $_GET[ 'ACTION' ] == 'DEL' ) ) {
    $ADV_ID = (int) $_GET[ 'ID' ];

    $SQL = " DELETE FROM ADV_ADVOGADOS WHERE ADV_ID = '$ADV_ID' ";

    if( mysqli_query( $CONN, $SQL ) ) {
      $_SESSION[ 'msg1' ] = "Registro excluído com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main'; }, 0);</script>";
    } else {
      $_SESSION[ 'msg2' ] = "Erro ao excluir o registro!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/lawyers/law_main'; }, 0);</script>";
    }    
  }

  // ======================================================================================= //
  // LIST
  // ======================================================================================= //
  $SQL = " SELECT *
             FROM ADV_ADVOGADOS ADV
             JOIN ADV_TIPOS ATP ON ATP.ATP_ID = ADV_FK_TIPO
             JOIN UFE_ESTADOS UFE ON UFE.UFE_ID = ADV_FK_OAB_UF
             JOIN UFE_ESTADOS UFS ON UFS.UFE_ID = ADV_FK_UF
         ORDER BY ADV_ID DESC ";

  $RESULTADO = mysqli_query( $CONN, $SQL );
  $VERIFICA = mysqli_num_rows( $RESULTADO );
?>