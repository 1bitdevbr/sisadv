<?php
    if ( !isset( $_SESSION ) ) session_start();
    require_once( 'connection.php' );

    // -- VALIDANDO A SESSION -- //
    if ( isset( $_SESSION[ 'USR_ID' ] ) OR
        isset( $_SESSION[ 'USR_NAME' ] ) OR
        isset( $_SESSION[ 'USR_LOGIN' ] ) OR
        isset( $_SESSION[ 'USR_FK_ACCESS_LEVEL' ] ) OR
		isset( $_SESSION[ 'USR_FK_CLIENT' ] ) OR
        isset( $_SESSION[ 'TIMEOUT' ] ) )
    {
        session_unset();
        session_destroy();
        session_start();
    }

    // -- AUTENTICANDO O USUARIO -- //
    if ( ( isset( $_POST[ 'USR_LOGIN' ] ) ) && isset( $_POST[ 'USR_PASS' ] ) )
    {  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)

        $USER = mysqli_real_escape_string( $CONN1, $_POST[ 'USR_LOGIN' ] ); // Escapar de caracteres especiais, como aspas, prevenindo SQL injection.
        $PASS = mysqli_real_escape_string( $CONN1, $_POST[ 'USR_PASS' ] );
        $PASS = md5( $PASS );

        $SQL = mysqli_query( $CONN1, " SELECT U.USR_ID, U.USR_LOGIN, U.USR_NAME, U.USR_MOBILE_PHONE, U.USR_FK_LEVEL, U.USR_FK_CLIENT, U.USR_FK_DB_NAME,
											  U.USR_ONLINE, U.USR_FK_STATUS, C.CLI_CLIENT, D.DBA_NAME, D.DBA_USER, D.DBA_PASS
                                         FROM SYS_USERS U
                                         JOIN SYS_CLIENTS C ON C.CLI_ID = U.USR_FK_CLIENT
                                         JOIN SYS_DATABASES D ON D.DBA_ID = U.USR_FK_DB_NAME
                                        WHERE U.USR_LOGIN = '$USER' AND U.USR_PASS = '$PASS' AND U.USR_FK_STATUS = 1
                                        LIMIT 1 ");

        $DB = mysqli_fetch_assoc( $SQL );

        // -- CRIANDO LOGS E REGISTRO DA SESSION -- //
        if ( !empty( $DB ) )
        {
            $_SESSION[ 'USR_ID'           ] = $DB[ 'USR_ID'           ];
            $_SESSION[ 'USR_LOGIN'        ] = $DB[ 'USR_LOGIN'        ];
            $_SESSION[ 'USR_NAME'         ] = $DB[ 'USR_NAME'         ];
            $_SESSION[ 'USR_MOBILE_PHONE' ] = $DB[ 'USR_MOBILE_PHONE' ];
            $_SESSION[ 'USR_FK_LEVEL'     ] = $DB[ 'USR_FK_LEVEL'     ];
            $_SESSION[ 'USR_FK_CLIENT'    ] = $DB[ 'USR_FK_CLIENT'    ];
            $_SESSION[ 'USR_DB_NAME'      ] = $DB[ 'DBA_NAME'         ];
            $_SESSION[ 'USR_DB_USER'      ] = $DB[ 'DBA_USER'         ];
            $_SESSION[ 'USR_DB_PASS'      ] = $DB[ 'DBA_PASS'         ];
            $_SESSION[ 'USR_ONLINE'       ] = $DB[ 'USR_ONLINE'       ];

            $IP         = getenv       ( 'REMOTE_ADDR' ) ;
            $PORT       = getenv       ( 'REMOTE_PORT' ) ;
            $HOST       = getHOSTbyaddr( $IP )           ;
            $DATA       = date         ( 'd/m/Y H:i:s' ) ;
            $USR_ID     = $_SESSION    [ 'USR_ID' ]      ;
            $USER       = $_SESSION    [ 'USR_LOGIN' ]   ;
            $NAME       = $_SESSION    [ 'USR_NAME' ]    ;
            $LEVEL      = $_SESSION    [ 'USR_FK_LEVEL' ];
            $DB_NAME    = $_SESSION    [ 'USR_DB_NAME' ] ;
            $DB_USER    = $_SESSION    [ 'USR_DB_USER' ] ;
            $DB_PASS    = $_SESSION    [ 'USR_DB_PASS' ] ;
            $USR_ONLINE = $_SESSION    [ 'USR_ONLINE' ]  ;

            $ARQ = fopen( 'IP.txt', 'a' );
                   fwrite( $ARQ, "\n$DATA; $NAME; $USER; $IP; $PORT; $DB_NAME; $HOST ");
                   fclose( $ARQ );

            // $IP = $_SERVER[ 'REMOTE_ADDR' ];
            $UM = fopen( 'IP.txt', 'r+' );
                  fputs( $UM, $IP );

            // API de geolocalização para obter dados da localização
            $apiKey = '7e0b41c16d00492a8e5015cfd400e297';  // Substitua pela chave de sua API
            $geoData = file_get_contents("https://api.ipgeolocation.io/ipgeo?apiKey=$apiKey&ip=$IP");
            $location = json_decode($geoData, true);

            // Verifique se os dados foram obtidos
            if ($location)
            {
                $SES_CITY = $location['city'] ?? 'Desconhecido';
                $SES_STATE = $location['state_prov'] ?? 'Desconhecido';
                $SES_COUNTRY = $location['country_name'] ?? 'Desconhecido';
                $SES_FLAG = $location['country_flag'] ?? 'Desconhecido';
                $SES_ISP = $location['isp'] ?? 'Desconhecido';
                $SES_LATITUDE = $location['latitude'] ?? '0.0';
                $SES_LONGITUDE = $location['longitude'] ?? '0.0';
            }

            // Obtenha o navegador do usuário
            $SES_BROWSER = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconhecido';

            // -- GRAVANDO LOG DE ACESSO NA TABELA SESSION -- //
            mysqli_query( $CONN1, " INSERT INTO SYS_SESSION( SES_LOGIN, SES_FK_USER, SES_IP, SES_PORT, SES_DB_NAME, SES_BROWSER, SES_ISP, SES_HOST, SES_CITY,
                                                             SES_STATE, SES_COUNTRY, SES_FLAG, SES_LATITUDE, SES_LONGITUDE )
                                         VALUES( NOW(), '$USR_ID', '$IP', '$PORT', '$DB_NAME', '$SES_BROWSER', '$SES_ISP', '$HOST', '$SES_CITY',
                                                        '$SES_STATE', '$SES_COUNTRY', '$SES_FLAG', '$SES_LATITUDE', '$SES_LONGITUDE' ) ");
            if( mysqli_connect_errno() )
            {
                echo 'Erro ao registrar Acesso!' . mysqli_connect_error();
            }

            // -- REDIRECIONANDO O USUARIO -- //
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '/index.php'; }, 0);</script>";

        } else
        {
            mysqli_close( $CONN1 );
            echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '/logout.php'; }, 0);</script>";
        }
    } else
    {
        mysqli_close( $CONN1 );
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '/logout.php'; }, 0);</script>";
    }
?>