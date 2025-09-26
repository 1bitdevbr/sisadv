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

    $SQL = " SELECT PPR.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME
               FROM PPR_PROC_PROCESSOS PPR
               JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
               JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
              WHERE CLI.CLI_ID = '$ID'
           ORDER BY PPR.PPR_ID DESC ";

    $RESULTADO = mysqli_query( $CONN, $SQL );
    $VERIFICA = mysqli_num_rows( $RESULTADO );
    if( $VERIFICA > 0 ) {
      $DADOS = mysqli_fetch_assoc( $RESULTADO );
    }
  }
?>

<div class="container-fluid">

    <div class="row mt-0">
      <div class="card-body p-0">

        <!-- INICIO ABAS -->
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="custom-content-below-procuracao-tab" data-toggle="pill" href="#custom-content-below-procuracao" role="tab" aria-controls="custom-content-below-procuracao" aria-selected="true" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;PROCURAÇÃO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-content-below-declaracao-tab" data-toggle="pill" href="#custom-content-below-declaracao" role="tab" aria-controls="custom-content-below-declaracao" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;DECLARAÇÃO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-content-below-contrato-tab" data-toggle="pill" href="#custom-content-below-contrato" role="tab" aria-controls="custom-content-below-contrato" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;CONTRATO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-content-below-recibo-tab" data-toggle="pill" href="#custom-content-below-recibo" role="tab" aria-controls="custom-content-below-recibo" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;RECIBO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link list-group-item-action disabled" aria-disabled="true" id="custom-content-below-substabelecimento-tab" data-toggle="pill" href="#custom-content-below-substabelecimento" role="tab" aria-controls="custom-content-below-substabelecimento" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;SUBSTABELECIMENTO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link list-group-item-action disabled" aria-disabled="true" id="custom-content-below-renuncia-tab" data-toggle="pill" href="#custom-content-below-renuncia" role="tab" aria-controls="custom-content-below-renuncia" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;RENÚNCIA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link list-group-item-action disabled" aria-disabled="true" id="custom-content-below-revogacao-tab" data-toggle="pill" href="#custom-content-below-revogacao" role="tab" aria-controls="custom-content-below-revogacao" aria-selected="false" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><i class="fas fa-file-pdf" style="color: rgb( 223, 165, 151 );"></i>&nbsp;REVOGAÇÃO</a>
          </li>
        </ul>

        <div class="tab-content" id="custom-content-below-tabContent">

          <!--// INÍCIO PROCURAÇÃO //-->
          <div class="tab-pane fade" id="custom-content-below-procuracao" role="tabpanel" aria-labelledby="custom-content-below-procuracao-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">

                <form name="form_procuracao" action="?pg=documents/doc_procuracao" method="POST">
                  <input type="hidden" name="ACTION" value="PROCURACAO" />
                  <input type="hidden" name="ID" value="<?= $ID; ?>" />

                  <!--// 1. SELEÇÃO PROCURADORES //-->
                  <div class="card card-secondary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">1. SELECIONAR PROCURADOR(ES)</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <select class="duallistbox" multiple="multiple" id="ADV_ADVOGADOS" name="ADV_ADVOGADOS[]" required>
                              <?php
                                $SQL = "SELECT ADV_ID, ADV_NOME FROM ADV_ADVOGADOS ORDER BY ADV_ID ";
                                $RESULTADO = mysqli_query( $CONN, $SQL );
                                while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                                <option value = "<?php echo $DADOS[ 'ADV_ID' ]; ?>"><?php echo $DADOS[ 'ADV_NOME' ]; ?></option>
                              <?php }	?>
                            </select>
                          </div><!-- /.form-group -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                      * Clique sobre o nome na lista para selecionar o procurador.
                    </div>
                  </div><!-- /.card -->

                  <br />

                  <!--// 2. PODERES OUTORGADOS //-->
                  <div class="card card-secondary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">2. PODERES OUTORGADOS</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_procuracao" class="form-control" name="ADV_PODERES" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DPR_PODERES FROM DOC_PROCURACAO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $ADV_PODERES = $DADOS[ 'DPR_PODERES' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div><!-- /.card-body -->
                  </div><!-- /.card -->

                  <div class="card-footer">
                    <div class="" style="text-align: center;">
                      <button class="btn btn-default btn-sm" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" title="Imprimir Procuração" style="color: rgb( 211, 188, 140 ); text-transform: uppercase; letter-spacing: 0.1em; text-align: center;" onmouseover="this.style.color='rgb( 241, 170, 83 )'" onmouseout="this.style.color='rgb( 211, 188, 140 )'" onclick="document.form_procuracao.submit();"><i class="fas fa-print"></i>&nbsp;Imprimir Procuração</button>
                    </div>
                  </div>

                </form>

            </div><!-- /.row -->
          </div>
          <!--// FIM PROCURAÇÃO //-->

          <!-- INÍCIO DECLARAÇÃO -->
          <div class="tab-pane fade" id="custom-content-below-declaracao" role="tabpanel" aria-labelledby="custom-content-below-declaracao-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">

                <form name="form_declaracao" action="?pg=documents/doc_declaracao" method="POST">
                  <input type="hidden" name="ACTION" value="DECLARACAO" />
                  <input type="hidden" name="ID" value="<?= $ID; ?>" />

                  <!--// 1. DECLARAÇÃO //-->
                  <div class="card card-secondary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">DECLARAÇÃO</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_declaracao" class="form-control" name="DDE_DECLARACAO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DDE_DECLARACAO FROM DOC_DECLARACAO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DDE_DECLARACAO = $DADOS[ 'DDE_DECLARACAO' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div><!-- /.card-body -->
                  </div><!-- /.card -->

                  <div class="card-footer">
                    <div class="" style="text-align: center;">
                      <button class="btn btn-default btn-sm" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" title="Imprimir Declaração" style="color: rgb( 211, 188, 140 ); text-transform: uppercase; letter-spacing: 0.1em; text-align: center;" onmouseover="this.style.color='rgb( 241, 170, 83 )'" onmouseout="this.style.color='rgb( 211, 188, 140 )'" onclick="document.form_decl.submit();"><i class="fas fa-print"></i>&nbsp;Imprimir Declaração</button>
                    </div>
                  </div>

                </form>

            </div><!-- /.row -->
          </div>
          <!--// FIM DECLARAÇÃO //-->

          <!-- INÍCIO CONTRATO -->
          <div class="tab-pane fade" id="custom-content-below-contrato" role="tabpanel" aria-labelledby="custom-content-below-contrato-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
              <style>
                .stepwizard-step p {
                    margin-top: 0px;
                    color:#666;
                }
                .stepwizard-row {
                    display: table-row;
                }
                .stepwizard {
                    display: table;
                    width: 100%;
                    position: relative;
                }
                .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
                    opacity:1 !important;
                    color:#bbb;
                }
                .stepwizard-row:before {
                    top: 14px;
                    bottom: 0;
                    position: absolute;
                    content:" ";
                    width: 100%;
                    height: 1px;
                    background-color: #ccc;
                    z-index: 0;
                }
                .stepwizard-step {
                    display: table-cell;
                    text-align: center;
                    position: relative;
                }
                .btn-circle {
                    width: 30px;
                    height: 30px;
                    text-align: center;
                    padding: 6px 0;
                    font-size: 12px;
                    line-height: 1.428571429;
                    border-radius: 15px;
                }
              </style>
              <div class="card card-secondary card-outline">

                <div class="stepwizard mt-3 mb-3">
                  <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-xs-3">
                      <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                      <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                      <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                      <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    </div>
                    <div class="stepwizard-step col-xs-3">
                      <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                    </div>
                  </div>
                </div>

                <form role="form" id="" name="form_contrato" action="?pg=documents/doc_contrato" method="POST">
                  <input type="hidden" name="ACTION" value="CONTRATO" />
                  <input type="hidden" name="ID" value="<?= $ID; ?>" />

                  <div class="panel panel-primary setup-content text-left" id="step-1">
                    <div class="panel-body">
                      <!-- // 1| SELEÇÃO PROCURADORES // -->
                      <label for="ADV_ADVOGADOS">1| SELECIONAR CONTRATADO(S)</label>
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <select class="duallistbox" multiple="multiple" id="ADV_ADVOGADOS" name="ADV_ADVOGADOS[]" required="required">
                            <?php
                              $SQL = "SELECT ADV_ID, ADV_NOME FROM ADV_ADVOGADOS ORDER BY ADV_ID ";
                              $RESULTADO = mysqli_query( $CONN, $SQL );
                              while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                              <option value="<?php echo $DADOS[ 'ADV_ID' ]; ?>"><?php echo $DADOS[ 'ADV_NOME' ]; ?></option>
                            <?php }	?>
                            </select>
                          </div><!-- /.form-group -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div>
                    <div class="panel-footer text-center">
                      <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
                    </div>
                  </div>

                  <div class="panel panel-primary setup-content text-left" id="step-2">
                    <div class="panel-body">
                      <!--// 2 |	DO OBJETO //-->
                      <label for="DCO_OBJETO">2| DO OBJETO</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_objeto" class="form-control" name="DCO_OBJETO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_OBJETO FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_OBJETO = $DADOS[ 'DCO_OBJETO' ];
                            ?>
                          </textarea>
                          <input type="text" class="form-control" id="PROCEDIMENTO" name="PROCEDIMENTO" size="25" maxlength="80" placeholder="Ação/Procedimento" onkeyup="this.value = this.value.toUpperCase();" required />
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!--// 3| DAS OBRIGAÇÕES DOS ADVOGADOS //-->
                      <label for="DCO_OBG_ADV">3| DAS OBRIGAÇÕES DOS ADVOGADOS</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_obg_adv" class="form-control" name="DCO_OBG_ADV" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_OBG_ADV FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_OBG_ADV = $DADOS[ 'DCO_OBG_ADV' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 4|	DAS DESPESAS -->
                      <label for="DCO_DESPESAS">4|	DAS DESPESAS</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_despesas" class="form-control" name="DCO_DESPESAS" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_DESPESAS FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_DESPESAS = $DADOS[ 'DCO_DESPESAS' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 5|	DAS OBRIGAÇÕES DO CLIENTE -->
                      <label for="DCO_OBG_CLIENTE">5|	DAS OBRIGAÇÕES DO CLIENTE</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_obg_cliente" class="form-control" name="DCO_OBG_CLIENTE" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_OBG_CLIENTE FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_OBG_CLIENTE = $DADOS[ 'DCO_OBG_CLIENTE' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div>
                    <div class="panel-footer text-center">
                      <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
                    </div>
                  </div>

                  <div class="panel panel-primary setup-content text-left" id="step-3">
                    <div class="panel-body">
                      <!-- 6|	DOS HONORARIOS ADVOCATICIOS -->
                      <label for="DCO_HON_ADV">6|	DOS HONORARIOS ADVOCATICIOS</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_hon_adv" class="form-control" name="DCO_HON_ADV" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_HON_ADV FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_HON_ADV = $DADOS[ 'DCO_HON_ADV' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div>
                    <div class="panel-footer text-center">
                      <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
                    </div>
                  </div>

                  <div class="panel panel-primary setup-content text-left" id="step-4">
                    <div class="panel-body">
                      <!-- 7|	DA MULTA PELO DESCUMPRIMENTO -->
                      <label for="DCO_MULTA_DESC">7|	DA MULTA PELO DESCUMPRIMENTO</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_multa_desc" class="form-control" name="DCO_MULTA_DESC" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_MULTA_DESC FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_MULTA_DESC = $DADOS[ 'DCO_MULTA_DESC' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 8|	DO PEDIDO DE DESISTÊNCIA PELO “CLIENTE” -->
                      <label for="DCO_DESISTENCIA">8|	DO PEDIDO DE DESISTÊNCIA PELO <b>CLIENTE</b></label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_desistencia" class="form-control" name="DCO_DESISTENCIA" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_DESISTENCIA FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_DESISTENCIA = $DADOS[ 'DCO_DESISTENCIA' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 9| DA ACORDO REALIZADO PELO “CLIENTE” -->
                      <label for="DCO_ACORDO">9| DA ACORDO REALIZADO PELO <b>CLIENTE</b></label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_acordo" class="form-control" name="DCO_ACORDO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_ACORDO FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_ACORDO = $DADOS[ 'DCO_ACORDO' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 10| DOS MEIOS DE COMUNICAÇÕES -->
                      <label for="DCO_COMUNICACOES">10| DOS MEIOS DE COMUNICAÇÕES</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_comunicacoes" class="form-control" name="DCO_COMUNICACOES" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_COMUNICACOES FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_COMUNICACOES = $DADOS[ 'DCO_COMUNICACOES' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div>
                    <div class="panel-footer text-center">
                      <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
                    </div>
                  </div>

                  <div class="panel panel-primary setup-content text-left" id="step-5">
                    <div class="panel-body">
                      <!-- 11| DO TRATAMENTO DOS DADOS -->
                      <label for="DCO_DADOS">11| DO TRATAMENTO DOS DADOS</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_dados" class="form-control" name="DCO_DADOS" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_DADOS FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_DADOS = $DADOS[ 'DCO_DADOS' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 12| DA REPRESENTAÇÃO -->
                      <label for="DCO_REPRESENTACAO">12| DA REPRESENTAÇÃO</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_representacao" class="form-control" name="DCO_REPRESENTACAO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_REPRESENTACAO FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_REPRESENTACAO = $DADOS[ 'DCO_REPRESENTACAO' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 13| DA COBRANCA JUDICIAL -->
                      <label for="DCO_COBRANCA">13| DA COBRANCA JUDICIAL</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_cobranca" class="form-control" name="DCO_COBRANCA" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_COBRANCA FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_COBRANCA = $DADOS[ 'DCO_COBRANCA' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 14| DO PROTESTO DA DÍVIDA -->
                      <label for="DCO_PROTESTO">14| DO PROTESTO DA DÍVIDA</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_protesto" class="form-control" name="DCO_PROTESTO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_PROTESTO FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_PROTESTO = $DADOS[ 'DCO_PROTESTO' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                      <br />
                      <!-- 15| DA PENHORA DE VERBA SALARIAL -->
                      <label for="DCO_PENHORA">15| DA PENHORA DE VERBA SALARIAL</label>
                      <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                        <div class="col-sm-12">
                          <textarea id="summernote_dco_penhora" class="form-control" name="DCO_PENHORA" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                            <?php
                              $SQL = mysqli_query( $CONN, " SELECT DCO_PENHORA FROM DOC_CONTRATO " );
                              $DADOS = mysqli_fetch_array( $SQL );
                              echo $DCO_PENHORA = $DADOS[ 'DCO_PENHORA' ];
                            ?>
                          </textarea>
                        </div>
                      </div><!-- /.row -->
                    </div>
                    <div class="panel-footer text-center">
                      <button class="btn btn-success pull-right" type="submit">Finalizar</button>
                    </div>
                  </div>

                </form>
              </div>

            </div><!-- /.row -->
          </div>
          <!--// FIM CONTRATO //-->

          <!-- INÍCIO RECIBO -->
          <div class="tab-pane fade" id="custom-content-below-recibo" role="tabpanel" aria-labelledby="custom-content-below-recibo-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">

              <form name="form_recibo" action="?pg=documents/doc_recibo" method="POST">
                <input type="hidden" name="ACTION" value="RECIBO" />
                <input type="hidden" name="ID" value="<?= $ID; ?>" />

                <!--// 1. RELAÇÃO DE DOCUMENTO(S) RESTITUÍDOS //-->
                <div class="card card-secondary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">1. RELAÇÃO DE DOCUMENTO(S) RESTITUÍDO(S):</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                      <div class="col-sm-12">
                        <textarea id="summernote_rol_docs" class="form-control" name="REC_ROL_DOCS" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                          <?php
                            $SQL = mysqli_query( $CONN, " SELECT REC_ROL_DOCS FROM DOC_RECIBO " );
                            $DADOS = mysqli_fetch_array( $SQL );
                            echo $ADV_PODERES = $DADOS[ 'REC_ROL_DOCS' ];
                          ?>
                        </textarea>
                      </div>
                    </div><!-- /.row -->
                  </div><!-- /.card-body -->
                </div><!-- /.card -->

                <br />

                <!--// 2. SELEÇÃO PROCURADORES //-->
                <div class="card card-secondary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">1. SELECIONAR PROCURADOR(ES)</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <select class="duallistbox" multiple="multiple" id="ADV_ADVOGADOS" name="ADV_ADVOGADOS[]" required>
                            <?php
                              $SQL = "SELECT ADV_ID, ADV_NOME FROM ADV_ADVOGADOS ORDER BY ADV_ID ";
                              $RESULTADO = mysqli_query( $CONN, $SQL );
                              while ( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
                              <option value = "<?php echo $DADOS[ 'ADV_ID' ]; ?>"><?php echo $DADOS[ 'ADV_NOME' ]; ?></option>
                            <?php }	?>
                          </select>
                        </div><!-- /.form-group -->
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.card-body -->
                  <div class="card-footer">
                    * Clique sobre o nome na lista para selecionar o procurador.
                  </div>
                </div><!-- /.card -->

                <br />

                <!--// 3. DECLARAÇÃO //-->
                <div class="card card-secondary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">3. DECLARAÇÃO</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="row" style="justify-content: justify; align-items: justify; vertical-align: middle; text-align: justify;">
                      <div class="col-sm-12">
                        <textarea id="summernote_rec_termo" class="form-control" name="REC_TERMO" rows="30" wrap="soft" style="font-size: 1.0em; letter-spacing: 0.1em; overflow: hidden; resize: none; text-align: justify;">
                          <?php
                            $SQL = mysqli_query( $CONN, " SELECT REC_TERMO FROM DOC_RECIBO " );
                            $DADOS = mysqli_fetch_array( $SQL );
                            echo $ADV_PODERES = $DADOS[ 'REC_TERMO' ];
                          ?>
                        </textarea>
                      </div>
                    </div><!-- /.row -->
                  </div><!-- /.card-body -->
                </div><!-- /.card -->

                <div class="card-footer">
                  <div class="" style="text-align: center;">
                    <button class="btn btn-default btn-sm" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" title="Imprimir Recibo" style="color: rgb( 211, 188, 140 ); text-transform: uppercase; letter-spacing: 0.1em; text-align: center;" onmouseover="this.style.color='rgb( 241, 170, 83 )'" onmouseout="this.style.color='rgb( 211, 188, 140 )'" onclick="document.form_recibo.submit();"><i class="fas fa-print"></i>&nbsp;Imprimir Recibo</button>
                  </div>
                </div>

              </form>

            </div><!-- /.row -->
          </div>
          <!--// FIM RECIBO //-->

          <!-- INÍCIO SUBSTABELECIMENTO -->
          <div class="tab-pane fade" id="custom-content-below-substabelecimento" role="tabpanel" aria-labelledby="custom-content-below-substabelecimento-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">



            </div><!-- /.row -->
          </div>
          <!--// FIM SUBSTABELECIMENTO //-->

          <!-- INÍCIO RENÚNCIA -->
          <div class="tab-pane fade" id="custom-content-below-renuncia" role="tabpanel" aria-labelledby="custom-content-below-renuncia-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">



            </div><!-- /.row -->
          </div>
          <!--// FIM RENÚNCIA //-->

          <!-- INÍCIO REVOGAÇÃO -->
          <div class="tab-pane fade" id="custom-content-below-revogacao" role="tabpanel" aria-labelledby="custom-content-below-revogacao-tab">
            <div class="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">



            </div><!-- /.row -->
          </div>
          <!--// FIM REVOGAÇÃO //-->

        </div>
        <!-- FIM ABAS -->

      </div><!-- /.card-body -->
    </div><!-- /.row -->

</div><!-- /.container-fluid -->

<!-- Bootstrap4 Duallistbox -->
<script src="./plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Summernote -->
<script src="./plugins/summernote/summernote-bs4.min.js"></script>

<!-- BS-Stepper -->
<script src="./plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- jquery-validation -->
<script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./plugins/jquery-validation/additional-methods.min.js"></script>

<!-- Funções -->
<script>
  $(function () {
    // Procuração
    $('#summernote_procuracao').summernote()
    // Declaração
    $('#summernote_declaracao').summernote()
    // Contrato ?
    $('#summernote_contrato').summernote()
    // Recibo
    $('#summernote_rol_docs').summernote()
    $('#summernote_rec_termo').summernote()
    // Contrato
    $('#summernote_dco_objeto').summernote()
    $('#summernote_dco_obg_adv').summernote()
    $('#summernote_dco_despesas').summernote()
    $('#summernote_dco_obg_cliente').summernote()
    $('#summernote_dco_hon_adv').summernote()
    $('#summernote_dco_multa_desc').summernote()
    $('#summernote_dco_desistencia').summernote()
    $('#summernote_dco_acordo').summernote()
    $('#summernote_dco_comunicacoes').summernote()
    $('#summernote_dco_dados').summernote()
    $('#summernote_dco_representacao').summernote()
    $('#summernote_dco_cobranca').summernote()
    $('#summernote_dco_protesto').summernote()
    $('#summernote_dco_penhora').summernote()

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
  })

  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
</script>

<!-- Form Contrato -->
<script>
  $(document).ready(function () {

  var navListItems = $('div.setup-panel div a'),
      allWells = $('.setup-content'),
      allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
          $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-success').addClass('btn-default');
          $item.addClass('btn-success');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function () {
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for (var i = 0; i < curInputs.length; i++) {
          if (!curInputs[i].validity.valid) {
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-success').trigger('click');
  });
</script>