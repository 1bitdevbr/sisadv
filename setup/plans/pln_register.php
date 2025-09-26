<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 4;
  require_once(__DIR__ . '/../../access/level.php');
  require_once(__DIR__ . '/../../access/conn.php');
  require_once(__DIR__ . '/../../config.php');

  if( isset( $_GET[ 'id' ] ) ) {
    $ID = $_GET[ 'id' ];

    $SQL = " SELECT *
               FROM SYS_PLANS
              WHERE PLN_ID = '$ID' ";

    $ROW = mysqli_query( $CONN1, $SQL );
    $DADOS = mysqli_fetch_array( $ROW );
  }
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'pln_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

      <!--// CLIENT MENU //-->
			<?php require 'pln_menu.php'; ?>

      <!-- INÍCIO -->
      <div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->

        <div class="container"><!-- title row -->
          <div class="row col-12">
              <div class="form-group col-sm-2">

              </div>
              <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                  <legend><?= $plnSubtitle; ?></legend>
              </div>
              <div class="form-group col-sm-2">

              </div>
          </div>
          <!-- /.col -->
        </div>

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <div class="container-fluid">

          <form action="?pg=setup/plans/pln_insert" method="POST">

            <center><legend style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 255, 255, 255 );">Adicionar Plano</legend></center>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="PLN_ID" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">#ID</label>
                <input type="text" class="form-control" id="PLN_ID" name="PLN_ID" readonly />
              </div>
              <div class="form-group col-md-2">
                <label for="PLN_NAME" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">PLANO</label>
                <input type="text" class="form-control" id="PLN_NAME" name="PLN_NAME" onkeyup="this.value = this.value.toUpperCase();" />
              </div>
              <div class="form-group col-md-6">
                <label for="PLN_DESCRIPTION" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">DESCRIÇÃO</label>
                <input type="text" class="form-control" id="PLN_DESCRIPTION" name="PLN_DESCRIPTION" onkeyup="this.value = this.value.toUpperCase();" />
              </div>
              <div class="form-group col-md-2">
                <label for="PLN_PRICE" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">VALOR</label>
                <input type="text" class="form-control money" id="PLN_PRICE" name="PLN_PRICE" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" />
              </div>
            </div>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-group" align="center">
              <button class="btn btn-danger btn-sm submit_btn" id="btn-insert" name="btn-insert" value="btn-insert" onclick="return confirm('Confirma o lançamento?')">Salvar&nbsp;<i class="fas fa-database"></i></button>
            </div>

          </form>

        </div><!-- /.container-fluid -->

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <?php require 'pln_footer.php'; ?>

      </div><!-- /.Invoice -->
      <!-- FIM -->

    </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php
	mysqli_close( $CONN1 );
?>