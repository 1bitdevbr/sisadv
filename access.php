<?php
    if( file_exists(__DIR__.'/access.php') ) {
        require_once(__DIR__.'/access/connection.php');
    } else {
        exit( 'Não foi possível encontrar o arquivo de conexão!' );
    }
?>