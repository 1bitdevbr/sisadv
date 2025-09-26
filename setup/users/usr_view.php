<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 2;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../config.php');

    if( isset( $_GET[ 'id' ] ) ) {
        $ID = $_GET[ 'id' ];

        $SQL = " SELECT U.*, L.*, C.*, D.*, S.*
                   FROM SYS_USERS U
                   JOIN SYS_LEVEL L ON L.LVL_ID = U.USR_FK_LEVEL
                   JOIN SYS_CLIENTS C ON C.CLI_ID = U.USR_FK_CLIENT
                   JOIN SYS_DATABASES D ON D.DBA_ID = U.USR_FK_DB_NAME
                   JOIN SYS_STATUS S ON S.STA_ID = U.USR_FK_STATUS
                  WHERE U.USR_ID = '$ID' ";

        $ROW = mysqli_query( $CONN1, $SQL );
        $DADOS = mysqli_fetch_array( $ROW );
    }
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'usr_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

      <!--// CLIENT MENU //-->
			<?php require 'usr_menu.php'; ?>

      <!-- INÍCIO -->
      <div class="invoice p-3 mb-3 card card-danger card-outline"><!-- Invoice -->

        <div class="container"><!-- title row -->
          <div class="row col-12">
              <div class="form-group col-sm-2">

              </div>
              <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                  <legend><?= $usrSubtitle; ?></legend>
              </div>
              <div class="form-group col-sm-2">

              </div>
          </div>
          <!-- /.col -->
        </div>

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <div class="container-fluid">

          <form action="?pg=setup/users/usr_edit" method="POST">

            <center><legend style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 255, 255, 255 );">Perfil do Usuário</legend></center>
            <div class="row justify-content-md-center">
              <div class="col col-md-1" align="right">
                <?php if( empty( $DADOS[ 'USR_PHOTO' ] ) ) {
                    $IMG = '/dist/img/user.png';
                } else {
                    $IMG = '/dist/img/' . $DADOS[ 'USR_PHOTO' ] . '';
                } ?>
                <span><img src="<?= $IMG; ?>" width="80px" heigth="120px" style="border: 2px solid white; box-shadow: 5px 5px 5px 1px rgb( 108, 117, 125 );" /></span>
              </div>
              <div class="col col-md-2">
                <label for="USR_FK_LEVEL" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nível de acesso atual:</label>
                <?php
                  $SQL = " SELECT U.*, N.LVL_NAME FROM SYS_USERS U JOIN SYS_LEVEL N ON U.USR_ID = $ID ";
                  $RESP = mysqli_query( $CONN1, $SQL );
                  $ROW = mysqli_fetch_array( $RESP );
                  echo '<em style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 155, 255, 167 );">' . $DADOS[ 'LVL_NAME' ] . '</em>';
                ?>
              </div>
              <div class="col col-md-1">
                <label for="ativo" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Ativo:</label>
                <?php
                  if( $DADOS[ 'USR_FK_STATUS' ] == 1 ) {
                      echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                  } else {
                      echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                  }
                ?>
              </div>

            </div>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="USR_ID" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">#ID</label>
                  <input type="text" class="form-control" id="USR_ID" name="USR_ID" value="<?= $DADOS[ 'USR_ID' ]; ?>" readonly />
                </div>
                <div class="form-group col-md-6">
                  <label for="USR_NAME" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nome</label>
                  <input type="text" class="form-control" id="USR_NAME" name="USR_NAME" value="<?= $DADOS[ 'USR_NAME' ]; ?>" readonly />
                </div>
                <div class="form-group col-md-2">
                  <label for="USR_LOGIN" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Login</label>
                  <input type="text" class="form-control" id="USR_LOGIN" name="USR_LOGIN" value="<?= $DADOS[ 'USR_LOGIN' ]; ?>" readonly />
                </div>
                <div class="form-group col-md-2">
                  <label for="USR_PASS" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Senha</label>
                  <input type="password" class="form-control" id="USR_PASS" name="USR_PASS" value="<?= $DADOS[ 'USR_PASS' ]; ?>" readonly />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="USR_FK_CLIENT" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Cliente</label>
                  <input type="text" class="form-control" id="USR_FK_CLIENT" name="USR_FK_CLIENT" value="<?= $DADOS[ 'CLI_OFFICE' ]; ?>" readonly />
                </div>
                <div class="form-group col-md-6">
                  <label for="USR_FK_DB_NAME" style="justify-content: center; align-items: center; display: table; vertical-align: middle; font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-align: center; text-transform: uppercase; color: rgb( 206, 212, 218 );">Base de Dados</label>
                  <input type="text" class="form-control" id="USR_FK_DB_NAME" name="USR_FK_DB_NAME" value="<?= $DADOS[ 'DBA_NAME' ]; ?>" readonly />
                </div>
            </div>

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="form-group" align="center">
              <a href="?pg=setup/users/usr_edit&id=<?= $DADOS[ 'USR_ID' ]; ?>" class="btn btn-outline-primary"><i class="fas fa-edit"></i>&nbsp;Editar</a>
              <a href="?pg=setup/users/usr_delete&id=<?= $DADOS[ 'USR_ID' ]; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este Usuário?')"><i class="fas fa-trash-alt"></i>&nbsp;Excluir</a>
            </div>

          </form>

        </div><!-- /.container-fluid -->

        <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <?php require 'usr_footer.php'; ?>

      </div><!-- /.Invoice -->
      <!-- FIM -->

    </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php
	mysqli_close( $CONN1 );
?>