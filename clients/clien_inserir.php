<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

        $CLI_NOME = corrigir( $_POST[ 'CLI_NOME' ] );
        $CLI_NACIONALIDADE = corrigir( $_POST[ 'CLI_NACIONALIDADE' ] );
        $CLI_PROFISSAO = corrigir( $_POST[ 'CLI_PROFISSAO' ] );
        $CLI_DT_NASC = $_POST[ 'CLI_DT_NASC' ];
        $CLI_GENERO = corrigir( $_POST[ 'CLI_GENERO' ] );
        $CLI_EST_CIVIL = corrigir( $_POST[ 'CLI_EST_CIVIL' ] );
        $CLI_RG = $_POST[ 'CLI_RG' ];
        $CLI_ORG_EMISSOR = corrigir( $_POST[ 'CLI_ORG_EMISSOR' ] );

        if( isset( $_POST[ 'CLI_TELEFONE' ] ) ) {
            $CLI_TELEFONE = $_POST[ 'CLI_TELEFONE' ];
            $CLI_TELEFONE = preg_replace( "/[^0-9]/", "", $CLI_TELEFONE );
        }
        if( isset( $_POST[ 'CLI_CELULAR' ] ) ) {
            $CLI_CELULAR = $_POST[ 'CLI_CELULAR' ];
            $CLI_CELULAR = preg_replace( "/[^0-9]/", "", $CLI_CELULAR );
        }
        $CLI_EMAIL = strtolower( trim( $_POST[ 'CLI_EMAIL' ] ) );
        $CLI_R_SOCIAL = corrigir( $_POST[ 'CLI_R_SOCIAL' ] );
        $CLI_RESP = corrigir( $_POST[ 'CLI_RESP' ] );

        if( isset( $_POST[ 'CLI_CNPJ' ] ) ) {
            $CLI_CNPJ = $_POST[ 'CLI_CNPJ' ];
            $CLI_CNPJ = preg_replace( "/[^0-9]/", "", $CLI_CNPJ );
        }
        if( isset( $_POST[ 'CLI_IE' ] ) ) {
            $CLI_IE = $_POST[ 'CLI_IE' ];
            $CLI_IE = preg_replace( "/[^0-9]/", "", $CLI_IE );
        }
        $CLI_EMAIL_EMP = strtolower( trim( $_POST[ 'CLI_EMAIL_EMP' ] ) );
        $CLI_SITE = strtolower( trim( $_POST[ 'CLI_SITE' ] ) );
        $CLI_ENDERECO = corrigir( $_POST[ 'CLI_ENDERECO' ] );
        $CLI_NUMERO = $_POST[ 'CLI_NUMERO' ];
        $CLI_COMPLEMENTO = corrigir( $_POST[ 'CLI_COMPLEMENTO' ] );
        $CLI_BAIRRO = corrigir( $_POST[ 'CLI_BAIRRO' ] );
        $CLI_CIDADE = corrigir( $_POST[ 'CLI_CIDADE' ] );

        if( isset( $_POST[ 'CLI_CEP' ] ) ) {
            $CLI_CEP = $_POST[ 'CLI_CEP' ];
            $CLI_CEP = preg_replace( "/[^0-9]/", "", $CLI_CEP );
        }
        $CLI_UF = corrigir( $_POST[ 'CLI_UF' ] );
        $CLI_OBS = corrigir( $_POST[ 'CLI_OBS' ] );
        $CLI_FK_PASTA = $_POST[ 'CLI_FK_PASTA' ];
        $CLI_FK_STATUS = $_POST[ 'CLI_FK_STATUS' ];

        $CLI_USER_CREATION = $_SESSION[ 'USR_ID' ];

        // TRATAMENTO DO CPF (FORMATAÇÃO, VERIFICAÇÃO E VALIDAÇÃO)
        if( isset( $_POST[ 'CLI_CPF' ] ) ) {

            $CLI_CPF = $_POST[ 'CLI_CPF' ];
            $CLI_CPF = preg_replace( '/[^0-9]/is', '', $CLI_CPF );  // Extrai somente os números
            if( strlen( $CLI_CPF ) != 11 ) { $_SESSION[ 'msg2' ] = "Erro: CPF necessita de 11 dígitos!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_cadastro'; }, 0);</script>"; return false; } // Verifica se foi informado todos os digitos corretamente
            if( preg_match( '/(\d)\1{10}/' , $CLI_CPF ) ) { $_SESSION[ 'msg2' ] = "Erro: CPF necessita de sequência válida de dígitos!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_cadastro'; }, 0);</script>"; return false; } // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            for( $t = 9; $t < 11; $t++ ) {  // Faz o calculo para validar o CPF
                for( $d = 0, $c = 0; $c < $t; $c++ ) { $d += $CLI_CPF[ $c ] * ( ( $t + 1 ) - $c ); } $d = ( ( 10 * $d ) % 11 ) % 10;
                if( $CLI_CPF[ $c ] != $d ) { $_SESSION[ 'msg2' ] = "Erro: CPF inválido!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_cadastro'; }, 0);</script>"; return false; }
            }

            // VER SE O CLIENTE JÁ EXISTE NA BASE DE DADOS E GRAVAR REGISTRO
            $SQL = $CONN->query( " SELECT * FROM CLI_CLIENTES WHERE CLI_CPF = '$CLI_CPF' " );

            if( mysqli_num_rows( $SQL ) > 0 ) {

                $_SESSION[ 'msg2' ] = "Erro: Cliente já cadastrado!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search'; }, 0);</script>";

            } else {

                $SQL = " INSERT INTO CLI_CLIENTES( CLI_NOME, CLI_NACIONALIDADE, CLI_PROFISSAO, CLI_DT_NASC, CLI_GENERO, CLI_EST_CIVIL, CLI_RG, CLI_ORG_EMISSOR, CLI_CPF, CLI_TELEFONE, CLI_CELULAR, CLI_EMAIL, CLI_FK_PASTA,
                                                        CLI_R_SOCIAL, CLI_RESP, CLI_CNPJ, CLI_IE, CLI_EMAIL_EMP, CLI_SITE, CLI_ENDERECO, CLI_NUMERO, CLI_COMPLEMENTO, CLI_BAIRRO, CLI_CIDADE, CLI_CEP, CLI_UF,
                                                        CLI_OBS, CLI_DT_CREATION, CLI_USER_CREATION, CLI_FK_STATUS )
                                        VALUES( '$CLI_NOME', '$CLI_NACIONALIDADE', '$CLI_PROFISSAO', '$CLI_DT_NASC', '$CLI_GENERO', '$CLI_EST_CIVIL', '$CLI_RG', '$CLI_ORG_EMISSOR', '$CLI_CPF', '$CLI_TELEFONE', '$CLI_CELULAR', '$CLI_EMAIL', '$CLI_FK_PASTA',
                                                        '$CLI_R_SOCIAL', '$CLI_RESP', '$CLI_CNPJ', '$CLI_IE', '$CLI_EMAIL_EMP', '$CLI_SITE', '$CLI_ENDERECO', '$CLI_NUMERO', '$CLI_COMPLEMENTO', '$CLI_BAIRRO', '$CLI_CIDADE',
                                                        '$CLI_CEP', '$CLI_UF', '$CLI_OBS', NOW(), $CLI_USER_CREATION, '$CLI_FK_STATUS' )";

                $RESULTADO = mysqli_query( $CONN, $SQL );

                if( $RESULTADO ) {

                    $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search'; }, 0);</script>";

                } else {

                    $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_cadastro'; }, 0);</script>";
                    return false;

                } mysqli_close( $CONN );

            }

        }
        // TRATAMENTO DO CPF (FORMATAÇÃO, VERIFICAÇÃO E VALIDAÇÃO)
    }
?>