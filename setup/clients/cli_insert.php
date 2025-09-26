<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 4;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

        $CLI_FK_STATUS = $_POST[ 'CLI_FK_STATUS' ];
        $CLI_OFFICE = corrigir( $_POST[ 'CLI_OFFICE' ] );
        $CLI_CLIENT = corrigir( $_POST[ 'CLI_CLIENT' ] );
        $CLI_DT_NASC = $_POST[ 'CLI_DT_NASC' ];
        $CLI_GENDER = corrigir( $_POST[ 'CLI_GENDER' ] );
        $CLI_MARITALSTATUS = corrigir( $_POST[ 'CLI_MARITALSTATUS' ] );
        $CLI_EMAIL = strtolower( trim( $_POST[ 'CLI_EMAIL' ] ) );
        $CLI_OAB = trim( $_POST[ 'CLI_OAB' ] );

        if( isset( $_POST[ 'CLI_PHONE' ] ) ) {
            $CLI_PHONE = $_POST[ 'CLI_PHONE' ];
            $CLI_PHONE = preg_replace( "/[^0-9]/", "", $CLI_PHONE );
        }
        if( isset( $_POST[ 'CLI_CELLPHONE' ] ) ) {
            $CLI_CELLPHONE = $_POST[ 'CLI_CELLPHONE' ];
            $CLI_CELLPHONE = preg_replace( "/[^0-9]/", "", $CLI_CELLPHONE );
        }

        $CLI_ADDRESS = corrigir( $_POST[ 'CLI_ADDRESS' ] );
        $CLI_NUMBER = $_POST[ 'CLI_NUMBER' ];
        $CLI_COMPLEMENT = corrigir( $_POST[ 'CLI_COMPLEMENT' ] );
        $CLI_NEIGHBORHOOD = corrigir( $_POST[ 'CLI_NEIGHBORHOOD' ] );
        $CLI_CITY = corrigir( $_POST[ 'CLI_CITY' ] );

        if( isset( $_POST[ 'CLI_ZIPCODE' ] ) ) {
            $CLI_ZIPCODE = $_POST[ 'CLI_ZIPCODE' ];
            $CLI_ZIPCODE = preg_replace( "/[^0-9]/", "", $CLI_ZIPCODE );
        }
        $CLI_STATE = corrigir( $_POST[ 'CLI_STATE' ] );
        $CLI_OBS = corrigir( $_POST[ 'CLI_OBS' ] );

        $CLI_USER_CREATION = $_SESSION[ 'USR_ID' ];

        // TRATAMENTO DO CPF (FORMATAÇÃO, VERIFICAÇÃO E VALIDAÇÃO)
        if( isset( $_POST[ 'CLI_CPF' ] ) ) {

            $CLI_CPF = $_POST[ 'CLI_CPF' ];
            $CLI_CPF = preg_replace( '/[^0-9]/is', '', $CLI_CPF );  // Extrai somente os números
            if( strlen( $CLI_CPF ) != 11 ) { $_SESSION[ 'msg2' ] = "Erro: CPF necessita de 11 dígitos!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_register'; }, 0);</script>"; return false; } // Verifica se foi informado todos os digitos corretamente
            if( preg_match( '/(\d)\1{10}/' , $CLI_CPF ) ) { $_SESSION[ 'msg2' ] = "Erro: CPF necessita de sequência válida de dígitos!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_register'; }, 0);</script>"; return false; } // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            for( $t = 9; $t < 11; $t++ ) {  // Faz o calculo para validar o CPF
                for( $d = 0, $c = 0; $c < $t; $c++ ) { $d += $CLI_CPF[ $c ] * ( ( $t + 1 ) - $c ); } $d = ( ( 10 * $d ) % 11 ) % 10;
                if( $CLI_CPF[ $c ] != $d ) { $_SESSION[ 'msg2' ] = "Erro: CPF inválido!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_register'; }, 0);</script>"; return false; }
            }

            // VER SE O CLIENTE JÁ EXISTE NA BASE DE DADOS E GRAVAR REGISTRO
            $SQL = $CONN1->query( " SELECT * FROM SYS_CLIENTS WHERE CLI_CPF = '$CLI_CPF' " );

            if( mysqli_num_rows( $SQL ) > 0 ) {

                $_SESSION[ 'msg2' ] = "Erro: Cliente já cadastrado!"; echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_main'; }, 0);</script>";

            } else {

                $SQL = " INSERT INTO SYS_CLIENTS( CLI_OFFICE, CLI_CLIENT, CLI_DT_NASC, CLI_GENDER, CLI_MARITALSTATUS, CLI_EMAIL, CLI_CPF, CLI_OAB,
                                                  CLI_ADDRESS, CLI_NUMBER, CLI_COMPLEMENT, CLI_NEIGHBORHOOD, CLI_CITY, CLI_STATE, CLI_ZIPCODE,
                                                  CLI_PHONE, CLI_CELLPHONE, CLI_OBS, CLI_FK_STATUS, CLI_DT_CREATION, CLI_USER_CREATION )
                                         VALUES( '$CLI_OFFICE', '$CLI_CLIENT', '$CLI_DT_NASC', '$CLI_GENDER', '$CLI_MARITALSTATUS', '$CLI_EMAIL', '$CLI_CPF', '$CLI_OAB',
                                                 '$CLI_ADDRESS', '$CLI_NUMBER', '$CLI_COMPLEMENT', '$CLI_NEIGHBORHOOD', '$CLI_CITY', '$CLI_STATE', '$CLI_ZIPCODE',
                                                 '$CLI_PHONE', '$CLI_CELLPHONE', '$CLI_OBS', '$CLI_FK_STATUS', NOW(), $CLI_USER_CREATION )";

                $RESULTADO = mysqli_query( $CONN1, $SQL );

                if( $RESULTADO ) {

                    $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_main'; }, 0);</script>";

                } else {

                    $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_register'; }, 0);</script>";
                    return false;

                } mysqli_close( $CONN1 );
            }
        }
    }
?>