<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

	if( isset( $_GET[ 'id' ] ) && isset( $_GET[ 'parc' ] ) && isset( $_GET[ 'vlr' ] ) ) {
        $ID = $_GET[ 'id' ];
        $PARC = $_GET[ 'parc' ];
        $VLR_PAGO = $_GET[ 'vlr' ];
		$SQL = " SELECT * FROM PPR_PROC_PROCESSOS WHERE PPR_ID = '$ID' ";
		$RESULTADO = mysqli_query( $CONN, $SQL );
		$DADOS = mysqli_fetch_array( $RESULTADO );
        $PPR_PARTE_CONTRARIA = $DADOS[ 'PPR_PARTE_CONTRARIA' ];
        $PPR_NUM_PROCESSO = $DADOS[ 'PPR_NUM_PROCESSO' ];
        $PPR_COMARCA = $DADOS[ 'PPR_COMARCA' ];
        $PPR_TIPO_ACAO = $DADOS[ 'PPR_TIPO_ACAO' ];
	}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: rgb( 255, 255, 255 );"><!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" style="background-color: rgb( 255, 255, 255 );">
		<div class="container-fluid" style="background-color: rgb( 255, 255, 255 );">

            <!--// INÍCIO DO DOCUMENTO //-->
            <!-- Invoice -->
            <div class="invoice p-3 mt-3 mb-3" style="background-color: rgb( 255, 255, 255 );">

                <div class="PDF container-fluid" style="background-color: rgb( 255, 255, 255 );">
                    
                    <?php
                        $SQL = mysqli_query( $CONN1, " SELECT C.* FROM SYS_USERS U JOIN SYS_CLIENTS C ON C.CLI_ID = U.USR_FK_CLIENT WHERE U.USR_ID = '$USERS' ");
                        $R = mysqli_fetch_array( $SQL );
                        $CLIENT_CITY = $R[ 'CLI_CITY' ];
                        if( empty( $R[ 'CLI_LOGO' ] ) ) {
                            $LOGO = 'dist/img/logo/logo.png'; 
                        } else {
                            $LOGO = 'dist/img/logo/' . $R[ 'CLI_LOGO' ] . ''; 
                        }                        
                    ?>                    

                    <div class="row">
                        <div class="col-sm-3" align="center">
                            <span><img class="img-circle" src="<?= $LOGO; ?>" style="width: 150px; heigth: 150px;"/></span>
                        </div>
                        <div class="col justify-content-left align-items-left" style="text-align: left;">
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.5em; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase;"><?= $R[ 'CLI_OFFICE' ]; ?></span><br />
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-map-marker"></i>&nbsp;<?= $R[ 'CLI_ADDRESS' ]; ?>, <?= $R[ 'CLI_NUMBER' ]; ?> - <?= $R[ 'CLI_NEIGHBORHOOD' ]; ?></span><br />
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-map"></i>&nbsp;<?= $R[ 'CLI_CITY' ]; ?>/<?= $R[ 'CLI_STATE' ]; ?></span><br />
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-envelope"></i>&nbsp;<?php if( !empty( $R[ 'CLI_ZIPCODE' ] ) ) { echo mask( $R[ 'CLI_ZIPCODE' ], '##.###-###' ); } else { echo ''; }  ?></span><br />
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-phone"></i>&nbsp;<?php if( !empty( $R[ 'CLI_PHONE' ] ) ) { echo mask( $R[ 'CLI_PHONE' ], '## | #####-####' ); } else { echo ''; }  ?> - <i class="fas fa-mobile"></i>&nbsp;<?php if( !empty( $R[ 'CLI_CELLPHONE' ] ) ) { echo mask( $R[ 'CLI_CELLPHONE' ], '## | #####-####' ); } else { echo ''; }  ?></span><br />
                            <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-globe"></i>&nbsp;<?php if( !empty( $R[ 'CLI_SITE' ] ) ) { echo $R[ 'CLI_SITE' ]; } else { echo ''; }  ?> - <i class="fas fa-envelope"></i>&nbsp;<?php if( !empty( $R[ 'CLI_EMAIL' ] ) ) { echo $R[ 'CLI_EMAIL' ]; } else { echo ''; }  ?></span>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid rgb( 55, 67, 81 );" />

                    <!--// TÍTULO DO DOCUMENTO //-->
                    <div style="text-align: center;">
                        <legend style="line-height: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">
                            RECIBO DE PAGAMENTO
                        </legend>
                    </div>

                    <hr style="border-top: 1px solid rgb( 55, 67, 81 );" />

                    <!--// LAYOUT DO DOCUMENTO //-->
                    <div class="">

                        <!--// 1. INFORMAÇÕES GERAIS //-->
                        <legend class="scheduler-border" style="color: rgb( 0, 0, 0 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">&nbsp;1. DESCRIÇÃO</legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <?php
                                    $SQL = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ");
                                    while( $ROW = mysqli_fetch_array( $SQL ) ) {
                                        if( $DADOS[ 'PPR_FK_CLIENTE' ] == $ROW[ 'CLI_ID' ] ) {
                                            $FK_CLIENT_NAME = $ROW[ 'CLI_NOME' ];
                                        }
                                    }
                                ?>
                                <label  style="font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_FK_CLIENTE">Cliente:</label>
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );">&nbsp;<?= $FK_CLIENT_NAME; ?></span>
                            </div>
                            <div class="col-sm-4 text-right">
                                <label  style="font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_COMARCA">Comarca:</label>
                                <span style="background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );">&nbsp;<?= $PPR_COMARCA; ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label  style="font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_PARTE_CONTRARIA">Parte Contrária:</label>
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );">&nbsp;<?= $PPR_PARTE_CONTRARIA; ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label  style="font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_TIPO_ACAO">Procedimento:</label>
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );">&nbsp;<?= $PPR_TIPO_ACAO; ?></span>
                            </div>
                            <div class="col-sm-6 text-right">
                                <label  style="font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_NUM_PROCESSO">Proc:</label>
                                <span style="background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );">&nbsp;<?= processNumber( "#######-##.####.#.##.####" , $PPR_NUM_PROCESSO ); ?></span>
                            </div>
                        </div>

                        <br />

                        <!--// 2. INFORMAÇÕES SOBRE O CONTRATO //-->
                        <legend class="scheduler-border" style="color: rgb( 0, 0, 0 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">&nbsp;2. INFORMAÇÕES SOBRE O CONTRATO</legend>

                        <div class="row" style="justify-content: center; align-items: center; vertical-align: middle; text-align: center;">

                            <div class="col-12 col-sm-6 col-md-2"><!--// DATA //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_DT_CONTRATO">DATA CONTRATO</label><br />
                                <span style="background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );"><?= date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_CONTRATO' ] ) ); ?></span>
                            </div><!-- /.col -->

                            <div class="col-12 col-sm-6 col-md-2"><!--// VALOR //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_VALOR">VALOR CONTRATO</label><br />
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );"><?= formata_dinheiro( $DADOS[ 'PPR_VALOR' ] ); ?></span>
                            </div><!-- /.col -->

                            <div class="col-12 col-sm-6 col-md-2"><!--// NR PARCELAS //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_QTD_PARCELA">NÚMERO PARCELAS</label><br />
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );"><?= $DADOS[ 'PPR_QTD_PARCELA' ]; ?></span>
                            </div><!-- /.col -->

                            <div class="col-12 col-sm-6 col-md-2"><!--// VR PARCELA //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_VALOR_PARCELA">VALOR PARCELA</label><br />
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );"><?= formata_dinheiro( $DADOS[ 'PPR_VALOR_PARCELA' ] ); ?></span>
                            </div><!-- /.col -->

                            <div class="col-12 col-sm-6 col-md-2"><!--// INICIO PGTO //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_DT_INICIO_PGTO">INÍCIO PAGAMENTO</label><br />
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); color: rgb( 0, 0, 0 );"><?= ( $DADOS[ 'PPR_DT_INICIO_PGTO' ] != 0000-00-00 ? date( "d/m/Y", strtotime( $DADOS[ 'PPR_DT_INICIO_PGTO' ] ) ) : '' ); ?></span>
                            </div><!-- /.col -->

                            <div class="col-12 col-sm-6 col-md-2"><!--// SALDO //-->
                                <label  style="background-color: rgb( 229, 229, 229 ); font-size: 0.9em; color: rgb( 0, 0, 0 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" class="label" for="PPR_SALDO">SALDO DEVEDOR</label><br />
                                <span style="font-size: 0.9em; background-color: rgb( 255, 255, 255 ); font-weight: 700; color: rgb( 0, 0, 0 );"><?= formata_dinheiro( $DADOS[ 'PPR_SALDO' ] ); ?></span>
                            </div><!-- /.col -->

                        </div><!-- /.row -->

                        <br />

                        <!--// FORMA DE PAGAMENTO //-->
                        <!-- <div class="row justify-content-center align-items-center" style="background-color: rgb( 229, 229, 229 );">
                            <h5 style="line-height: 1.2em; color: rgb( 0, 0, 0 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">FORMA DE PAGAMENTO</h5>
                        </div> -->

                        <!--// INFORMAÇOES DE PAGAMENTO //-->
                        <!-- <div class="row justify-content-center align-items-center">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Parcela</th>
                                        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
                                        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); letter-spacing: 0.1em; text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $FK_PROCESSO = $_GET[ 'id' ];
                                        $SQL = " SELECT PPP.*
                                                            FROM PPP_PROC_PROCESSOS_PGTO PPP
                                                        WHERE PPP.PPP_FK_PROCESSO = '$FK_PROCESSO'
                                                        ";
                                        $R = mysqli_query( $CONN, $SQL );
                                        while( $ROW = mysqli_fetch_assoc( $R ) ) { ?>
                                    <tr>
                                        <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); text-transform: uppercase; font-weight: 600;"><?= $ROW[ 'PPP_NR_PARCELA' ]; ?></th>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); text-transform: uppercase; font-weight: 600;"><?= formata_dinheiro( $ROW[ 'PPP_VALOR' ] ); ?></td>
                                        <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 0, 0, 0 ); text-transform: uppercase; font-weight: 600;"><?= date("d/m/Y", strtotime( $ROW[ 'PPP_DT_VENCIMENTO' ] ) ); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> -->

                        <!--// 3. TERMO DE QUITAÇÃO DE PARCELA //-->
                        <legend class="scheduler-border" style="color: rgb( 0, 0, 0 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">&nbsp;3. TERMO DE QUITAÇÃO DE PARCELA</legend>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <span style="color: rgb( 0, 0, 0 );">Recebemos de <strong><?= $FK_CLIENT_NAME; ?></strong>, a importância de <strong><?= formata_dinheiro( $VLR_PAGO ) . '&nbsp;(' . extenso( $VLR_PAGO ) . '&nbsp;)'; ?></strong>,
                                    referente a parcela <strong><?= $PARC; ?></strong>, do contrato supramencionado, conferindo-lhe caráter de quitação da referida parcela.
                                </span>
                                <?php
                                    $SQL = mysqli_query( $CONN, " SELECT PPP.PPP_VALOR FROM PPP_PROC_PROCESSOS_PGTO PPP WHERE PPP.PPP_FK_PROCESSO = '$ID' ");
                                    $R = mysqli_fetch_array( $SQL );
                                    $VLR_PARCELA = $R[ 'PPP_VALOR' ];
                                    if( $VLR_PAGO < $VLR_PARCELA ) {
                                        echo '<br /><sub style="color: rgb( 0, 0, 0 ); font-weight: 600; letter-spacing: 0.1em;"><em>* Em caso de pagamento inferior ao valor da parcela, o ajuste do saldo devedor será feito na parcela final.</em></sub>';
                                    } elseif( $VLR_PAGO > $VLR_PARCELA ) {
                                        echo '<br /><sub style="color: rgb( 0, 0, 0 ); font-weight: 600; letter-spacing: 0.1em;"><em>* Em caso de pagamento superior ao valor da parcela, o ajuste do saldo devedor será feito na parcela final.</em></sub>';
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </div>
                        </div>

                        <!--// 4. DATA //-->
                        <div>
                            <span style="font-size: 1.0em; color: rgb( 0, 0, 0 ); font-weight: light;"><?= ucwords( strtolower( $CLIENT_CITY ) ); ?>, <?= date( 'd' ); ?> de <?= strtolower( mostraMes( date( 'm' ) ) ); ?> de <?= date( 'Y' ); ?>.</span>
                            <br /><br /><br />
                            <div class="float-left d-none d-sm-inline-block col-sm-6" style="border-top: 1px solid rgb( 55, 67, 81 );">
                                <span style="color: rgb( 0, 0, 0 );">Assinatura</span>
                            </div>
                        </div>
                        <br />

                        <!--// 5. RODAPE //-->
                        <div class="text-right" style="border-top: 0px solid rgb( 55, 67, 81 );">
                            <small style="color: rgb( 0, 0, 0 ); font-weight: light;">Gerenciado por: <strong>sisadv.com.br</strong></small>
                        </div>

                    </div>

                </div><!-- /.container-fluid -->

            </div><!-- /.Invoice -->

         <!--// FIM DO DOCUMENTO //-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->

<?php
    mysqli_close( $CONN );
    mysqli_close( $CONN1 );
?>

<!-- INICIO GERANDO PDF ======================================================-->
<!--
    // Font //
    https://ekoopmans.github.io/html2pdf.js/

    // Incluir no header //
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    // Incluir a classe PDF na DIV que possui o conteúdo a ser gerado PDF //
    <div class="PDF">  </div>

    // Incluir no JS //
    <script>
        function downloadPDF() {
            const item = document.querySelector(".Content");
            var opt = {
            margin: 1,
            filename: "recibo.pdf",
            html2canvas: { scale: 2 },
            jdPDF: { unit: "in", format: "A4", orientation: "portrait" },
            };
            html2pdf().set(opt).from(item).save();
    }
    </script>
-->

<script language="javascript">
    //window.onload = downloadPDF();
    document.addEventListener("DOMContentLoaded", function(){ downloadPDF(); } );
    //window.addEventListener("load", window.print());
</script>

<?= "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=cases/cas_view&id=$ID'; }, 1000);</script>"; ?>

<!-- FIM GERANDO PDF ======================================================-->