<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/clien_proc.php');
?>

<a name="topo"></a>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <?php require './menuh.php'; ?>

            <div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $clientManagement; ?><span class="subtitle"><?= $clientSubtitle; ?></span></legend>
                </div>

              <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <!-- /.CADASTRO DE PASTA -->
                <div class="row justify-content-md-center">
                    <!-- /.BLOCO ADD/REMOV CAT./MOV. -->
                    <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_pasta">
                        <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Pasta</h3>
                        <table class="table" width="100%" style="background-color: rgb( 69, 77, 85 );">
                            <tr>
                                <td valign="top">
                                    <form method="POST" action="<?= $_SERVER['REQUEST_URI']; ?>">
                                        <div class="container" style="text-align: center;">
                                            <div class="row justify-content-md-center">
                                                <div class="col" style="text-align: center;">
                                                    <input type="hidden" name="acao" value="2" />
                                                    <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Nome:</strong><br />
                                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="PAS_NOME" size="20" maxlength="50" required />
                                                    <br /><br />
                                                    <button type="submit" value="Enviar" class="btn input btn-light btn-sm" style="color: rgb( 205, 204, 204 ); font-weight: 400; letter-spacing: 0.1em; text-align: center; background-color: transparent; border: 1px solid transparent rgb( 211, 211, 213 ); font-size: 1rem; border-radius: 1.0rem;" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='#CDCCCC'">
                                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td valign="top" align="right">
                                    <b>Editar/Remover Pastas:</b><br/><br/>
                                    <?php
                                        $QR = mysqli_query( $CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ");
                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                    ?>
                                    <div id="editar2_pasta_<?= $ROW[ 'PAS_ID' ]; ?>"><?= $ROW[ 'PAS_NOME' ]; ?>
                                        <a style="font-size: 1.0em; color: rgb( 227, 164, 164 )" onclick="return confirm('Tem certeza que deseja remover esta pasta?\nAtenção: Apenas pastas sem movimentos associados poderão ser removidas.')" href="index.php?pg=clients/clien_content&acao=apagar_pasta&id=<?= $ROW[ 'PAS_ID' ]; ?>" title="Remover">[remover]</a>
                                        <a href="javascript:;" style="font-size: 1.0em; color: rgb( 119, 230, 189 )" onclick="document.getElementById('editar_pasta_<?= $ROW[ 'PAS_ID' ]; ?>').style.display=''; document.getElementById('editar2_pasta_<?= $ROW[ 'PAS_ID' ]; ?>').style.display='none'" title="Editar">[editar]</a>
                                    </div>
                                    <div style="display: none" id="editar_pasta_<?= $ROW[ 'PAS_ID' ]; ?>">
                                        <form method="POST" action="index.php?pg=clients/clien_content">
                                            <input type="hidden" name="acao" value="editar_pasta" />
                                            <input type="hidden" name="PAS_ID" value="<?= $ROW[ 'PAS_ID' ]; ?>" />
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="PAS_NOME" value="<?= $ROW[ 'PAS_NOME' ]; ?>" size="20" maxlength="50" />
                                            <input type="submit" class="input" value="Alterar" />
                                        </form>
                                    </div>

                                    <?php }?>

                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

            <div class="container-fluid">

                <!-- INÍCIO FORMULÁRIO -->
                <form name="form_cadastro" action="?pg=clients/clien_inserir" method="POST">

                    <table class="table table-striped table-dark table-sm">
                        <thead style="text-align: center;">
                            <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Data de cadastro<?php $dtAtual = date("Y-m-d"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td><input type="number" class="form-control" style="width:180px; text-align: center;" id="id" name="id" size="10" value="" readonly /></td>
                                <td><input type="date" class="form-control" style="width:180px; text-align: center;" id="dtCad" name="dtCad" size="10" maxlength="10" value="<?= $dtAtual; ?>" placeholder="Data de cadastro" readonly /></td>
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
                                        <td colspan="2" width="75%">
                                            <input type="text" class="form-control" id="CLI_NOME" name="CLI_NOME" size="25" maxlength="80" placeholder="Nome completo" onkeyup="this.value = this.value.toUpperCase();" autofocus required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_NACIONALIDADE">Nacionalidade</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <input type="text" class="form-control" id="CLI_NACIONALIDADE" name="CLI_NACIONALIDADE" size="25" maxlength="80" placeholder="Nacionalidade" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_PROFISSAO">Profissão</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <input type="text" class="form-control" id="CLI_PROFISSAO" name="CLI_PROFISSAO" size="25" maxlength="80" placeholder="Profissão" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_DT_NASC">Data de nascimento</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <input type="date" class="form-control" id="CLI_DT_NASC" name="CLI_DT_NASC" size="10" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_GENERO">Gênero</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <select class="form-control" id="CLI_GENERO" name="CLI_GENERO" >
                                                <!--CIS = Nasceu com o mesmo sexo que se considera-->
                                                <!--Trans = Nasceu com um sexo, porém, se considera de outro-->
                                                <option selected>Selecione...</option>
                                                <option value="MASCULINO">Masculino</option>
                                                <option value="FEMININO">Feminino</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EST_CIVIL">Estado civil</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <select class="form-control" id="CLI_EST_CIVIL" name="CLI_EST_CIVIL">
                                                <option selected>Selecione...</option>
                                                <option value="SOLTEIRO/A">Solteiro/a</option>
                                                <option value="CASADO/A">Casado/a</option>
                                                <option value="DIVORCIADO/A">Divorciado/a</option>
                                                <option value="SEPARADO/A_JUDICIALMENTE">Separado/a Judicialmente</option>
                                                <option value="UNIAO_ESTAVEL">Únião Estável</option>
                                                <option value="VIUVO/A">Viúvo/a</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EMAIL">E-mail</label>
                                        </td>
                                        <td colspan="2" width="75%">
                                            <input type="text" class="form-control" id="CLI_EMAIL" name="CLI_EMAIL" size="25" placeholder="voce@seuprovedor.com.br" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" class="label" for="CLI_FK_PASTA">Pasta</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_FK_PASTA" name="CLI_FK_PASTA" required>
                                                <option value="">Selecione...</option>
                                                <?php
                                                    $SQL = "SELECT * FROM PAS_PROC_PASTA ORDER By PAS_NOME ";
                                                    $RESULTADO = mysqli_query( $CONN, $SQL );
                                                    while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                                                    <option value = "<?php echo $DADOS[ 'PAS_ID' ]; ?>"><?php echo $DADOS[ 'PAS_NOME' ]; ?></option>
                                                <?php }	?>
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
                                            <input type="text" class="form-control" id="CLI_R_SOCIAL" name="CLI_R_SOCIAL" size="25" maxlength="80" placeholder="Razão Social" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_RESP">Responsável</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_RESP" name="CLI_RESP" size="25" maxlength="80" placeholder="Responsável" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CNPJ">CNPJ</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_CNPJ" name="CLI_CNPJ" size="20" maxlength="18" placeholder="00.000.000/0000-00" onkeypress="$(this).mask('00.000.000/0000-00');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_IE">Inscrição Estadual</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_IE" name="CLI_IE" size="20" maxlength="15" placeholder="000.000.000.000" onkeypress="$(this).mask('000.000.000.000');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_EMAIL_EMP">E-mail</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_EMAIL_EMP" name="CLI_EMAIL_EMP" size="25" maxlength="50" placeholder="E-mail" onkeyup="this.value = this.value.toLowerCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_SITE">Site</label>
                                        </td>
                                        <td width="65%">
                                            <input type="text" class="form-control" id="CLI_SITE" name="CLI_SITE" size="25" maxlength="50" placeholder="Site" onkeyup="this.value = this.value.toLowerCase();" />
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
                                            <input type="text" class="form-control" id="CLI_CPF" name="CLI_CPF" size="11" maxlength="14" placeholder="000.000.000-00" onkeypress="$(this).mask('000.000.000-00');" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_RG">RG</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_RG" name="CLI_RG" placeholder="Registro Geral" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_ORG_EMISSOR">Órgão Emissor</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_ORG_EMISSOR" name="CLI_ORG_EMISSOR" size="11" placeholder="SSP/XX" onkeyup="this.value = this.value.toUpperCase();" />
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
                                            <input type="text" class="form-control" id="CLI_ENDERECO" name="CLI_ENDERECO" size="25" maxlength="100" placeholder="Endereço"  onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_NUMERO">Número</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_NUMERO" name="CLI_NUMERO" size="10" maxlength="8" placeholder="Número" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_COMPLEMENTO">Complemento</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_COMPLEMENTO" name="CLI_COMPLEMENTO" size="25" maxlength="25" placeholder="Casa, Apartamento, Condomínio..."  onkeyup="this.value = this.value.toUpperCase();"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_BAIRRO">Bairro</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_BAIRRO" name="CLI_BAIRRO" size="25" maxlength="25" placeholder="Bairro, Vila, Jardim, Distrito..."  onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CIDADE">Cidade</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CIDADE" name="CLI_CIDADE" size="25" maxlength="75" placeholder="Cidade"  onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_UF">Estado</label>
                                        </td>
                                        <td width="75%">
                                            <select class="form-control" id="CLI_UF" name="CLI_UF">
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                                <option value="AP">Amapá</option>
                                                <option value="AM">Amazonas</option>
                                                <option value="BA">Bahia</option>
                                                <option value="CE">Ceará</option>
                                                <option value="DF">Distrito Federal</option>
                                                <option value="ES">Espírito Santo</option>
                                                <option value="GO">Goiás</option>
                                                <option value="MA">Maranhão</option>
                                                <option value="MT">Mato Grosso</option>
                                                <option value="MS">Mato Grosso do Sul</option>
                                                <option value="MG">Minas Gerais</option>
                                                <option value="PA">Pará</option>
                                                <option value="PB">Paraiba</option>
                                                <option value="PR">Paraná</option>
                                                <option value="PE">Pernambuco</option>
                                                <option value="PI">Piauí</option>
                                                <option value="RJ">Rio de Janeiro</option>
                                                <option value="RN">Rio Grande do Norte</option>
                                                <option value="RS">Rio Grande do Sul</option>
                                                <option value="RO">Rondônia</option>
                                                <option value="RR">Roraima</option>
                                                <option value="SC">Santa Catarina</option>
                                                <option value="SP" selected>São Paulo</option>
                                                <option value="SE">Sergipe</option>
                                                <option value="TO">Tocantins</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CEP">CEP</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CEP" name="CLI_CEP" size="20" maxlength="10" placeholder="00.000-000" onkeypress="$(this).mask('00.000-000');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_TELEFONE">Telefone</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_TELEFONE" class="telefone" name="CLI_TELEFONE" size="20" maxlength="15" placeholder="(00) 0000-0000" onkeypress="$(this).mask('(00) 0000-00009');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label style="color: rgb( 205, 205, 205 );" for="CLI_CELULAR">Celular</label>
                                        </td>
                                        <td width="75%">
                                            <input type="text" class="form-control" id="CLI_CELULAR" class="celular" name="CLI_CELULAR" size="20" maxlength="15" placeholder="(00) 0000-0000" onkeypress="$(this).mask('(00) 00000-0009');" />
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
                                <textarea class="form-control" id="CLI_OBS" name="CLI_OBS" rows="10" wrap="soft" style="overflow: hidden; resize: none; text-align: justify;" placeholder="Observações..."></textarea>
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
                                    <select class="form-control" id="CLI_FK_STATUS" name="CLI_FK_STATUS" required>
                                        <?php
                                            $SQL = mysqli_query( $CONN, " SELECT * FROM STA_STATUS ");
                                            while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                            <option value="<?php echo $ROW[ 'STA_ID' ]?>"><?php echo $ROW[ 'STA_NAME' ]?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <br />
                    <div class="form-group" style="text-align: center;">
                        <input type="submit" class="btn btn-success btn-sm" value="Cadastrar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger btn-sm" value="Limpar">
                    </div>

                </form>

            </div><!-- /.row -->

            <hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />


          </div><!-- /.Invoice -->
          <!-- FIM DA PESQUISA-->

        </div><!-- /.End Container-fluid -->
      </section><!-- /.End Section -->

      <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->
<a name="fim"></a>