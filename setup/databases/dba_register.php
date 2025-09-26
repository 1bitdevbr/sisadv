<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 4;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../config.php');
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'dba_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

      <!--// CLIENT MENU //-->
			<?php require 'dba_menu.php'; ?>

      <!-- INÍCIO -->
      <div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->

        <div class="container"><!-- title row -->
          <div class="row col-12">
              <div class="form-group col-sm-2">

              </div>
              <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                  <legend><?= $dbaSubtitle; ?></legend>
              </div>
              <div class="form-group col-sm-2">

              </div>
          </div>
          <!-- /.col -->
        </div>

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <div class="container-fluid">

          <form action="?pg=setup/databases/dba_insert" method="POST">

            <center><legend style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 255, 255, 255 );">Cadastro</legend></center>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="DBA_ID" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">#ID</label>
                <input type="text" class="form-control" id="DBA_ID" name="DBA_ID" readonly />
              </div>
              <div class="form-group col-md-6">
                <label for="DBA_NAME" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">DBA_NAME</label>
                <input type="text" class="form-control" id="DBA_NAME" name="DBA_NAME" />
              </div>
              <div class="form-group col-md-2">
                <label for="DBA_USER" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">DBA_USER</label>
                <input type="text" class="form-control" id="DBA_USER" name="DBA_USER" />
              </div>
              <div class="form-group col-md-2">
                <label for="DBA_PASS" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">DBA_PASS</label>
                <input type="password" class="form-control" id="DBA_PASS" name="DBA_PASS" />
              </div>
            </div>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-group" align="center">
              <button class="btn btn-danger btn-sm submit_btn" id="btn-update" name="btn-update" value="btn-update" onclick="return confirm('Confirma o lançamento?')">Salvar&nbsp;<i class="fas fa-database"></i></button>
            </div>

          </form>

        </div><!-- /.container-fluid -->

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <?php require 'dba_footer.php'; ?>

      </div><!-- /.Invoice -->
      <!-- FIM -->

    </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php
	mysqli_close( $CONN1 );
?>