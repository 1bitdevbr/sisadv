<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 4;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../dist/func/functions.php');

    if( isset( $_POST[ 'id' ] ) ) {

        $CLI_FK_STATUS = $_POST[ 'CLI_FK_STATUS' ];
        $CLI_OFFICE = corrigir( $_POST[ 'CLI_OFFICE' ] );
        $CLI_CLIENT = corrigir( $_POST[ 'CLI_CLIENT' ] );
        $CLI_DT_NASC = $_POST[ 'CLI_DT_NASC' ];
        $CLI_GENDER = corrigir( $_POST[ 'CLI_GENDER' ] );
        $CLI_MARITALSTATUS = corrigir( $_POST[ 'CLI_MARITALSTATUS' ] );
        $CLI_EMAIL = strtolower( trim( $_POST[ 'CLI_EMAIL' ] ) );
        $CLI_CPF = $_POST[ 'CLI_CPF' ];
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

        $ID = $_POST[ 'id' ];
        $CLI_USER_UPDATE = $_SESSION[ 'USR_ID' ];
    }

    $SQL = " UPDATE SYS_CLIENTS
                           SET CLI_OFFICE = '$CLI_OFFICE', CLI_CLIENT = '$CLI_CLIENT', CLI_DT_NASC = '$CLI_DT_NASC', CLI_GENDER = '$CLI_GENDER',
                                  CLI_MARITALSTATUS = '$CLI_MARITALSTATUS', CLI_EMAIL = '$CLI_EMAIL', CLI_CPF = '$CLI_CPF', CLI_OAB = '$CLI_OAB',
                                  CLI_PHONE = '$CLI_PHONE', CLI_CELLPHONE = '$CLI_CELLPHONE', CLI_ADDRESS= '$CLI_ADDRESS', CLI_NUMBER = '$CLI_NUMBER',
                                  CLI_COMPLEMENT = '$CLI_COMPLEMENT', CLI_NEIGHBORHOOD = '$CLI_NEIGHBORHOOD', CLI_CITY = '$CLI_CITY', CLI_ZIPCODE = '$CLI_ZIPCODE',
                                  CLI_STATE = '$CLI_STATE', CLI_OBS = '$CLI_OBS', CLI_FK_STATUS = '$CLI_FK_STATUS', CLI_DT_UPDATE = NOW(), CLI_USER_UPDATE = $CLI_USER_UPDATE
                    WHERE CLI_ID = '$ID' ";

    $RESULTADO = mysqli_query( $CONN1, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro atualizado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_main'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Nenhum registro editado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=setup/clients/cli_edit&id=$ID'; }, 0);</script>";
    } mysqli_close( $CONN1 );
?>