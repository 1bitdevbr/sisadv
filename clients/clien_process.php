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
  }
?>

<div class="container-fluid">
  <table id="cas" class="table table-dark table-striped table-hover table-sm">
    <caption>Resultado da consulta</caption>
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">#Caso</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Ativo</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Cliente</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Cidade</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Procedimento</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Processo</th>
        <th scope="col" class="col-4" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase;">Pasta</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if( $VERIFICA > 0 ) {
          while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) {
      ?>
        <tr>
          <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: auto;"><?= $DADOS['PPR_CASO']; ?></th>
          <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
            <?php
              if( $DADOS[ 'PPR_FK_STATUS' ] == 1 ) {
                echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
              } else {
                echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
              }
            ?>
          </td>
          <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 30%;">
            <a href="?pg=cases/cas_view&id=<?= $DADOS['PPR_ID']; ?>" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><?= $DADOS['CLI_NOME']; ?></a>
          </td>
          <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: auto;"><?= $DADOS['CLI_CIDADE']; ?></td>
          <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 40%;"><?= $DADOS['PPR_TIPO_ACAO']; ?></td>
          <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600; width: 16%;">
          <?php if ($DADOS['PPR_NUM_PROCESSO'] > 0) {
            $NUMPROCESS = processNumber("#######-##.####.#.##.####", $DADOS['PPR_NUM_PROCESSO']); ?>
            <div class="input-group">
              <input class="form-control" type="search" id="par_autorizacaoCaso_autorizacao_numeroProcessoUnificado" name="autorizacaoCaso.autorizacao.numeroProcessoUnificado" value="<?= $NUMPROCESS; ?>" aria-label="Search" readonly />
              <div class="input-group-append">
                <!-- <button name="Consultar Processo" title="Consultar Processo" id="par_3obzrl3jl99o2ussxsslr74e" class="btn btn-outline-danger btn-sm" value="javascript:consultarProcesso();" role="button" aria-disabled="false"><i class="fas fa-search fa-fw" style="color: rgb( 221, 221, 221 );"></i></button> -->
              </div>
            </div>
          <?php } ?>
          </td>
          <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
            <?php
            if( $DADOS[ 'PPR_FK_PASTA' ] ) {
              $PASTA = $DADOS[ 'PPR_FK_PASTA' ];
              echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</h7>';
            }
            ?>
          </td>
        </tr>
      <?php }
      }
      ?>
    </tbody>
  </table>
</div><!-- /.container-fluid -->