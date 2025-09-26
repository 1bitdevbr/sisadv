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
  if( ( $_SERVER[ "REQUEST_METHOD" ] == "GET" ) && ( isset( $_GET[ 'ACTION' ] ) ) && ( $_GET[ 'ACTION' ] == 'PRINT' ) ) {
    $ID = (int) $_GET[ 'NOT_FK_CLIENT' ];
    $NOT_ID = (int) $_GET[ 'NOT_ID' ];

    $SQL = " SELECT C.*, P.PAS_ID, P.PAS_NOME
               FROM CLI_CLIENTES C
               JOIN STA_STATUS S ON C.CLI_FK_STATUS = S.STA_ID
               JOIN PAS_PROC_PASTA P ON C.CLI_FK_PASTA = P.PAS_ID
              WHERE C.CLI_ID = '$ID'
           ORDER BY C.CLI_ID DESC ";

    $RESULTADO = mysqli_query( $CONN, $SQL );
    $DADOS     = mysqli_fetch_array( $RESULTADO );
    $CLIENTE   = $DADOS[ 'CLI_NOME' ];
    $CPF       = $DADOS[ 'CLI_CPF' ];
    $PASTA     = $DADOS[ 'PAS_NOME' ];

    $QR = "  SELECT DISTINCT
                    NTE.NOT_ID, NTE.NOT_NOTE, NTE.NOT_DT_CREATION, NTE.NOT_USER_CREATION,
                    CLI.CLI_ID, CLI.CLI_NOME,
                    PAS.PAS_NOME
               FROM NOT_NOTES NTE
          LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = NTE.NOT_FK_CLIENT
          LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
              WHERE CLI.CLI_ID = '$ID'
                AND NTE.NOT_ID = '$NOT_ID'
           ORDER BY NOT_DT_CREATION DESC ";

    $RES    = mysqli_query( $CONN, $QR );
    $NOT    = mysqli_fetch_array( $RES );
    $NOTA   = $NOT[ 'NOT_NOTE' ];
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
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.2em; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase;"><?= $R[ 'CLI_OFFICE' ]; ?></span><br />
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-map-marker"></i>&nbsp;<?= $R[ 'CLI_ADDRESS' ]; ?>, <?= $R[ 'CLI_NUMBER' ]; ?> - <?= $R[ 'CLI_NEIGHBORHOOD' ]; ?></span><br />
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-map"></i>&nbsp;<?= $R[ 'CLI_CITY' ]; ?>/<?= $R[ 'CLI_STATE' ]; ?></span><br />
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-envelope"></i>&nbsp;<?php if( !empty( $R[ 'CLI_ZIPCODE' ] ) ) { echo mask( $R[ 'CLI_ZIPCODE' ], '##.###-###' ); } else { echo ''; }  ?></span><br />
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-phone"></i>&nbsp;<?php if( !empty( $R[ 'CLI_PHONE' ] ) ) { echo mask( $R[ 'CLI_PHONE' ], '## | #####-####' ); } else { echo ''; }  ?> - <i class="fas fa-mobile"></i>&nbsp;<?php if( !empty( $R[ 'CLI_CELLPHONE' ] ) ) { echo mask( $R[ 'CLI_CELLPHONE' ], '## | #####-####' ); } else { echo ''; }  ?></span><br />
              <span style="line-height: 1.0rem; color: rgb( 0, 0, 0 ); font-size: 1.0em; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;"><i class="fas fa-globe"></i>&nbsp;<?php if( !empty( $R[ 'CLI_SITE' ] ) ) { echo $R[ 'CLI_SITE' ]; } else { echo ''; }  ?> - <i class="fas fa-envelope"></i>&nbsp;<?php if( !empty( $R[ 'CLI_EMAIL' ] ) ) { echo $R[ 'CLI_EMAIL' ]; } else { echo ''; }  ?></span>
            </div>
          </div>

          <hr style="width: auto; height: 1px; text-align: center; border: 1px; color: rgb( 144, 164, 174 ); background: rgb( 144, 164, 174 );" />

          <!--// TÍTULO DO DOCUMENTO //-->
          <div class="mt-2 mb-2 text-center">
            <legend style="font-size: 1em; letter-spacing: 0.1em; line-height: 1.0em; color: rgb( 0, 0, 0 ); font-weight: 700; text-align: center; text-transform: uppercase;">
              REGISTRO DE ATENDIMENTO
            </legend>
          </div>

          <br />

          <!-- /.CLIENTE -->
          <div class="mt-2 mb-2 text-left">
            <span style="font-size: 1em; text-transform: uppercase; letter-spacing: 0.1em; color: rgb( 0, 0, 0 );">
              Cliente: <?= $CLIENTE; ?><br />Pasta: <?= $PASTA; ?>
            </span>
          </div>

          <br />

          <!--// 1. NOTA //-->
          <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
            <div class="col-sm-12" style="font-size: 0.8em; letter-spacing: 0.1em; color: rgb( 0, 0, 0 );">
              <?= $NOTA; ?>
            </div>
          </div>

          <br />

          <!--// 2. DATA //-->
          <div style="font-size: 0.8em; letter-spacing: 0.1em; color: rgb( 0, 0, 0 );">
            <span style="font-weight: light;"><?= ucwords( strtolower( $CLIENT_CITY ) ); ?>, <?= date( 'd' ); ?> de <?= strtolower( mostraMes( date( 'm' ) ) ); ?> de <?= date( 'Y' ); ?>.</span>
            <br />
            <p style="font-size: 1em; letter-spacing: 0.1em; color: rgb( 0, 0, 0 );">De acordo:</p>
            <br /><br />
            <div class="float-left d-none d-sm-inline-block col-sm-6" style="border-top: 1px dashed rgb( 55, 67, 81 );">
              <span style="font-size: 1em; letter-spacing: 0.1em; font-weight: 700;"><?= $CLIENTE; ?><br />CPF nº: <?= mask( $CPF, '###.###.###-##' ); ?></span>
            </div>
          </div>
          
          <br /><br /><br />
          <!--// 3. RODAPE //-->
          <?php require_once(__DIR__ . '/../footerSys.php'); ?>

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
<script language="javascript">document.addEventListener("DOMContentLoaded", function(){ downloadPDF(); } );</script>
<?= "<script language=\"javascript\">setTimeout(function () { window.location.href = '?pg=clients/clien_view&id=$ID'; }, 1000);</script>"; ?>
<!-- FIM GERANDO PDF ======================================================-->