<?php
	if (!isset($_SESSION)) session_start();
	$required_level = 2;
	require_once(__DIR__ . '/../../access/level.php');
	require_once(__DIR__ . '/../../access/conn.php');
	require_once(__DIR__ . '/../../config.php');
	require_once(__DIR__ . '/../../dist/func/functions.php');

	if( isset( $_POST[ 'btn-update' ] ) )	{

		$USR_ID 					= $_POST[ 'USR_ID' ];
		$ID 							= $_POST[ 'ID' ];

		if( !empty( $_FILES[ 'USR_PHOTO' ][ 'tmp_name' ] ) || is_uploaded_file( $_FILES[ 'USR_PHOTO' ][ 'tmp_name' ] ) ) {
			$SQL 						= " SELECT USR_PHOTO, USR_LOGIN, DBA_NAME FROM SYS_USERS JOIN SYS_DATABASES ON DBA_ID = USR_FK_DB_NAME WHERE USR_ID = '$ID' ";
			$RES 						= mysqli_query( $CONN1, $SQL );
			$ROW						= mysqli_fetch_array( $RES );
			$EXT 						= strtolower( substr( $_FILES[ 'USR_PHOTO' ][ 'name' ], -4 ) ); // Get extension file
			$NEW_NAME 			= $ROW[ 'USR_LOGIN' ] . '.' . $ROW[ 'DBA_NAME' ] . $EXT; // Define a new name for file
			$DIR 						= './dist/img/'; // Directory for uploads
			move_uploaded_file( $_FILES[ 'USR_PHOTO' ][ 'tmp_name' ], $DIR.$NEW_NAME ); // Making file upload
			$USR_PHOTO			= $NEW_NAME;
		} else {
			$SQL 						= " SELECT USR_PHOTO, USR_LOGIN, DBA_NAME FROM SYS_USERS JOIN SYS_DATABASES ON DBA_ID = USR_FK_DB_NAME WHERE USR_ID = '$ID' ";
			$RES 						= mysqli_query( $CONN1, $SQL );
			$ROW						= mysqli_fetch_array( $RES );
			$USR_PHOTO 			= $ROW[ 'USR_PHOTO' ];
		}

		$USR_NAME 				= $_POST[ 'USR_NAME' ];
		$USR_LOGIN 				= $_POST[ 'USR_LOGIN' ];
		$USR_PASS 				= $_POST[ 'USR_PASS' ];
		if( $USR_PASS 		== strlen( $USR_PASS ) < 32 ) {
				$USR_PASS 		= md5( $_POST[ 'USR_PASS' ] );
		} else { $USR_PASS = $USR_PASS; }
		$USR_FK_LEVEL 		= $_POST[ 'USR_FK_LEVEL' ];
		$USR_FK_STATUS 		= $_POST[ 'USR_FK_STATUS' ];
		$USR_FK_CLIENT 		= $_POST[ 'USR_FK_CLIENT' ];
		$USR_FK_DB_NAME 	= $_POST[ 'USR_FK_DB_NAME' ];
		$USR_USER_UPDATE 	= $_SESSION[ 'USR_ID' ];

		$SQL = " UPDATE SYS_USERS
								SET USR_PHOTO = '$USR_PHOTO', USR_LOGIN = '$USR_LOGIN', USR_PASS = '$USR_PASS', USR_NAME = '$USR_NAME',
										USR_FK_LEVEL = '$USR_FK_LEVEL', USR_FK_CLIENT = '$USR_FK_CLIENT', USR_FK_DB_NAME = '$USR_FK_DB_NAME',
										USR_FK_STATUS = '$USR_FK_STATUS', USR_DT_UPDATE = NOW(), USR_USER_UPDATE = '$USR_USER_UPDATE'
							WHERE USR_ID = '$USR_ID' ";

		$RESULT = mysqli_query( $CONN1, $SQL );

		if( $RESULT ) {
				$_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/users/usr_main'; }, 0);</script>";
		} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/users/usr_view&id=$ID'; }, 0);</script>";
		} mysqli_close( $CONN1 );

}
?>