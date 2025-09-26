<?php
    // =========================== $CONN1 ============================= //
    // Força o header UTF-8 antes de qualquer output
    header('Content-Type: text/html; charset=utf-8');

    // Conecta ao banco de dados
    $CONN1 = new mysqli('localhost', 'sisadv_system', 'GPv%YpLH7@', 'sisadv_system');

    // Trap de erros de conexão
    if ($CONN1->connect_error) {
        die("Erro no servidor: " . $CONN1->connect_error);
    }

    // Configuração definitiva para UTF-8 (usando utf8mb4 para suporte completo)
    $CONN1->set_charset("utf8mb4"); // Substitui todas as queries SET NAMES

    // Configuração adicional para locale (opcional, mas recomendado para datas em pt_BR)
    $CONN1->query('SET lc_time_names = "pt_BR"');

// =========================== $CONN1 ============================= //
//     # Informa qual o conjunto de caracteres será usado
//     header('Content-Type: text/html; charset=utf-8');
//
//     # Conecta ao banco de dados
//     $CONN1 = new mysqli( 'localhost', 'sisadv_system', 'GPv%YpLH7@', 'sisadv_system' );
//
//     # Trap de erros de conexão
//     if( $CONN1->connect_error ) die( "Erro no servidor: " . $CONN1->connect_error );
//
//     # Aqui está o segredo da conexão em UTF-8
//     $CONN1->query("SET NAMES 'utf8'");
//     $CONN1->query('SET character_set_connection=utf8');
//     $CONN1->query('SET character_set_client=utf8');
//     $CONN1->query('SET character_set_results=utf8');
//
//     # Meses e dias da semana em pt/BR
//     $CONN1->query('SET lc_time_names = "pt_BR"');
?>