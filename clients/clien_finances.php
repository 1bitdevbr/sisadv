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
    $DADOS = mysqli_fetch_array( $RESULTADO );

    $SQL = " SELECT PPR.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME
               FROM PPR_PROC_PROCESSOS PPR
               JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = PPR.PPR_FK_CLIENTE
               JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = PPR.PPR_FK_PASTA
              WHERE CLI.CLI_ID = '$ID'
                AND PPR.PPR_FK_DEFENSORIA = 2
           ORDER BY CLI.CLI_NOME ";

    $RESULTADO = mysqli_query( $CONN, $SQL );
    $VERIFICA = mysqli_num_rows( $RESULTADO );
  }
?>

<!-- CONTRATOS ATIVOS -->
<div class="container-fluid">
  <div class="row mb-0">
    <div class="form-group col-sm text-left mb-1" style="color: rgb( 211, 211, 213 );">
    <?php
      $SQL = mysqli_query( $CONN, " SELECT COUNT( PPR_ID )
                                      FROM PPR_PROC_PROCESSOS
                                     WHERE PPR_FK_CLIENTE = '$ID'
                                       AND PPR_FK_STATUS = 1
                                       AND PPR_FK_DEFENSORIA = 2
                                       AND PPR_SALDO > 0 ");
      $ROW = mysqli_fetch_array( $SQL );
      $DADOS = $ROW[ 0 ];

      $SQL = mysqli_query( $CONN, " SELECT SUM( PPR_VALOR_TOTAL ) AS TOTAL,
                                           SUM( PPR_VALOR_PARCELA ) AS TOTAL_PARCELA,
                                           SUM( PPR_SALDO ) AS SALDO
                                      FROM PPR_PROC_PROCESSOS
                                     WHERE PPR_FK_CLIENTE = '$ID'
                                       AND PPR_FK_STATUS = 1
                                       AND PPR_FK_DEFENSORIA = 2 ");
      $R = mysqli_fetch_assoc( $SQL );
      $PPR_VALOR_TOTAL = $R[ 'TOTAL' ];
      $TOTAL_PARCELA = $R[ 'TOTAL_PARCELA' ];
      $SALDO = $R[ 'SALDO' ];
    ?>
      <span style="text-align: left; color: rgb( 254, 214, 122 );">Contratos ativos:
        <b><?= $DADOS; ?></b></span><br />
      <span style="text-align: left;">Valor total:
        <b><?= formata_dinheiro($PPR_VALOR_TOTAL); ?></b></span><br />
      <span style="text-align: left;">À receber/mês:
        <b><?= formata_dinheiro($TOTAL_PARCELA); ?></b></span><br />
      <span style="text-align: left;">Saldo pendente:
        <b><?= formata_dinheiro($SALDO); ?></b></span>
    </div>
  </div>

  <hr class="mt-0 mb-1" style="width: auto; height: 1px; text-align: center; border: 2px; color: rgb( 86, 96, 106 ); background: rgb( 86, 96, 106 );" />

  <table id="finances" class="table table-dark table-striped table-hover table-sm">
    <caption>Resultado da consulta</caption>
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Ativo</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Cliente</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Procedimento</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Pasta</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          $ Contrato</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Parc</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          $ Parc</th>
        <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">
          Saldo</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if( $VERIFICA > 0 ) {
          while( $DADOS = mysqli_fetch_assoc( $RESULTADO ) ) {
      ?>
          <tr>
            <th style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
              <?php
              if ($DADOS['PPR_FK_STATUS'] == 1) {
                echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
              } else {
                echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
              }
              ?>
            </th>
            <td scope="row" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <a href="?pg=cases/cas_view&id=<?= $DADOS['PPR_ID']; ?>" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><?= $DADOS['CLI_NOME']; ?></a>
            </td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <?= $DADOS['PPR_TIPO_ACAO']; ?></td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle;">
              <?php
              if ($DADOS['PPR_FK_PASTA']) {
                $PASTA = $DADOS['PPR_FK_PASTA'];
                echo '<h7 style="color: ' . colorItem( $PASTA ) . '; font-weight: 600;"> ' . $DADOS['PAS_NOME'] . '</h7>';
              }
              ?>
            </td>
            <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <?= formata_dinheiro($DADOS['PPR_VALOR_TOTAL']); ?></td>
            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <?= $DADOS['PPR_QTD_PARCELA']; ?></td>
            <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <?= formata_dinheiro($DADOS['PPR_VALOR_PARCELA']); ?></td>
            <td style="justify-content: center; align-items: center; text-align: right; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 0.8em; font-weight: 600;">
              <?= formata_dinheiro($DADOS['PPR_SALDO']); ?></td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>

</div><!-- /.container-fluid -->