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
  }
?>

<div class="container-fluid">
  <table id="deb" class="table table-dark table-striped table-hover table-sm">
    <caption>Resultado da consulta</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ativo</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Processo</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Cliente</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Descrição</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Valor</th>
        </tr>
    </thead>
    <tbody>
      <?php
        $SQL = "SELECT DEV.*, CLI.CLI_NOME, CLI.CLI_CIDADE, PAS.PAS_NOME, STA.STA_NAME
                  FROM DEV_CALC_MOV DEV
                  JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = DEV.DEV_FK_CLIENT
                  JOIN STA_STATUS STA ON STA.STA_ID = DEV.DEV_FK_STATUS
                  JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = DEV.DEV_FK_FOLDER
                 WHERE DEV.DEV_FK_STATUS = 1
                   AND CLI.CLI_ID = '$ID'
              ORDER BY DEV.DEV_FK_FOLDER ASC, DEV.DEV_DATE DESC ";

        $RESULTADO = mysqli_query( $CONN, $SQL );
        $VERIFICA = mysqli_num_rows( $RESULTADO );

        if( $VERIFICA > 0 ) {
            while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>

        <tr>
            <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DEV_DATE = date("d/m/Y", strtotime( $DADOS[ 'DEV_DATE' ] ) ); ?></th>
            <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle;">
            <?php
              if( $DADOS[ 'DEV_FK_STATUS' ] == 1 ) {
                echo '<h7><i class="fas fa-check-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 57, 255, 20, 90 );"></i></h7>'; // 1 - ATIVO
              } else {
                echo '<h7><i class="fas fa-times-circle" style="justify-content: center; align-items: center; display: table-cell; vertical-align: middle; font-size: 1.5rem; text-align: center; color: rgb( 220, 53, 69 );"></i></h7>'; // 0 - INATIVO
              }
            ?>
            </td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;">
              <a href="?pg=debtor/deb_main" style="color: rgb( 211, 211, 213 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 211, 211, 213 )'"><?= processNumber( "#######-##.####.#.##.####" , $DADOS[ 'DEV_PROCESS' ] ); ?></a>
            </td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'CLI_NOME' ]; ?></td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'DEV_DESCRIPTION' ]; ?></td>
            <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= formata_dinheiro( $DADOS[ 'DEV_PRICE' ] ) ?></td>
        </tr>

      <?php } } ?>

    </tbody>
  </table>

</div><!-- /.container-fluid -->