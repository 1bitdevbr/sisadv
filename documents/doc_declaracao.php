<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');

  // ======================================================================================= //
  // RECEBENDO DADOS VIA POST
  // ======================================================================================= //
  if( ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) && ( isset( $_POST[ 'ACTION' ] ) ) && ( $_POST[ 'ACTION' ] == 'DECLARACAO' ) ) {
    $ID = $_POST[ 'ID' ];
    $DDE_DECLARACAO = $_POST[ 'DDE_DECLARACAO' ];

    mysqli_query( $CONN, " UPDATE DOC_DECLARACAO SET DDE_DECLARACAO = '$DDE_DECLARACAO' " );
    echo mysqli_error( $CONN );

    $SQL = mysqli_query( $CONN, " SELECT C.*, P.PAS_ID, P.PAS_NOME
                                    FROM CLI_CLIENTES C
                                    JOIN STA_STATUS S ON C.CLI_FK_STATUS = S.STA_ID
                                    JOIN PAS_PROC_PASTA P ON C.CLI_FK_PASTA = P.PAS_ID
                                   WHERE C.CLI_ID = '$ID'
                                ORDER BY C.CLI_ID DESC " );
    $DADOS = mysqli_fetch_array( $SQL );
  }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" style="max-width: 90%;">

        <!--// INÍCIO DO DOCUMENTO //-->
        <div class="invoice p-3 mt-3 mb-3">

            <div class="PDF container-fluid background" style="width: 98%; margin-right: 2px;">

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
                    <div class="col-auto">
                    <span><img class="logoCabecalho img-circle" src="<?= $LOGO; ?>"/></span>
                    </div>
                    <div class="cabecalho col justify-content-left align-items-left">
                    <span class="titulo"><?= $R[ 'CLI_OFFICE' ]; ?></span><br />
                    <span><i class="fas fa-map-marker"></i>&nbsp;<?= $R[ 'CLI_ADDRESS' ]; ?>, <?= $R[ 'CLI_NUMBER' ]; ?> - <?= $R[ 'CLI_NEIGHBORHOOD' ]; ?></span><br />
                    <span><i class="fas fa-map"></i>&nbsp;<?= $R[ 'CLI_CITY' ]; ?>/<?= $R[ 'CLI_STATE' ]; ?> -  <i class="fas fa-envelope"></i>&nbsp;<?php if( !empty( $R[ 'CLI_ZIPCODE' ] ) ) { echo mask( $R[ 'CLI_ZIPCODE' ], '##.###-###' ); } else { echo ''; }  ?></span><br />
                    <span>
                        <?php if( !empty( $R[ 'CLI_PHONE' ] ) ) { echo '<i class="fas fa-phone"></i>&nbsp;' . mask( $R[ 'CLI_PHONE' ], '## | #####-####' ) . ' - '; } else { echo ''; }  ?><?php if( !empty( $R[ 'CLI_CELLPHONE' ] ) ) { echo '<i class="fas fa-mobile"></i>&nbsp;' . mask( $R[ 'CLI_CELLPHONE' ], '## | #####-####' ); } else { echo ''; }  ?>
                    </span><br />
                    <span class="network">
                        <?php if( !empty( $R[ 'CLI_SITE' ] ) ) { echo '<i class="fas fa-globe"></i>&nbsp;' . strtolower($R[ 'CLI_SITE' ]); } else { echo ''; }  ?> <br /> <?php if( !empty( $R[ 'CLI_EMAIL' ] ) ) { echo '<i class="fas fa-envelope"></i>&nbsp;' . strtolower($R[ 'CLI_EMAIL' ]); } else { echo ''; }  ?>
                    </span>
                    </div>
                </div>

                <hr style="border-top: 1px solid rgb( 55, 67, 81 );" />

                <!--// TÍTULO DO DOCUMENTO //-->
                <div class="cabecalho mt-2 mb-2" style="text-align: center;">
                    <span class="titulo">DECLARAÇÃO DE HIPOSSUFICIÊNCIA</span>
                </div>

                <br />

                <!--// LAYOUT DO DOCUMENTO //-->
                <!--// 1. DECLARAÇÃO //-->
                <div class="row">
                    <div class="texto col-sm-12">
                        <p>
                            Eu, <span style="font-weight: 700;"><?= $DADOS[ 'CLI_NOME' ]; ?></span>,
                            <?php if( !empty( $DADOS[ 'CLI_NACIONALIDADE' ] ) && $DADOS[ 'CLI_NACIONALIDADE' ] != '' ) { echo strtolower( $DADOS[ 'CLI_NACIONALIDADE' ] ) . ','; } else { echo ''; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_PROFISSAO' ] ) && $DADOS[ 'CLI_PROFISSAO' ] != '' ) { echo strtolower( $DADOS[ 'CLI_PROFISSAO' ] ) . ','; } else { echo ''; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_EST_CIVIL' ] ) && $DADOS[ 'CLI_EST_CIVIL' ] != 'SELECIONE...' ) { echo strtolower( $DADOS[ 'CLI_EST_CIVIL' ] ) . ',';  } else { echo ''; } ?>
                            inscrito/a
                            <?php
                                if( !empty( $DADOS[ 'CLI_ORG_EMISSOR' ] ) && !empty( $DADOS[ 'CLI_RG' ] ) ) {
                                echo 'na Cédula de Identidade RG/'.$DADOS[ 'CLI_ORG_EMISSOR' ].', sob o nº '.mask( $DADOS[ 'CLI_RG' ], '##.###.###-#' ).', e ';
                                } elseif( empty( $DADOS[ 'CLI_ORG_EMISSOR' ] ) && !empty( $DADOS[ 'CLI_RG' ] ) ) {
                                echo 'na Cédula de Identidade RG sob o nº '.mask( $DADOS[ 'CLI_RG' ], '##.###.###-#' ).', e ';
                                } else {
                                echo '';
                                }
                            ?>
                            no CPF/MF sob o nº <?php $CLI_CPF = $DADOS[ 'CLI_CPF' ]; echo mask( $CLI_CPF, '###.###.###-##' ); ?>,
                            <?php if( !empty( $DADOS[ 'CLI_EMAIL' ] ) ) { echo 'e-mail: ' . $DADOS[ 'CLI_EMAIL' ] . ',';  } else { echo 'e-mail: não informado, '; } ?>
                            residente e domiciliado/a <?php if( !empty( $DADOS[ 'CLI_ENDERECO' ] ) ) { echo 'na ' . safe_ucwords($DADOS[ 'CLI_ENDERECO' ]) . ',';  } else { echo 'na <b>não informado, </b>'; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_NUMERO' ] ) ) { echo 'nº ' . $DADOS[ 'CLI_NUMERO' ] . ',';  } else { echo 'nº <b>não informado, </b>'; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_COMPLEMENTO' ] ) ) { echo safe_ucwords($DADOS[ 'CLI_COMPLEMENTO' ]) . ',';  } else { echo ''; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_BAIRRO' ] ) ) { echo safe_ucwords($DADOS[ 'CLI_BAIRRO' ]) . ',';  } else { echo ''; } ?>
                            <?php if( !empty( $DADOS[ 'CLI_CEP' ] ) ) { echo 'CEP nº ' . mask( $DADOS[ 'CLI_CEP' ], '##.###-###' ) . ',';  } else { echo ''; } ?>
                            na cidade de <?= safe_ucwords($DADOS[ 'CLI_CIDADE' ]); ?>/<?= $DADOS[ 'CLI_UF' ]; ?>.
                            <br /><br />
                            <?= $DDE_DECLARACAO; ?>
                        </p>
                    </div>
                </div>

                <!--// 2. DATA //-->
                <div class="data mt-2">
                    <span>
                        <?= ucwords( strtolower( $CLIENT_CITY ) ); ?>, <?= date( 'd' ); ?> de
                        <?= strtolower( mostraMes( date( 'm' ) ) ); ?> de
                        <?= date( 'Y' ); ?>.
                    </span>
                </div>

                <!--// 3. ASSINATURA //-->
                <div class="assinatura mt-5">
                    <span style="font-weight: 700;"><?= $DADOS[ 'CLI_NOME' ]; ?></span>
                </div>

                <!--// 4. RODAPE //-->
                <div class="mt-3">
                    <?php require_once(__DIR__ . '/../footerSys.php'); ?>
                </div>

            </div><!-- /.End Container-fluid -->

        </div><!-- /.Invoice -->
        <!--// FIM DO DOCUMENTO //-->

    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->

<?php
  mysqli_close( $CONN );
  mysqli_close( $CONN1 );
?>
<script language="javascript">document.addEventListener("DOMContentLoaded", function(){ downloadPDF(); } );</script>
<?= "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$ID'; }, 1000);</script>"; ?>
<!-- FIM GERANDO PDF ======================================================-->