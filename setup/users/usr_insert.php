<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_POST[ 'btn-update' ] ) )	{
		$USR_ID = $_POST[ 'USR_ID' ];
		$USR_NAME = $_POST[ 'USR_NAME' ];
		$USR_LOGIN = $_POST[ 'USR_LOGIN' ];
		$USR_PASS = $_POST[ 'USR_PASS' ];
		if( $USR_PASS == strlen( $USR_PASS ) < 32 ) {
				$USR_PASS = md5( $_POST[ 'USR_PASS' ] );
		} else { $USR_PASS = $USR_PASS; }
		$USR_FK_LEVEL = $_POST[ 'USR_FK_LEVEL' ];
		$USR_FK_STATUS = $_POST[ 'USR_FK_STATUS' ];
		$USR_FK_CLIENT = $_POST[ 'USR_FK_CLIENT' ];
		$USR_FK_DB_NAME = $_POST[ 'USR_FK_DB_NAME' ];
		$USR_USER_CREATION = $_SESSION[ 'USR_ID' ];

		$SQL = " INSERT INTO SYS_USERS( USR_LOGIN, USR_PASS, USR_NAME, USR_FK_LEVEL, USR_FK_CLIENT, USR_FK_DB_NAME,
																		USR_FK_STATUS, USR_DT_CREATION, USR_USER_CREATION )

							VALUES( '$USR_LOGIN', '$USR_PASS', '$USR_NAME', '$USR_FK_LEVEL', '$USR_FK_CLIENT',
											'$USR_FK_DB_NAME', '$USR_FK_STATUS', NOW(), '$USR_USER_CREATION' ) ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/users/usr_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/users/usr_view&id=$ID'; }, 0);</script>";
		} mysqli_close( $CONN1 );
}
?>