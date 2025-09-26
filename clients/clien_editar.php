<?php
    if( !isset( $_SESSION ) ) session_start();
    $required_level = 1;
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');

	// Selecionando o ID do produto a ser Editado/Alterado
	if( isset( $_GET[ 'id' ] ) ) {
	    $ID = $_GET[ 'id' ];

        $SQL = " SELECT C.*, P.PAS_ID, P.PAS_NOME
                          FROM CLI_CLIENTES C
                             JOIN PAS_PROC_PASTA P ON C.CLI_FK_PASTA = P.PAS_ID
                        WHERE C.CLI_ID = '$ID'
                    ORDER By C.CLI_ID DESC ";

        $RESULTADO = mysqli_query( $CONN, $SQL );
        $DADOS = mysqli_fetch_array( $RESULTADO );
	}
?>
<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

    <!--// CLIENT HEADER //-->
    <?php require 'clien_header.php'; ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

            <!--// CLIENT MENU //-->
			<?php require 'clien_menu.php'; ?>

            <!-- INÍCIO DA PESQUISA -->
            <!-- Invoice -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="container">
                <div class="row col-12">
                    <div class="form-group col-sm-2">

                    </div>
                    <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                        <legend><?= $clientManagement; ?></legend>
                    </div>
                    <div class="form-group col-sm-2">

                    </div>
                </div>
                <!-- /.col -->
              </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="container-fluid">

                <!-- INÍCIO FORMULÁRIO -->
                <form name="form_editar" action="?pg=clients/clien_atualizar" method="POST" >

                    <table class="table table-striped table-dark table-sm">
                        <thead style="text-align: center;">
                            <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Data de alteração<?php $dtAtual = date("Y-m-d"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td><input type="number" class="form-control" style="width:180px; text-align: center;" id="id"  name="id" size="10" value="<?= $ID; ?>" readonly /></td>
                                <td><input type="date" class="form-control" style="width:180px; text-align: center;" id="lastUpdt"  name="lastUpdt" size="10" maxlength="10" value="<?= $dtAtual; ?>" placeholder="Data de Atualização" readonly /></td>
                            </tr>
                        </tbody>
                    </table>

                    <hr />

                    <div class="form-row">

                        <div class="col-sm-6"><!-- COLUNA DADOS PESSOAIS -->
                            <fieldset>
                                <legend style="color: rgb( 205, 205, 205 );">Dados Pessoais</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_NOME">Nome</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NOME" name="CLI_NOME" size="25" value="<?= $DADOS[ 'CLI_NOME' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" autofocus />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_NACIONALIDADE">Nacionalidade</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NACIONALIDADE" name="CLI_NACIONALIDADE" size="25" value="<?= $DADOS[ 'CLI_NACIONALIDADE' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_PROFISSAO">Profissão</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_PROFISSAO" name="CLI_PROFISSAO" size="25" value="<?= $DADOS[ 'CLI_PROFISSAO' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_DT_NASC">Data de nascimento</label>
                                        </td>
                                        <td width="75%">
                                            <input type="date" class="form-control" id="CLI_DT_NASC" name="CLI_DT_NASC" size="10" value="<?= $DADOS[ 'CLI_DT_NASC' ]; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_GENERO">Gênero</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_GENERO" name="CLI_GENERO">
                                                <?php
                                                    $CLI_GENERO = 'MASCULINO,FEMININO' ;
                                                    $CLI_GENERO = explode( ',' , $CLI_GENERO );
                                                    $TOTAL = count( $CLI_GENERO );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                        $AUX = '' ;
                                                        if( $CLI_GENERO[ $i ] == $DADOS[ 'CLI_GENERO' ] ) {
                                                            $AUX = 'selected' ;
                                                    }
                                                ?>
                                                    <option value="<?= $CLI_GENERO[ $i ]; ?>"<?= $AUX; ?>><?= $CLI_GENERO[ $i ]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EST_CIVIL">Estado civil</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_EST_CIVIL" name="CLI_EST_CIVIL">
                                                <?php
                                                    $CLI_EST_CIVIL = 'SOLTEIRO/A,CASADO/A,DIVORCIADO/A,SEPARADO/A_JUDICIALMENTE,UNIAO_ESTAVEL,VIUVO/A' ;
                                                    $CLI_EST_CIVIL = explode( ',' , $CLI_EST_CIVIL );
                                                    $TOTAL = count( $CLI_EST_CIVIL );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                    $AUX = '' ;
                                                    if ( $CLI_EST_CIVIL[ $i ] == $DADOS[ 'CLI_EST_CIVIL' ] ) {
                                                        $AUX = 'selected' ;
                                                    }
                                                ?>
                                                    <option value = "<?= $CLI_EST_CIVIL[ $i ]; ?>"<?= $AUX; ?>><?= $CLI_EST_CIVIL[ $i ]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EMAIL">E-mail</label>
                                        </td>
                                        <td width="25%">
                                            <input type="text" class="form-control" id="CLI_EMAIL" name="CLI_EMAIL" size="25" value="<?= $DADOS[ 'CLI_EMAIL' ]; ?>" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" class="label" for="CLI_FK_PASTA">Pasta</label>
                                        </td>
                                        <td width="25%">
                                            <select class="form-control" id="CLI_FK_PASTA" name="CLI_FK_PASTA" required>
                                                <?php
                                                    $SQL = mysqli_query( $CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
                                                    while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                    <option value="<?= $ROW[ 'PAS_ID' ]?>"<?php if( $DADOS[ 'CLI_FK_PASTA' ] == $ROW[ 'PAS_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'PAS_NOME' ]?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>

                        <div class="col-sm-6"><!-- COLUNA DADOS EMPRESARIAIS -->
                            <fieldset>
                                <legend style="color: rgb( 205, 205, 205 );">Dados Empresariais</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_R_SOCIAL">Razão Social</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_R_SOCIAL" name="CLI_R_SOCIAL" size="25" value="<?= $DADOS[ 'CLI_R_SOCIAL' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_RESP">Responsável</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_RESP" name="CLI_RESP" size="25" maxlength="80" value="<?= $DADOS[ 'CLI_RESP' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CNPJ">CNPJ</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_CNPJ" name="CLI_CNPJ" size="20" placeholder="00.000.000/0000-00" value="<?php $CLI_CNPJ = $DADOS[ 'CLI_CNPJ' ]; echo mask( $CLI_CNPJ, '##.###.###/####-##' ); ?>" onkeypress="$(this).mask('00.000.000/0000-00');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_IE">Inscrição Estadual</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_IE" name="CLI_IE" size="20" placeholder="000.000.000.000" value="<?php $CLI_IE = $DADOS[ 'CLI_IE' ]; echo mask( $CLI_IE, '###.###.###.###' ); ?>" onkeypress="$(this).mask('000.000.000.000');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EMAIL_EMP">E-mail</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_EMAIL_EMP" name="CLI_EMAIL_EMP" size="25" value="<?= $DADOS[ 'CLI_EMAIL_EMP' ]; ?>" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_SITE">Site</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_SITE" name="CLI_SITE" size="25" value="<?= $DADOS[ 'CLI_SITE' ]; ?>" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col-sm-6"><!-- COLUNA DOCUMENTOS -->
                            <fieldset>
                                <legend style="color: rgb( 205, 205, 205 );">Documentos</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CPF">CPF</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CPF" name="CLI_CPF" size="11" placeholder="000.000.000-00" value="<?php $CLI_CPF = $DADOS[ 'CLI_CPF' ]; echo mask( $CLI_CPF, '###.###.###-##' ); ?>" onkeypress="$(this).mask('000.000.000-00');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_RG">RG</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_RG" name="CLI_RG" value="<?= $DADOS[ 'CLI_RG' ]; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_ORG_EMISSOR">Órgão Emissor</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_ORG_EMISSOR" name="CLI_ORG_EMISSOR" size="11" value="<?= $DADOS[ 'CLI_ORG_EMISSOR' ]; ?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                        <div class="col-sm-6"><!-- COLUNA CORRESPONDÊNCIA -->
                            <fieldset>
                                <legend style="color: rgb( 205, 205, 205 );">Correspondência</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_ENDERECO">Endereço</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_ENDERECO" name="CLI_ENDERECO" size="25" value="<?= $DADOS[ 'CLI_ENDERECO' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_NUMERO">Número</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NUMERO" name="CLI_NUMERO" size="10" value="<?= $DADOS[ 'CLI_NUMERO' ];?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_COMPLEMENTO">Complemento</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_COMPLEMENTO" name="CLI_COMPLEMENTO" size="25" value="<?= $DADOS[ 'CLI_COMPLEMENTO' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_BAIRRO">Bairro</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_BAIRRO" name="CLI_BAIRRO" size="25" value="<?= $DADOS[ 'CLI_BAIRRO' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="cidade">Cidade</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CIDADE" name="CLI_CIDADE" size="25" value="<?= $DADOS[ 'CLI_CIDADE' ];?>" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_UF">Estado</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_UF" name="CLI_UF">
                                                <?php
                                                    $ESTADOS = 'AC,AL,AM,AP,BA,CE,DF,ES,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RO,RR,RS,SC,SE,SP,TO' ;
                                                    $ESTADOS = explode( ',' , $ESTADOS );
                                                    $TOTAL = count( $ESTADOS );
                                                    for( $i = 0; $i < $TOTAL; $i++ ) {
                                                        //echo "\t\t\t\t\t\t\t\t <option value=\"$ESTADOS[$i]\">$ESTADOS[$i]</option>\n";
                                                        $AUX = '' ;
                                                        if( $ESTADOS[ $i ] == $DADOS[ 'CLI_UF' ] ) { //quando a variável passar pelo estado SP, selecioná-la.
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
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CEP">CEP</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CEP" id="CLI_CEP" name="CLI_CEP" size="20" placeholder="00.000-000" value="<?php $CLI_CEP = $DADOS[ 'CLI_CEP' ]; echo mask( $CLI_CEP, '##.###-###' ); ?>" onkeypress="$(this).mask('00.000-000');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_TELEFONE">Telefone</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_TELEFONE" name="CLI_TELEFONE" size="20" placeholder="(00) 0000-0000" value="<?php $CLI_TELEFONE = $DADOS[ 'CLI_TELEFONE' ]; echo mask( $CLI_TELEFONE, '(##) ####-####' ); ?>" onkeypress="$(this).mask('(00) 0000-00009');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CELULAR">Celular</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CELULAR" name="CLI_CELULAR" size="20" placeholder="(00) 0000-0000" value="<?php $CLI_CELULAR = $DADOS[ 'CLI_CELULAR' ]; echo mask( $CLI_CELULAR, '(##) #####-####' ); ?>" onkeypress="$(this).mask('(00) 0000-00009');" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                    <br />
                    <div class="form-row"><!-- BLOCO OBSERVAÇÕES -->
                        <div class="col-sm-12">
                            <fieldset>
                                <legend style="color: rgb( 205, 205, 205 );">Observações</legend>
                                <table border="0" align="center" width="100%">
                                    <tr>
                                        <td width="100%"></td>
                                            <textarea id="CLI_OBS" name="CLI_OBS" class="form-control" rows="10" cols="10" wrap="soft" style="overflow:hidden; resize:none; text-align:justify;"><?= $DADOS[ 'CLI_OBS' ];?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </div>

                    <table class="table-striped table-sm" align="center">
                        <thead align="center">
                            <tr>
                            <th scope="col" colspan="2">Cliente ativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="90%">
                                    <select class="form-control" id="CLI_FK_STATUS" name="CLI_FK_STATUS">
                                        <?php
                                            $SQL = mysqli_query( $CONN, " SELECT * FROM STA_STATUS ");
                                            while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                            <option value="<?= $ROW[ 'STA_ID' ]?>" <?php if( $DADOS[ 'CLI_FK_STATUS' ] == $ROW[ 'STA_ID' ] ) {?>selected<?php } ?> ><?= $ROW[ 'STA_NAME' ]?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <center><button class="btn btn-danger btn-md submit_btn" id="btn-atualizar" name="btn-atualizar" value="btn-atualizar"><i class="fas fa-user-edit"></i>&nbsp;Atualizar</button></center>
                    <hr />
                </form>

            </div><!-- /.row -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <?php require 'clien_footer.php'; ?>

            </div><!-- /.Invoice -->
         <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>