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
    <?php require 'cli_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'cli_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3 card card-danger card-outline">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $cliSubtitle; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb(108, 117, 125); background: rgb(108, 117, 125, 20%);" />

            <div class="row table-responsive">
                <table id="table" class="table table-dark table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">#ID</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">ESCRITÓRIO</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">CONTATO</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">TELEFONE</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">CELULAR</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">CIDADE</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">STATUS</th>
                            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Início da consulta sql
                            $SQL = " SELECT CLI.*, STA.*
                                       FROM SYS_CLIENTS CLI
                                       JOIN SYS_STATUS STA ON STA.STA_ID = CLI.CLI_FK_STATUS
                                   ORDER By CLI.CLI_OFFICE ASC
                                   ";

                            $RESULT = mysqli_query( $CONN1, $SQL );
                            while( $DADOS = mysqli_fetch_assoc( $RESULT ) ) {
                            ?>
                            <tr>
                                <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_ID' ] ?></th>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_OFFICE' ] ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_CLIENT' ] ?></td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'CLI_PHONE' ] == "" ) {
                                            echo ' --- ';
                                        } else {
                                            echo mask( $DADOS[ 'CLI_PHONE' ], '(##) ####-####' );
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'CLI_CELLPHONE' ] == "" ) {
                                            echo ' --- ';
                                        } else {
                                            echo mask( $DADOS[ 'CLI_CELLPHONE' ], '(##) #####-####' );
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_CITY' ] ?></td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                    <?php
                                        if( $DADOS[ 'CLI_FK_STATUS' ] == 1 ) {
                                            echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                                        } else {
                                            echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                                        }
                                    ?>
                                </td>
                                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                                    <a href="?pg=setup/clients/cli_view&id=<?= $DADOS[ 'CLI_ID' ]; ?>" class="btn btn-outline-success"><i class="fas fa-eye"></i></a>&nbsp;
                                    <a href="?pg=setup/clients/cli_edit&id=<?= $DADOS[ 'CLI_ID' ]; ?>" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                    <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="?pg=setup/clients/cli_delete&id=<?= $DADOS[ 'CLI_ID' ]; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este Cliente?')"><i class="fas fa-trash-alt"></i></a><?php } ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div><!-- /.row -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb(108, 117, 125); background: rgb(108, 117, 125, 20%);" />

            <?php require 'cli_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>
<?php mysqli_close( $CONN ); mysqli_close( $CONN1 ); ?>