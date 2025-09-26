<?php
    if( !isset( $_SESSION ) ) session_start();
    ob_start(); // Inicia o buffer de saída

    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access.php');
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
    $QR = mysqli_query($conn, "SELECT CAT_NOME FROM ORC_CAT ORDER BY CAT_NOME");
    $categorias = [];
    while ($row = mysqli_fetch_array($QR)) {
        $categorias[] = $row['CAT_NOME'];
    }
    $cores = gerarCoresEscurasPHP($categorias); // Gerar cores para todas as categorias

    /**
     * Controle e Alteração das Metas Definidas
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o botão "Resetar valores" foi clicado
        if (isset($_POST['resetar'])) {
            // Atualiza a tabela ORC_CAT, atribuindo CAT_DEFAULT a CAT_PERCENTUAL
            $sql = "UPDATE ORC_CAT SET CAT_PERCENTUAL = CAT_DEFAULT";
            if ($conn->query($sql)) {
                $_SESSION[ 'msg1' ] = "Valores resetados com sucesso!";
            } else {
                $_SESSION[ 'msg2' ] = "Erro ao resetar valores: " . $conn->error;
            }
            header("Location: index.php?pg=orcamento/main");

        } else {
            // Verifica se o campo 'percentual' foi enviado
            if (isset($_POST['percentual']) && is_array($_POST['percentual'])) {
                // Processa as alterações normais (salvar)
                $totalPercentual = array_sum($_POST['percentual']);

                // Verifica se a soma ultrapassa 100%
                if ($totalPercentual > 100) {
                    $_SESSION[ 'msg2' ] = "A soma dos percentuais não pode ultrapassar 100%.";
                } else {
                    // Atualiza os percentuais no banco de dados
                    foreach ($_POST['percentual'] as $cat_id => $percentual) {
                        $cat_id = intval($cat_id);
                        $percentual = floatval($percentual);

                        $sql = "UPDATE ORC_CAT SET CAT_PERCENTUAL = ? WHERE CAT_ID = ?";
                        $stmt = $conn->prepare($sql);

                        if ($stmt === false) {
                            die("Erro ao preparar a query: " . $conn->error);
                        }

                        $stmt->bind_param("di", $percentual, $cat_id);

                        if (!$stmt->execute()) {
                            die("Erro ao executar a query: " . $stmt->error);
                        }

                        $stmt->close();
                    }

                    $_SESSION[ 'msg1' ] = "Alterações salvas com sucesso!";
                    header("Location: index.php?pg=orcamento/main");
                }
            } else {
                $_SESSION[ 'msg1' ] = "Nenhum dado foi enviado para atualização.";
                header("Location: index.php?pg=orcamento/main");
            }
        }
    }

    /**
     * Controle das Ações
     */
    if( isset(  $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar' ) {
        $ID = $_GET[ 'id' ];

        mysqli_query( $conn, "DELETE FROM ORC_MOVIMENTO WHERE MOV_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento removido com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_cat' ) {
        $ID = $_POST[ 'id' ];
        $NOME = $_POST[ 'nome' ];

        mysqli_query( $conn, "UPDATE ORC_CAT SET CAT_NOME = '$NOME' WHERE CAT_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria alterada com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=3" );
    }

    if( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'apagar_cat' ) {
        $ID = $_GET[ 'id' ];

        $QR = mysqli_query( $conn, "SELECT C.CAT_ID FROM ORC_MOVIMENTO M, ORC_CAT C WHERE C.CAT_ID = M.MOV_CAT && C.CAT_ID = $ID " );
        if( mysqli_num_rows( $QR ) > 0 ) {
            $_SESSION[ 'msg2' ] = "Esta categoria não pode ser removida, pois há movimentos associados a ela.";
            header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_err=1" );
        }

        mysqli_query( $conn, " DELETE FROM ORC_CAT WHERE CAT_ID = '$ID' ");

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria removida com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=2" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 'editar_mov' ) {
        $ID = $_POST[ 'id' ];
        $DIA = $_POST[ 'dia' ];
        $TIPO = $_POST[ 'tipo' ];
        $CAT = $_POST[ 'cat' ];
        $DESCRICAO = $_POST[ 'descricao' ];
        $VALOR = moeda( $_POST[ 'valor' ] );

        mysqli_query( $conn, " UPDATE ORC_MOVIMENTO SET MOV_DIA = '$DIA', MOV_TIPO = '$TIPO', MOV_CAT = '$CAT', MOV_DESCRICAO = '$DESCRICAO', MOV_VALOR = '$VALOR' WHERE MOV_ID = '$ID' " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento alterado com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=3" );
    }

    if( isset( $_POST[ 'acao' ] ) && $_POST[ 'acao' ] == 2) {

        $NOME = $_POST[ 'nome' ];
        mysqli_query( $conn, " INSERT INTO ORC_CAT( CAT_NOME ) values( '$NOME' ) " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Categoria cadastrada com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&cat_ok=1" );
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

        mysqli_query( $conn, " INSERT INTO ORC_MOVIMENTO( MOV_DIA, MOV_MES, MOV_ANO, MOV_TIPO, MOV_DESCRICAO, MOV_VALOR, MOV_CAT ) values( '$DIA', '$MES', '$ANO', '$TIPO', '$DESCRICAO', '$VALOR', '$CAT' ) " );

        // Verifica se ocorreu um erro e só então usa echo
        if (mysqli_error($conn)) {
            echo mysqli_error($conn);
            exit; // Para garantir que o header não será enviado após o erro
        }

        $_SESSION[ 'msg1' ] = "Movimento cadastrado com sucesso!";
        header("Location: index.php?pg=orcamento/main&mes=" . $_GET[ 'mes' ] . "&ano=" . $_GET[ 'ano' ] . "&ok=1" );
    }

    /**
     * Envia e limpa o buffer de saída
     */
    ob_end_flush();