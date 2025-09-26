<?php
	if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

	// Definir um fuso horario padrao
	date_default_timezone_set('America/Sao_Paulo');

	//Inicio da conexão com o banco de dados utilizando PDO
	$host = "localhost";

	try {
		//Conexão sem a porta
		$CONNPDO = new PDO("mysql:host=$host;dbname=" . $_SESSION[ 'USR_DB_NAME' ], $_SESSION[ 'USR_DB_USER' ], $_SESSION[ 'USR_DB_PASS' ]);
		//echo "Conexão com banco de dados realizado com sucesso.";
	} catch (PDOException $err) {
		echo "Erro: Conexão com banco de dados não realizada. Erro gerado " . $err->getMessage();
	}
	//Fim da conexão com o banco de dados utilizando PDO

	// Variável para receber o valor final da parcela
	$VALOR_FINAL_PARCELA = "";

	if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

		//<!-- PARCESSOS EM GERAL -->//
    $PPR_CASO = corrigir( $_POST[ 'PPR_CASO' ] );
    $PPR_FK_STATUS = $_POST[ 'PPR_FK_STATUS' ];
    $PPR_FK_HONORARIOS = $_POST[ 'PPR_FK_HONORARIOS' ];
		$PPR_FK_DEFENSORIA = $_POST[ 'PPR_FK_DEFENSORIA' ] ?? 2;
    $PPR_FK_PASTA = $_POST[ 'PPR_FK_PASTA' ];
    $PPR_FK_CLIENTE = $_POST[ 'PPR_FK_CLIENTE' ];
    $PPR_PARTE_CONTRARIA = corrigir( $_POST[ 'PPR_PARTE_CONTRARIA' ] );
    $PPR_NUM_PROCESSO = number( $_POST[ 'PPR_NUM_PROCESSO' ] );
		$PPR_COMARCA = corrigir( $_POST[ 'PPR_COMARCA' ] );
		$PPR_FK_NATUREZA = $_POST[ 'PPR_FK_NATUREZA' ];
		$PPR_FK_MEIO = $_POST[ 'PPR_FK_MEIO' ];
    $PPR_TIPO_ACAO = corrigir( $_POST[ 'PPR_TIPO_ACAO' ] );

		//<!-- INFORMAÇÕES DO CONTRATO -->//
    $PPR_DT_CONTRATO = $_POST[ 'PPR_DT_CONTRATO' ] ?? '0000-00-00';
		$PPR_MENSALISTA = $_POST[ 'PPR_MENSALISTA' ] ?? 0;
		$PPR_DT_INICIO_PGTO = $_POST[ 'PPR_DT_INICIO_PGTO' ];
		$PPR_VALOR = moeda( $_POST[ 'PPR_VALOR' ] );
		$PPR_VALOR_TOTAL = $PPR_VALOR;
		$PPR_SALDO = $PPR_VALOR_TOTAL;

		//<!-- PARA CLIENTES DEFENSORIA -->//
		if( $PPR_FK_DEFENSORIA == 1 ) {
			$PPR_MENSALISTA = 0;
			$PPR_QTD_PARCELA = 0;
			$PPR_VALOR_PARCELA = 0.00;
		}

		//<!-- PARA CLIENTES PARTICULARES -->//
		if( $PPR_FK_DEFENSORIA == 2 ) {

			if( $PPR_MENSALISTA == 1 ) {

				//<!-- PARA CONTRATOS MENSALISTAS -->//
				$PPR_MENSALISTA = 1;
				$PPR_QTD_PARCELA = 1;
				$PPR_VALOR_PARCELA = $PPR_VALOR;

			} else {

				//<!-- PARA CONTRATOS PARTICULARES -->//
				$PPR_MENSALISTA = 0;
				$PPR_QTD_PARCELA = $_POST[ 'PPR_QTD_PARCELA' ] ?? 1;
				$PPR_VALOR_PARCELA = $PPR_VALOR / $PPR_QTD_PARCELA;

			}

		}

		//<!-- OBSERVAÇÕES -->//
		$PPR_OBS = corrigir( $_POST[ 'PPR_OBS' ] );

		//<!-- SESSION -->//
		$PPR_USER_CREATION = $_SESSION[ 'USR_ID' ];

		//<!-- VARIAVEIS NÃO UTILIZADAS NESTA SESSÃO, MAS NECESSÁRIAS PARA O BANCO -->//
		$PPR_FK_INSS = 1;
		$PPR_FK_COD_ACAO = 1;
		$PPR_FK_PERCENTUAL = 6;

		// Variável para receber o id do processo
		$PPP_FK_PROCESSO = "";

		// GRAVANDO OS DADOS DO PROCESSO
		$SQL = " INSERT INTO PPR_PROC_PROCESSOS( PPR_MENSALISTA, PPR_CASO, PPR_FK_STATUS, PPR_FK_HONORARIOS, PPR_FK_DEFENSORIA, PPR_FK_PASTA, PPR_FK_CLIENTE, PPR_PARTE_CONTRARIA,
																					PPR_NUM_PROCESSO, PPR_COMARCA, PPR_FK_NATUREZA, PPR_FK_MEIO, PPR_TIPO_ACAO, PPR_DT_CONTRATO, PPR_VALOR, PPR_QTD_PARCELA,
																					PPR_DT_INICIO_PGTO, PPR_VALOR_PARCELA, PPR_VALOR_TOTAL, PPR_SALDO, PPR_OBS, PPR_FK_INSS,
																					PPR_FK_COD_ACAO, PPR_FK_PERCENTUAL, PPR_DT_CREATION, PPR_USER_CREATION )
													  VALUES( '$PPR_MENSALISTA', '$PPR_CASO', '$PPR_FK_STATUS', '$PPR_FK_HONORARIOS', '$PPR_FK_DEFENSORIA', '$PPR_FK_PASTA', '$PPR_FK_CLIENTE', '$PPR_PARTE_CONTRARIA',
																			 		 '$PPR_NUM_PROCESSO', '$PPR_COMARCA', '$PPR_FK_NATUREZA', '$PPR_FK_MEIO', '$PPR_TIPO_ACAO', '$PPR_DT_CONTRATO', '$PPR_VALOR', '$PPR_QTD_PARCELA',
																					 '$PPR_DT_INICIO_PGTO', '$PPR_VALOR_PARCELA', '$PPR_VALOR_TOTAL', '$PPR_SALDO', '$PPR_OBS',
																					 '$PPR_FK_INSS', '$PPR_FK_COD_ACAO', '$PPR_FK_PERCENTUAL', NOW(), '$PPR_USER_CREATION' ) ";

		// Acessa o IF quando cadastrar o processo no BD para pegar o último ID
		if( mysqli_query( $CONN, $SQL) ) {
			$PPP_FK_PROCESSO = mysqli_insert_id( $CONN );
		} else {
			echo "Error: " . $SQL . "<br />" . mysqli_error( $CONN );
		}

		// Atualiza a condição de mensalista
		mysqli_query( $CONN, " UPDATE PPR_PROC_PROCESSOS
																										 SET PPR_MENSALISTA = '$PPR_MENSALISTA'
 																							WHERE PPR_ID = '$PPP_FK_PROCESSO'
												 									 " );
		echo mysqli_error( $CONN );

		//<!-- INICIO DO TRATAMENTO DO PAGAMENTO -->//
		//echo '<br /><br /><br />';
		//echo "Valor da compra: " . number_format( $PPR_VALOR, 2, ',', '.' ) . "<br />";
		// Imprimir a quantidade de parcelas
		//echo "Quantidade de parcelas: $PPR_QTD_PARCELA <br /><br />";
		// Variável para controlar o WHILE
		$CONTROLE = 1;
		// Soma total das parcelas
		$SOMA_VALOR_PARC = 0;
		$PPR_DT_INICIO_PGTO = date( 'Y-m-d', strtotime( "-1 month", strtotime( $PPR_DT_INICIO_PGTO ) ) ); // Recuperar a data atual

		// Laço de repetição para imprimir o valor das parcelas
		while( $CONTROLE <= $PPR_QTD_PARCELA ) {

			// Somar um mês na data
			$PPR_DT_INICIO_PGTO = date( 'Y-m-d', strtotime( "+1 month", strtotime( $PPR_DT_INICIO_PGTO ) ) );

			// Imprimindo o número da parcela
			$PPP_NR_PARCELA = $CONTROLE;
			//echo "Número da parcela: $CONTROLE <br />" ;

			// Acessa o IF quando é última parcela para corrigir o valor da compra
			if( $CONTROLE == $PPR_QTD_PARCELA ) {

				// Utilizar a soma das parcelas já impressa e subtrair do valor total da compra para obter o valor a última parcela e corrigir a diferença
				$VALOR_ULTIMA_PARC = $PPR_VALOR - $SOMA_VALOR_PARC;

				// Converter o valor da parcela para o formato Real separado pela virgula
				//echo "Valor da parcela " . number_format( $VALOR_ULTIMA_PARC, 2, ',', '.' ) . "<br />";

				// Somar o valor das parcelas
				$SOMA_VALOR_PARC += number_format( $VALOR_ULTIMA_PARC, 2, '.', '' );

				// Valor final da parcela
        $VALOR_FINAL_PARCELA = number_format( $VALOR_ULTIMA_PARC, 2, '.', '' );
			} else {

				// Converter o valor da parcela para o formato Real separado pela virgula
				//echo "Valor da parcela " . number_format( $PPR_VALOR_PARCELA, 2, ',', '.' ) . "<br />";

				// Somar o valor das parcelas
				$SOMA_VALOR_PARC += number_format( $PPR_VALOR_PARCELA, 2, '.', '' );

				// Valor final da parcela
        $VALOR_FINAL_PARCELA = number_format( $PPR_VALOR_PARCELA, 2, '.', '' );
			}

			// Converter a data
			//echo "Data de vencimento: " . $PPR_DT_INICIO_PGTO . "<br /><br />";

			$PPP_STATUS = 1;

			// Acessa o IF quando tem Contrato
			if( !empty( $PPR_VALOR ) ) {

					// Cadastrar as parcelas
					$QR_PARCELAS = "INSERT INTO PPP_PROC_PROCESSOS_PGTO (PPP_FK_PROCESSO, PPP_STATUS, PPP_NR_PARCELA, PPP_DT_VENCIMENTO, PPP_VALOR)
															 										VALUES (:PPP_FK_PROCESSO, :PPP_STATUS, :PPP_NR_PARCELA, :PPP_DT_VENCIMENTO, :PPP_VALOR)";
					$CAD_PARCELAS = $CONNPDO->prepare( $QR_PARCELAS );
					$CAD_PARCELAS->bindParam(':PPP_FK_PROCESSO', $PPP_FK_PROCESSO);
					$CAD_PARCELAS->bindParam(':PPP_STATUS', $PPP_STATUS);
					$CAD_PARCELAS->bindParam(':PPP_NR_PARCELA', $PPP_NR_PARCELA);
					$CAD_PARCELAS->bindValue(':PPP_DT_VENCIMENTO', $PPR_DT_INICIO_PGTO);
					$CAD_PARCELAS->bindParam(':PPP_VALOR', $VALOR_FINAL_PARCELA);
					$CAD_PARCELAS->execute();
			}

			// Incrementar a variável após imprimir a parcela
			$CONTROLE++;
		}

		// Imprimir o valor total da soma das parcelas e converter para o formato Real separado pela virgula
		//echo "Valor total parcelado: " . number_format( $SOMA_VALOR_PARC, 2, ',', '.' ) . "<br />";

		if( !empty( $PPP_FK_PROCESSO ) ) {
			$_SESSION[ 'msg1' ] = "Registro cadastrado com sucesso!";
			echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
		} else {
			$_SESSION[ 'msg2' ] = "Erro ao gravar registro!";
			echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_main'; }, 0);</script>";
		} mysqli_close( $CONN );

  }
?>