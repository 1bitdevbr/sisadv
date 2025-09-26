<?php
    if( !isset(  $_SESSION ) ) session_start();

    // Define o nível de acesso necessário
    $required_level = 2;

    // Inclui os arquivos necessários
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../access/conn.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../dist/func/functions.php');
    require_once(__DIR__ . '/fin_proc.php');
?>

<!-- Plugins requeridos para Área de Gráficos: -->
<!-- Plugin Chartjs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Inclua o plugin chartjs-plugin-datalabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<a name="topo"></a>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<?php require './menuh.php'; ?>

			<div class="invoice p-3 card-primary card-outline">

                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $financesTitle; ?><span class="subtitle"><?= $financesSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <!-- /.FAIXA DO MES -->
                <!-- <div class="row mt-0 mb-2" style="background-color: rgb( 63, 71, 78 );">
                    <div class="col-auto mt-1 mb-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=finances/fin_main&ano=<?= $ANO_HOJE; ?>&mes='+this.value)">
                            <?php for( $i = 1; $i <= 12; $i++  ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $MES_HOJE ) echo "selected=selected"?> ><?= mostraMes( $i ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto mt-1 mb-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano='+this.value)">
                            <?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $ANO_HOJE ) echo "selected=selected"?> ><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-10 mt-1 mb-1 text-right">
                        <h3 style="color: rgb( 253, 224, 139 );"><i class="icon fas fa-calendar"></i>&nbsp;<?= mostraMes( $MES_HOJE ) . '/' . $ANO_HOJE; ?></h3>
                    </div>
                </div> -->

                <!-- /.FAIXA DO MES -->
                <div class="row mt-0 mb-0 d-flex align-items-center p-1" style="background-color: rgb( 63, 71, 78 );">
                    <div class="col-auto p-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=finances/fin_main&ano=<?= $ANO_HOJE; ?>&mes='+this.value)">
                            <?php for( $i = 1; $i <= 12; $i++  ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $MES_HOJE ) echo "selected=selected"?> ><?= mostraMes( $i ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto p-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano='+this.value)">
                            <?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $ANO_HOJE ) echo "selected=selected"?> ><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="card-body col-8 p-1 text-center">
                        <ul class="pagination pagination-month justify-content-center mb-0">
                            <!-- Navegação para o ano anterior -->
                            <li class="page-item">
                                <a class="page-link" href="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE - 1; ?>">«</a>
                            </li>

                            <?php
                            // Loop pelos meses do ano atual selecionado
                            for ($mes = 1; $mes <= 12; $mes++) {
                                // Verifica se é o mês atual selecionado
                                $is_active = ($mes == $MES_HOJE) ? 'active' : '';

                                // Obter nome do mês abreviado
                                $nome_mes_abreviado = substr(mostraMes($mes), 0, 3);
                            ?>
                                <li class="page-item <?= $is_active ?>">
                                    <a class="page-link" href="index.php?pg=finances/fin_main&mes=<?= $mes ?>&ano=<?= $ANO_HOJE ?>">
                                        <p class="page-month mb-0"><?= $nome_mes_abreviado ?></p>
                                        <p class="page-year mb-0"><?= $ANO_HOJE ?></p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                            <!-- Navegação para o próximo ano -->
                            <li class="page-item">
                                <a class="page-link" href="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE + 1; ?>">»</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-2 p-1 text-right">
                        <h3 class="mb-0" style="color: rgb( 253, 224, 139 );"><i class="icon fas fa-calendar"></i>&nbsp;<?= mostraMes( $MES_HOJE ) . '/' . $ANO_HOJE; ?></h3>
                    </div>
                </div>

                <!-- /.BLOCO ADD/REMOV CAT./MOV. -->
                <div class="mt-1 mb-1">
                    <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_cat">
                        <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Categoria</h3>
                        <table class="table" width="100%" style="background-color: rgb( 69, 77, 85 );">
                            <tr>
                                <td valign="top">
                                    <form method="POST" action="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                        <div class="container" style="text-align: center;">
                                            <div class="row justify-content-md-center">
                                                <div class="col" style="text-align: center;">
                                                    <input type="hidden" name="acao" value="2" />
                                                    <strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Nome:</strong><br />
                                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" size="20" maxlength="50" required />
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
                                    <b>Editar/Remover Categorias:</b><br/><br/>
                                    <?php
                                        $QR = mysqli_query( $CONN, " SELECT LCA_ID, LCA_NOME FROM LCA_LC_CAT ");
                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                    ?>
                                    <div id="editar2_cat_<?= $ROW[ 'LCA_ID' ]; ?>">
                                        <?= $ROW[ 'LCA_NOME' ]; ?>
                                        <a style="font-size: 1.0em; color: rgb( 227, 164, 164 )" onclick="return confirm('Tem certeza que deseja remover esta categoria?\nAtenção: Apenas categorias sem movimentos associados poderão ser removidas.')" href="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar_cat&id=<?= $ROW[ 'LCA_ID' ]; ?>" title="Remover">[remover]</a>
                                        <a href="javascript:;" style="font-size: 1.0em; color: rgb( 119, 230, 189 )" onclick="document.getElementById('editar_cat_<?= $ROW[ 'LCA_ID' ]; ?>').style.display=''; document.getElementById('editar2_cat_<?= $ROW[ 'LCA_ID' ]; ?>').style.display='none'" title="Editar">[editar]</a>
                                    </div>
                                    <div style="display: none" id="editar_cat_<?= $ROW[ 'LCA_ID' ]; ?>">
                                        <form method="POST" action="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                            <input type="hidden" name="acao" value="editar_cat" />
                                            <input type="hidden" name="id" value="<?= $ROW[ 'LCA_ID' ]; ?>" />
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" value="<?= $ROW[ 'LCA_NOME' ]; ?>" size="20" maxlength="50" />
                                            <input type="submit" class="input" value="Alterar" />
                                        </form>
                                    </div>
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-1" style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_movimento">
                        <form method="POST" action="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                            <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Movimento</h3>
                            <?php
                                $QR = mysqli_query( $CONN, " SELECT * FROM LCA_LC_CAT ");
                                if( mysqli_num_rows( $QR ) == 0 )
                                    echo "Adicione ao menos uma categoria";
                                    else{
                            ?>
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="form-group col-auto border-right">
                                        <label for="tipo_receita" style="color: rgb( 0, 117, 255 );">
                                        <input class="form-control" type="radio" name="tipo" value="1" id="tipo_receita" required /> Receita</label>
                                        <label for="tipo_despesa" style="color: rgb( 228, 60, 48 );">
                                        <input class="form-control" type="radio" name="tipo" value="0" id="tipo_despesa" required /> Despesa</label>
                                    </div>
                                    <div class="form-group col">
                                        <label for="cat" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Categoria</label>
                                        <select class="form-control" name="cat">
                                            <?php
                                                while( $ROW = mysqli_fetch_array( $QR ) ) { ?>
                                                <option class="form-control" value="<?= $ROW[ 'LCA_ID' ]; ?>"><?= $ROW[ 'LCA_NOME' ]; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-auto text-center">
                                        <label for="dia" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Dia</label>
                                        <input type="hidden" name="acao" value="1" />
                                        <input class="form-control text-center" type="text" name="dia" size="2" maxlength="2" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" value="<?= date( 'd' )?>" onClick="this.select();" onfocus="this.value='';" required />
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="descricao" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Descrição</label>
                                        <input class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();" name="descricao" size="100" maxlength="255" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;" required />
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="valor" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Valor</label>
                                        <input class="form-control money" id="money" type="text" name="valor" size="10" maxlength="9" data-precision="2" style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: left; text-transform: uppercase;" onkeypress="$('.money').mask('000.000.000.000.000,00', {reverse: true});" required />
                                    </div>
                                    <div class="form-group col-2 text-left">
                                        <label for="submit" style="color: rgb( 52, 58, 64 );">.</label><br />
                                        <button type="submit" class="btn btn-primary" name="submit" title="Enviar" ><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                </div>

                <!-- /.BLOCO DE RESUMO ENTRADAS/SAIDAS - BALANÇO GERAL -->
                <div class="row lead card-body mt-0 mb-1 p-0" style="background-color: rgb( 64, 71, 78 );">
                    <div class="col">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border" style="color: rgb( 211, 211, 213 );">&nbsp; Entradas/Saídas no mês</legend>
                            <div class="card-body alert alert-secondary mb-0" style="background-color: rgb( 240, 240, 240 );">
                                <?php
                                    $QR = mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 1 && LCM_MES = '$MES_HOJE' && LCM_ANO = '$ANO_HOJE' ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS = $ROW[ 'TOTAL' ];

                                    $QR =mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 0 && LCM_MES = '$MES_HOJE' && LCM_ANO = '$ANO_HOJE' ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS = $ROW[ 'TOTAL' ];

                                    $RESULTADO_MES = $ENTRADAS - $SAIDAS ;
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 63, 103, 145 ); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 63, 103, 145 ); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 131, 55, 60 ); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 131, 55, 60 ); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0) echo "rgb( 33, 37, 41);"; else echo "#030" ?>">Resultado:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0) echo "rgb( 131, 55, 60 );"; else echo "#030" ?>"><?= formata_dinheiro( $RESULTADO_MES ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border" style="color:rgb( 211, 211, 213 );">&nbsp; Balanço Geral</legend>
                            <div class="card-body alert alert-secondary mb-0" style="background-color:rgb( 240, 240, 240 );">
                                <?php
                                    $QR = mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 1 ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS = $ROW[ 'TOTAL' ];

                                    $QR = mysqli_query( $CONN, "SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 0 ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS = $ROW[ 'TOTAL' ];

                                    $RESULTADO_GERAL = $ENTRADAS - $SAIDAS ;
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 63, 103, 145); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 63, 103, 145); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 131, 55, 60); font-size: 1.5em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 131, 55, 60); font-size: 1.5em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 33, 37, 41);"; else echo "#030"?>">Resultado:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="font-size: 1.5em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 131, 55, 60);"; else echo "#030"?>"><?= formata_dinheiro( $RESULTADO_GERAL ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <!-- /.GRAFICO GASTOS X RENDA -->
                <div class="row mt-1 mb-1" style="background-color: rgb( 64, 71, 78 );">
                    <div class="col">
                        <?php
                            /**
                             * Consulta para alimentar:
                             * Gráfico de Gastos X Renda
                             */
                            $sql = "WITH
                                        Meses AS (
                                            SELECT
                                                DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL seq MONTH), '%m') AS Mes,
                                                DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL seq MONTH), '%Y') AS Ano
                                            FROM
                                                (SELECT 0 AS seq UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                                                UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9
                                                UNION SELECT 10 UNION SELECT 11) AS Sequencia
                                        ),
                                        GastosPorMes AS (
                                            SELECT
                                                LPAD(LCM_MES, 2, '0') AS Mes,
                                                LCM_ANO AS Ano,
                                                SUM(LCM_VALOR) AS TotalGastos
                                            FROM
                                                LCM_LC_MOVIMENTO
                                            WHERE
                                                LCM_TIPO = 0 -- Gastos (tipo 0)
                                                AND CONCAT(LCM_ANO, '-', LPAD(LCM_MES, 2, '0'), '-01') >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                                            GROUP BY
                                                LCM_MES, LCM_ANO
                                        ),
                                        RendaPorMes AS (
                                            SELECT
                                                LPAD(LCM_MES, 2, '0') AS Mes,
                                                LCM_ANO AS Ano,
                                                SUM(LCM_VALOR) AS TotalRenda
                                            FROM
                                                LCM_LC_MOVIMENTO
                                            WHERE
                                                LCM_TIPO = 1 -- Renda (tipo 1)
                                                AND CONCAT(LCM_ANO, '-', LPAD(LCM_MES, 2, '0'), '-01') >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                                            GROUP BY
                                                LCM_MES, LCM_ANO
                                        )
                                    SELECT
                                        CONCAT(M.Mes, '/', M.Ano) AS MesAno,
                                        COALESCE(G.TotalGastos, 0.00) AS TotalGastos,
                                        COALESCE(R.TotalRenda, 0.00) AS TotalRenda
                                    FROM
                                        Meses M
                                    LEFT JOIN
                                        GastosPorMes G ON M.Mes = G.Mes AND M.Ano = G.Ano
                                    LEFT JOIN
                                        RendaPorMes R ON M.Mes = R.Mes AND M.Ano = R.Ano
                                    ORDER BY
                                        M.Ano DESC, M.Mes DESC";

                                try {
                                    // Executar a consulta com tratamento de erro
                                    $result = $CONN->query($sql);

                                    // Verificar se a consulta retornou resultados
                                    if ($result->num_rows > 0) {
                                        $dados = [];
                                        while ($row = $result->fetch_assoc()) {
                                            $dados[] = $row;
                                        }
                                    } else {
                                        $dados = []; // Se não houver resultados
                                    }

                                    // Converter os dados para JSON
                                    $dados_json = json_encode($dados);

                                } catch (mysqli_sql_exception $e) {
                                    // Tratamento de erro mais detalhado
                                    $_SESSION[ 'msg2' ] = "Erro na consulta: " . htmlspecialchars($e->getMessage());
                                }
                        ?>

                        <div class="chart-container">
                            <canvas id="graficoGastosRenda" width="100%" height="15%"></canvas>
                        </div>

                        <script>
                            // Dados recebidos do PHP
                            const dados = <?php echo $dados_json; ?>;

                            // Preparar os dados para o gráfico
                            const cat = dados.map(item => item.MesAno); // Meses e Anos
                            const gastos = dados.map(item => item.TotalGastos); // Valores de gastos
                            const renda = dados.map(item => item.TotalRenda); // Valores de renda (DevoGastar)

                            // Configuração do gráfico
                            const ct = document.getElementById('graficoGastosRenda').getContext('2d');
                            const graph = new Chart(ct, {
                                type: 'bar', // Tipo de gráfico (barras)
                                data: {
                                    labels: cat, // Eixo X (categorias)
                                    datasets: [
                                        {
                                            label: 'Gastos', // Legenda para Gastos
                                            data: gastos, // Dados de Gastos
                                            backgroundColor: 'rgba(255, 99, 132, 0.5)', // Cor das barras de Gastos
                                            borderColor: 'rgba(255, 99, 132, 1)', // Cor da borda das barras de Gastos
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Renda', // Legenda para Renda
                                            data: renda, // Dados de Renda (DevoGastar)
                                            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Cor das barras de Renda
                                            borderColor: 'rgba(54, 162, 235, 1)', // Cor da borda das barras de Renda
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true, // Começa o eixo Y do zero
                                            title: {
                                                display: true,
                                                text: 'Valores (R$)',
                                                color: 'rgb(255, 255, 255)' // Cor do título do eixo Y
                                            },
                                            ticks: {
                                                color: 'rgb(255, 255, 255)' // Cor dos valores do eixo Y
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: false,
                                                text: 'Meses',
                                                color: 'rgb(255, 255, 255)' // Cor do título do eixo X
                                            },
                                            ticks: {
                                                color: 'rgb(255, 255, 255)' // Cor dos valores do eixo X
                                            }
                                        }
                                    },
                                    plugins: {
                                        title: {
                                            display: false,
                                            text: 'Gráfico de Gastos e Renda (<?php echo $MES_HOJE . '/' . $ANO_HOJE; ?>)',
                                            color: 'rgb(255, 255, 255)' // Cor do título do gráfico
                                        },
                                        legend: {
                                            labels: {
                                                color: 'rgb(255, 255, 255)' // Cor da legenda
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- /.BLOCO MOVIMENTO DESTE MES -->
                <div class="table-borderless">
                    <div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
                        <div class="col-10 mt-2 mb-0">
                            <h4 style="letter-spacing: .2rem; text-transform: uppercase; font-weight: 500; color: rgb( 254, 214, 122 );">Movimentos do mês</h4>
                        </div>
                        <div class="col-2 mt-1 mb-1 text-right">
                            <form name="form_filtro_cat" action="" method="GET">
                                <input type="hidden" name="pg" value="finances/fin_main" />
                                <input type="hidden" name="mes" value="<?= $MES_HOJE; ?>" />
                                <input type="hidden" name="ano" value="<?= $ANO_HOJE; ?>" />
                                <select class="form-control" class="mt-1 mb-1" name="filtro_cat" onchange="form_filtro_cat.submit()">
                                <option value="">TODOS</option>
                                    <?php
                                        $QR = mysqli_query( $CONN, " SELECT DISTINCT C.LCA_ID, C.LCA_NOME FROM LCA_LC_CAT C, LCM_LC_MOVIMENTO M WHERE M.LCM_CAT = C.LCA_ID && M.LCM_MES = '$MES_HOJE' && M.LCM_ANO = '$ANO_HOJE' ");
                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                    ?>
                                    <option <?php if( isset( $_GET[ 'filtro_cat' ] ) && $_GET[ 'filtro_cat' ] == $ROW[ 'LCA_ID' ] ) echo "selected=selected" ?> value="<?= $ROW[ 'LCA_ID' ]; ?>"><?= $ROW[ 'LCA_NOME' ]; ?></option>
                                    <?php }?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <table class="table table-dark table-striped table-hover table-sm">
                            <thead>
                                <tr class="extrato">
                                    <th class="text-center" scope="col">DIA</th>
                                    <th class="text-left" scope="col">MOVIMENTO</th>
                                    <th class="text-right" scope="col">VALOR</th>
                                </tr>
                            </thead>
                            <?php
                                $filtros="";
                                if( isset( $_GET[ 'filtro_cat' ] ) && $_GET[ 'filtro_cat' ] != '' ) {
                                    $filtros="&& LCM_CAT = '".$_GET[ 'filtro_cat' ]."' ";

                                    $QR =mysqli_query( $CONN, " SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 1 && LCM_MES = '$MES_HOJE' && LCM_ANO = '$ANO_HOJE' $filtros ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS =$ROW[ 'TOTAL' ];

                                    $QR =mysqli_query( $CONN, " SELECT SUM( LCM_VALOR ) AS TOTAL FROM LCM_LC_MOVIMENTO WHERE LCM_TIPO = 0 && LCM_MES = '$MES_HOJE' && LCM_ANO = '$ANO_HOJE' $filtros ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS =$ROW[ 'TOTAL' ];

                                    $RESULTADO_MES = $ENTRADAS - $SAIDAS;
                                }

                                $QR = mysqli_query( $CONN, " SELECT * FROM LCM_LC_MOVIMENTO WHERE LCM_MES = '$MES_HOJE' && LCM_ANO = '$ANO_HOJE' $filtros ORDER By LCM_DIA DESC, LCM_ID DESC ");
                                $CONT = 0;
                                while( $ROW = mysqli_fetch_array( $QR ) ) {
                                $CONT++;

                                $CAT = $ROW[ 'LCM_CAT' ];
                                $QR2 = mysqli_query( $CONN, " SELECT LCA_NOME FROM LCA_LC_CAT WHERE LCA_ID = '$CAT' ");
                                $ROW2 = mysqli_fetch_array( $QR2 );
                                $CATEGORIA = $ROW2[ 'LCA_NOME' ];
                            ?>
                            <tbody>
                                <tr style="background-color:<?php if( $CONT%2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" >
                                    <td class="lead" align="center" width="5%"><strong style="color: rgb( 197, 237, 255); font-weight: 600;"><?= $ROW[ 'LCM_DIA' ]; ?></strong></td>
                                    <td class="lead" width="80%" style="color: rgb( 255, 255, 255 );">
                                        <?php
                                            if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?>
                                                <a href="javascript:;" onclick="abreFecha('editar_mov_<?= $ROW[ 'LCM_ID' ]; ?>')" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    style="color: rgb( 255, 255, 255 ); font-size: 1.0em; position: relative; text-decoration: none;"
                                                    onmouseover="this.style.color='rgb( 250, 202, 98 )'; this.querySelector('.edit-text').style.display='inline';"
                                                    onmouseout="this.style.color='rgb( 255, 255, 255 )'; this.querySelector('.edit-text').style.display='none';"
                                                    title="Editar"><?= $ROW[ 'LCM_DESCRICAO' ]; ?>
                                                    <span class="edit-text" style="display: none; margin-left: 5px; font-size: 0.9em;"><i class="fa fa-edit"></i>&nbsp;&nbsp;Editar</span>
                                                </a>
                                        <?php
                                            } else {
                                                echo $ROW[ 'LCM_DESCRICAO' ];
                                            }
                                            if( $CAT > 0 ) {
                                                echo '&nbsp;&nbsp;<em><span class="badge badge-pill lead" style="background-color: ' . $cores[$CATEGORIA] . '; color: rgb( 244, 244, 244 ); font-weight: 500; font-size: 1em;"><small>' . $CATEGORIA . '</small></span></em>&nbsp;&nbsp;&nbsp;';
                                            }
                                        ?>
                                    </td>
                                    <td align="right" width="15%">
                                        <strong class="lead" style="font-weight: 500; color: <?= ($ROW['LCM_TIPO'] == 0) ? "rgb(231, 185, 184)" : "rgb(197, 237, 255)"; ?>">
                                            <?= ($ROW['LCM_TIPO'] == 0) ? "-" : "+"; ?><?= formata_dinheiro($ROW['LCM_VALOR']); ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr style="display:none; background-color:<?php if( $CONT % 2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" id="editar_mov_<?= $ROW[ 'LCM_ID' ]; ?>">
                                    <form method="POST" action="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                        <input type="hidden" name="acao" value="editar_mov" />
                                        <input type="hidden" name="id" value="<?= $ROW[ 'LCM_ID' ]; ?>" />
                                        <td  colspan="3" style="background-color: rgb( 52, 58, 64 );">
                                            <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb(  108, 117, 125 ); background: rgb(  108, 117, 125, 20% );" />
                                            <div class="container">
                                                <div class="row justify-content-md-center">
                                                    <div class="form-group col-auto border-right">
                                                        <label for="tipo_receita<?= $ROW[ 'LCM_ID' ]; ?>" style="color: rgb( 0, 117, 255 );">
                                                        <input class="form-control" <?php if( $ROW[ 'LCM_TIPO' ] == 1 ) echo "checked=checked"?> type="radio" name="tipo" value="1" id="tipo_receita<?= $ROW[ 'LCM_ID' ]; ?>" /> Receita</label>&nbsp;
                                                        <label for="tipo_despesa<?= $ROW[ 'LCM_ID' ]; ?>" style="color: rgb( 228, 60, 48 );">
                                                        <input class="form-control" <?php if( $ROW[ 'LCM_TIPO' ] == 0 ) echo "checked=checked"?> type="radio" name="tipo" value="0" id="tipo_despesa<?= $ROW[ 'LCM_ID' ]; ?>" /> Despesa</label>&nbsp;
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="cat">Categoria</label>
                                                        <select class="form-control" name="cat">
                                                            <?php
                                                                $QR2 = mysqli_query( $CONN, " SELECT * FROM LCA_LC_CAT ");
                                                                while( $ROW2 = mysqli_fetch_array( $QR2 ) ) {
                                                                    ?>
                                                                <option class="form-control" <?php if( $ROW2[ 'LCA_ID' ] == $ROW[ 'LCM_CAT' ] ) echo "selected"?> value="<?= $ROW2[ 'LCA_ID' ]; ?>"><?= $ROW2[ 'LCA_NOME' ]; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col text-center">
                                                        <label for="dia">Dia</label>
                                                        <input class="form-control text-center" type="text" name="dia" size="3" maxlength="2" value="<?= $ROW[ 'LCM_DIA' ]; ?>" />
                                                    </div>
                                                    <div class="form-group col-auto">
                                                        <label for="descricao">Descrição</label>
                                                        <input class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();" name="descricao" value="<?= $ROW[ 'LCM_DESCRICAO' ]; ?>" size="70" maxlength="255" />
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="valor">Valor</label>
                                                        <input class="form-control" type="text" id="valor" value="<?= $ROW[ 'LCM_VALOR' ]; ?>" name="valor" size="10" onfocus="manterMascara(this)" onblur="formatarMoeda(this)" oninput="formatarMoeda(this)" />
                                                    </div>
                                                    <div class="form-group col text-left">
                                                        <label for="submit" style="color: rgb( 52, 58, 64 );">.</label><br />
                                                        <button type="submit" class="btn btn-primary" name="submit" title="Alterar"><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                                    </div>
                                                    <div class="form-group col text-right">
                                                        <label for="delete" style="color: rgb( 52, 58, 64 );">.</label>
                                                        <a class="btn btn-danger" name="delete" style="color: rgb( 254, 254, 254 ); font-size: 1.0em; font-weight: 600; letter-spacing: 0.1em;" onclick="return confirm('Tem certeza que deseja apagar?')" href="index.php?pg=finances/fin_main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar&id=<?= $ROW[ 'LCM_ID' ]; ?>" title="Remover"><i class="fas fa-trash"></i>&nbsp;Remover</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="mt-1 text-right">
                                        <!-- /.SALDO -->
                                        <span class="lead" style="font-size: 1.5em; font-weight: 500; letter-spacing: 0.1em; color:<?php if( $RESULTADO_MES < 0 ) echo "rgb( 231, 185, 184 )"; else echo "rgb( 197, 237, 255 )"; ?>">SALDO:&nbsp; <?= formata_dinheiro( $RESULTADO_MES ); ?></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.FIM BLOCO MOVIMENTO DESTE MES -->
            </div><!-- /.Invoice -->
        </div><!-- /.End Container-fluid -->
    </section><!-- /.End Section -->
    <?php
        require './footerInt.php';
        $CONN->close();
    ?>
</div><!-- /.End Content-wrapper -->
<a name="fim"></a>

<script>
    /**
     * Utilizado em Editar, no input valor contendo id="valor" oninput="formatarMoeda(this)"
     * Linha 388
     */

     function manterMascara(campo) {
        let valor = campo.value;

        // Remove o "R$" e mantém a vírgula no lugar certo
        valor = valor.replace("R$", "").trim();

        // Substitui a vírgula decimal por ponto temporariamente, se necessário
        valor = valor.replace(",", ".");

        // Atualiza o campo com o valor sem o "R$" mas mantendo a vírgula/ponto correto para edição
        campo.value = valor;
    }

    function formatarMoeda(campo) {
        let valor = campo.value;

        // Remove tudo que não for dígito
        valor = valor.replace(/\D/g, "");

        // Adiciona as casas decimais
        valor = (valor / 100).toFixed(2) + "";

        // Substitui o ponto por vírgula para o formato brasileiro
        valor = valor.replace(".", ",");

        // Adiciona pontos a cada 3 dígitos antes da vírgula
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        // Atualiza o campo com o valor formatado com "R$"
        campo.value = "R$ " + valor;
    }
</script>