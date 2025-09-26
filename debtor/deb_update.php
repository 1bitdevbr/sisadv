<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

  if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
    $DEV_DATE = test_input( $_POST[ 'DEV_DATE' ] );
    $DEV_FK_STATUS = $_POST[ 'DEV_FK_STATUS' ];
    $DEV_FK_FOLDER = $_POST[ 'DEV_FK_FOLDER' ];
    $DEV_PROCESS = number( $_POST[ 'DEV_PROCESS' ] );
    $DEV_FK_CLIENT = $_POST[ 'DEV_FK_CLIENT' ];
    $DEV_DEMANDED = corrigir( $_POST[ 'DEV_DEMANDED' ] );
    $DEV_DESCRIPTION = corrigir( $_POST[ 'DEV_DESCRIPTION' ] );
    $DEV_PRICE = moeda( $_POST[ 'DEV_PRICE' ] );

    $DEV_USER_UPDATE = $_SESSION[ 'USR_ID' ];
    $ID = $_POST[ 'DEV_ID' ];
  }

  $SQL = " UPDATE DEV_CALC_MOV
              SET DEV_DATE = '$DEV_DATE', DEV_FK_STATUS = '$DEV_FK_STATUS', DEV_FK_FOLDER='$DEV_FK_FOLDER', DEV_PROCESS = '$DEV_PROCESS', DEV_FK_CLIENT = '$DEV_FK_CLIENT',
                  DEV_DEMANDED = '$DEV_DEMANDED', DEV_DESCRIPTION = '$DEV_DESCRIPTION', DEV_PRICE = '$DEV_PRICE', DEV_DT_UPDATE = NOW(), DEV_USER_UPDATE = '$DEV_USER_UPDATE'
            WHERE DEV_ID = $ID ";

  $RESULTADO = mysqli_query( $CONN, $SQL );

  if( $RESULTADO ) {
      $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=debtor/deb_main'; }, 0);</script>";
  } else {
      $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
      echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=debtor/deb_main'; }, 0);</script>";
  } mysqli_close( $CONN );
?>