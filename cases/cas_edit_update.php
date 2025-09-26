<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../dist/func/functions.php');

	if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

		if( $_POST[ 'PPR_FK_DEFENSORIA' ] == 1 ) {

			//<!-- PROCESSOS EM GERAL -->//
			$PPR_CASO              = number( $_POST[ 'PPR_CASO' ] );
			$PPR_FK_STATUS         = $_POST[ 'PPR_FK_STATUS' ];
			$PPR_FK_HONORARIOS     = $_POST[ 'PPR_FK_HONORARIOS' ];
			$PPR_FK_DEFENSORIA     = $_POST[ 'PPR_FK_DEFENSORIA' ];
			$PPR_FK_PASTA          = $_POST[ 'PPR_FK_PASTA' ];
			$PPR_FK_CLIENTE        = $_POST[ 'PPR_FK_CLIENTE' ];
			$PPR_PARTE_CONTRARIA   = corrigir( $_POST[ 'PPR_PARTE_CONTRARIA' ] );
			$PPR_NUM_PROCESSO      = number( $_POST[ 'PPR_NUM_PROCESSO' ] );
			$PPR_COMARCA           = corrigir( $_POST[ 'PPR_COMARCA' ] );
			$PPR_FK_NATUREZA       = $_POST[ 'PPR_FK_NATUREZA' ];
			$PPR_FK_MEIO           = $_POST[ 'PPR_FK_MEIO' ];
			$PPR_TIPO_ACAO         = corrigir( $_POST[ 'PPR_TIPO_ACAO' ] );

			//<!-- INFORMAÇÕES DO CONVÊNIO DPE-OAB/SP -->//
			$PPR_FK_COD_ACAO       = $_POST[ 'PPR_FK_COD_ACAO' ];
			$PPR_DT_NOMEACAO       = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_NOMEACAO' ])));
			$PPR_DT_PUB_SENTENCA   = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_PUB_SENTENCA' ])));
			$PPR_DT_TRANS_JULGADO  = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_TRANS_JULGADO' ])));
			$PPR_DT_ENVIO_CERTIDAO = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_ENVIO_CERTIDAO' ])));
			$PPR_DT_RECEBIMENTO    = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_RECEBIMENTO' ])));
			$PPR_FK_PERCENTUAL     = $_POST[ 'PPR_FK_PERCENTUAL' ];
			$PPR_VALOR_TABELA      = moeda( $_POST[ 'PPR_VALOR_TABELA' ] );
			$PPR_FK_INSS           = $_POST[ 'PPR_FK_INSS' ];

			//<!-- OBSERVAÇÕES -->//
			$PPR_OBS 			   = corrigir( $_POST[ 'PPR_OBS' ] );

			//<!-- SESSION -->//
			$PPR_USER_UPDATE 	   = $_SESSION[ 'USR_ID' ];
			$id  			       = $_POST[ 'id' ];
            // $id                    = mysqli_real_escape_string($CONN, $_POST['id']);

			//<!-- ATUALIZANDO AS INFORMAÇÕES -->//
			$SQL 				   = " UPDATE PPR_PROC_PROCESSOS
			                              SET PPR_CASO = '$PPR_CASO', PPR_FK_STATUS = '$PPR_FK_STATUS',
                                              PPR_FK_HONORARIOS = '$PPR_FK_HONORARIOS', PPR_FK_DEFENSORIA = '$PPR_FK_DEFENSORIA',
                                              PPR_FK_PASTA = '$PPR_FK_PASTA', PPR_FK_CLIENTE = '$PPR_FK_CLIENTE', PPR_PARTE_CONTRARIA = '$PPR_PARTE_CONTRARIA', PPR_NUM_PROCESSO = '$PPR_NUM_PROCESSO', PPR_COMARCA = '$PPR_COMARCA', PPR_FK_NATUREZA = '$PPR_FK_NATUREZA', PPR_FK_MEIO = '$PPR_FK_MEIO', PPR_TIPO_ACAO = '$PPR_TIPO_ACAO', PPR_FK_COD_ACAO = '$PPR_FK_COD_ACAO', PPR_DT_NOMEACAO = '$PPR_DT_NOMEACAO', PPR_DT_PUB_SENTENCA = '$PPR_DT_PUB_SENTENCA',
                                              PPR_DT_TRANS_JULGADO	= '$PPR_DT_TRANS_JULGADO', PPR_DT_ENVIO_CERTIDAO = '$PPR_DT_ENVIO_CERTIDAO',	PPR_DT_RECEBIMENTO	= '$PPR_DT_RECEBIMENTO', PPR_FK_PERCENTUAL = '$PPR_FK_PERCENTUAL',
                                              PPR_VALOR_TABELA = '$PPR_VALOR_TABELA', PPR_FK_INSS = '$PPR_FK_INSS',
					                          PPR_OBS = '$PPR_OBS', PPR_DT_UPDATE = NOW(), PPR_USER_UPDATE = '$PPR_USER_UPDATE'
			                            WHERE PPR_ID = $id ";

			$RESULTADO 			   = mysqli_query( $CONN, $SQL );

			if( $RESULTADO ) {
				$_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
			} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
			} mysqli_close( $CONN );

		} else {

			//<!-- PROCESSOS EM GERAL -->//
			$PPR_CASO              = corrigir( $_POST[ 'PPR_CASO' ] );
            $PPR_CREDITO_PODRE     = (int) $_POST['PPR_CREDITO_PODRE'];
			$PPR_FK_STATUS         = $_POST[ 'PPR_FK_STATUS' ];
			$PPR_FK_HONORARIOS     = $_POST[ 'PPR_FK_HONORARIOS' ];
			$PPR_FK_DEFENSORIA     = $_POST[ 'PPR_FK_DEFENSORIA' ];
			$PPR_FK_PASTA          = $_POST[ 'PPR_FK_PASTA' ];
			$PPR_FK_CLIENTE        = $_POST[ 'PPR_FK_CLIENTE' ];
			$PPR_PARTE_CONTRARIA   = corrigir( $_POST[ 'PPR_PARTE_CONTRARIA' ] );
			$PPR_NUM_PROCESSO      = number( $_POST[ 'PPR_NUM_PROCESSO' ] );
			$PPR_COMARCA           = corrigir( $_POST[ 'PPR_COMARCA' ] );
			$PPR_FK_NATUREZA       = $_POST[ 'PPR_FK_NATUREZA' ];
			$PPR_FK_MEIO           = $_POST[ 'PPR_FK_MEIO' ];
			$PPR_TIPO_ACAO         = corrigir( $_POST[ 'PPR_TIPO_ACAO' ] );

			//<!-- INFORMAÇÕES DO CONTRATO -->//
			$PPR_DT_CONTRATO       = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_CONTRATO' ])));
			$PPR_VALOR             = (float) moeda($_POST[ 'PPR_VALOR' ]);
			$PPR_QTD_PARCELA       = (int) corrigir( $_POST[ 'PPR_QTD_PARCELA' ] );
			$PPR_DIA_PGTO          = corrigir( $_POST[ 'PPR_DIA_PGTO' ] );
			$PPR_DT_INICIO_PGTO    = date("Y-m-d",strtotime(str_replace('/','-',$_POST[ 'PPR_DT_INICIO_PGTO' ])));
            // $PPR_VALOR_PARCELA     = $PPR_VALOR / $PPR_QTD_PARCELA;
			if( $PPR_QTD_PARCELA   > 1 ) {
                $PPR_VALOR_PARCELA = $PPR_VALOR / $PPR_QTD_PARCELA;
				$PPR_DT_FIM_PGTO   = dt_fim_pgto( $PPR_DT_INICIO_PGTO, $PPR_QTD_PARCELA );
			} else {
                $PPR_VALOR_PARCELA = $PPR_VALOR;
				$PPR_DT_FIM_PGTO   = $PPR_DT_INICIO_PGTO;
			}

			//<!-- OBSERVAÇÕES -->//
			$PPR_OBS 			   = corrigir( $_POST[ 'PPR_OBS' ] );

			//<!-- SESSION -->//
			$PPR_USER_UPDATE 	   = $_SESSION[ 'USR_ID' ];
			// $id 				   = (int) $_POST[ 'id' ];
            $id                    = mysqli_real_escape_string($CONN, $_POST['id']);

			//<!-- ATUALIZANDO AS INFORMAÇÕES -->//
			$SQL 				   = " UPDATE PPR_PROC_PROCESSOS
			                              SET PPR_CASO = '$PPR_CASO', PPR_CREDITO_PODRE = '$PPR_CREDITO_PODRE', PPR_FK_STATUS = '$PPR_FK_STATUS',
                                              PPR_FK_HONORARIOS = '$PPR_FK_HONORARIOS', PPR_FK_DEFENSORIA = '$PPR_FK_DEFENSORIA', PPR_FK_PASTA = '$PPR_FK_PASTA',
                                              PPR_FK_CLIENTE = '$PPR_FK_CLIENTE', PPR_PARTE_CONTRARIA = '$PPR_PARTE_CONTRARIA',
                                              PPR_NUM_PROCESSO = '$PPR_NUM_PROCESSO', PPR_COMARCA	= '$PPR_COMARCA', PPR_FK_NATUREZA = '$PPR_FK_NATUREZA', PPR_FK_MEIO = '$PPR_FK_MEIO', PPR_TIPO_ACAO = '$PPR_TIPO_ACAO', PPR_DT_CONTRATO = '$PPR_DT_CONTRATO',
                                              PPR_VALOR = '$PPR_VALOR', PPR_DT_FIM_PGTO = '$PPR_DT_FIM_PGTO', PPR_QTD_PARCELA = '$PPR_QTD_PARCELA', PPR_VALOR_PARCELA = '$PPR_VALOR_PARCELA', PPR_DIA_PGTO = '$PPR_DIA_PGTO',
                                              PPR_DT_INICIO_PGTO = '$PPR_DT_INICIO_PGTO', PPR_OBS = '$PPR_OBS', PPR_DT_UPDATE = NOW(),
                                              PPR_USER_UPDATE = '$PPR_USER_UPDATE'
			                            WHERE PPR_ID = $id ";

			$RESULTADO = mysqli_query( $CONN, $SQL );

			if( $RESULTADO ) {
				$_SESSION[ 'msg1' ] = "Registro alterado com sucesso!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
			} else {
				$_SESSION[ 'msg2' ] = "Erro: Registro não alterado!";
				echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
			} mysqli_close( $CONN );

		}

	}