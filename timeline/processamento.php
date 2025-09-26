<?php
    //$FOLDER = '../img/img_produto/';
    //$IMG = glob("$FOLDER{*.jpg,png,jpeg}", GLOB_BRACE);
    //$defaults = array('{SRC_IMG}', '{NOME_PROD}', '{DESCRICAO}', '{PRECO}', '{ID}');

    function montaDivs($DATA) {
        $PHP = file_get_contents('tml_main.php'); // php criado anteriormente
        return str_replace(array_keys($DATA), array_values($DATA), $PHP);
    }
    $SQL = " SELECT CLI.CLI_ID, CLI.CLI_NOME, CLI.CLI_DT_CREATION, CLI.CLI_USER_CREATION, CLI.CLI_FK_STATUS,
                                 NTE.NOT_NOTE, NTE.NOT_DT_CREATION, NTE.NOT_USER_CREATION,
                                 DEV.DEV_DATE, DEV.DEV_DESCRIPTION, DEV.DEV_DT_CREATION, DEV.DEV_USER_CREATION,
                                 PPR.PPR_PARTE_CONTRARIA, PPR.PPR_TIPO_ACAO, PPR.PPR_NUM_PROCESSO, PPR.PPR_DT_CREATION, PPR.PPR_USER_CREATION,
                                 EMP.EMP_DT_FINANCIAMENTO, EMP.EMP_VALOR_FINANCIADO, EMP.EMP_DT_INICIO_PGTO, EMP.EMP_DT_FIM_PGTO, EMP.EMP_DT_CREATION, EMP.EMP_USER_CREATION,
                                 PAS.PAS_NOME
                     FROM CLI_CLIENTES CLI
             LEFT JOIN NOT_NOTES NTE ON NTE.NOT_FK_CLIENT = CLI.CLI_ID
             LEFT JOIN DEV_CALC_MOV DEV ON DEV.DEV_FK_CLIENT = CLI.CLI_ID
             LEFT JOIN PPR_PROC_PROCESSOS PPR ON PPR.PPR_FK_CLIENTE = CLI.CLI_ID
             LEFT JOIN EMP_EMPRESTIMO_MOV EMP ON EMP.EMP_FK_CLIENTE = CLI.CLI_ID
             LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                 WHERE CLI.CLI_ID = '$ID'
            ORDER By CLI.CLI_DT_CREATION DESC,
                               NOT_DT_CREATION DESC,
                               DEV_DT_CREATION DESC,
                               PPR_DT_CREATION DESC,
                               EMP_DT_CREATION DESC
                 ";
    $RESULT = mysqli_query($CONN, $SQL);
    while ($ROW = mysqli_fetch_assoc($RESULT)) {
        //$SET['{SRC_IMG}'] = $FOLDER . $ROW['Img_produto'];
        $SET['{CLI_ID}'] = $ROW['CLI_ID'];
        $SET['{CLI_NOME}'] = $ROW['CLI_NOME'];
        $SET['{CLI_DT_CREATION}'] = $ROW['CLI_DT_CREATION'];
        $SET['{CLI_FK_STATUS}'] = $ROW['CLI_FK_STATUS'];
        $SET['{NOT_NOTE}'] = $ROW['NOT_NOTE'];
        $SET['{NOT_DT_CREATION}'] = $ROW['NOT_DT_CREATION'];
        $SET['{NOT_USER_CREATION}'] = $ROW['NOT_USER_CREATION'];
        $SET['{DEV_DATE}'] = $ROW['DEV_DATE'];
        $SET['{DEV_DESCRIPTION}'] = $ROW['DEV_DESCRIPTION'];
        $SET['{DEV_DT_CREATION}'] = $ROW['DEV_DT_CREATION'];
        $SET['{DEV_USER_CREATION}'] = $ROW['DEV_USER_CREATION'];
        $SET['{PPR_PARTE_CONTRARIA}'] = $ROW['PPR_PARTE_CONTRARIA'];
        $SET['{PPR_TIPO_ACAO}'] = $ROW['PPR_TIPO_ACAO'];
        $SET['{PPR_NUM_PROCESSO}'] = $ROW['PPR_NUM_PROCESSO'];
        $SET['{PPR_DT_CREATION}'] = $ROW['PPR_DT_CREATION'];
        $SET['{PPR_USER_CREATION}'] = $ROW['PPR_USER_CREATION'];
        $SET['{EMP_DT_FINANCIAMENTO}'] = $ROW['EMP_DT_FINANCIAMENTO'];
        $SET['{EMP_VALOR_FINANCIADO}'] = $ROW['EMP_VALOR_FINANCIADO'];
        $SET['{EMP_DT_INICIO_PGTO}'] = $ROW['EMP_DT_INICIO_PGTO'];
        $SET['{EMP_DT_FIM_PGTO}'] = $ROW['EMP_DT_FIM_PGTO'];
        $SET['{EMP_DT_CREATION}'] = $ROW['EMP_DT_CREATION'];
        $SET['{EMP_USER_CREATION}'] = $ROW['EMP_USER_CREATION'];
        $SET['{PAS_NOME}'] = $ROW['PAS_NOME'];
        echo montaDivs($SET);
    }
?>