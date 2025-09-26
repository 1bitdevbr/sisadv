<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 4;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_POST[ 'btn-update' ] ) )	{

		$DBA_ID = $_POST[ 'DBA_ID' ];
		$DBA_NAME = $_POST[ 'DBA_NAME' ];
		$DBA_USER = $_POST[ 'DBA_USER' ];
		$DBA_PASS = $_POST[ 'DBA_PASS' ];
		if( $DBA_PASS == strlen( $DBA_PASS ) < 32 ) {
				$DBA_PASS = md5( $_POST[ 'DBA_PASS' ] );
		} else { $DBA_PASS = $DBA_PASS; }
		$DBA_USER_UPDATE 	= $_SESSION[ 'USR_ID' ];

		$SQL = " UPDATE SYS_DATABASES
								SET DBA_NAME = '$DBA_NAME', DBA_USER = '$DBA_USER', DBA_PASS = '$DBA_PASS', DBA_DT_UPDATE = NOW(), DBA_USER_UPDATE = '$DBA_USER_UPDATE'
							WHERE DBA_ID = '$DBA_ID' ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
		} mysqli_close( $CONN1 );

}
?>