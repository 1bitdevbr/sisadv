<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');

  if( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];

    $SQL = " SELECT * FROM PPR_PROC_PROCESSOS WHERE PPR_ID = '$id' ";
    $RESULTADO = mysqli_query( $CONN, $SQL );
    $DADOS = mysqli_fetch_array( $RESULTADO );
	}
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $caseSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <div class="container-fluid">

                    <form class="signin-form" formname="cases" action="?pg=cases/cas_reg_insert" method="POST">

                        <!-- PROCESSOS em GERAL -->
                        <div class="card-body">

                            <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações Gerais</legend>
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_CASO">#Caso</label>
                                    <input class="form-control" type="text" id="PPR_CASO" name="PPR_CASO" value="<?= $DADOS[ 'PPR_CASO' ]; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_STATUS">Status</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM STA_STATUS ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_STATUS' ] == $ROW[ 'STA_ID' ] ) {
                                                $FK_STATUS_NAME = $ROW[ 'STA_NAME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_STATUS" name="PPR_FK_STATUS" value="<?= $DADOS[ 'PPR_FK_STATUS' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_STATUS_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_HONORARIOS">Honorários</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM PHO_PROC_HONORARIOS ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_HONORARIOS' ] == $ROW[ 'PHO_ID' ] ) {
                                                $FK_HONORARIOS_NAME = $ROW[ 'PHO_NOME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_HONORARIOS" name="PPR_FK_HONORARIOS" value="<?= $DADOS[ 'PPR_FK_HONORARIOS' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_HONORARIOS_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_DEFENSORIA">Defensoria</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM PDE_PROC_DEFENSORIA ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == $ROW[ 'PDE_ID' ] ) {
                                                $FK_DEFENSORIA_NAME = $ROW[ 'PDE_NOME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_DEFENSORIA" name="PPR_FK_DEFENSORIA" value="<?= $DADOS[ 'PPR_FK_DEFENSORIA' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_DEFENSORIA_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_PASTA">Pasta</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM PAS_PROC_PASTA ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_PASTA' ] == $ROW[ 'PAS_ID' ] ) {
                                                $FK_PASTA_NAME = $ROW[ 'PAS_NOME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_PASTA" name="PPR_FK_PASTA" value="<?= $DADOS[ 'PPR_FK_PASTA' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_PASTA_NAME; ?>" readonly />
                                </div>
                            </div>

                            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" for="PPR_FK_CLIENTE">Cliente:</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME, CLI_TELEFONE, CLI_CELULAR FROM CLI_CLIENTES ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_CLIENTE' ] == $ROW[ 'CLI_ID' ] ) {
                                                $FK_CLIENT_NAME = $ROW[ 'CLI_NOME' ];
                                                $CLI_TELEFONE = $ROW[ 'CLI_TELEFONE' ];
                                                $CLI_CELULAR = $ROW[ 'CLI_CELULAR' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_CLIENTE" name="PPR_FK_CLIENTE" value="<?= $DADOS[ 'PPR_FK_CLIENTE' ]; ?>" readonly />
                                    <input class="form-control" type="text" value="<?= $FK_CLIENT_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="CLI_TELEFONE">Telefone</label>
                                    <input class="form-control" type="text" id="CLI_TELEFONE" name="CLI_TELEFONE" value="<?php if( !empty( $CLI_TELEFONE ) ) { echo mask( $CLI_TELEFONE, '(##) #####-####' ); } else { echo ''; } ?>" readonly />
                                </div>
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="CLI_CELULAR">Celular</label>
                                    <input class="form-control" type="text" id="CLI_CELULAR" name="CLI_CELULAR" value="<?php if( !empty( $CLI_CELULAR ) ) { echo mask( $CLI_CELULAR, '(##) #####-####' ); } else { echo ''; } ?>" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label style="color: rgb( 205, 205, 205 );" class="label">Parte Contrária</label>
                                    <input class="form-control" type="text" id="PPR_PARTE_CONTRARIA" name="PPR_PARTE_CONTRARIA" value="<?= $DADOS[ 'PPR_PARTE_CONTRARIA' ]; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_NUM_PROCESSO">Número do Processo</label>
                                    <input class="form-control" type="text" id="PPR_NUM_PROCESSO" name="PPR_NUM_PROCESSO" value="<?= processNumber( "#######-##.####.#.##.####" , $DADOS[ 'PPR_NUM_PROCESSO' ] ); ?>" readonly />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_COMARCA">Comarca</label>
                                    <input class="form-control" type="text" id="PPR_COMARCA" name="PPR_COMARCA" value="<?= $DADOS[ 'PPR_COMARCA' ]; ?>" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );">Natureza da Ação</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM PNA_PROC_NATUREZA ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_NATUREZA' ] == $ROW[ 'PNA_ID' ] ) {
                                                $FK_NATUREZA_NAME = $ROW[ 'PNA_NOME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_NATUREZA" name="PPR_FK_NATUREZA" value="<?= $DADOS[ 'PPR_FK_NATUREZA' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_NATUREZA_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_MEIO">Digital/Físico</label>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT * FROM PME_PROC_MEIO ");
                                        while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                            if( $DADOS[ 'PPR_FK_MEIO' ] == $ROW[ 'PME_ID' ] ) {
                                                $FK_MEIO_NAME = $ROW[ 'PME_NOME' ];
                                            }
                                        }
                                    ?>
                                    <input class="form-control" type="hidden" id="PPR_FK_MEIO" name="PPR_FK_MEIO" value="<?= $DADOS[ 'PPR_FK_MEIO' ]; ?>" />
                                    <input class="form-control" type="text" value="<?= $FK_MEIO_NAME; ?>" readonly />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_TIPO_ACAO">Tipo de Ação</label>
                                    <input class="form-control" type="text" id="PPR_TIPO_ACAO" name="PPR_TIPO_ACAO" value="<?= $DADOS[ 'PPR_TIPO_ACAO' ]; ?>" readonly />
                                </div>
                            </div>

                        <!-- INFORMAÇÕES DO CONTRATO -->
                        <?php if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == 2 ) { ?>
                            <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações do Contrato</legend>

                            <!--// INICIO DO BLOCO DE INFORMAÇÕES DO CONTRATO //-->
                            <div class="row" style="justify-content: center; align-items: center; vertical-align: middle;">

                                <div class="col-12 col-sm-6 col-md-2"><!--// DATA //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">DATA DO CONTRATO</span>
                                            <span class="info-box-number">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_CONTRATO" value="<?= date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_CONTRATO' ] ) ) ?>" readonly />
                                                </div>
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <div class="col-12 col-sm-6 col-md-2"><!--// VALOR //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">VALOR DO CONTRATO</span>
                                            <span class="info-box-number">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    <input class="form-control" style="text-align: center;" type="text" name="PPR_VALOR" value="<?= formata_dinheiro( $DADOS[ 'PPR_VALOR' ] ) ?>" readonly />
                                                </div>
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <div class="col-12 col-sm-6 col-md-2"><!--// NR PARCELAS //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">NÚMERO DE PARCELAS</span>
                                            <span class="info-box-number">
                                                <input class="form-control" style="text-align: center;" type="text" name="PPR_QTD_PARCELA" value="<?= $DADOS[ 'PPR_QTD_PARCELA' ] ?>" readonly />
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <div class="col-12 col-sm-6 col-md-2"><!--// VR PARCELA //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">VALOR DA PARCELA</span>
                                            <span class="info-box-number">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    <input class="form-control" style="text-align: center; font-weight: 700; color: rgb( 205, 205, 205 );" type="text" id="PPR_VALOR_PARCELA" name="PPR_VALOR_PARCELA" value="<?= formata_dinheiro( $DADOS[ 'PPR_VALOR_PARCELA' ] ) ?>" readonly />
                                                </div>
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <div class="col-12 col-sm-6 col-md-2"><!--// INICIO PGTO //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">INÍCIO DO PAGAMENTO</span>
                                            <span class="info-box-number">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_INICIO_PGTO" value="<?= ( $DADOS[ 'PPR_DT_INICIO_PGTO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_INICIO_PGTO' ] ) ) : '' ) ?>" readonly />
                                                </div>
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <div class="col-12 col-sm-6 col-md-2"><!--// SALDO //-->
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text badge badge-danger" style="font-size: 1.0rem; line-height: 0.9em; color: rgb( 255, 199, 240, 20 ); font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">SALDO DEVEDOR</span>
                                            <span class="info-box-number">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    <input class="form-control" style="text-align: center; font-weight: 700; color: rgb( 255, 199, 240, 20 );" type="text" id="PPR_SALDO" name="PPR_SALDO" value="<?= formata_dinheiro( $DADOS[ 'PPR_SALDO' ] ) ?>" readonly />
                                                </div>
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                            </div><!-- /.row -->

                            <?php if( $DADOS[ 'PPR_QTD_PARCELA' ] > 0 ) { ?>

                            <!--// HISTÓRICO DE PAGAMENTOS //-->
                            <hr style="width: auto; height: 1px; text-align: center; border: 0px; color: rgb( 52, 58, 64 ); background: rgb( 52, 58, 64);" />
                            <div class="row  justify-content-center align-items-center">
                                <h5 style="line-height: 1.2em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Histórico de pagamentos</h5>
                            </div>

                            <!--// INFORMAÇOES DE PAGAMENTO //-->
                            <div class="row table-responsive justify-content-center align-items-center">
                                <table id="example1" class="table table-dark table-striped table-hover table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Parcela</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data Vencimento</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor Devido</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data Pagamento</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor Pago</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Status</th>
                                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $FK_PROCESSO = $_GET[ 'id' ];
                                            $SQL = " SELECT PPP.*
                                                            FROM PPP_PROC_PROCESSOS_PGTO PPP
                                                        WHERE PPP.PPP_FK_PROCESSO = '$FK_PROCESSO'
                                                    ORDER BY PPP.PPP_DT_VENCIMENTO DESC
                                                        ";
                                            $R = mysqli_query( $CONN, $SQL );
                                            while( $ROW = mysqli_fetch_assoc( $R ) ) { ?>
                                        <tr>
                                            <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;"><?= $ROW[ 'PPP_NR_PARCELA' ]; ?></th>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;"><?= date("d/m/Y", strtotime( $ROW[ 'PPP_DT_VENCIMENTO' ] ) ); ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;"><?= formata_dinheiro( $ROW[ 'PPP_VALOR' ] ); ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;"><?php if( $ROW[ 'PPP_DT_PGTO' ] != '0000-00-00' ) { echo date("d/m/Y", strtotime( $ROW[ 'PPP_DT_PGTO' ] ) ); } else { echo ''; } ?></td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;"><?= formata_dinheiro( $ROW[ 'PPP_VLR_PAGO' ] ); ?></td>

                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-weight: 600;">
                                                <?php
                                                    if( !isset( $ROW[ 'PPP_STATUS' ] ) OR ( $ROW[ 'PPP_STATUS' ] != 0 ) OR ( !empty( $ROW[ 'PPP_STATUS' ] ) ) ) {
                                                        echo '<h7 style="font-size: 1.1rem; color: rgb( 255, 255, 255 ); background: rgb( 220, 53, 69 ); letter-spacing: 0.1em; text-align: center; text-transform: uppercase; border-radius: 10px 10px 10px 10px;">&nbsp;<i class="fas fa-times-circle"></i>&nbsp;Pendente&nbsp;</h7>';
                                                    } else {
                                                        echo '<h7 style="font-size: 1.1rem; color: rgb( 33, 37, 41 ); background:rgb( 57, 255, 20, 90 ); letter-spacing: 0.1em; text-align: center; text-transform: uppercase; border-radius: 10px 10px 10px 10px;">&nbsp;<i class="fas fa-check-circle"></i>&nbsp;Pago&nbsp;</h7>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
                                                <?php if( !isset( $ROW[ 'PPP_STATUS' ] ) OR ( $ROW[ 'PPP_STATUS' ] != 0 ) OR ( !empty( $ROW[ 'PPP_STATUS' ] ) ) ) { echo '<a href="?pg=cases/cas_launch&id=' . $DADOS[ 'PPR_ID' ] . '&parc=' . $ROW[ 'PPP_NR_PARCELA' ] . '" class="btn btn-sm btn-outline-info" title="Lançar pagamento"><i class="fas fa-dollar-sign" style="text-transform: uppercase; letter-spacing: 0.1em; text-align: center;">&nbsp;Pagar</i></a>'; } else{ echo '<a href="?pg=cases/cas_receipt&id=' . $DADOS[ 'PPR_ID' ] . '&parc=' . $ROW[ 'PPP_NR_PARCELA' ] . '&vlr=' . $ROW[ 'PPP_VLR_PAGO' ] . '" class="btn btn-default btn-sm" title="Emitir Recibo"><i class="fas fa-print" style="text-transform: uppercase; letter-spacing: 0.1em; text-align: center;">&nbsp;Recibo</i></a>'; }?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr style="width: auto; height: 1px; text-align: center; border: 0px; color: rgb( 52, 58, 64 ); background: rgb( 52, 58, 64 );" />

                            <?php } } ?>

                            <!-- PROCESSOS DE CONVÊNIOS DPE-OAB/SP -->
                            <?php
                            if( $DADOS[ 'PPR_FK_DEFENSORIA' ] == 1 ) { ?>
                                <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Informações do Convênio DPE-OAB/SP</legend>
                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_COD_ACAO">Código de Ação</label>
                                        <select class="form-control" name="PPR_FK_COD_ACAO">
                                        <?php
                                            $QR = mysqli_query( $CONN, " SELECT * FROM PTD_PROC_TABELA_DEF ");
                                            while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                            <option value="<?= $ROW[ 'PTD_ID' ]; ?>"<?php ( $DADOS[ 'PPR_FK_COD_ACAO' ] == $ROW[ 'PTD_ID' ] ? ' selected ' :  '' ) ?>><?= $ROW[ 'PTD_COD_ACAO' ]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );">Nomeação</label>
                                        <input class="form-control" style="text-align: center;" type="text" id="PPR_DT_NOMEACAO" name="PPR_DT_NOMEACAO" value="<?= ( $DADOS[ 'PPR_DT_NOMEACAO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_NOMEACAO' ] ) ) : '' ) ?>" readonly />
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );">Sentença</label>
                                        <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_PUB_SENTENCA" value="<?= ( $DADOS[ 'PPR_DT_PUB_SENTENCA' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_PUB_SENTENCA' ] ) ) : '' ) ?>" readonly />
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );">Transito</label>
                                        <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_TRANS_JULGADO" value="<?= ( $DADOS[ 'PPR_DT_TRANS_JULGADO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_TRANS_JULGADO' ] ) ) : '' ) ?>" readonly />
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );">Envio Certidão</label>
                                        <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_ENVIO_CERTIDAO" value="<?= ( $DADOS[ 'PPR_DT_ENVIO_CERTIDAO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_ENVIO_CERTIDAO' ] ) ) : '' ) ?>" readonly />
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label style="color: rgb( 205, 205, 205 );">Recebimento</label>
                                        <input class="form-control" style="text-align: center;" type="text" name="PPR_DT_RECEBIMENTO" value="<?= ( $DADOS[ 'PPR_DT_RECEBIMENTO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_RECEBIMENTO' ] ) ) : '' ) ?>" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label style="color: rgb( 205, 205, 205 );">Percentual pago</label>
                                        <select id="select" onChange="pSel(this.value);" class="form-control" name="PPR_FK_PERCENTUAL">
                                        <?php
                                            $QR = mysqli_query( $CONN, " SELECT * FROM PPE_PROC_PERCENTUAL ");
                                            while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                            <option value="<?= $ROW[ 'PPE_ID' ]; ?>"<?= ( $DADOS[ 'PPR_FK_PERCENTUAL' ] == $ROW[ 'PPE_ID' ] ? ' selected ' :  '' ) ?>><?= $ROW[ 'PPE_VALOR' ]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label style="color: rgb( 205, 205, 205 );">Valor da tabela</label>
                                        <input class="form-control" type="text" id="PPR_VALOR_TABELA" name="PPR_VALOR_TABELA" value="<?= formata_dinheiro( $DADOS[ 'PPR_VALOR_TABELA' ] ) ?>" readonly />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label style="color: rgb( 205, 205, 205 );">% Retenção INSS</label>
                                        <select class="form-control" name="PPR_FK_INSS">
                                        <?php
                                            $QR = mysqli_query( $CONN, " SELECT * FROM PIN_PROC_INSS ");
                                            while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                            <option value="<?= $ROW[ 'PIN_ID' ]; ?>"<?= ( $DADOS[ 'PPR_FK_INSS' ] == $ROW[ 'PIN_ID' ] ? ' selected ' :  '' ) ?>><?= $ROW[ 'PIN_PERCENTUAL' ]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- OBSERVAÇÕES -->
                            <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Observações</legend>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <textarea class="form-control" id="PPR_OBS" name="PPR_OBS" cols="20" rows="5" onkeyup="this.value = this.value.toUpperCase();" readonly ><?= $DADOS[ 'PPR_OBS' ]; ?></textarea>
                                </div>
                            </div>

                            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                            <div class="form-group" align="center">
                                <a href="?pg=cases/cas_edit&id=<?= $DADOS[ 'PPR_ID' ]; ?>" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-edit"></i>&nbsp;Editar</a>
                            </div>

                        </div>
                    </form>

                </div><!-- /.container-fluid -->

            </div><!-- /.Invoice -->

        </div><!-- /.End Container-fluid -->

    </section><!-- /.End Section -->

    <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>