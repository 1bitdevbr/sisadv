<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

	if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
		$EMP_ID = $_POST[ 'EMP_ID' ];
		$EMP_FK_CLIENTE = $_POST[ 'EMP_FK_CLIENTE' ];
		$EPG_DT_PGTO = test_input( $_POST[ 'EPG_DT_PGTO' ] );
		$EPG_VALOR = moeda( $_POST[ 'EPG_VALOR' ] );
		$EMP_USER_CREATION = $_SESSION[ 'USR_ID' ];

		mysqli_query( $CONN, " INSERT INTO EPG_EMPRESTIMO_PGTO( EPG_FK_CONTRATO, EPG_DT_PGTO, EPG_VALOR ) VALUES( '$EMP_ID', '$EPG_DT_PGTO', '$EPG_VALOR' ) " );
		echo mysqli_error( $CONN );

		// BUSCANDO O ID DO USUARIO, VEZ QUE APENAS VEM O NOME PELA URL
		if( $EMP_FK_CLIENTE ) {
			$SQL = mysqli_query( $CONN, " SELECT CLI_ID FROM CLI_CLIENTES WHERE CLI_NOME = '$EMP_FK_CLIENTE' ");
			$ROW = mysqli_fetch_array( $SQL );
			$EMP_FK_CLIENTE = $ROW[ 'CLI_ID' ];
		} else {
			$_SESSION[ 'msg2' ] = "Erro: Cliente não cadastrado!";
			echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=loan/loa_main'; }, 0);</script>";
		}

		$SQL = mysqli_query( $CONN, " SELECT EMP_SALDO FROM EMP_EMPRESTIMO_MOV WHERE EMP_ID = '$EMP_ID' ");
		$ROW = mysqli_fetch_array( $SQL );

		if( $ROW[ 'EMP_SALDO' ] ) {
			$SALDO = $ROW[ 'EMP_SALDO' ];
			$NOVO_SALDO = $SALDO - $EPG_VALOR;
		} else {
			$_SESSION[ 'msg2' ] = mysqli_error( $CONN );
			echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=loan/loa_main'; }, 0);</script>";
		}

		mysqli_query( $CONN, " UPDATE EMP_EMPRESTIMO_MOV SET EMP_SALDO = '$NOVO_SALDO', EMP_DT_UPDATE = NOW(), EMP_USER_UPDATE = '$EMP_USER_CREATION' WHERE EMP_ID = '$EMP_ID' AND EMP_FK_CLIENTE = '$EMP_FK_CLIENTE' " );
		echo mysqli_error( $CONN );

		$_SESSION[ 'msg1' ] = "Registro atualizado com sucesso!";
		echo "<script>window.location.replace('?pg=loan/loa_view&id=$EMP_ID')</script>";
		mysqli_close( $CONN );
	} else {
		$_SESSION[ 'msg2' ] = "Erro: REQUEST_METHOD_POST vazio!";
		echo "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=loan/loa_main'; }, 0);</script>";
		mysqli_close( $CONN );
	}
?>