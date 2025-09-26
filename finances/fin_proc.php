<?php
    if( !isset(  $_SESSION ) ) session_start();
    ob_start(); // Inicia o buffer de saída

    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    /**
     * Controle de meses
     */
    if( isset( $_GET[ 'mes' ] ) )
        $MES_HOJE = $_GET[ 'mes' ];
    else
        $MES_HOJE = date( 'm' );

    if( isset( $_GET[ 'ano' ] ) )
        $ANO_HOJE = $_GET[ 'ano' ];
    else
        $ANO_HOJE = date( 'Y' );

    /**
     * Função para gerar cores escuras dinamicamente no PHP
     */
    function gerarCoresEscurasPHP($categorias) {
        $cores = [];
        $hueStep = 360 / count($categorias); // Divide o espectro de cores em partes iguais
        $saturation = 70; // Saturação fixa para cores vibrantes
        $lightness = 40; // Luminosidade fixa para cores escuras

        foreach ($categorias as $index => $categoria) {
            $hue = $index * $hueStep; // Calcula o tom com base no índice
            $cores[$categoria] = "hsl($hue, $saturation%, $lightness%)"; // Gera a cor no formato HSL
        }
        return $cores;
    }

    // Obter categorias para gerar cores
    $QR = mysqli_query($CONN, "SELECT LCA_NOME FROM LCA_LC_CAT ORDER BY LCA_NOME");
    $categorias = [];
    while ($row = mysqli_fetch_array($QR)) {
        $categorias[] = $row['LCA_NOME'];
    }
    $cores = gerarCoresEscurasPHP($categorias); // Gerar cores para todas as categorias

    /**
     * Controle das Ações
     */
    if( isset(  $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar' ) {
        $ID = $_GET[ 'id' ];

        mysqli_query( $CONN, "DELETE FROM LCM_LC_MOVIMENTO WHERE LCM_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento removido com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_cat' ) {
        $ID = $_POST[ 'id' ];
        $NOME = $_POST[ 'nome' ];

        mysqli_query( $CONN, "UPDATE LCA_LC_CAT SET LCA_NOME = '$NOME' WHERE LCA_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria alterada com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=3" );
    }

    if( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar_cat' ) {
        $ID = $_GET[ 'id' ];

        $QR = mysqli_query( $CONN, "SELECT C.LCA_ID FROM LCM_LC_MOVIMENTO M, LCA_LC_CAT C WHERE C.LCA_ID = M.LCM_CAT && C.LCA_ID = $ID " );
        if( mysqli_num_rows( $QR ) > 0 ) {
            $_SESSION[ 'msg2' ] = "Esta categoria não pode ser removida, pois há movimentos associados a ela.";
            header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_err=1" );
        }

        mysqli_query( $CONN, " DELETE FROM LCA_LC_CAT WHERE LCA_ID = '$ID' ");

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria removida com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_mov' ) {
        $ID = $_POST[ 'id' ];
        $DIA = $_POST[ 'dia' ];
        $TIPO = $_POST[ 'tipo' ];
        $CAT = $_POST[ 'cat' ];
        $DESCRICAO = $_POST[ 'descricao' ];
        $VALOR = moeda( $_POST[ 'valor' ] );

        mysqli_query( $CONN, " UPDATE LCM_LC_MOVIMENTO SET LCM_DIA = '$DIA', LCM_TIPO = '$TIPO', LCM_CAT = '$CAT', LCM_DESCRICAO = '$DESCRICAO', LCM_VALOR = '$VALOR' WHERE LCM_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento alterado com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=3" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 2) {

        $NOME = $_POST[ 'nome' ];
        mysqli_query( $CONN, " INSERT INTO LCA_LC_CAT( LCA_NOME ) values( '$NOME' ) " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria cadastrada com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=1" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 1) {

        // $DATA = $_POST[ 'data' ];
        $TIPO = $_POST[ 'tipo' ];
        $CAT = $_POST[ 'cat' ];
        $DESCRICAO = $_POST[ 'descricao' ];
        $VALOR = moeda( $_POST[ 'valor' ] );

        // $T = explode("/", $DATA);
        // $DIA = $T[0];
        // $MES = $T[1];
        // $ANO = $T[2];

        $DIA = $_POST[ 'dia' ];
        $MES = $MES_HOJE;
        $ANO = $ANO_HOJE;

        mysqli_query( $CONN, " INSERT INTO LCM_LC_MOVIMENTO( LCM_DIA, LCM_MES, LCM_ANO, LCM_TIPO, LCM_DESCRICAO, LCM_VALOR, LCM_CAT ) values( '$DIA', '$MES', '$ANO', '$TIPO', '$DESCRICAO', '$VALOR', '$CAT' ) " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento cadastrado com sucesso!";
        header("Location: index.php?pg=finances/fin_main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=1" );
    }

    /**
     * Envia e limpa o buffer de saída
     */
    ob_end_flush();