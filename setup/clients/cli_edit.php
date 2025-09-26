<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 4;
    require_once(__DIR__ . '/../../access/level.php');
    require_once(__DIR__ . '/../../access/conn.php');
    require_once(__DIR__ . '/../../config.php');
    require_once(__DIR__ . '/../../dist/func/functions.php');

	// Selecionando o ID do produto a ser Editado/Alterado
	if( isset( $_GET[ 'id' ] ) ) {
	    $ID = $_GET[ 'id' ];

        $SQL = " SELECT CLI.*, STA.*
                   FROM SYS_CLIENTS CLI
                   JOIN SYS_STATUS STA ON STA.STA_ID = CLI.CLI_FK_STATUS
                  WHERE CLI.CLI_ID = '$ID'
               ORDER By CLI.CLI_OFFICE ASC ";

        $RESULTADO = mysqli_query( $CONN1, $SQL );
        $DADOS = mysqli_fetch_array( $RESULTADO );
	}
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
            <div class="invoice p-3 mb-3">
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

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid table-responsive">

                <!-- INÍCIO FORMULÁRIO -->
                <form name="form_editar" action="?pg=setup/clients/cli_update" method="POST" >

                    <!-- INICIO DO BLOCO DE CARDS DO TOPO -->
                    <div class="row" style="justify-content: center; align-items: center; vertical-align: middle;">

                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Código</span>
                                    <span class="info-box-number">
                                        <input type="text" class="form-control" style="width: 100%; text-align: center; color: rgb( 255, 193, 7 );" id="id" name="id" size="10" value="<?= $ID; ?>" readonly />
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Cadastrado</span>
                                    <span class="info-box-number">
                                        <input type="" class="form-control" style="width: 100%; text-align: center;" id="CLI_DT_CREATION" name="CLI_DT_CREATION" size="10" maxlength="10" value="<?= date( "d/m/Y", strtotime( $DADOS[ 'CLI_DT_CREATION' ] ) ); ?>" readonly />
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Alterado</span>
                                    <span class="info-box-number">
                                        <?php
                                            if( $DADOS[ 'CLI_DT_UPDATE' ] == "0000-00-00 00:00:00" ) {
                                                    $CLI_DT_UPDATE = $DADOS[ 'CLI_DT_CREATION' ];
                                            } else {
                                                $CLI_DT_UPDATE = $DADOS[ 'CLI_DT_UPDATE' ];
                                            }
                                        ?>
                                        <input type="" class="form-control" style="width: 100%; text-align: center;" id="CLI_DT_UPDATE" name="CLI_DT_UPDATE" size="10" maxlength="10" value="<?= date( "d/m/Y", strtotime( $CLI_DT_UPDATE ) ); ?>" readonly />
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Status</span>
                                    <span class="info-box-number">
                                        <select class="form-control" id="CLI_FK_STATUS" name="CLI_FK_STATUS">
                                            <?php
                                                $SQL = mysqli_query( $CONN1, " SELECT * FROM SYS_STATUS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                <option value="<?= $ROW[ 'STA_ID' ]?>" <?php if( $DADOS[ 'CLI_FK_STATUS' ] == $ROW[ 'STA_ID' ] ) {?>selected<?php } ?> ><?= $ROW[ 'STA_NAME' ]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->

                    <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                    <div class="form-row">

                        <div class="col-sm-6">
                            <!-- COLUNA DADOS PESSOAIS -->
                            <fieldset>
                                <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">Dados Pessoais</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_OFFICE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Escritório</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_OFFICE" name="CLI_OFFICE" size="25" value="<?= $DADOS[ 'CLI_OFFICE' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" autofocus />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_CLIENT" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Contato</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CLIENT" name="CLI_CLIENT" size="10" value="<?= $DADOS[ 'CLI_CLIENT' ]; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_DT_NASC" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Data de Nascimento</label>
                                        </td>
                                        <td width="75%">
                                            <input type="date" class="form-control" id="CLI_DT_NASC" name="CLI_DT_NASC" size="10" value="<?= $DADOS[ 'CLI_DT_NASC' ]; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_GENDER" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Gênero</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_GENDER" name="CLI_GENDER">
                                                <?php
                                                    $CLI_GENDER = 'MASCULINO,FEMININO' ;
                                                    $CLI_GENDER = explode( ',' , $CLI_GENDER );
                                                    $TOTAL = count( $CLI_GENDER );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                        $AUX = '' ;
                                                        if( $CLI_GENDER[ $i ] == $DADOS[ 'CLI_GENDER' ] ) {
                                                            $AUX = 'selected' ;
                                                    }
                                                ?>
                                                    <option value="<?= $CLI_GENDER[ $i ]; ?>"<?= $AUX; ?>><?= $CLI_GENDER[ $i ]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_MARITALSTATUS" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Estado civil</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_MARITALSTATUS" name="CLI_MARITALSTATUS">
                                                <?php
                                                    $CLI_MARITALSTATUS = 'SOLTEIRO/A,CASADO/A,DIVORCIADO/A,SEPARADO/A_JUDICIALMENTE,UNIAO_ESTAVEL,VIUVO/A';
                                                    $CLI_MARITALSTATUS = explode( ',' , $CLI_MARITALSTATUS );
                                                    $TOTAL = count( $CLI_MARITALSTATUS );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                    $AUX = '' ;
                                                    if ( $CLI_MARITALSTATUS[ $i ] == $DADOS[ 'CLI_MARITALSTATUS' ] ) {
                                                        $AUX = 'selected' ;
                                                    }
                                                ?>
                                                    <option value = "<?= $CLI_MARITALSTATUS[ $i ]; ?>"<?= $AUX; ?>><?= $CLI_MARITALSTATUS[ $i ]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_EMAIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-mail</label>
                                        </td>
                                        <td width="25%">
                                            <input type="text" class="form-control" id="CLI_EMAIL" name="CLI_EMAIL" size="25" value="<?= $DADOS[ 'CLI_EMAIL' ]; ?>" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>

                            <!-- COLUNA DOCUMENTOS -->
                            <fieldset>
                                <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">Documentos</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_CPF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CPF</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CPF" name="CLI_CPF" size="11" placeholder="000.000.000-00" value="<?php $CLI_CPF = $DADOS[ 'CLI_CPF' ]; echo mask( $CLI_CPF, '###.###.###-##' ); ?>" onkeypress="$(this).mask('000.000.000-00');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_OAB" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">OAB</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_OAB" name="CLI_OAB" size="11" value="<?php if( !empty( $DADOS[ 'CLI_OAB' ] ) ) { $CLI_OAB = $DADOS[ 'CLI_OAB' ]; echo mask( $CLI_OAB, '###.###-#' ); } else { echo ''; } ?>" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>

                        </div>

                        <div class="col-sm-6">
                            <!-- COLUNA CORRESPONDÊNCIA -->
                            <fieldset>
                                <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">Correspondência</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_ADDRESS" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Endereço</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_ADDRESS" name="CLI_ADDRESS" size="25" value="<?= $DADOS[ 'CLI_ADDRESS' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_NUMBER" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Número</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NUMBER" name="CLI_NUMBER" size="10" value="<?= $DADOS[ 'CLI_NUMBER' ];?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_COMPLEMENT" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Complemento</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_COMPLEMENT" name="CLI_COMPLEMENT" size="25" value="<?= $DADOS[ 'CLI_COMPLEMENT' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_NEIGHBORHOOD" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Bairro</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NEIGHBORHOOD" name="CLI_NEIGHBORHOOD" size="25" value="<?= $DADOS[ 'CLI_NEIGHBORHOOD' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_CITY" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Cidade</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CITY" name="CLI_CITY" size="25" value="<?= $DADOS[ 'CLI_CITY' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_STATE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Estado</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_STATE" name="CLI_STATE">
                                                <?php
                                                    $ESTADOS = 'AC,AL,AM,AP,BA,CE,DF,ES,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RO,RR,RS,SC,SE,SP,TO' ;
                                                    $ESTADOS = explode( ',' , $ESTADOS );
                                                    $TOTAL = count( $ESTADOS );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                        //echo "\t\t\t\t\t\t\t\t <option value=\"$ESTADOS[$i]\">$ESTADOS[$i]</option>\n";
                                                        $AUX = '' ;
                                                        if( $ESTADOS[ $i ] == $DADOS[ 'CLI_STATE' ] ) { //quando a variável passar pelo estado SP, selecioná-la.
                                                            $AUX = 'selected' ;
                                                        }
                                                ?>
                                                    <option value="<?= $ESTADOS[ $i ]; ?>"<?= $AUX; ?>><?= $ESTADOS[ $i ]; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_ZIPCODE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CEP</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_ZIPCODE" id="CLI_ZIPCODE" name="CLI_ZIPCODE" size="20" placeholder="00.000-000" value="<?php if( !empty( $DADOS[ 'CLI_ZIPCODE' ] ) ) { $CLI_ZIPCODE = $DADOS[ 'CLI_ZIPCODE' ]; echo mask( $CLI_ZIPCODE, '##.###-###' ); } else { echo ''; } ?>" onkeypress="$(this).mask('00.000-000');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_PHONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Telefone</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_PHONE" name="CLI_PHONE" size="20" placeholder="(00) 0000-0000" value="<?php if( !empty( $DADOS[ 'CLI_PHONE' ] ) ) { $CLI_PHONE = $DADOS[ 'CLI_PHONE' ]; echo mask( $CLI_PHONE, '(##) #####-####' ); } else { echo ''; } ?>" onkeypress="$(this).mask('(00) 0000-00009');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label for="CLI_CELLPHONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Celular</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CELLPHONE" name="CLI_CELLPHONE" size="20" placeholder="(00) 0000-0000" value="<?php if( !empty( $DADOS[ 'CLI_CELLPHONE' ] ) ) { $CLI_CELLPHONE = $DADOS[ 'CLI_CELLPHONE' ]; echo mask( $CLI_CELLPHONE, '(##) #####-####' ); } else { echo ''; } ?>" onkeypress="$(this).mask('(00) 0000-00009');" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>

                    </div>

                    <br />

                    <div class="form-row">
                        <div class="col-sm-12">
                            <!-- BLOCO OBSERVAÇÕES -->
                            <fieldset>
                                <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">Observações</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="100%"></td>
                                            <textarea id="CLI_OBS" name="CLI_OBS" class="form-control" rows="5" cols="10" wrap="soft" style="resize:none; text-align:justify;"><?= $DADOS[ 'CLI_OBS' ];?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </div>

                    <br />

                    <center><button class="btn btn-danger btn-md submit_btn" id="btn-update" name="btn-update" value="btn-update"><i class="fas fa-user-database"></i>&nbsp;Salvar</button></center>

                </form>

            </div><!-- /.row -->

            <hr style="width: auto; height: 2px; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'cli_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>