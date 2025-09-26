<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');

  // Selecionando o ID do Cliente
  if( isset( $_GET[ 'id' ] ) ) {
    $ID = $_GET[ 'id' ];

    $SQL = " SELECT C.*, P.PAS_ID, P.PAS_NOME
               FROM CLI_CLIENTES C
               JOIN STA_STATUS S ON C.CLI_FK_STATUS = S.STA_ID
               JOIN PAS_PROC_PASTA P ON C.CLI_FK_PASTA = P.PAS_ID
              WHERE C.CLI_ID = '$ID'
           ORDER BY C.CLI_ID DESC ";

    $RESULTADO = mysqli_query( $CONN, $SQL );
    $DADOS     = mysqli_fetch_array( $RESULTADO );
    $CLIENTE   = $DADOS[ 'CLI_NOME' ];
    $PASTA     = $DADOS[ 'PAS_NOME' ];
  }
?>

<a name="topo"></a>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

      <!--// CLIENT MENU //-->
			<?php require './menuh.php'; ?>

      <!--// INVOICE //-->
      <div class="invoice p-3 mb-3 card card-primary card-outline">

        <!--// TITLE //-->
        <div class="container">
          <div class="row col-12">
            <div class="form-group col-sm-2"></div>
            <div class="form-group col-sm-8" style="color: rgb( 211, 211, 213 ); text-align: center;">
                <legend><?= $clientManagement; ?></legend>
            </div>
            <div class="form-group col-sm-2"></div>
          </div>
        </div>

				<!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				// START TOP CARDS //
				-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
				<section class="content">
					<div class="container-fluid">
						<div class="col-12 col-md-12">
							<div class="card card-danger card-outline">
								<div class="card-header p-0 pt-1 border-bottom-0">

									<div class="row" style="justify-content: center; align-items: center; vertical-align: middle;">
										<div class="col-auto">
											<div class="info-box">
												<div class="info-box-content">
                          <!-- CÓDIGO -->
													<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Código</span>
													<span class="info-box-number">
														<input type="text" class="form-control" style="width: auto; text-align: center; color: rgb( 255, 193, 7 );" id="id" name="id" size="10" value="<?= $ID; ?>" readonly />
													</span>
												</div><!-- /.info-box-content -->
											</div><!-- /.info-box -->
										</div><!-- /.col -->
										<div class="col-auto">
											<div class="info-box">
												<div class="info-box-content">
                          <!-- CADASTRADO -->
													<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Cadastrado</span>
													<span class="info-box-number">
														<input type="" class="form-control" style="width: auto; text-align: center;" id="CLI_DT_CREATION" name="CLI_DT_CREATION" size="10" maxlength="10" value="<?= date( "d/m/Y", strtotime( $DADOS[ 'CLI_DT_CREATION' ] ) ); ?>" readonly />
													</span>
												</div><!-- /.info-box-content -->
											</div><!-- /.info-box -->
										</div><!-- /.col -->
										<div class="col-auto">
											<div class="info-box">
												<div class="info-box-content">
                          <!-- ALTERADO -->
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
										<div class="col-auto">
											<div class="info-box">
												<div class="info-box-content">
                          <!-- STATUS -->
													<span class="info-box-text" style="line-height: 0.9em; color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Status</span>
													<span class="info-box-number">
                            <?php
                              if( $DADOS[ 'CLI_FK_STATUS' ] == 1 ) {
                                echo '<input type="" class="form-control" style="width: 100%; letter-spacing: 0.1em; color: rgb( 255, 193, 7 ); font-weight: 500; text-align: center; text-transform: uppercase;" value="Ativo" readonly />';
                              } else {
                                echo '<input type="" class="form-control" style="width: 100%; letter-spacing: 0.1em; color: rgb( 235, 235, 235 ); font-weight: 500; text-align: center; text-transform: uppercase;" value="Inativo" readonly />';
                              }
                            ?>
													</span>
												</div><!-- /.info-box-content -->
											</div><!-- /.info-box -->
										</div><!-- /.col -->
									</div><!-- /.row -->

								</div>
							</div>
						</div>
					</div>
				</section>

        <!-- // --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
				// START ABAS //
				// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- // -->
				<section class="content">
					<div class="container-fluid">
						<div class="col-12 col-md-12">
              <!-- /.CLIENTE -->
              <div class="card" style="background-color: rgb( 63, 71, 78 );">
                <div class="col-auto text-center">
                  <span style="text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600; color: rgb( 205, 204, 204 );">  Cliente:</span>
                  <span style="text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600; color: aliceblue;">  <?= $DADOS[ 'CLI_NOME' ]; ?></span>  |
                  <span style="text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600; color: rgb( 205, 204, 204 );">  Pasta:</span>
                  <span style="text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600; color: aliceblue;">  <?= $DADOS[ 'PAS_NOME' ]; ?></span>
                </div>
              </div>
							<div class="card card-secondary card-outline card-tabs">
								<div class="card-header p-0 pt-1 border-bottom-0">
									<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <!-- CADASTRO -->
										<li class="nav-item">
											<a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">CADASTRO</a>
										</li>
                    <!-- DOCUMENTOS -->
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-three-documents-tab" data-toggle="pill" href="#custom-tabs-three-documents" role="tab" aria-controls="custom-tabs-three-documents" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">DOCUMENTOS</a>
										</li>
                    <!-- HISTÓRICO -->
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-three-historic-tab" data-toggle="pill" href="#custom-tabs-three-historic" role="tab" aria-controls="custom-tabs-three-historic" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">HISTÓRICO</a>
										</li>
                    <!-- PROCESSOS -->
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-three-process-tab" data-toggle="pill" href="#custom-tabs-three-process" role="tab" aria-controls="custom-tabs-three-process" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">PROCESSOS</a>
										</li>
                    <!-- FINANCEIRO -->
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-three-finances-tab" data-toggle="pill" href="#custom-tabs-three-finances" role="tab" aria-controls="custom-tabs-three-finances" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">FINANCEIRO</a>
										</li>
                    <!-- CÁLCULOS -->
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-three-calc-tab" data-toggle="pill" href="#custom-tabs-three-calc" role="tab" aria-controls="custom-tabs-three-calc" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'">CÁLCULOS</a>
										</li>
									</ul>
								</div>
								<div class="card-body">
									<div class="tab-content" id="custom-tabs-three-tabContent">
										<!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
										// CADASTRO //
										-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
										<div class="tab-pane fade show active" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

											<div class="row">
												<div class="col-sm-6">

                          <!-- COLUNA DADOS PESSOAIS -->
													<fieldset>
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Dados Pessoais</legend>
														<div class="row">
															<div class="col-4">
                                <!-- Nome -->
																<label for="CLI_NOME" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nome</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_NOME" name="CLI_NOME" size="25" value="<?= $DADOS['CLI_NOME']; ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- Nacionalidade -->
																<label for="CLI_NACIONALIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Nacionalidade</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_NACIONALIDADE" name="CLI_NACIONALIDADE" size="25" value="<?= $DADOS['CLI_NACIONALIDADE']; ?>" readonly />
															</div>
														</div>
                            <div class="row">
															<div class="col-4">
                                <!-- Profissão -->
																<label for="CLI_PROFISSAO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Profissão</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_PROFISSAO" name="CLI_PROFISSAO" size="25" value="<?= $DADOS['CLI_PROFISSAO']; ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- Data de nascimento -->
																<label for="CLI_DT_NASC" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Data de nascimento</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_DT_NASC" name="CLI_DT_NASC" size="25" value="<?php if( !empty( $DADOS[ 'CLI_DT_NASC' ] ) ) { $CLI_DT_NASC = date( "d/m/Y", strtotime( $DADOS[ 'CLI_DT_NASC' ] ) ); echo $CLI_DT_NASC; } else { echo ''; } ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- Gênero -->
																<label for="CLI_GENERO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Gênero</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_GENERO" name="CLI_GENERO" size="25" maxlength="80" value="<?php if( $DADOS[ 'CLI_GENERO' ] == "SELECIONE..." ) { echo ''; } else { $CLI_GENERO = $DADOS[ 'CLI_GENERO' ]; echo $CLI_GENERO; } ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- Estado civil -->
																<label for="CLI_EST_CIVIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Estado civil</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_EST_CIVIL" name="CLI_EST_CIVIL" size="20" value="<?php if( $DADOS[ 'CLI_EST_CIVIL' ] == "SELECIONE..." ) { echo ''; } else { $CLI_EST_CIVIL = $DADOS[ 'CLI_EST_CIVIL' ]; echo $CLI_EST_CIVIL; } ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- E-mail -->
																<label for="CLI_EMAIL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-mail</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_EMAIL" name="CLI_EMAIL" size="20" value="<?= $DADOS[ 'CLI_EMAIL' ]; ?>" readonly />
															</div>
														</div>
														<div class="row">
															<div class="col-4">
                                <!-- Pasta -->
																<label for="CLI_FK_PASTA" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Pasta</label>
															</div>
															<div class="col-8">
																<input type="text" class="form-control" id="CLI_FK_PASTA" name="CLI_FK_PASTA" size="25" value="<?= $DADOS[ 'PAS_NOME' ]; ?>" readonly />
															</div>
														</div>
													</fieldset>

                          <br />

                          <!-- COLUNA DOCUMENTOS -->
													<fieldset>
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Documentos</legend>
                            <div class="row">
                              <div class="col-4">
                                <!-- CPF -->
                                <label for="CLI_CPF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CPF</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_CPF" name="CLI_CPF" size="11" value="<?php $CLI_CPF = $DADOS[ 'CLI_CPF' ]; echo mask( $CLI_CPF, '###.###.###-##' ); ?>" readonly  />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- RG -->
                                <label for="CLI_RG" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">RG</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_RG" name="CLI_RG" value="<?= $DADOS[ 'CLI_RG' ]; ?>" readonly  />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Órgão Emissor -->
                                <label for="CLI_ORG_EMISSOR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Órgão Emissor</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_ORG_EMISSOR" name="CLI_ORG_EMISSOR" size="11" value="<?= $DADOS[ 'CLI_ORG_EMISSOR' ];?>" readonly />
                              </div>
                            </div>
                          </fieldset>

                          <!-- COLUNA DADOS EMPRESARIAIS -->
                          <?php if( ( $DADOS[ 'CLI_CNPJ' ] ) != '' ) { ?>
                          <br />
                          <fieldset>
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Dados Empresariais</legend>
                            <div class="row">
                              <div class="col-4">
                                <!-- Razão Social -->
                                <label for="CLI_R_SOCIAL" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Razão Social</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_R_SOCIAL" name="CLI_R_SOCIAL" size="25" value="<?= $DADOS[ 'CLI_R_SOCIAL' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Responsável -->
                                <label for="CLI_RESP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Responsável</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_RESP" name="CLI_RESP" size="25" maxlength="80" value="<?= $DADOS[ 'CLI_RESP' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- CNPJ -->
                                <label for="CLI_CNPJ" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CNPJ</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_CNPJ" name="CLI_CNPJ" size="20" value="<?php if( !empty( $DADOS[ 'CLI_CNPJ' ] ) ) { $CLI_CNPJ = $DADOS[ 'CLI_CNPJ' ]; echo mask( $CLI_CNPJ, '##.###.###/####-##' ); } else { echo ''; } ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Inscrição Estadual -->
                                <label for="CLI_IE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Inscrição Estadual</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_IE" name="CLI_IE" size="20" value="<?php if( !empty( $DADOS[ 'CLI_IE' ] ) ) { $CLI_CNPJ = $DADOS[ 'CLI_IE' ]; echo mask( $CLI_IE, '###.###.###.###' ); } else { echo ''; } ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- E-mail -->
                                <label for="CLI_EMAIL_EMP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">E-mail</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_EMAIL_EMP" name="CLI_EMAIL_EMP" size="25" value="<?= $DADOS[ 'CLI_EMAIL_EMP' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Site -->
                                <label for="CLI_SITE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Site</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_SITE" name="CLI_SITE" size="25" value="<?= $DADOS[ 'CLI_SITE' ]; ?>" readonly />
                              </div>
                            </div>
                          </fieldset>
                          <?php } ?>
												</div> <!-- /.col-sm-6 -->

												<div class="col-sm-6">
                          <!-- COLUNA CORRESPONDÊNCIA -->
													<fieldset>
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Correspondência</legend>
                            <div class="row">
                              <div class="col-4">
                                <!-- Endereço -->
                                <label for="CLI_ENDERECO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Endereço</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_ENDERECO" name="CLI_ENDERECO" size="25" value="<?= $DADOS[ 'CLI_ENDERECO' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Número -->
                                <label for="CLI_NUMERO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Número</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_NUMERO" name="CLI_NUMERO" size="10" value="<?= $DADOS[ 'CLI_NUMERO' ];?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Complemento -->
                                <label for="CLI_COMPLEMENTO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Complemento</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_COMPLEMENTO" name="CLI_COMPLEMENTO" size="25" value="<?= $DADOS[ 'CLI_COMPLEMENTO' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Bairro -->
                                <label for="CLI_BAIRRO" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Bairro</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_BAIRRO" name="CLI_BAIRRO" size="25" value="<?= $DADOS[ 'CLI_BAIRRO' ];?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Cidade -->
                                <label for="CLI_CIDADE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Cidade</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_CIDADE" name="CLI_CIDADE" size="25" value="<?= $DADOS[ 'CLI_CIDADE' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Estado -->
                                <label for="CLI_UF" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Estado</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_UF" name="CLI_UF" size="25" value="<?= $DADOS[ 'CLI_UF' ]; ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- CEP -->
                                <label for="CLI_CEP" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">CEP</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_CEP" name="CLI_CEP" size="20" value="<?php if( !empty( $DADOS[ 'CLI_CEP' ] ) ) { $CLI_CEP = $DADOS[ 'CLI_CEP' ]; echo mask( $CLI_CEP, '##.###-###' ); } else { echo ''; } ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Telefone -->
                                <label for="CLI_TELEFONE" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Telefone</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_TELEFONE" name="CLI_TELEFONE" size="20" value="<?php if( !empty( $DADOS[ 'CLI_TELEFONE' ] ) ) { $CLI_TELEFONE = $DADOS[ 'CLI_TELEFONE' ]; echo mask( $CLI_TELEFONE, '(##) #####-####' ); } else { echo ''; } ?>" readonly />
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <!-- Celular -->
                                <label for="CLI_CELULAR" style="font-size: 1.0rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgb( 206, 212, 218 );">Celular</label>
                              </div>
                              <div class="col-8">
                                <input type="text" class="form-control" id="CLI_CELULAR" name="CLI_CELULAR" size="20" value="<?php if( !empty( $DADOS[ 'CLI_CELULAR' ] ) ) { $CLI_CELULAR = $DADOS[ 'CLI_CELULAR' ]; echo mask( $CLI_CELULAR, '(##) #####-####' ); } else { echo ''; } ?>" readonly />
                              </div>
                            </div>
                          </fieldset>
                        </div><!-- /.col-sm-6 -->

                      </div><!-- /.row -->

                      <br />

                      <!-- BLOCO OBSERVAÇÕES -->
                      <div class="row">
                        <div class="col-sm-12">
                          <fieldset>
                            <!-- Observações -->
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Observações</legend>
                            <textarea id="CLI_OBS" name="CLI_OBS" class="form-control" rows="5" cols="10" wrap="soft" style="resize: none; text-align: justify;" readonly><?= $DADOS[ 'CLI_OBS' ]; ?></textarea>
                          </fieldset>
                        </div>
                      </div>

                    </div><!-- /.tab-pane -->

                    <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    // DOCUMENTS //
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="tab-pane fade" id="custom-tabs-three-documents" role="tabpanel" aria-labelledby="custom-tabs-three-documents-tab">
                      <div class="row">
                        <div class="card-body p-0 table-responsive" style="overflow: hidden;">
                          <?php require_once(__DIR__ . '/clien_documents.php'); ?>
                        </div><!-- /.card-body -->
                      </div><!-- /.row -->
                    </div><!-- /.tab-pane -->

                    <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    // HISTORIC //
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="tab-pane fade" id="custom-tabs-three-historic" role="tabpanel" aria-labelledby="custom-tabs-three-historic-tab">
                      <div class="row">
                        <div class="card-body p-0 table-responsive" style="overflow: hidden;">
                          <?php require './notes/not_history.php'; ?>
                        </div><!-- /.card-body -->
                      </div><!-- /.row -->
                    </div><!-- /.tab-pane -->

                    <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    // PROCESS //
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="tab-pane fade" id="custom-tabs-three-process" role="tabpanel" aria-labelledby="custom-tabs-three-process-tab">
                      <div class="row">
                        <div class="card-body p-0 table-responsive" style="overflow: hidden;">
                          <?php require_once(__DIR__ . '/clien_process.php'); ?>
                        </div><!-- /.card-body -->
                      </div><!-- /.row -->
                    </div><!-- /.tab-pane -->

                    <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    // FINANCEIRO //
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="tab-pane fade" id="custom-tabs-three-finances" role="tabpanel" aria-labelledby="custom-tabs-three-finances-tab">
                      <div class="row">
                        <div class="card-body p-0 table-responsive" style="overflow: hidden;">
                          <?php require_once(__DIR__ . '/clien_finances.php'); ?>
                        </div><!-- /.card-body -->
                      </div><!-- /.row -->
                    </div><!-- /.tab-pane -->

                    <!--// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    // CÁLCULOS //
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-->
                    <div class="tab-pane fade" id="custom-tabs-three-calc" role="tabpanel" aria-labelledby="custom-tabs-three-calc-tab">
                      <div class="row">
                        <div class="card-body p-0 table-responsive" style="overflow: hidden;">
                          <?php require_once(__DIR__ . '/clien_calc.php'); ?>
                        </div><!-- /.card-body -->
                      </div><!-- /.row -->
                    </div><!-- /.tab-pane -->

									</div><!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div><!-- /.card -->
						</div><!-- /.col-12 -->
					</div><!-- /.End Container-fluid -->
				</section><!-- /.End Section -->
        <!-- // --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
				// END ABAS //
				// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- // -->

      </div><!-- /.Invoice -->

    </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

	<!--// FOOTER //-->
	<?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close( $CONN ); ?>