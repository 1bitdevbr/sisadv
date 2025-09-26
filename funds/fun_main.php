<?php
    if( !isset(  $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');
    require_once(__DIR__ . '/fun_proc.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'fun_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'fun_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend style="text-transform: uppercase; letter-spacing: 0.3em;"><?= $fundsSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb(  108, 117, 125, 20% );" />

            <div class="container-fluid">

                <!-- // MOVIMENTO DESTE MES // -->
                <table cellpadding="10" cellspacing="0" align="center" width="100%">
                    <tr>
                        <td colspan="3">
                            <?php
                                if( isset( $_GET[ 'cat_err' ] ) && $_GET[ 'cat_err' ] == 1 ) {
                            ?>

                            <div style="padding: 5px; background-color: #FF6; text-align: center; color: #030">
                                <strong>Esta categoria não pode ser removida, pois há movimentos associados a ela.</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'cat_ok' ] ) && $_GET[ 'cat_ok' ] == 2 ) {
                            ?>

                            <div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
                                <strong>Categoria removida com sucesso!</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'cat_ok' ] ) && $_GET[ 'cat_ok' ] == 1 ) {
                            ?>

                            <div style="padding: 5px; background-color: #FF6; text-align: center; color: #030">
                                <strong>Categoria cadastrada com sucesso!</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'cat_ok' ] ) && $_GET[ 'cat_ok' ] == 3 ) {
                            ?>

                            <div style="padding: 5px; background-color: #FF6; text-align: center; color: #030">
                                <strong>Categoria alterada com sucesso!</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'ok' ] ) && $_GET[ 'ok' ] == 1 ) {
                            ?>

                            <div style="padding: 5px; background-color: #FF6; text-align: center; color: #030">
                                <strong>Movimento cadastrado com sucesso!</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'ok' ] ) && $_GET[ 'ok' ] == 2 ) {
                            ?>

                            <div style="padding: 5px; background-color: #900; text-align: center; color: #FFF">
                                <strong>Movimento removido com sucesso!</strong>
                            </div>

                            <?php }?>

                            <?php
                                if( isset( $_GET[ 'ok' ] ) && $_GET[ 'ok' ] == 3 ) {
                            ?>

                            <div style="padding: 5px; background-color: #FF6; text-align: center; color: #030">
                                <strong>Movimento alterado com sucesso!</strong>
                            </div>

                            <?php }?>

                            <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_cat">
                                <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Categoria</h3>
                                <table class="table" width="100%" style="background-color: rgb( 69, 77, 85 );">
                                    <tr>
                                        <td valign="top">
                                            <form method="POST" action="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                                <div class="container" style="text-align: center;">
                                                    <div class="row justify-content-md-center">
                                                        <div class="col" style="text-align: center;">
                                                            <input type="hidden" name="acao" value="2" />
                                                            <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Nome:</strong><br />
                                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" size="20" maxlength="50" required />
                                                            <br /><br />
                                                            <button type="submit" value="Enviar" class="btn input btn-light btn-sm" style="color: rgb( 205, 204, 204 ); font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td valign="top" align="right">
                                            <b>Editar/Remover Categorias:</b><br/><br/>
                            <?php
                                $QR = mysqli_query( $CONN, " SELECT RCA_ID, RCA_NOME FROM RCA_RES_CAT ");
                                while( $ROW = mysqli_fetch_array( $QR ) ) {
                            ?>
                                            <div id="editar2_cat_<?= $ROW[ 'RCA_ID' ]; ?>">
                                                <?= $ROW[ 'RCA_NOME' ]; ?>
                                                <a style="font-size: 1.0em; color: rgb( 227, 164, 164 )" onclick="return confirm('Tem certeza que deseja remover esta categoria?\nAtenção: Apenas categorias sem movimentos associados poderão ser removidas.')" href="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar_cat&id=<?= $ROW[ 'RCA_ID' ]; ?>" title="Remover">[remover]</a>
                                                <a href="javascript:;" style="font-size: 1.0em; color: rgb( 119, 230, 189 )" onclick="document.GETElementById('editar_cat_<?= $ROW[ 'RCA_ID' ]; ?>').style.display=''; document.GETElementById('editar2_cat_<?= $ROW[ 'RCA_ID' ]; ?>').style.display='none'" title="Editar">[editar]</a>
                                            </div>
                                            <div style="display: none;" id="editar_cat_<?= $ROW[ 'RCA_ID' ]; ?>">
                                                <form method="POST" action="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                                    <input type="hidden" name="acao" value="editar_cat" />
                                                    <input type="hidden" name="id" value="<?= $ROW[ 'RCA_ID' ]; ?>" />
                                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" value="<?= $ROW[ 'RCA_NOME' ]; ?>" size="20" maxlength="50" />
                                                    <input type="submit" class="input" value="Alterar" />
                                                </form>
                                            </div>

                            <?php }?>

                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_movimento">
                                <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Movimento</h3>
                                <?php
                                    $QR = mysqli_query( $CONN, " SELECT * FROM RCA_RES_CAT ");
                                if( mysqli_num_rows( $QR ) == 0 )
                                    echo "Adicione ao menos uma categoria";
                                    else{
                                ?>
                                <form method="POST" action="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                    <div class="container" style="text-align: center;">
                                        <div class="row justify-content-md-center">
                                            <div class="col col-lg-2" tabindex="0">
                                                <input type="hidden" name="acao" value="1" />
                                                <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Data</strong><br />
                                                <input type="text" name="data" size="11" maxlength="10" style="text-align: center;" value="<?= date( 'd' )?>/<?= $MES_HOJE; ?>/<?= $ANO_HOJE; ?>" autofocus />
                                            </div>
                                            <div class="col-md-auto">

                                            </div>
                                            <div class="col col-lg-2">
                                                <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Categoria</strong><br />
                                                <select name="cat">
                                                    <?php
                                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                                    ?>
                                                    <option value="<?= $ROW[ 'RCA_ID' ]; ?>"><?= $ROW[ 'RCA_NOME' ]; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <br /><strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Descrição</strong><br />
                                                <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="descricao" size="100" maxlength="255" required />
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col col col-lg-2">
                                                <br /><strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Valor</strong><br /><!-- Para a mascara funcionar, precisa incluir a classe e o id -->
                                                R$&nbsp;<input class="money" id="money" type="text" name="valor" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" required />
                                            </div>
                                            <div class="col col col-lg-2">
                                                <br /><strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Tipo<br /></strong>
                                                <label for="tipo_receita" style="color: rgb( 119, 230, 189 )"><input type="radio" name="tipo" value="1" id="tipo_receita" required /> Receita</label>&nbsp;
                                                <label for="tipo_despesa" style="color: rgb( 227, 164, 164 )"><input type="radio" name="tipo" value="0" id="tipo_despesa" required /> Despesa</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row justify-content-md-center">
                                        <button type="submit" value="Enviar" class="btn input btn-light btn-sm" style="color: rgb( 205, 204, 204 ); font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                                        </button>
                                    </div>

                                </form>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                </table>
<!-- ==================================================== // -->
                <!-- /.FAIXA DO MES -->
                <div class="col-12" align="center">
                    <div class="info-box mb-3 bg-light" style="border: 1px solid #C8C8C8; justify-content: center; display: table-cell; align-items: center; vertical-align: middle;
                            background-color: #F1F1F1; padding: 5px 5px 5px 5px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; text-align: center; text-transform: uppercase;
                            font-size: 1.0em; font-weight: 600; color: rgb( 29, 166, 243 ); letter-spacing: .1rem; border-radius: 100px 100px 100px 100px; flex-direction: row; opacity: 80%;">
                        <div class="info-box-content">
                            <table>
                                <tr>
                                    <td>
                                        <select onchange="location.replace('index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano='+this.value)">
                                            <?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
                                                <option value="<?= $i; ?>" <?php if( $i == $ANO_HOJE ) echo "selected=selected"?> ><?= $i; ?></option>
                                            <?php } ?>
                                        </select>&nbsp;
                                    </td>
                                    <?php for( $i = 1; $i <= 12; $i++  ) { ?>
                                    <td align="center" style="<?php if( $i != 12 ) echo "border-right: 1px solid #C8C8C8;" ?> padding: 2px 3px 2px 3px;">
                                        <a href="index.php?pg=funds/fun_main&mes=<?= $i; ?>&ano=<?= $ANO_HOJE; ?>" style="<?php if( $MES_HOJE == $i ) { ?>color: rgb( 159, 0, 0 ); font-size: 1.0em; font-weight: 600; background-color: rgb( 211, 211, 213 ); padding: 5px; <?php } else{ ?> color: #262524; font-size: 1.0em; <?php } ?>"><?= mostraMes( $i ); ?></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- /.FAIXA DO MES -->

                <div class="table-borderless">

                    <div class="" style="margin: 10px 10px 10px 10px;">
                        <h2 style="color: rgb( 253, 224, 139 ); text-align: center;"><i class="icon fas fa-calendar"></i>&nbsp;<?= mostraMes( $MES_HOJE ) . '/' . $ANO_HOJE; ?></h2>
                    </div>

                    <table class="table" cellpadding="10" cellspacing="0" align="center">
                        <tr style="background-color: rgb( 63, 71, 78 );">
                            <td width="48%">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border" style="color: rgb( 205, 205, 205);">&nbsp; Entradas e Saídas deste mês</legend>

                                    <div class="card-body alert alert-secondary" style="background-color: #F9F9F9;">
                                        <?php
                                            $QR = mysqli_query( $CONN, "SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 1 && RMO_MES = '$MES_HOJE' && RMO_ANO = '$ANO_HOJE' ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $ENTRADAS = $ROW[ 'TOTAL' ];

                                            $QR =mysqli_query( $CONN, "SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 0 && RMO_MES = '$MES_HOJE' && RMO_ANO = '$ANO_HOJE' ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $SAIDAS = $ROW[ 'TOTAL' ];

                                            $RESULTADO_MES = $ENTRADAS - $SAIDAS ;
                                        ?>
                                        <table class="table table-sm" style="border: 0px; color: rgb( 63, 71, 78 ); border-style: solid;">
                                            <tr>
                                                <td><span style="color: rgb( 63, 103, 145 ); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span></td>
                                                <td align="right"><span style="color: rgb( 63, 103, 145 ); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><span style="color: rgb( 131, 55, 60 ); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span></td>
                                                <td align="right"><span style="color: rgb( 131, 55, 60 ); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0 ) echo "rgb( 33, 37, 41);"; else echo "#030" ?>">Resultado:</span></td>
                                                <td align="right"><span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0 ) echo "rgb( 131, 55, 60 );"; else echo "#030"; ?>"><?= formata_dinheiro( $RESULTADO_MES ); ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </fieldset>
                            </td>

                            <td width="2%" style="border: 0px; border-color: rgb( 63, 103, 145); border-style: solid;"></td>

                            <td width="48%">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border" style="color:rgb( 205, 205, 205);">&nbsp; Balanço Geral</legend>

                                    <div class="card-body alert alert-secondary" style="background-color:#F9F9F9;">
                                        <?php
                                            $QR = mysqli_query( $CONN, " SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 1 ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $ENTRADAS = $ROW[ 'TOTAL' ];

                                            $QR = mysqli_query( $CONN, " SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 0 ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $SAIDAS = $ROW[ 'TOTAL' ];

                                            $RESULTADO_GERAL = $ENTRADAS - $SAIDAS ;
                                        ?>
                                        <table class="table table-sm">
                                            <tr>
                                                <td align="left"><span style="color: rgb( 63, 103, 145); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span></td>
                                                <td align="right"><span style="color: rgb( 63, 103, 145); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="color: rgb( 131, 55, 60); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span></td>
                                                <td align="right"><span style="color: rgb( 131, 55, 60); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 33, 37, 41);"; else echo "#030"?>">Resultado:</span></td>
                                                <td align="right"><span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 131, 55, 60);"; else echo "#030"?>"><?= formata_dinheiro( $RESULTADO_GERAL ); ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </fieldset>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-dark table-striped table-hover table-sm">
                        <tr>
                            <td colspan="3">
                                <div style="float: right; text-align: right;">
                                    <form name="form_filtro_cat" method="GET" action="">
                                        <input type="hidden" name="mes" value="<?= $MES_HOJE; ?>" >
                                        <input type="hidden" name="ano" value="<?= $ANO_HOJE; ?>" >
                                            Filtrar por categoria:
                                            <select name="filtro_cat" onchange="form_filtro_cat.submit()">
                                            <option value="">Tudo</option>
                                                <?php
                                                    $QR =mysqli_query( $CONN, " SELECT DISTINCT C.RCA_ID, C.RCA_NOME FROM RCA_RES_CAT C, RMO_RES_MOVIMENTO M WHERE M.RMO_CAT = C.RCA_ID && M.RMO_MES = '$MES_HOJE' && M.RMO_ANO = '$ANO_HOJE' ");
                                                    while( $ROW = mysqli_fetch_array( $QR ) ) {
                                                ?>
                                                <option <?php if( isset( $_GET[ 'filtro_cat' ] ) && $_GET[ 'filtro_cat' ] == $ROW[ 'RCA_ID' ] ) echo "selected=selected"?> value="<?= $ROW[ 'RCA_ID' ]; ?>"><?= $ROW[ 'RCA_NOME' ]; ?></option>
                                                <?php }?>
                                            </select>
                                        <input type="submit" value="Filtrar" class="botao" />
                                    </form>
                                </div>
                                <h3 style="color: rgb(   254, 214, 122 );">Movimentos deste Mês</h3>
                            </td>
                        </tr>

                        <tr class="extrato">
                            <th scope="col" style="text-align: center;">DIA</th>
                            <th scope="col" style="float: left;">MOVIMENTO</th>
                            <th scope="col" style="text-align: right;">VALOR</th>
                        </tr>

                        <?php
                            $filtros="";
                            if( isset( $_GET[ 'filtro_cat' ] ) ) {
                                if( $_GET[ 'filtro_cat' ]!='' ) {
                                    $filtros="&& cat='".$_GET[ 'filtro_cat' ]."'";

                                            $QR =mysqli_query( $CONN, " SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 1 && RMO_MES = '$MES_HOJE' && RMO_ANO = '$ANO_HOJE' $filtros ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $ENTRADAS =$ROW[ 'TOTAL' ];

                                            $QR =mysqli_query( $CONN, " SELECT SUM( RMO_VALOR ) AS TOTAL FROM RMO_RES_MOVIMENTO WHERE RMO_TIPO = 0 && RMO_MES = '$MES_HOJE' && RMO_ANO = '$ANO_HOJE' $filtros ");
                                            $ROW = mysqli_fetch_array( $QR );
                                            $SAIDAS =$ROW[ 'TOTAL' ];

                                            $RESULTADO_MES = $ENTRADAS - $SAIDAS;
                                    }
                            }

                            $QR = mysqli_query( $CONN, " SELECT * FROM RMO_RES_MOVIMENTO WHERE RMO_MES = '$MES_HOJE' && RMO_ANO = '$ANO_HOJE' $filtros ORDER By RMO_ID ");
                            $CONT = 0;
                            while( $ROW = mysqli_fetch_array( $QR ) ) {
                            $CONT++;

                            $CAT = $ROW[ 'RMO_CAT' ];
                            $QR2 = mysqli_query( $CONN, " SELECT RCA_NOME FROM RCA_RES_CAT WHERE RCA_ID = '$CAT' ");
                            $ROW2 = mysqli_fetch_array( $QR2 );
                            $CATEGORIA = $ROW2[ 'RCA_NOME' ];
                        ?>

                        <tbody>
                            <tr style="background-color:<?php if( $CONT%2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" >
                                <td align="center" width="5%"><strong style="color: rgb( 197, 237, 255); font-weight: 600;"><?= $ROW[ 'RMO_DIA' ]; ?></strong></td>
                                <td width="80%" style="color: rgb( 255, 255, 255 ); font-weight: 600;">
                                    <?= $ROW[ 'RMO_DESCRICAO' ]; ?>
                                    <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?>
                                        <a href="javascript:;" style="font-size: 1em; color: rgb( 53, 236, 20 )" onclick="document.getElementById('editar_mov_<?= $ROW[ 'RMO_ID' ]; ?>').style.display='';" title="Editar"><i class="fas fa-edit"></i></a>
                                    <?php } ?>
                                </td>
                                <td align="right" width="15%"><strong style="color:<?php if( $ROW[ 'RMO_TIPO' ] == 0 ) echo "rgb( 231, 185, 184 )"; else echo "rgb( 197, 237, 255 )"?>"><?php if( $ROW[ 'RMO_TIPO' ] == 0 ) echo "-"; else echo "+"?><?= formata_dinheiro( $ROW[ 'RMO_VALOR' ] ); ?></strong></td>
                            </tr>
                            <tr style="display:none; background-color:<?php if( $CONT%2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" id="editar_mov_<?= $ROW[ 'RMO_ID' ]; ?>">
                                <td colspan="3" style="background-color: rgb( 63, 71, 78 );">
                                    <hr/>
                                    <form method="POST" action="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                        <input type="hidden" name="acao" value="editar_mov" />
                                        <input type="hidden" name="id" value="<?= $ROW[ 'RMO_ID' ]; ?>" />

                                        <b style="color: rgb( 197, 237, 255 ); font-weight: 600;">Dia:</b> <input type="text" name="dia" size="3" maxlength="2" value="<?= $ROW[ 'RMO_DIA' ]; ?>" />&nbsp;|&nbsp;
                                        <b style="color: rgb( 197, 237, 255 ); font-weight: 600;">Tipo:</b> <label for="tipo_receita<?= $ROW[ 'RMO_ID' ]; ?>"  style="color: rgb( 197, 237, 255); font-weight: 600;"><input <?php if( $ROW[ 'RMO_TIPO' ] == 1 ) echo "checked=checked"?> type="radio" name="tipo" value="1" id="tipo_receita<?= $ROW[ 'RMO_ID' ]; ?>" /> Receita</label>&nbsp; <label for="tipo_despesa<?= $ROW[ 'RMO_ID' ]; ?>"  style="color: rgb( 231, 185, 184 ); font-weight: 600;"><input <?php if( $ROW[ 'RMO_TIPO' ] == 0 ) echo "checked=checked"?> type="radio" name="tipo" value="0" id="tipo_despesa<?= $ROW[ 'RMO_ID' ]; ?>" /> Despesa</label>&nbsp;|&nbsp;
                                        <b style="color: rgb( 197, 237, 255 ); font-weight: 600;">Categoria:</b>
                                        <select name="cat">
                                            <?php
                                                $QR2 = mysqli_query( $CONN, " SELECT * FROM RCA_RES_CAT ");
                                                while( $ROW2 = mysqli_fetch_array( $QR2 ) ) {
                                            ?>
                                                <option <?php if( $ROW2[ 'RCA_ID' ] == $ROW[ 'RMO_CAT' ] ) echo "selected"?> value="<?= $ROW2[ 'RCA_ID' ]; ?>"><?= $ROW2[ 'RCA_NOME' ]; ?></option>
                                            <?php }?>
                                        </select>&nbsp;|&nbsp;
                                            <b style="color: rgb( 197, 237, 255 ); font-weight: 600;">Valor:</b> R$&nbsp;<input class="money" id="money" type="text" value="<?= $ROW[ 'RMO_VALOR' ]; ?>" name="valor" size="10" maxlength="9" data-precision="2" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" />
                                            <br/>
                                            <b style="color: rgb( 197, 237, 255 ); font-weight: 600;">Descricao:</b> <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="descricao" value="<?= $ROW[ 'RMO_DESCRICAO' ]; ?>" size="70" maxlength="255" />
                                            <input type="submit" class="input" value="Alterar" />
                                    </form>
                                    <div style="text-align: right">
                                        <a style="color: rgb( 231, 185, 184 ); font-weight: 800;" onclick="return confirm('Tem certeza que deseja apagar?')" href="index.php?pg=funds/fun_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar&id=<?= $ROW[ 'RMO_ID' ]; ?>" title="Remover">[remover]</a>
                                    </div>
                                    <hr/>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <h4  style="text-align: right; color:<?php if( $RESULTADO_MES < 0 ) echo "rgb( 231, 185, 184 )"; else echo "rgb( 197, 237, 255 )"; ?>">SALDO TOTAL:&nbsp; <?= formata_dinheiro( $RESULTADO_MES ); ?></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
<!-- ==================================================== // -->
            </div><!-- /.container-fluid -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'fun_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>