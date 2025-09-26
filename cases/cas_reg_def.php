<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');
?>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?><span class="subtitle"><?= $caseAdd; ?></span></legend>
                </div>

				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <div class="container-fluid">

                    <form id="CAS_ADD_DEF" name="CAS_ADD_DEF" class="signin-form" formname="cases" action="?pg=cases/cas_reg_insert" method="POST">

                        <!-- PROCESSOS EM GERAL -->
                        <div class="card-body">
                            <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Processos em Geral</legend>
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_CASO">#Caso</label>
                                    <strong>
                                    <?php
                                        $SQL = mysqli_query( $CONN, " SELECT  MAX( PPR_CASO ) AS CASO FROM PPR_PROC_PROCESSOS WHERE PPR_FK_DEFENSORIA = 1 AND PPR_CASO != '' LIMIT 1 ");
                                        $QR = mysqli_fetch_array( $SQL );
                                        $CASO = $QR[ 'CASO' ];
                                        if( !empty( $CASO ) OR NULL ) {
                                            echo '<small><b  style="color: rgb( 211, 188, 140 );">&nbsp;(Anterior:&nbsp;' .  $CASO . ')</b></small>';
                                        } else {
                                            echo 'VAZIO';
                                        }
                                    ?>
                                    </strong>
                                    <input class="form-control  form-control" type="text" id="PPR_CASO" name="PPR_CASO" onkeyup="this.value = this.value.toUpperCase();" autofocus />
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_STATUS">Status</label>
                                    <div>
                                        <select class="form-control  form-control" id="PPR_FK_STATUS" name="PPR_FK_STATUS">
                                            <?php
                                                $SQL = mysqli_query( $CONN, " SELECT * FROM STA_STATUS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                <option value="<?= $ROW[ 'STA_ID' ]; ?>"><?= $ROW[ 'STA_NAME' ]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_HONORARIOS">Honorários</label>
                                    <div>
                                        <select class="form-control  form-control" id="PPR_FK_HONORARIOS" name="PPR_FK_HONORARIOS">
                                            <?php
                                                $SQL = mysqli_query( $CONN, " SELECT * FROM PHO_PROC_HONORARIOS ORDER By PHO_ID DESC ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                <option value="<?= $ROW[ 'PHO_ID' ]; ?>"><?= $ROW[ 'PHO_NOME' ]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_DEFENSORIA">Defensoria</label>
                                    <div>
                                        <select class="form-control  form-control" id="PPR_FK_DEFENSORIA" name="PPR_FK_DEFENSORIA" readonly>
                                            <option value="1" selected>Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_PASTA">Pasta</label>
                                    <select class="form-control  form-control" name="PPR_FK_PASTA" required>
                                        <option value="" required>Selecione</option>
                                        <?php
                                            $SQL = "SELECT * FROM PAS_PROC_PASTA ORDER By PAS_NOME ";
                                            $RESULTADO = mysqli_query( $CONN, $SQL );
                                            while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                                            <option value = "<?= $DADOS[ 'PAS_ID' ]; ?>"><?= $DADOS[ 'PAS_NOME' ]; ?></option>
                                        <?php }	?>
                                    </select>
                                </div>
                            </div>

                            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" for="PPR_FK_CLIENTE">Cliente:</label>
                                    <select class="form-control  form-control" name="PPR_FK_CLIENTE" id="PPR_FK_CLIENTE" required>
                                    <option value="" required>Selecione...</option>
                                        <?php
                                            $QR = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER By CLI_NOME ");
                                            while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                            <option value="<?= $ROW[ 'CLI_ID' ]; ?>"><?= $ROW[ 'CLI_NOME' ] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" class="PPR_PARTE_CONTRARIA">Parte Contrária</label>
                                    <input class="form-control  form-control" type="text" name="PPR_PARTE_CONTRARIA" onkeyup="this.value = this.value.toUpperCase();" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_NUM_PROCESSO">Número do Processo</label>
                                    <input class="form-control  form-control" type="text" id="PPR_NUM_PROCESSO" name="PPR_NUM_PROCESSO" onkeypress="$(this).mask('0000000-00.0000.0.00.0000');" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_COMARCA">Comarca</label>
                                    <input class="form-control  form-control" type="text" id="PPR_COMARCA" name="PPR_COMARCA" onkeyup="this.value = this.value.toUpperCase();" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );">Natureza da Ação</label>
                                    <select class="form-control  form-control" id="PPR_FK_NATUREZA" name="PPR_FK_NATUREZA" required>
                                        <option value="" required>Selecione</option>
                                        <?php
                                            $SQL = "SELECT * FROM PNA_PROC_NATUREZA ORDER By PNA_NOME";
                                            $RESULTADO = mysqli_query( $CONN, $SQL );
                                            while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                                            <option value = "<?= $DADOS[ 'PNA_ID' ]; ?>"><?= $DADOS[ 'PNA_NOME' ]; ?></option>
                                        <?php }	?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_FK_MEIO">Digital/Físico</label>
                                    <select class="form-control  form-control" id="PPR_FK_MEIO" name="PPR_FK_MEIO" required>
                                        <option value="" required>Selecione</option>
                                        <?php
                                            $SQL = "SELECT * FROM PME_PROC_MEIO ";
                                            $RESULTADO = mysqli_query( $CONN, $SQL );
                                            while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                                            <option value = "<?= $DADOS[ 'PME_ID' ]; ?>"><?= $DADOS[ 'PME_NOME' ]; ?></option>
                                        <?php }	?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label style="color: rgb( 205, 205, 205 );" class="label" for="PPR_TIPO_ACAO">Tipo de Ação</label>
                                    <input class="form-control  form-control" type="text" id="PPR_TIPO_ACAO" name="PPR_TIPO_ACAO" placeholder="Ex: Alimentos, Execução, Cobrança, etc..." onkeyup="this.value = this.value.toUpperCase();" />
                                </div>
                            </div>

                            <!-- OBSERVAÇÕES -->

                            <legend class="scheduler-border" style="color: rgb( 205, 205, 205 );">&nbsp;Observações</legend>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <textarea class="form-control  form-control" id="PPR_OBS" name="PPR_OBS" cols="20" rows="5" onkeyup="this.value = this.value.toUpperCase();" ></textarea>
                                </div>
                            </div>

                            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                            <div class="submit" align="center">
                                <button class="btn btn-danger btn-sm submit_btn" id="btn-gravar" name="btn-gravar" value="btn-gravar" onclick="return confirm('Confirma o lançamento?')"><i class="fas fa-database"></i>&nbsp;Salvar</button>
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