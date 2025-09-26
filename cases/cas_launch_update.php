<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

    if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

        //-- DADOS GERAIS --//
        $PPR_FK_PROCESSO = $_POST[ 'id' ];
        $PPR_FK_CLIENTE = $_POST[ 'PPR_FK_CLIENTE' ];
        $PPR_MENSALISTA = $_POST[ 'PPR_MENSALISTA' ];
        $PPR_USER_UPDATE = $_SESSION[ 'USR_ID' ];

        //-- DADOS DE PAGAMENTO --//
        $PPP_NR_PARCELA = $_POST[ 'PPP_NR_PARCELA' ];
        $PPR_DT_PGTO = test_input( $_POST[ 'PPR_DT_PGTO' ] );
        $PPR_VALOR = moeda( $_POST[ 'PPR_VALOR' ] );

        // debugVW( $_POST );

        if( $PPR_MENSALISTA == 1 ) {

            //---========================================================================================================---//
            //---=== CONTRATOS MENSALISTAS === VERIFICA SE É A ÚLTIMA PARCELA ==========================================---//
            //---========================================================================================================---//
            if( $PPR_MENSALISTA == 1 && isset( $_POST[ 'PARCELA_FIM' ] ) ) {

                $PARCELA_FIM = $_POST[ 'PARCELA_FIM' ];

                if( $PARCELA_FIM == 1 ) {

                    //-- 01. // VERIFICA O SALDO NA TABELA PPP_PROC_PROCESSOS E O VALOR DO CONTRATO PARA A CRIAÇÃO DE NOVA PARCELA DA TABELA ABAIXO --//
                    $SQL = mysqli_query( $CONN, " SELECT PPR_VALOR, PPR_SALDO
                                                    FROM PPR_PROC_PROCESSOS
                                                   WHERE PPR_ID = '$PPR_FK_PROCESSO'
                                                " );
                    $ROW = mysqli_fetch_array( $SQL );
                    $VLR_CONTRATO = $ROW[ 'PPR_VALOR' ];

                    if( $ROW[ 'PPR_SALDO' ] ) {
                        $SALDO = $ROW[ 'PPR_SALDO' ];
                        $NOVO_SALDO = $SALDO - $PPR_VALOR;
                        if( $NOVO_SALDO == 0.00 ) {
                            $PPR_FK_STATUS = 2;
                            $PPR_FK_HONORARIOS = 1;
                            $PPP_STATUS = 0;
                        } else {
                            $PPR_FK_STATUS = 1;
                            $PPR_FK_HONORARIOS = 2;
                            $PPP_STATUS = 0; // STATUS DA PARCELA
                        }
                    } else {
                        echo mysqli_error( $CONN );
                    }

                    //-- 02. // ATUALIZA OS DADOS GERAIS NA TABELA  PPP_PROC_PROCESSOS_PGTO --//
                    mysqli_query( $CONN, " UPDATE PPP_PROC_PROCESSOS_PGTO
                                              SET PPP_STATUS = '$PPP_STATUS',
                                                  PPP_DT_PGTO = '$PPR_DT_PGTO',
                                                  PPP_VLR_PAGO = '$PPR_VALOR'
                                            WHERE PPP_FK_PROCESSO = '$PPR_FK_PROCESSO'
                                              AND PPP_NR_PARCELA = '$PPP_NR_PARCELA'
                                         " );
                    echo mysqli_error( $CONN );

                    //-- 03. // ATUALIZA O SALDO E OUTROS STATUS NA TABELA  PPP_PROC_PROCESSOS --//
                    $SQL = " UPDATE PPR_PROC_PROCESSOS
                                SET PPR_FK_HONORARIOS = '$PPR_FK_HONORARIOS',
                                    PPR_FK_STATUS = '$PPR_FK_STATUS',
                                    PPR_VALOR_PAGO = '$PPR_VALOR',
                                    PPR_SALDO = '$NOVO_SALDO',
                                    PPR_DT_UPDATE = NOW(),
                                    PPR_USER_UPDATE = '$PPR_USER_UPDATE'
                              WHERE PPR_ID = '$PPR_FK_PROCESSO'
                                AND PPR_FK_CLIENTE = '$PPR_FK_CLIENTE'
                           ";

                    $RESULTADO = mysqli_query( $CONN, $SQL );

                    //-- 04. // ENCERRA A ATUALIZAÇÃO E REDIRECIONA O USUÁRIO --//
                    if( $RESULTADO ) {
                        $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
                        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
                    } else {
                        $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
                        echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
                    } mysqli_close( $CONN );

                }

            } else {

                //---========================================================================================================---//
                //---=== CONTRATOS MENSALISTAS === VERIFICA SE É PAGAMENTO RECORRENTE ===================================---//
                //---========================================================================================================---//

                //-- 01. // ALTERA PARA STATUS DE PAGO --//
                $PPP_STATUS = 0; // STATUS DA PARCELA

                //-- 02. // ATUALIZA OS DADOS GERAIS NA TABELA  PPP_PROC_PROCESSOS_PGTO --//
                mysqli_query( $CONN, " UPDATE PPP_PROC_PROCESSOS_PGTO
                                          SET PPP_STATUS = '$PPP_STATUS',
                                              PPP_DT_PGTO = '$PPR_DT_PGTO',
                                              PPP_VLR_PAGO = '$PPR_VALOR'
                                        WHERE PPP_FK_PROCESSO = '$PPR_FK_PROCESSO'
                                          AND PPP_NR_PARCELA = '$PPP_NR_PARCELA'
                                     " );
                echo mysqli_error( $CONN );

                //-- 03. // CONSULTANDO DATA DE VENCIMENTO --//
                $SQL = mysqli_query( $CONN, " SELECT PPP_DT_VENCIMENTO
                                                FROM PPP_PROC_PROCESSOS_PGTO
                                               WHERE PPP_FK_PROCESSO = '$PPR_FK_PROCESSO'
                                            ORDER BY PPP_DT_VENCIMENTO DESC
                                               LIMIT 1
                                            " );
                $ROW = mysqli_fetch_array( $SQL );
                $PPP_DT_VENCIMENTO = $ROW[ 'PPP_DT_VENCIMENTO' ];

                //-- 04. // VERIFICA O SALDO NA TABELA PPP_PROC_PROCESSOS --//
                $SQL = mysqli_query( $CONN, " SELECT PPR_VALOR
                                                FROM PPR_PROC_PROCESSOS
                                               WHERE PPR_ID = '$PPR_FK_PROCESSO'
                                            " );
                $ROW = mysqli_fetch_array( $SQL );
                $VLR_CONTRATO = $ROW[ 'PPR_VALOR' ];

                //-- 05. // CRIA NOVA PARCELA RECORRENTE --//
                $PPP_FK_PROCESSO = $PPR_FK_PROCESSO;
                $PPP_STATUS = 1;
                $PPP_NR_PARCELA++;
                $PPP_DT_VENCIMENTO = date( 'Y-m-d', strtotime( "+1 month", strtotime( $PPP_DT_VENCIMENTO ) ) );
                $PPP_VALOR = $VLR_CONTRATO;

                $SQL = " INSERT INTO PPP_PROC_PROCESSOS_PGTO( PPP_FK_PROCESSO, PPP_STATUS, PPP_NR_PARCELA, PPP_DT_VENCIMENTO, PPP_VALOR )
                              VALUES ( '$PPP_FK_PROCESSO', '$PPP_STATUS', '$PPP_NR_PARCELA', '$PPP_DT_VENCIMENTO', '$PPP_VALOR' )
                       ";

                $RESULTADO = mysqli_query( $CONN, $SQL );

                //-- 06. // ENCERRA A ATUALIZAÇÃO E REDIRECIONA O USUÁRIO --//
                if( $RESULTADO ) {
                    $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
                } else {
                    $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
                    echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
                } mysqli_close( $CONN );

            }

        } else {

            //---========================================================================================================---//
            //---=== CONTRATOS COM PRAZO DETERMINADO ================================================================---//
            //---========================================================================================================---//

            //-- 01. // VERIFICA O SALDO NA TABELA PPP_PROC_PROCESSOS E O VALOR DO CONTRATO PARA A CRIAÇÃO DE NOVA PARCELA DA TABELA ABAIXO --//
            $SQL = mysqli_query( $CONN, " SELECT PPR_VALOR, PPR_SALDO
                                            FROM PPR_PROC_PROCESSOS
                                           WHERE PPR_ID = '$PPR_FK_PROCESSO'
                                        " );
            $ROW = mysqli_fetch_array( $SQL );
            $VLR_CONTRATO = $ROW[ 'PPR_VALOR' ];

            if( $ROW[ 'PPR_SALDO' ] ) {
                $SALDO = $ROW[ 'PPR_SALDO' ];
                $NOVO_SALDO = $SALDO - $PPR_VALOR;
                if( $NOVO_SALDO == 0.00 ) {
                    $PPR_FK_STATUS = 2;
                    $PPR_FK_HONORARIOS = 1;
                    $PPP_STATUS = 0;
                } else {
                    $PPR_FK_STATUS = 1;
                    $PPR_FK_HONORARIOS = 2;
                    $PPP_STATUS = 0; // STATUS DA PARCELA
                }
            } else {
                echo mysqli_error( $CONN );
            }

            //-- 02. // ATUALIZA OS DADOS GERAIS NA TABELA  PPP_PROC_PROCESSOS_PGTO --//
            mysqli_query( $CONN, " UPDATE PPP_PROC_PROCESSOS_PGTO
                                      SET PPP_STATUS = '$PPP_STATUS',
                                          PPP_DT_PGTO = '$PPR_DT_PGTO',
                                          PPP_VLR_PAGO = '$PPR_VALOR'
                                    WHERE PPP_FK_PROCESSO = '$PPR_FK_PROCESSO'
                                      AND PPP_NR_PARCELA = '$PPP_NR_PARCELA'
                                 " );
            echo mysqli_error( $CONN );

            //-- 03. // ATUALIZA O SALDO E OUTROS STATUS NA TABELA  PPP_PROC_PROCESSOS --//
            $SQL = " UPDATE PPR_PROC_PROCESSOS
                        SET PPR_FK_HONORARIOS = '$PPR_FK_HONORARIOS',
                            PPR_FK_STATUS = '$PPR_FK_STATUS',
                            PPR_VALOR_PAGO = '$PPR_VALOR',
                            PPR_SALDO = '$NOVO_SALDO',
                            PPR_DT_UPDATE = NOW(),
                            PPR_USER_UPDATE = '$PPR_USER_UPDATE'
                      WHERE PPR_ID = '$PPR_FK_PROCESSO'
                        AND PPR_FK_CLIENTE = '$PPR_FK_CLIENTE'
                   ";

            $RESULTADO = mysqli_query( $CONN, $SQL );

            //-- 04. // ENCERRA A ATUALIZAÇÃO E REDIRECIONA O USUÁRIO --//
            if( $RESULTADO ) {
                $_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
                echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
            } else {
                $_SESSION[ 'msg2' ] = "Erro: Registro não cadastrado!";
                echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$PPR_FK_PROCESSO'; }, 0);</script>";
            }

        }

        //-- 05. // REGISTRA O PAGAMENTO NO LIVRO CAIXA --//

        //-- DADOS DO CONTRATO PARA REGISTRO --//
        $PPR_CLI_NOME = $_POST[ 'CLI_NOME' ];
        $PPR_NUM_PROCESSO = $_POST[ 'PPR_NUM_PROCESSO' ];
        $PPP_NR_PARCELA = $_POST[ 'PPP_NR_PARCELA' ];
        $PPR_QTD_PARCELA = $_POST[ 'PPR_QTD_PARCELA' ];

        $T = explode("-", $PPR_DT_PGTO);
        $DIA = $T[2];
        $MES = $T[1];
        $ANO = $T[0];

        $TIPO = 1; // ENTRADA: 1, SAÍDA: 0.
        $CAT  = 1; // PADRÃO DE SISTEMA: 1.

        // DESCRIÇÃO NO PADRÃO: NOME DO CLIENTE - PROC. #######-##.####.#.##.#### - PARC. 01/10 - SALDO: R$ XXX,XX.
        $LCM_DESCRICAO = $PPR_CLI_NOME . ' - PROC. ' . processNumber( "#######-##.####.#.##.####" , $PPR_NUM_PROCESSO )
                                       . ' - PARC. ' . $PPP_NR_PARCELA . '/' . $PPR_QTD_PARCELA . '. <small style="color: rgb( 252, 200, 47 );">[LANÇAMENTO AUTOMÁTICO]</small>';

        mysqli_query( $CONN, " INSERT INTO LCM_LC_MOVIMENTO( LCM_DIA, LCM_MES, LCM_ANO, LCM_TIPO, LCM_DESCRICAO, LCM_VALOR, LCM_CAT ) values( '$DIA', '$MES', '$ANO', '$TIPO', '$LCM_DESCRICAO', '$PPR_VALOR', '$CAT' ) " );

        //-- Verifica se ocorreu um erro e só então usa echo --//
        if (mysqli_error($CONN)) {
            echo mysqli_error($CONN);
            exit; // Para garantir que o header não será enviado após o erro
        }

        //-- 06. // ENCERRA CONEXÃO COM O BANCO DE DADOS --//
        mysqli_close( $CONN );

    }
?>