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
		$DBA_USER_CREATION = $_SESSION[ 'USR_ID' ];

		$SQL = " INSERT INTO SYS_DATABASES( DBA_NAME, DBA_USER, DBA_PASS, DBA_DT_CREATION, DBA_USER_CREATION )
						 VALUES( '$DBA_NAME', '$DBA_USER', '$DBA_PASS', NOW(), '$DBA_USER_CREATION' ) ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/databases/dba_main'; }, 0);</script>";
		} mysqli_close( $CONN1 );
}
?>