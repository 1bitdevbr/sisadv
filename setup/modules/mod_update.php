<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 4;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_POST[ 'btn-insert' ] ) )	{

		$MOD_ID = $_POST[ 'MOD_ID' ];
		$MOD_NAME = $_POST[ 'MOD_NAME' ];
		$MOD_DESCRIPTION = $_POST[ 'MOD_DESCRIPTION' ];

		$SQL = " UPDATE SYS_MODULES
					SET MOD_NAME = '$MOD_NAME', MOD_DESCRIPTION = '$MOD_DESCRIPTION'
				  WHERE MOD_ID = '$MOD_ID' ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/modules/mod_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/modules/mod_main'; }, 0);</script>";
		} mysqli_close( $CONN1 );

}