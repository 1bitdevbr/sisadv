<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

  if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
    $DEV_FK_CLIENT = $_POST[ 'DEV_FK_CLIENT' ];
    $DEV_PRICE = str_replace( ',' , '.' , $_POST[ 'DEV_PRICE' ] );
    $DEV_DT_PAYMENT = $_POST[ 'DEV_DT_PAYMENT' ];
    $DEV_AMOUNT =  str_replace( ',' , '.' , $_POST[ 'DEV_AMOUNT' ] );
    if( $DEV_AMOUNT == $DEV_PRICE ) {
      $DEV_FK_STATUS = 2;
    } else {
      $DEV_FK_STATUS = 1;
    }
    $DEV_USER_UPDATE = $_SESSION[ 'USR_ID' ];

    $SQL = " UPDATE DEV_CALC_MOV
                           SET DEV_DT_PAYMENT = '$DEV_DT_PAYMENT', DEV_AMOUNT = '$DEV_AMOUNT', DEV_FK_STATUS = '$DEV_FK_STATUS',
                                  DEV_DT_UPDATE = NOW(), DEV_USER_UPDATE = '$DEV_USER_UPDATE'
                    WHERE DEV_FK_CLIENT = $DEV_FK_CLIENT ";

    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=debtor/deb_main'; }, 0);</script>";
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=debtor/deb_main'; }, 0);</script>";
    } mysqli_close( $CONN );

  }
?>