<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 4;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_POST[ 'btn-insert' ] ) )	{

		$PLN_ID = $_POST[ 'PLN_ID' ];
		$PLN_NAME = $_POST[ 'PLN_NAME' ];
		$PLN_DESCRIPTION = $_POST[ 'PLN_DESCRIPTION' ];
		$PLN_PRICE = moeda( $_POST[ 'PLN_PRICE' ] );

		$SQL = " INSERT INTO SYS_PLANS( PLN_NAME, PLN_DESCRIPTION, PLN_PRICE )
						 VALUES( '$PLN_NAME', '$PLN_DESCRIPTION', '$PLN_PRICE' ) ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/modules/man_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/modules/man_main'; }, 0);</script>";
		} mysqli_close( $CONN1 );
	}
?>