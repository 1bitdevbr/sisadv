<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( isset( $_POST[ 'id' ] ) ) {
        $CLI_NOME = corrigir( $_POST[ 'CLI_NOME' ] );
        $CLI_NACIONALIDADE = corrigir( $_POST[ 'CLI_NACIONALIDADE' ] );
        $CLI_PROFISSAO = corrigir( $_POST[ 'CLI_PROFISSAO' ] );
        $CLI_DT_NASC = $_POST[ 'CLI_DT_NASC' ];
        $CLI_GENERO = corrigir( $_POST[ 'CLI_GENERO' ] );
        $CLI_EST_CIVIL = corrigir( $_POST[ 'CLI_EST_CIVIL' ] );
        $CLI_RG = $_POST[ 'CLI_RG' ];
        $CLI_ORG_EMISSOR = corrigir( $_POST[ 'CLI_ORG_EMISSOR' ] );

        if( isset( $_POST[ 'CLI_CPF' ] ) ) {
            $CLI_CPF = $_POST[ 'CLI_CPF' ];
            $CLI_CPF = preg_replace( "/[^0-9]/", "", $CLI_CPF );
        }

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
        $CLI_FK_PASTA =  $_POST[ 'CLI_FK_PASTA' ];
        $CLI_FK_STATUS = $_POST[ 'CLI_FK_STATUS' ];

        $ID = $_POST[ 'id' ];
        $CLI_USER_UPDATE = $_SESSION[ 'USR_ID' ];
    }

    $SQL = "UPDATE CLI_CLIENTES
                    SET   CLI_NOME = '$CLI_NOME', CLI_NACIONALIDADE = '$CLI_NACIONALIDADE', CLI_PROFISSAO = '$CLI_PROFISSAO', CLI_DT_NASC = '$CLI_DT_NASC', CLI_GENERO = '$CLI_GENERO', CLI_EST_CIVIL = '$CLI_EST_CIVIL', CLI_RG = '$CLI_RG', CLI_ORG_EMISSOR = '$CLI_ORG_EMISSOR',
                          CLI_CPF = '$CLI_CPF', CLI_TELEFONE = '$CLI_TELEFONE', CLI_CELULAR = '$CLI_CELULAR', CLI_EMAIL = '$CLI_EMAIL', CLI_R_SOCIAL = '$CLI_R_SOCIAL', CLI_RESP = '$CLI_RESP', CLI_CNPJ = '$CLI_CNPJ',
                          CLI_IE = '$CLI_IE', CLI_EMAIL_EMP = '$CLI_EMAIL_EMP', CLI_SITE = '$CLI_SITE', CLI_ENDERECO= '$CLI_ENDERECO', CLI_NUMERO = '$CLI_NUMERO', CLI_COMPLEMENTO = '$CLI_COMPLEMENTO',
                          CLI_BAIRRO = '$CLI_BAIRRO', CLI_CIDADE = '$CLI_CIDADE', CLI_CEP = '$CLI_CEP', CLI_UF = '$CLI_UF', CLI_OBS = '$CLI_OBS', CLI_FK_PASTA = '$CLI_FK_PASTA',
                          CLI_DT_UPDATE = NOW(), CLI_USER_UPDATE = $CLI_USER_UPDATE, CLI_FK_STATUS = '$CLI_FK_STATUS'
                  WHERE CLI_ID = $ID ";

    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro atualizado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_search'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Nenhum registro editado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_editar&id=$ID'; }, 0);</script>";
    } mysqli_close( $CONN );
?>