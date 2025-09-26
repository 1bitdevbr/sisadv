<?php
	if( !isset( $_SESSION ) ) session_start();

    if( isset( $_SESSION[ 'USR_ID' ] ) ) {
        require(__DIR__ . '/access.php');

        $USR_ID = $_SESSION[ 'USR_ID' ];

        $SQL = " SELECT SES_FK_USER,
                        MAX( SES_LOGIN ) AS LOGIN
                   FROM SYS_SESSION
                  WHERE SES_FK_USER = '$USR_ID'
               ";

        $RESULT = mysqli_query( $CONN1, $SQL );
        $RESP = mysqli_fetch_array( $RESULT );
        $LOGIN = $RESP[ 'LOGIN' ];

        mysqli_query( $CONN1, " UPDATE SYS_SESSION
                                   SET SES_LOGOUT  = NOW(),
                                       SES_TIME    = TIMEDIFF( NOW(), '$LOGIN' )
                                 WHERE SES_LOGIN   = '$LOGIN'
                                   AND SES_FK_USER = '$USR_ID'
                              " );

        echo 'Erro ao registrar Logout! <br />' . mysqli_error( $CONN1 );
        mysqli_close( $CONN1 );
    }

    session_unset();
    session_destroy();
    header("Location: login/login.php");
    exit();
?>