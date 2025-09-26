<?php
    if( !isset( $_SESSION ) ) session_start();
    // =========================== $CONN ============================= //
    if( isset( $_SESSION[ 'USR_DB_NAME' ] ) OR
         isset( $_SESSION[ 'USR_DB_USER' ] ) OR
         isset( $_SESSION[ 'USR_DB_PASS' ] ) ) {

        # Conecta ao banco de dados
        $CONN = new mysqli( 'localhost', $_SESSION[ 'USR_DB_USER' ], $_SESSION[ 'USR_DB_PASS' ], $_SESSION[ 'USR_DB_NAME' ] );

        # Trap de erros de conexão
        if( $CONN->connect_error ) die( "Erro no servidor: " . $CONN->connect_error );

        # Aqui está o segredo da conexão em UTF-8
        $CONN->query("SET NAMES 'utf8'");
        $CONN->query('SET character_set_connection=utf8');
        $CONN->query('SET character_set_client=utf8');
        $CONN->query('SET character_set_results=utf8');

        # Meses e dias da semana em pt/BR
        $CONN->query('SET lc_time_names = "pt_BR"');
    }
?>