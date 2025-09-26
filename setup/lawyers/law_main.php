<?php
  if (!isset($_SESSION)) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../../access/level.php');
  require_once(__DIR__ . '/../../access/conn.php');
  require_once(__DIR__ . '/../../config.php');
  require_once(__DIR__ . '/law_proc.php');
?>

<a name="topo"></a>
<div class="content-wrapper">

  <section class="content">
    <div class="container-fluid">

      <?php require './menuh.php'; ?>

      <div class="invoice p-3 card-primary card-outline">

        <div class="row legend">
          <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $advTitle; ?><span class="subtitle"><?= $advSubtitle; ?></span></legend>
        </div>

        <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // INÍCIO NEW FORMULÁRIO //
        -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
        <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 211, 213 );">CADASTRO:</legend>
        <div class="card-body" style="display: none;" id="new">
          <form name="ADV_SAVE" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
            <input type="hidden" name="ACTION" value="SAVE" />
            <section>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-danger card-outline">
                      <div class="card-body pad table-responsive">
                        <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                        // PERSONAL DATA //
                        -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                        <div class="row">
                          <div class="col-sm-6">
                            <fieldset>
                              <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">INFORMAÇÕES CADASTRAIS</legend>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_SOCIEDADE -->
                                  <label for="ADV_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">SOCIEDADE</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_SOCIEDADE" name="ADV_SOCIEDADE" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_CNPJ -->
                                  <label for="ADV_CNPJ" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CNPJ</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_CNPJ" name="ADV_CNPJ" size="20" value="" onkeypress="$(this).mask('00.000.000/0000-00');" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_NR_OAB_SOCIEDADE -->
                                  <label for="ADV_NR_OAB_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB SOCIEDADE</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_NR_OAB_SOCIEDADE" name="ADV_NR_OAB_SOCIEDADE" size="25" value="" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_NOME -->
                                  <label for="ADV_NOME" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ADVOGADO</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_NOME" name="ADV_NOME" size="25" maxlength="80" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_NR_OAB -->
                                  <label for="ADV_NR_OAB" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_NR_OAB" name="ADV_NR_OAB" size="20" value="" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_FK_OAB_UF -->
                                  <label for="ADV_FK_OAB_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                </div>
                                <div class="col-8">
                                  <select class="form-control" id="ADV_FK_OAB_UF" name="ADV_FK_OAB_UF" required>
                                    <?php
                                      $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                      while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                        <option value="<?= $ROW[ 'UFE_ID' ]; ?>"><?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_FK_TIPO -->
                                  <label for="ADV_FK_TIPO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">TIPO</label>
                                </div>
                                <div class="col-8">
                                  <select class="form-control" id="ADV_FK_TIPO" name="ADV_FK_TIPO" required>
                                    <?php
                                      $SQL = mysqli_query( $CONN, " SELECT ATP_ID, ATP_TIPO FROM ADV_TIPOS ");
                                      while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                        <option value="<?= $ROW[ 'ATP_ID' ]; ?>"><?= $ROW[ 'ATP_TIPO' ] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_NACIONALIDADE -->
                                  <label for="ADV_NACIONALIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NACIONALIDADE</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_NACIONALIDADE" name="ADV_NACIONALIDADE" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_FK_EST_CIVIL -->
                                  <label for="ADV_FK_EST_CIVIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO CIVIL</label>
                                </div>
                                <div class="col-8">
                                  <select class="form-control" id="ADV_FK_EST_CIVIL" name="ADV_FK_EST_CIVIL" required>
                                    <?php
                                      $SQL = mysqli_query( $CONN, " SELECT EST_ID, EST_NOME FROM EST_CIVIL ");
                                      while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                        <option value="<?= $ROW[ 'EST_ID' ]; ?>"><?= $ROW[ 'EST_NOME' ] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_EMAIL -->
                                  <label for="ADV_EMAIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-MAIL</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_EMAIL" name="ADV_EMAIL" size="25" value="" />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-sm-6">
                            <fieldset>
                              <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">CORRESPONDÊNCIA</legend>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_ENDERECO -->
                                  <label for="ADV_ENDERECO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ENDEREÇO</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_ENDERECO" name="ADV_ENDERECO" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_NR -->
                                  <label for="ADV_NR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NÚMERO</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_NR" name="ADV_NR" size="10" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_COMPLEMENTO -->
                                  <label for="ADV_COMPLEMENTO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">COMPLEMENTO</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_COMPLEMENTO" name="ADV_COMPLEMENTO" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_BAIRRO -->
                                  <label for="ADV_BAIRRO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">BAIRRO</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_BAIRRO" name="ADV_BAIRRO" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_CIDADE -->
                                  <label for="ADV_CIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CIDADE</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_CIDADE" name="ADV_CIDADE" size="25" value="" style="text-transform: uppercase;" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ESTADO -->
                                  <label for="ADV_FK_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                </div>
                                <div class="col-8">
                                  <select class="form-control" id="ADV_FK_UF" name="ADV_FK_UF" required>
                                    <?php
                                      $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                      while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                        <option value="<?= $ROW[ 'UFE_ID' ]; ?>"><?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.CEP -->
                                  <label for="ADV_CEP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CEP</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_CEP" name="ADV_CEP" size="20" value="<?php if (!empty($DADOS['ADV_CEP'])) {
                                                                                                                                        $ADV_CEP = $DADOS['ADV_CEP'];
                                                                                                                                        echo mask($ADV_CEP, '##.###-###');
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?>" onkeypress="$(this).mask('00.000-000');" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_TELEFONE -->
                                  <label for="ADV_TELEFONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Telefone</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_TELEFONE" name="ADV_TELEFONE" size="20" value="<?php if (!empty($DADOS['ADV_TELEFONE'])) {
                                                                                                                                                                  $ADV_TELEFONE = $DADOS['ADV_TELEFONE'];
                                                                                                                                                                  echo mask($ADV_TELEFONE, '(##) ####-####');
                                                                                                                                                              } else {
                                                                                                                                                                  echo '';
                                                                                                                                                              } ?>" onkeypress="$(this).mask('(00) 0000-0000');" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.ADV_CELULAR -->
                                  <label for="ADV_CELULAR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CELULAR</label>
                                </div>
                                <div class="col-8">
                                  <input type="text" class="form-control" id="ADV_CELULAR" name="ADV_CELULAR" size="20" value="<?php if (!empty($DADOS['ADV_CELULAR'])) {
                                                                                                                                          $ADV_CELULAR = $DADOS['ADV_CELULAR'];
                                                                                                                                          echo mask($ADV_CELULAR, '(##) #####-####');
                                                                                                                                      } else {
                                                                                                                                          echo '';
                                                                                                                                      } ?>" onkeypress="$(this).mask('(00) 00000-0000');" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4"><!-- /.STATUS -->
                                  <label for="ADV_FK_STATUS" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">STATUS</label>
                                </div>
                                <div class="col-8">
                                  <select class="form-control" id="ADV_FK_STATUS" name="ADV_FK_STATUS" required>
                                    <?php
                                      $SQL = mysqli_query( $CONN, " SELECT STA_ID, STA_NAME FROM STA_STATUS ");
                                      while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                        <option value="<?= $ROW[ 'STA_ID' ]; ?>"><?= $ROW[ 'STA_NAME' ] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                            </fieldset>
                          </div>

                        </div>

                      </div><!-- /.card -->
                      <div class="card-footer">
                        <div class="form-group">
                          <div class="container">
                            <div class="row">
                              <div class="col">

                              </div>
                              <div class="col text-center">
                                <button class="btn input btn-primary" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" onmouseover="this.style.color='#F2D786'" onmouseout="this.style.color='rgb( 255, 255, 255 )'">
                                  <i class="fas fa-database"></i>&nbsp;&nbsp;Salvar
                                </button>
                              </div>
                              <div class="col" style="text-align: right;">

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.col -->
                </div><!-- ./row -->
              </div><!-- ./container -->
            </section>
          </form>
        </div>

        <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

        <div class="row table-responsive" style="overflow: hidden;">

          <table id="cli" class="table table-dark table-striped table-hover table-sm overflow-hidden" style="overflow: hidden;">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">#</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">Nome</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">Sociedade</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">Status</th>
                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.2em; font-weight: 700;">Ações</th>
              </tr>
            </thead>
              <?php
                if( $VERIFICA > 0 ) {
                  while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) {
              ?>
            <tbody>
              <tr>
                <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                  <?= $DADOS['ADV_ID'] ?>
                </th>
                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                  <?= $DADOS['ADV_NOME'] ?>
                </td>
                <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                  <?= $DADOS['ADV_SOCIEDADE'] ?>
                </td>
                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                  <?php
                  if ($DADOS['ADV_FK_STATUS'] == 1) { // 1 - ATIVO
                    echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>';
                  } else { // 0 - INATIVO
                    echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>';
                  }
                  ?>
                </td>
                <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
                  <a href="javascript:;" onclick="abreFecha('view_<?= $DADOS['ADV_ID']; ?>')" class="btn btn-default btn-sm" title="Visualizar" style="text-decoration: none; color: rgb( 253, 210, 110 ); font-weight: 500; text-transform: uppercase; letter-spacing: 0.1em; text-align: center;"><i class="fas fa-eye" style="color: rgb( 0, 188, 140 );"></i></a>&nbsp;
                  <a href="javascript:;" onclick="abreFecha('edit_<?= $DADOS['ADV_ID']; ?>')" class="btn btn-default btn-sm" title="Editar" style="text-decoration: none; color: rgb( 253, 210, 110 ); font-weight: 500; text-transform: uppercase; letter-spacing: 0.1em; text-align: center;"><i class="fas fa-edit" style="color: rgb( 63, 103, 145 );"></i></a>&nbsp;
                </td>
              </tr>
              <tr style="display: none;" id="view_<?= $DADOS['ADV_ID']; ?>">
                <td colspan="5" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">

                  <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                  // INÍCIO VIEW //
                  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="card-body">
                      <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card card-danger card-outline">
                                <div class="card-body pad table-responsive">
                                  <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                  // PERSONAL DATA //
                                  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <fieldset>
                                        <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">INFORMAÇÕES CADASTRAIS</legend>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_SOCIEDADE -->
                                            <label for="ADV_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">SOCIEDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_SOCIEDADE" name="ADV_SOCIEDADE" size="25" value="<?= $DADOS['ADV_SOCIEDADE']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CNPJ -->
                                            <label for="ADV_CNPJ" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CNPJ</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CNPJ" name="ADV_CNPJ" size="20" value="<?php if (!empty($DADOS['ADV_CNPJ'])) { $num = $DADOS['ADV_CNPJ']; if ($num < 14) { echo mask($num, '###.###.###-##'); } else { echo mask($num, '##.###.###/####-##'); } } else { echo ''; } ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR_OAB_SOCIEDADE -->
                                            <label for="ADV_NR_OAB_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB SOCIEDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR_OAB_SOCIEDADE" name="ADV_NR_OAB_SOCIEDADE" size="25" value="<?= $DADOS['ADV_NR_OAB_SOCIEDADE']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NOME -->
                                            <label for="ADV_NOME" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ADVOGADO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NOME" name="ADV_NOME" size="25" maxlength="80" value="<?= $DADOS['ADV_NOME']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR_OAB -->
                                            <label for="ADV_NR_OAB" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR_OAB" name="ADV_NR_OAB" size="20" value="<?php if (!empty($DADOS['ADV_NR_OAB'])) { $num = $DADOS[ 'ADV_NR_OAB' ]; if ( $num < 5 ) { echo mask( $num, '##.###' ); } else { echo mask( $num, '###.###' ); } } else { echo ''; } ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_OAB_UF -->
                                            <label for="ADV_FK_OAB_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_OAB_UF" name="ADV_FK_OAB_UF" required readonly >
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'UFE_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_OAB_UF' ] == $ROW[ 'UFE_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_TIPO -->
                                            <label for="ADV_FK_TIPO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">TIPO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_TIPO" name="ADV_FK_TIPO" required readonly >
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT ATP_ID, ATP_TIPO FROM ADV_TIPOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'ATP_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_TIPO' ] == $ROW[ 'ATP_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'ATP_TIPO' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NACIONALIDADE -->
                                            <label for="ADV_NACIONALIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NACIONALIDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NACIONALIDADE" name="ADV_NACIONALIDADE" size="25" value="<?= $DADOS['ADV_NACIONALIDADE']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_EST_CIVIL -->
                                            <label for="ADV_FK_EST_CIVIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO CIVIL</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_EST_CIVIL" name="ADV_FK_EST_CIVIL" required readonly >
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT EST_ID, EST_NOME FROM EST_CIVIL ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'EST_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_EST_CIVIL' ] == $ROW[ 'EST_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'EST_NOME' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_EMAIL -->
                                            <label for="ADV_EMAIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-MAIL</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_EMAIL" name="ADV_EMAIL" size="25" value="<?= strtolower( $DADOS['ADV_EMAIL'] ); ?>" readonly />
                                          </div>
                                        </div>
                                      </fieldset>
                                    </div>
                                    <div class="col-sm-6">
                                      <fieldset>
                                        <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">CORRESPONDÊNCIA</legend>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_ENDERECO -->
                                            <label for="ADV_ENDERECO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ENDEREÇO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_ENDERECO" name="ADV_ENDERECO" size="25" value="<?= $DADOS['ADV_ENDERECO']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR -->
                                            <label for="ADV_NR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NÚMERO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR" name="ADV_NR" size="10" value="<?= $DADOS['ADV_NR']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_COMPLEMENTO -->
                                            <label for="ADV_COMPLEMENTO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">COMPLEMENTO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_COMPLEMENTO" name="ADV_COMPLEMENTO" size="25" value="<?= $DADOS['ADV_COMPLEMENTO']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_BAIRRO -->
                                            <label for="ADV_BAIRRO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">BAIRRO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_BAIRRO" name="ADV_BAIRRO" size="25" value="<?= $DADOS['ADV_BAIRRO']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CIDADE -->
                                            <label for="ADV_CIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CIDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CIDADE" name="ADV_CIDADE" size="25" value="<?= $DADOS['ADV_CIDADE']; ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ESTADO -->
                                            <label for="ADV_FK_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_UF" name="ADV_FK_UF" required readonly >
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'UFE_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_UF' ] == $ROW[ 'UFE_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.CEP -->
                                            <label for="ADV_CEP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CEP</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CEP" name="ADV_CEP" size="20" value="<?php if (!empty($DADOS['ADV_CEP'])) {
                                                                                                                                                  $ADV_CEP = $DADOS['ADV_CEP'];
                                                                                                                                                  echo mask($ADV_CEP, '##.###-###');
                                                                                                                                              } else {
                                                                                                                                                  echo '';
                                                                                                                                              } ?>" onkeypress="$(this).mask('00.000-000');" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_TELEFONE -->
                                            <label for="ADV_TELEFONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Telefone</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_TELEFONE" name="ADV_TELEFONE" size="20" value="<?php if (!empty($DADOS['ADV_TELEFONE'])) {
                                                                                                                                                                            $ADV_TELEFONE = $DADOS['ADV_TELEFONE'];
                                                                                                                                                                            echo mask($ADV_TELEFONE, '(##) ####-####');
                                                                                                                                                                        } else {
                                                                                                                                                                            echo '';
                                                                                                                                                                        } ?>" onkeypress="$(this).mask('(00) 0000-0000');" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CELULAR -->
                                            <label for="ADV_CELULAR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CELULAR</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CELULAR" name="ADV_CELULAR" size="20" value="<?php if (!empty($DADOS['ADV_CELULAR'])) {
                                                                                                                                                    $ADV_CELULAR = $DADOS['ADV_CELULAR'];
                                                                                                                                                    echo mask($ADV_CELULAR, '(##) #####-####');
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>" onkeypress="$(this).mask('(00) 00000-0000');" readonly />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.STATUS -->
                                            <label for="ADV_FK_STATUS" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">STATUS</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_STATUS" name="ADV_FK_STATUS" required readonly >
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT STA_ID, STA_NAME FROM STA_STATUS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'STA_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_STATUS' ] == $ROW[ 'STA_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'STA_NAME' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>

                                      </fieldset>
                                    </div>

                                  </div>

                                </div><!-- /.card -->
                              </div>

                            </div><!-- /.col -->
                          </div><!-- ./row -->
                        </div><!-- ./container -->
                      </section>
                    </div>
                </td>
              </tr>
              <tr style="display: none;" id="edit_<?= $DADOS['ADV_ID']; ?>">
                <td colspan="5" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">

                  <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                  // INÍCIO UPDT FORMULÁRIO //
                  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                  <form name="ADV_UPDT" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <input type="hidden" name="ACTION" value="UPDT" />
                    <input type="hidden" name="ADV_ID" value="<?= $DADOS['ADV_ID'] ?>" />
                    <div class="card-body">
                      <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card card-danger card-outline">
                                <div class="card-body pad table-responsive">
                                  <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                  // PERSONAL DATA //
                                  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <fieldset>
                                        <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">INFORMAÇÕES CADASTRAIS</legend>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_SOCIEDADE -->
                                            <label for="ADV_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">SOCIEDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_SOCIEDADE" name="ADV_SOCIEDADE" size="25" value="<?= $DADOS['ADV_SOCIEDADE']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CNPJ -->
                                            <label for="ADV_CNPJ" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CNPJ</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CNPJ" name="ADV_CNPJ" size="20" value="<?php if (!empty($DADOS['ADV_CNPJ'])) { $num = $DADOS['ADV_CNPJ']; if ($num < 14) { echo mask($num, '###.###.###-##'); } else { echo mask($num, '##.###.###/####-##'); } } else { echo ''; } ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR_OAB_SOCIEDADE -->
                                            <label for="ADV_NR_OAB_SOCIEDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB SOCIEDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR_OAB_SOCIEDADE" name="ADV_NR_OAB_SOCIEDADE" size="25" value="<?= $DADOS['ADV_NR_OAB_SOCIEDADE']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NOME -->
                                            <label for="ADV_NOME" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ADVOGADO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NOME" name="ADV_NOME" size="25" maxlength="80" value="<?= $DADOS['ADV_NOME']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR_OAB -->
                                            <label for="ADV_NR_OAB" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nº OAB</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR_OAB" name="ADV_NR_OAB" size="20" value="<?php if (!empty($DADOS['ADV_NR_OAB'])) { $num = $DADOS[ 'ADV_NR_OAB' ]; if ( $num < 5 ) { echo mask( $num, '##.###' ); } else { echo mask( $num, '###.###' ); } } else { echo ''; } ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_OAB_UF -->
                                            <label for="ADV_FK_OAB_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_OAB_UF" name="ADV_FK_OAB_UF" required>
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'UFE_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_OAB_UF' ] == $ROW[ 'UFE_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_TIPO -->
                                            <label for="ADV_FK_TIPO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">TIPO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_TIPO" name="ADV_FK_TIPO" required>
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT ATP_ID, ATP_TIPO FROM ADV_TIPOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'ATP_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_TIPO' ] == $ROW[ 'ATP_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'ATP_TIPO' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NACIONALIDADE -->
                                            <label for="ADV_NACIONALIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NACIONALIDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NACIONALIDADE" name="ADV_NACIONALIDADE" size="25" value="<?= $DADOS['ADV_NACIONALIDADE']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_FK_EST_CIVIL -->
                                            <label for="ADV_FK_EST_CIVIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO CIVIL</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_EST_CIVIL" name="ADV_FK_EST_CIVIL" required>
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT EST_ID, EST_NOME FROM EST_CIVIL ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'EST_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_EST_CIVIL' ] == $ROW[ 'EST_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'EST_NOME' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_EMAIL -->
                                            <label for="ADV_EMAIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-MAIL</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_EMAIL" name="ADV_EMAIL" size="25" value="<?= strtolower( $DADOS['ADV_EMAIL'] ); ?>" />
                                          </div>
                                        </div>
                                      </fieldset>
                                    </div>
                                    <div class="col-sm-6">
                                      <fieldset>
                                        <legend style="font-size: 1.3rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 211, 188, 140 );">CORRESPONDÊNCIA</legend>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_ENDERECO -->
                                            <label for="ADV_ENDERECO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ENDEREÇO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_ENDERECO" name="ADV_ENDERECO" size="25" value="<?= $DADOS['ADV_ENDERECO']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_NR -->
                                            <label for="ADV_NR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">NÚMERO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_NR" name="ADV_NR" size="10" value="<?= $DADOS['ADV_NR']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_COMPLEMENTO -->
                                            <label for="ADV_COMPLEMENTO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">COMPLEMENTO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_COMPLEMENTO" name="ADV_COMPLEMENTO" size="25" value="<?= $DADOS['ADV_COMPLEMENTO']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_BAIRRO -->
                                            <label for="ADV_BAIRRO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">BAIRRO</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_BAIRRO" name="ADV_BAIRRO" size="25" value="<?= $DADOS['ADV_BAIRRO']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CIDADE -->
                                            <label for="ADV_CIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CIDADE</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CIDADE" name="ADV_CIDADE" size="25" value="<?= $DADOS['ADV_CIDADE']; ?>" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ESTADO -->
                                            <label for="ADV_FK_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">ESTADO</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_UF" name="ADV_FK_UF" required>
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT UFE_ID, UFE_SIGLA FROM UFE_ESTADOS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'UFE_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_UF' ] == $ROW[ 'UFE_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'UFE_SIGLA' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.CEP -->
                                            <label for="ADV_CEP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CEP</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CEP" name="ADV_CEP" size="20" value="<?php if (!empty($DADOS['ADV_CEP'])) {
                                                                                                                                                  $ADV_CEP = $DADOS['ADV_CEP'];
                                                                                                                                                  echo mask($ADV_CEP, '##.###-###');
                                                                                                                                              } else {
                                                                                                                                                  echo '';
                                                                                                                                              } ?>" onkeypress="$(this).mask('00.000-000');" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_TELEFONE -->
                                            <label for="ADV_TELEFONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Telefone</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_TELEFONE" name="ADV_TELEFONE" size="20" value="<?php if (!empty($DADOS['ADV_TELEFONE'])) {
                                                                                                                                                                            $ADV_TELEFONE = $DADOS['ADV_TELEFONE'];
                                                                                                                                                                            echo mask($ADV_TELEFONE, '(##) ####-####');
                                                                                                                                                                        } else {
                                                                                                                                                                            echo '';
                                                                                                                                                                        } ?>" onkeypress="$(this).mask('(00) 0000-0000');" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.ADV_CELULAR -->
                                            <label for="ADV_CELULAR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CELULAR</label>
                                          </div>
                                          <div class="col-8">
                                            <input type="text" class="form-control" id="ADV_CELULAR" name="ADV_CELULAR" size="20" value="<?php if (!empty($DADOS['ADV_CELULAR'])) {
                                                                                                                                                    $ADV_CELULAR = $DADOS['ADV_CELULAR'];
                                                                                                                                                    echo mask($ADV_CELULAR, '(##) #####-####');
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>" onkeypress="$(this).mask('(00) 00000-0000');" />
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-4"><!-- /.STATUS -->
                                            <label for="ADV_FK_STATUS" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">STATUS</label>
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" id="ADV_FK_STATUS" name="ADV_FK_STATUS" required>
                                              <?php
                                                $SQL = mysqli_query( $CONN, " SELECT STA_ID, STA_NAME FROM STA_STATUS ");
                                                while( $ROW = mysqli_fetch_array( $SQL ) ) { ?>
                                                  <option value="<?= $ROW[ 'STA_ID' ]; ?>" <?php echo $DADOS[ 'ADV_FK_STATUS' ] == $ROW[ 'STA_ID' ] ? ' selected' : ''; ?>> <?= $ROW[ 'STA_NAME' ] ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>

                                      </fieldset>
                                    </div>

                                  </div>

                                </div><!-- /.card -->
                                <div class="card-footer">
                                  <div class="form-group">
                                    <div class="container">
                                      <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col text-center">
                                          <button class="btn input btn-primary" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" onmouseover="this.style.color='#F2D786'" onmouseout="this.style.color='rgb( 255, 255, 255 )'">
                                            <i class="fas fa-database"></i>&nbsp;&nbsp;Salvar
                                          </button>
                                        </div>
                                        <div class="col" style="text-align: right;">
                                          <?php if( $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?>
                                            <a href="?pg=setup/lawyers/law_main&ACTION=DEL&ID=<?= $DADOS['ADV_ID']; ?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn btn-danger" title="Excluir" style="text-decoration: none; font-weight: 500; text-transform: uppercase; letter-spacing: 0.1em; text-align: center;"><i class="fas fa-trash-alt" style="color: rgb( 255, 255, 255 );"></i>&nbsp;&nbsp;Excluir</a>
                                          <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div><!-- /.col -->
                          </div><!-- ./row -->
                        </div><!-- ./container -->
                      </section>
                    </div>

                  </form>

                </td>
              </tr>
              <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div><!-- /.row -->

      </div><!-- /.Invoice -->

    </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

  <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>