<?php
  if (!isset($_SESSION)) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/tsk_proc.php');
?>

<a name="topo"></a>

<div class="content-wrapper">

    <section class="content">
      <div class="container-fluid">

        <?php require './menuh.php'; ?>

        <div class="invoice p-3 card-primary card-outline">

          <div class="row legend">
            <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $tasksTitle; ?><span class="subtitle"><?= $tasksSubtitle; ?></span></legend>
          </div>

          <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

          <!-- /.BLOCO ADD/TAREFA -->
          <div class="row justify-content-md-center">

            <div class="container" style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_task">
              <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Tarefa</h3>

              <form class="row g-3 needs-validation" novalidate action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
                <input type="hidden" name="ACTION" value="SAVE" />
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Natureza</legend>
                        <select class="form-control form-select select2" name="PNA_PROC_NATUREZA" style="width: 100%;" id="validationCustom" required>
                          <option selected disabled value="">Selecione...</option>
                          <?php
                            $QR = mysqli_query( $CONN, " SELECT * FROM PNA_PROC_NATUREZA " );
                            while ( $ROW = mysqli_fetch_array( $QR ) ) {
                          ?>
                            <option <?php if (isset($_GET['filter_cat']) && $_GET['filter_cat'] == $ROW['PNA_ID']) echo "selected=selected" ?> value="<?= $ROW['PNA_ID']; ?>"><?= $ROW['PNA_NOME']; ?></option>
                          <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                          Selecione uma opção.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Cliente</legend>
                        <select class="form-control form-select select3" name="CLI_CLIENTES" style="width: 100%;" id="validationCustom1" required>
                          <option selected disabled value="">Selecione...</option>
                          <?php
                            $QR = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER BY CLI_NOME " );
                            while ( $ROW = mysqli_fetch_array( $QR ) ) {
                          ?>
                            <option <?php if (isset($_GET['filter_cat']) && $_GET['filter_cat'] == $ROW['CLI_ID']) echo "selected=selected" ?> value="<?= $ROW['CLI_ID']; ?>"><?= $ROW['CLI_NOME']; ?></option>
                          <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                          Selecione uma opção.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <fieldset>
                          <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Descrição</legend>
                          <textarea class="form-control" name="DESCRICAO" rows="5" cols="10" wrap="soft" style="resize: none; text-align: justify;" required></textarea>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Atribuir a</legend>
                        <select class="form-control form-select select3" name="USR_FK_CLIENT" style="width: 100%;" id="validationCustom2" required>
                          <option selected disabled value="">Selecione...</option>
                          <?php
                            $USR_FK_CLIENT = $_SESSION[ 'USR_FK_CLIENT' ];
                            $QR = mysqli_query( $CONN1, " SELECT U.*
                                                            FROM SYS_USERS U
                                                           WHERE U.USR_FK_CLIENT = '$USR_FK_CLIENT'
                                                             AND U.USR_FK_STATUS = 1
                                                        ORDER BY U.USR_NAME
                                                        " );
                            while ( $ROW = mysqli_fetch_array( $QR ) ) {
                          ?>
                            <option <?php if (isset($_GET['filter_cat']) && $_GET['filter_cat'] == $ROW['USR_ID']) echo "selected=selected" ?> value="<?= $ROW['USR_ID']; ?>"><?= $ROW['USR_NAME']; ?></option>
                          <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                          Selecione uma opção.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Prazo</legend>
                        <input class="form-control" type="date" name="TAR_PZ_FIM" required />
                      </div>
                    </div>
                  </div><!-- /.row -->
                  <div class="text-center">
                    <button type="submit" value="Enviar" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salvar" onmouseover="this.style.color='rgb( 255, 199, 240 )'" onmouseout="this.style.color='rgb( 255, 229, 192 )'">
                      <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                    </button>
                    <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fechar" onclick="fecha('add_task')" onmouseover="this.style.color='rgb( 29, 166, 243 )'" onmouseout="this.style.color='rgb( 255, 229, 192 )'"><i class="fas fa-close"></i>Fechar</a>
                  </div>
                </div><!-- /.card-body -->
              </form>
            </div>

          </div>

          <div class="row table-responsive" style="overflow: hidden;">

            <!-- /.BLOCO FILTRO -->
            <hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
                <div class="col-<?php echo ($_SESSION['USR_FK_LEVEL'] == 4) ? '8' : '10'; ?> mt-2 mb-0">
                    <caption style="color: rgb( 254, 214, 122 );">Filtrar resultado por</caption>
                </div>

                <?php
                $selectedFilterAdm = isset($_GET['filter_adm']) ? $_GET['filter_adm'] : "";
                $selectedFilter = isset($_GET['filter']) ? $_GET['filter'] : "";

                if (isset($_SESSION['USR_FK_LEVEL']) && $_SESSION['USR_FK_LEVEL'] == 4) { ?>
                    <div class="col-2 mt-1 mb-1 text-left">
                        <form name="form_filter_adm" action="<?= $_SERVER['REQUEST_URI']; ?>" method="GET">
                            <input type="hidden" name="pg" value="tasks/tsk_main" />
                            <input type="hidden" name="filter" value="<?= $selectedFilter; ?>" />
                            <select class="form-control mt-1 mb-1" name="filter_adm" id="filter_adm" onchange="this.form.submit()">
                                <option disabled value="">Selecione...</option>
                                <option value="0" <?= ($selectedFilterAdm == "0") ? 'selected' : ''; ?>>APENAS EU</option>
                                <option value="1" <?= ($selectedFilterAdm == "1") ? 'selected' : ''; ?>>TODOS</option>
                            </select>
                        </form>
                    </div>
                <?php } ?>

                <div class="col-2 mt-1 mb-1 text-right">
                    <form name="form_filter" action="<?= $_SERVER['REQUEST_URI']; ?>" method="GET">
                        <input type="hidden" name="pg" value="tasks/tsk_main" />
                        <input type="hidden" name="filter_adm" value="<?= $selectedFilterAdm; ?>" />
                        <select class="form-control mt-1 mb-1" name="filter" onchange="this.form.submit()">
                            <option disabled value="">Selecione...</option>
                            <option value="1" <?= ($selectedFilter == "1") ? 'selected' : ''; ?>>PENDENTES</option>
                            <option value="3" <?= ($selectedFilter == "3") ? 'selected' : ''; ?>>CONCLUÍDOS</option>
                            <option value="0" <?= ($selectedFilter == "0") ? 'selected' : ''; ?>>FINALIZADOS</option>
                        </select>
                    </form>
                </div>
            </div>

            <hr class="mt-1 mb-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

            <table id="tsk_main" class="table table-sm table-dark table-striped table-hover overflow-hidden" style="overflow: hidden;">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    ID
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Data
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Natureza
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Cliente
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Descrição
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Pasta
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Criado por:
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Atribuido a:
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Prazo
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Situação
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Status
                  </th>
                  <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    Ação
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $USR_ACCESS = $_SESSION['USR_ID'];
                    $USR_LEVEL = $_SESSION['USR_FK_LEVEL'];
                    $whereConditions = [
                        "TAR.TAR_FK_STATUS = 1", // Status padrão: Pendente
                        "TAR.TAR_FK_SITUACAO < 3", // Situação padrão: Pendente ou Em Andamento
                        "TAR.TAR_TIPO = 0" // Apenas tarefas
                    ];

                    // Verifica filtro geral
                    if (isset($_GET['filter'])) {
                        $filterValue = $_GET['filter'];
                        if ($filterValue == 0) {
                            $whereConditions = ["TAR.TAR_FK_STATUS = 0", "TAR.TAR_TIPO = 0"];
                        } elseif ($filterValue == 1) {
                            $whereConditions = ["TAR.TAR_FK_STATUS = 1", "TAR.TAR_FK_SITUACAO < 3", "TAR.TAR_TIPO = 0"];
                        } elseif ($filterValue == 3) {
                            $whereConditions = ["TAR.TAR_FK_STATUS = 1", "TAR.TAR_FK_SITUACAO = 3", "TAR.TAR_TIPO = 0"];
                        }
                    }

                    // Se filter_adm = 1, ignora filtro por usuário logado
                    if (!(isset($_GET['filter_adm']) && $_GET['filter_adm'] == 1)) {
                        $whereConditions[] = "(TAR.TAR_FK_ATRIBUIDO = '$USR_ACCESS' OR TAR.TAR_USER_CREATION = '$USR_ACCESS')";
                    }

                    // Junta todas as condições para o WHERE
                    $whereSQL = implode(" AND ", $whereConditions);

                    $SQL = "SELECT TAR.*, PNA.*, CLI.*, SIT.*, PAS.*
                            FROM TAR_TAREFAS TAR
                            LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID = TAR.TAR_FK_NATUREZA
                            LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = TAR.TAR_FK_CLIENTE
                            LEFT JOIN TAR_SITUACAO SIT ON SIT.TAR_ID_SIT = TAR.TAR_FK_SITUACAO
                            LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                            WHERE $whereSQL
                            ORDER BY TAR.TAR_PZ_FIM ASC";

                    $RESULTADO = mysqli_query($CONN, $SQL);
                    $VERIFICA = mysqli_num_rows($RESULTADO);

                    if ($VERIFICA > 0) {
                        while ($DADOS = mysqli_fetch_assoc($RESULTADO)) {
                ?>
                <tr>
                  <!-- ID -->
                  <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;"><?= $DADOS['TAR_ID']; ?></th>
                  <!-- Data -->
                  <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;"><?= $TAR_DT_CREATION = date("d/m/Y", strtotime( $DADOS[ 'TAR_DT_CREATION' ] ) ); ?></td>
                  <!-- Natureza -->
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;"><?= $DADOS['PNA_NOME']; ?></td>
                  <!-- Cliente -->
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;"><a href="?pg=clients/clien_view&id=<?= $DADOS['CLI_ID']; ?>" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><?= $DADOS['CLI_NOME'] ?></a></td>
                  <!-- Descrição -->
                  <td style="width: 20% !important; justify-content: center; align-items: center; text-align: justify; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;">
                    <?php
                      // Se o texto for maior que 30, exibe até 30 caracteres
                      if( strlen( $DADOS['TAR_DESCRICAO'] ) > 30 ) {
                        echo substr( $DADOS['TAR_DESCRICAO'], 0, 30 ) . " [...]";
                      }
                      // senão, exibe o texto completo
                      else{
                        echo $DADOS['TAR_DESCRICAO'];
                      }
                    ?>
                  </td>
                  <!-- Pasta -->
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
                    <?php
                      $SQL = mysqli_query($CONN, " SELECT PAS_ID, PAS_NOME FROM PAS_PROC_PASTA ORDER By PAS_NOME ");
                      while ($ROW = mysqli_fetch_array($SQL)) {
                        if ($DADOS['CLI_FK_PASTA'] == $ROW['PAS_ID']) {
                          $PASTA = $DADOS['CLI_FK_PASTA'];
                          echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $ROW['PAS_NOME'] . '</h7>';
                        }
                      }
                    ?>
                  </td>
                  <!-- Criado por: -->
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;">
                    <?php
                      $USR_CREATED = $DADOS['TAR_USER_CREATION'];
                      $ATRIBUIDO   = $DADOS['TAR_FK_ATRIBUIDO'];
                      $QR = mysqli_query( $CONN1, " SELECT U.*
                                                      FROM SYS_USERS U
                                                     WHERE U.USR_FK_CLIENT = '$USR_FK_CLIENT'
                                                       AND U.USR_ID = '$USR_CREATED'
                                                       AND U.USR_FK_STATUS = 1
                                                  " );
                      $ROW = mysqli_fetch_array( $QR );
                      echo $ROW['USR_LOGIN'];
                    ?>
                  </td>
                  <!-- Atribuído a: -->
                  <?php if( $_SESSION[ 'USR_FK_LEVEL' ] == 4 ) { echo ' '; } ?>
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase;">
                    <?php
                      $ATRIBUIDO   = $DADOS['TAR_FK_ATRIBUIDO'];
                      $QR = mysqli_query( $CONN1, " SELECT U.*
                                                      FROM SYS_USERS U
                                                     WHERE U.USR_FK_CLIENT = '$USR_FK_CLIENT'
                                                       AND U.USR_ID = '$ATRIBUIDO'
                                                       AND U.USR_FK_STATUS = 1
                                                  " );
                      $ROW = mysqli_fetch_array( $QR );
                      echo $ROW['USR_LOGIN'];
                    ?>
                  </td>
                  <!-- Prazo: -->
                  <td style="text-align: center; display: table-cell; vertical-align: middle; color: rgb(143, 185, 205); text-transform: uppercase; padding: 10px 0;">
                    <?php
                        // Apresentação da data numérica
                        $PRAZO = $DADOS['TAR_PZ_FIM'];
                        // Criar o objeto DateTime diretamente com o formato do banco de dados (Y-m-d)
                        // $PRAZO = DateTime::createFromFormat('Y-m-d', datetime: $PRAZO);
                        $PRAZO = DateTime::createFromFormat('Y-m-d H:i:s', $DADOS['TAR_PZ_FIM']);

                        if (!$PRAZO)
                        {
                            // Caso o prazo não seja uma data válida, mostrar uma mensagem de erro ou fazer outro tratamento
                            echo "<strong style='color: red;'>Data inválida</strong>";
                        } else {
                            $TAR_FK_SITUACAO = $DADOS['TAR_FK_SITUACAO'];
                            $TAR_FK_STATUS   = $DADOS['TAR_FK_STATUS'];

                            // Apresentação do dia da semana - inicializando IntlDateFormatter
                            $fmt = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Sao_Paulo', IntlDateFormatter::GREGORIAN, 'EEEE');
                            $diaSemana = '<small class="mt-0" style="color: #ECEFF1; font-size: 0.7em; font-weight: 500; letter-spacing: 0.1em; line-height: 0.9em; text-transform: uppercase; display: block; margin-top: -5px;">' . $fmt->format($PRAZO) . '</small>';

                            // Definir cor e estilo baseado na situação e prazo
                            $corDataPrazo = '#33F51F'; // Verde (default para futuro)
                            $isBold = false;

                            if ($TAR_FK_SITUACAO == 3 || $TAR_FK_STATUS == 0) {
                                $corDataPrazo = '#C2C8CE'; // Cinza (para concluído/finalizado)
                            } else {
                                $today = new DateTime();

                                if ($PRAZO <= $today) {
                                    $corDataPrazo = '#F00'; // Vermelho (para atrasado ou hoje)
                                    $isBold = true;
                                } elseif ($PRAZO <= (clone $today)->modify('+3 days')) {
                                    $corDataPrazo = '#FCC522'; // Amarelo (para próximos 3 dias)
                                }
                            }

                            // Exibir data formatada com estilo apropriado
                            $tag = $isBold ? 'strong' : 'span';
                            echo "<{$tag} style='color: {$corDataPrazo}; line-height: 1; display: inline-block;'>" . $PRAZO->format('d/m/Y') . "<br />" . $diaSemana . "</{$tag}>";
                        }
                    ?>
                    </td>
                  <!-- Situação: -->
                  <td style="color: rgb( 237, 237, 237 ); font-size: 1.0em; font-weight: 600; letter-spacing: 0.1em; line-height: 0.9em; text-transform: uppercase;" class="project_progress">

                    <?php
                        $TAR_FK_SITUACAO = $DADOS['TAR_FK_SITUACAO'];
                        $TAR_SIT_NOME    = $DADOS['TAR_SIT_NOME'];
                        if ($TAR_FK_SITUACAO == 1) { // 1 - PENDENTE ?>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div><small style="color: #ECEFF1; font-size: 0.8em; font-weight: 500; letter-spacing: 0.1em; line-height: 0.9em; text-transform: uppercase;"><?= $TAR_SIT_NOME; ?></small>
                        <?php } else if ($TAR_FK_SITUACAO == 2) { // 2 - EM ANDAMENTO ?>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; background-color: #FAE086;"></div>
                            </div><small style="color: #FAE086; font-size: 0.8em; font-weight: 500; letter-spacing: 0.1em; line-height: 0.9em; text-transform: uppercase;"><?= $TAR_SIT_NOME; ?></small>
                        <?php } else { // 3 - CONCLUÍDO ?>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #D3D3D5;"></div>
                            </div><span style="color: #FFF; font-size: 0.8em; font-weight: 500; letter-spacing: 0.1em; line-height: 0.9em; text-transform: uppercase;"><?= $TAR_SIT_NOME; ?></span>
                        <?php }  ?>

                  </td>
                  <!-- Status: -->
                  <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">
                    <?php
                        if ($DADOS['TAR_FK_STATUS'] == 1) {
                            echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
                        } else {
                            echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
                        }
                    ?>
                  </td>
                  <!-- Ação: -->
                  <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;"><a href="javascript:;" class="btn btn-outline-info" style="text-decoration: none; color: rgb( 255, 255, 255);" onclick="abreFecha('opt_<?= $DADOS[ 'TAR_ID' ]; ?>')" title="Mais"><i class="fas fa-plus"></i></a></td>
                </tr>

                <!-- /.BLOCO UPDT/TAREFA -->
                <div class="row justify-content-md-center">

                    <div class="container" style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="opt_<?= $DADOS['TAR_ID']; ?>">
                    <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Editar Tarefa</h3>

                    <form class="row g-3 needs-validation" novalidate action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
                      <input type="hidden" name="ACTION" value="UPDT" />
                      <input type="hidden" name="TAR_ID" value="<?= $DADOS[ 'TAR_ID' ]; ?>" />
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Natureza</legend>
                              <select class="form-control form-select select2" name="PNA_PROC_NATUREZA" style="width: 100%;" id="validationCustom3" required>
                                <option selected disabled value="">Selecione...</option>
                                <?php
                                  $QR = mysqli_query( $CONN, " SELECT * FROM PNA_PROC_NATUREZA " );
                                  while ( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                  <option value="<?= $ROW[ 'PNA_ID' ]?>"<?php if( $DADOS[ 'TAR_FK_NATUREZA' ] == $ROW[ 'PNA_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'PNA_NOME' ]?></option>
                                <?php } ?>
                              </select>
                              <div class="invalid-feedback">
                                Selecione uma opção.
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Cliente</legend>
                              <select class="form-control form-select select3" name="CLI_CLIENTES" style="width: 100%;" id="validationCustom4" required>
                                <option selected disabled value="">Selecione...</option>
                                <?php
                                  $QR = mysqli_query( $CONN, " SELECT CLI_ID, CLI_NOME FROM CLI_CLIENTES ORDER BY CLI_NOME " );
                                  while ( $ROW = mysqli_fetch_array( $QR ) ) {
                                ?>
                                  <option value="<?= $ROW[ 'CLI_ID' ]?>"<?php if( $DADOS[ 'TAR_FK_CLIENTE' ] == $ROW[ 'CLI_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'CLI_NOME' ]?></option>
                                <?php } ?>
                              </select>
                              <div class="invalid-feedback">
                                Selecione uma opção.
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <fieldset>
                                <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Descrição</legend>
                                <textarea class="form-control" name="DESCRICAO" rows="5" cols="10" wrap="soft" style="resize: none; text-align: justify;" required><?= $DADOS[ 'TAR_DESCRICAO' ];?></textarea>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Atribuir a</legend>
                              <select class="form-control form-select select3" name="USR_FK_CLIENT" style="width: 100%;" id="validationCustom5" required>
                                <option selected disabled value="">Selecione...</option>
                                <?php
                                  $USR_FK_CLIENT = $_SESSION[ 'USR_FK_CLIENT' ];
                                  $QR = mysqli_query( $CONN1, " SELECT U.*
                                                                  FROM SYS_USERS U
                                                                 WHERE U.USR_FK_CLIENT = '$USR_FK_CLIENT'
                                                                   AND U.USR_FK_STATUS = 1
                                                              ORDER BY U.USR_NAME
                                                              " );
                                  while ( $ROW = mysqli_fetch_array( $QR ) ) {
                                ?>
                                  <option value="<?= $ROW[ 'USR_ID' ]?>"<?php if( $DADOS[ 'TAR_FK_ATRIBUIDO' ] == $ROW[ 'USR_ID' ] ) {?>selected<?php } ?>> <?= $ROW[ 'USR_NAME' ]?></option>
                                <?php } ?>
                              </select>
                              <div class="invalid-feedback">
                                Selecione uma opção.
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Prazo</legend>
                              <?php
                                // Data vinda do banco de dados no formato "2024-11-08 12:00:00"
                                $dataBanco = $DADOS[ 'TAR_PZ_FIM' ];

                                // Criar objeto DateTime
                                $dataObj = new DateTime($dataBanco);

                                // Formato esperado pelo input date
                                $dataFormatadaParaInput = $dataObj->format('Y-m-d');
                              ?>
                                <input class="form-control" type="date" id="datetime-picker1" name="TAR_PZ_FIM" value="<?php echo htmlspecialchars($dataFormatadaParaInput, ENT_QUOTES, 'UTF-8'); ?>" required />
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Situação</legend>
                              <select class="form-control form-select select3" name="TAR_FK_SITUACAO" style="width: 100%;" id="validationCustom5" required>
                                <option selected disabled value="">Selecione...</option>
                                <?php
                                  $QR = mysqli_query( $CONN, " SELECT * FROM TAR_SITUACAO " );
                                  while ( $ROW = mysqli_fetch_array( $QR ) ) {
                                ?>
                                  <option value="<?= $ROW[ 'TAR_ID_SIT' ]; ?>"<?php if( $DADOS[ 'TAR_FK_SITUACAO' ] == $ROW[ 'TAR_ID_SIT' ] ) {?>selected<?php } ?>> <?= $ROW[ 'TAR_SIT_NOME' ]; ?></option>
                                <?php } ?>
                              </select>
                              <div class="invalid-feedback">
                                Selecione uma opção.
                              </div>
                            </div>
                          </div>

                          <!-- Apresenta a opção de encerrar a tarefa apenas para quem a criou -->
                          <?php if( $_SESSION[ 'USR_ID' ] == $DADOS[ 'TAR_USER_CREATION' ] ) { ?>
                          <div class="col-md-3">
                            <div class="form-group">
                              <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Status</legend>
                              <select class="form-control form-select select3" name="TAR_FK_STATUS" style="width: 100%;" id="validationCustom7" required>
                                <option selected disabled value="">Selecione...</option>
                                <option value="1" <?= $DADOS['TAR_FK_STATUS'] == 1 ? 'selected' : ''; ?>>PENDENTE</option>
                                <option value="0" <?= $DADOS['TAR_FK_STATUS'] == 0 ? 'selected' : ''; ?>>FINALIZADO</option>
                              </select>
                              <div class="invalid-feedback">
                                Selecione uma opção.
                              </div>
                            </div>
                          </div>
                          <?php } ?>

                        </div><!-- /.row -->
                        <div class="text-center">
                          <button type="submit" value="Enviar" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salvar" onmouseover="this.style.color='rgb( 255, 199, 240 )'" onmouseout="this.style.color='rgb( 255, 229, 192 )'">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                          </button>
                          <a href="javascript:;" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fechar" onclick="fecha('opt_<?= $DADOS[ 'TAR_ID' ]; ?>')" onmouseover="this.style.color='rgb( 29, 166, 243 )'" onmouseout="this.style.color='rgb( 255, 229, 192 )'"><i class="fas fa-close"></i>Fechar</a>
                        </div>
                      </div><!-- /.card-body -->
                    </form>
                  </div>
                </div>
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
<?php mysqli_close($CONN); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputDate = document.getElementById('datetime-picker1');

        // Formatar a data para exibição dd/mm/yyyy
        const formatData = (dateStr) => {
            const [year, month, day] = dateStr.split('-');
            return `${day}/${month}/${year}`;
        };

        // Converter data para o formato yyyy-mm-dd antes de enviar o formulário
        document.getElementById('form-validation').addEventListener('submit', function(event) {
            const [day, month, year] = inputDate.value.split('/');
            const isoDate = `${year}-${month}-${day}`;
            inputDate.value = isoDate;
        });
    });
</script>

<script>
  (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>