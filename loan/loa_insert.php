<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        $EMP_FK_CLIENTE = $_POST[ 'EMP_FK_CLIENTE' ];
        $EMP_DT_FINANCIAMENTO = test_input( $_POST[ 'EMP_DT_FINANCIAMENTO' ] );
        $EMP_PARCELAS = test_input( $_POST[ 'EMP_PARCELAS' ] );
        $EMP_DT_INICIO_PGTO = test_input( $_POST[ 'EMP_DT_INICIO_PGTO' ] );
        $EMP_DT_FIM_PGTO = test_input( $_POST[ 'EMP_DT_FIM_PGTO' ] );
        $EMP_DIA_PGTO = test_input( $_POST[ 'EMP_DIA_PGTO' ] );
        $EMP_PERCENTUAL_JUROS = $_POST[ 'EMP_PERCENTUAL_JUROS' ];

        $EMP_VALOR_FINANCIADO = moeda( $_POST[ 'EMP_VALOR_FINANCIADO' ] );
        $EMP_VALOR_PARCELA = moeda( $_POST[ 'EMP_VALOR_PARCELA' ] );
        $EMP_TOTAL_JUROS = moeda( $_POST[ 'EMP_TOTAL_JUROS' ] );
        $EMP_VALOR_TOTAL = moeda( $_POST[ 'EMP_VALOR_TOTAL' ] );

        $EMP_OBS = $_POST[ 'EMP_OBS' ];
        $EMP_USER_CREATION = $_SESSION[ 'USR_ID' ];
    }

    // BUSCANDO O ID DO USUARIO, VEZ QUE APENAS VEM O NOME PELA URL
    if( $EMP_FK_CLIENTE ) {
        $SQL = mysqli_query( $CONN, " SELECT CLI_ID FROM CLI_CLIENTES WHERE CLI_NOME = '$EMP_FK_CLIENTE' ");
        $ROW = mysqli_fetch_array( $SQL );
        $EMP_FK_CLIENTE = $ROW[ 'CLI_ID' ];
      } else {
        echo " Erro ";
      }
/*
    echo '<span style="margin-left: 260px;">EMP_FK_CLIENTE:</span>&nbsp;&nbsp;' . $EMP_FK_CLIENTE . '<br />';
    echo '<span style="margin-left: 260px;">EMP_DT_FINANCIAMENTO:</span>&nbsp;&nbsp;' . $EMP_DT_FINANCIAMENTO . '<br />';
    echo '<span style="margin-left: 260px;">EMP_PARCELAS:</span>&nbsp;&nbsp;' . $EMP_PARCELAS . '<br />';
    echo '<span style="margin-left: 260px;">EMP_DT_INICIO_PGTO:</span>&nbsp;&nbsp;'. $EMP_DT_INICIO_PGTO . '<br />';
    echo '<span style="margin-left: 260px;">EMP_DT_FIM_PGTO:</span>&nbsp;&nbsp;' . $EMP_DT_FIM_PGTO . '<br />';
    echo '<span style="margin-left: 260px;">EMP_DIA_PGTO:</span>&nbsp;&nbsp;' . $EMP_DIA_PGTO . '<br />';
    echo '<span style="margin-left: 260px;">EMP_PERCENTUAL_JUROS:</span>&nbsp;&nbsp;' . $EMP_PERCENTUAL_JUROS . '<br />';
    echo '<span style="margin-left: 260px;">EMP_VALOR_FINANCIADO:</span>&nbsp;&nbsp;' . $EMP_VALOR_FINANCIADO . '<br />';
    echo '<span style="margin-left: 260px;">EMP_VALOR_PARCELA:</span>&nbsp;&nbsp;' . $EMP_VALOR_PARCELA . '<br />';
    echo '<span style="margin-left: 260px;">EMP_TOTAL_JUROS:</span>&nbsp;&nbsp;' . $EMP_TOTAL_JUROS . '<br />';
    echo '<span style="margin-left: 260px;">EMP_VALOR_TOTAL:</span>&nbsp;&nbsp;' . $EMP_VALOR_TOTAL . '<br />';
    echo '<span style="margin-left: 260px;">EMP_OBS:</span>&nbsp;&nbsp;' . $EMP_OBS . '<br />';
    echo '<span style="margin-left: 260px;">EMP_USER_CREATION:</span>&nbsp;&nbsp;' . $EMP_USER_CREATION . '<br />';
*/

    $SQL = " INSERT INTO EMP_EMPRESTIMO_MOV( EMP_FK_CLIENTE, EMP_DT_FINANCIAMENTO, EMP_DT_INICIO_PGTO, EMP_DT_FIM_PGTO, EMP_DIA_PGTO,
                                            EMP_VALOR_FINANCIADO, EMP_PARCELAS, EMP_VALOR_PARCELA, EMP_PERCENTUAL_JUROS, EMP_TOTAL_JUROS,
                                            EMP_VALOR_TOTAL, EMP_SALDO, EMP_OBS, EMP_DT_CREATION, EMP_USER_CREATION )
                            VALUES( '$EMP_FK_CLIENTE', '$EMP_DT_FINANCIAMENTO', '$EMP_DT_INICIO_PGTO', '$EMP_DT_FIM_PGTO', '$EMP_DIA_PGTO',
                                            '$EMP_VALOR_FINANCIADO', '$EMP_PARCELAS', '$EMP_VALOR_PARCELA', '$EMP_PERCENTUAL_JUROS', '$EMP_TOTAL_JUROS',
                                            '$EMP_VALOR_TOTAL', '$EMP_VALOR_TOTAL', '$EMP_OBS', NOW(), '$EMP_USER_CREATION' ) ";

    $RESULTADO = mysqli_query( $CONN, $SQL );

    if( $RESULTADO ) {
        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=loan/loa_main'; }, 0);</script>"; // 2 segundos = 2000
    } else {
        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=loan/loa_main'; }, 0);</script>";
    } mysqli_close( $CONN );
?>