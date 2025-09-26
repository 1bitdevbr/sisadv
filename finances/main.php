<?php
    if( !isset( $_SESSION ) ) session_start();

    // Define o nível de acesso necessário
    $required_level = 1;

    // Inclui os arquivos necessários
    require_once(__DIR__ . '/../access/level.php');
    require_once(__DIR__ . '/../config.php');
    require_once(__DIR__ . '/../access.php');
    require_once(__DIR__ . '/../dist/func/functions.php');
    require_once(__DIR__ . '/proc.php');
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
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $orcamentoTitle; ?><span class="subtitle"><?= $orcamentoSubtitle; ?></span></legend>
                </div>

				<hr class="mt-0 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

                <!-- /.FAIXA DO MES -->
                <div class="row mt-0 mb-2" style="background-color: rgb( 63, 71, 78 );">
                    <div class="col-auto mt-1 mb-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=orcamento/main&ano=<?= $ANO_HOJE; ?>&mes='+this.value)">
                            <?php for( $i = 1; $i <= 12; $i++  ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $MES_HOJE ) echo "selected=selected"?> ><?= mostraMes( $i ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto mt-1 mb-1 text-center">
                        <select class="form-control" onchange="location.replace('index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano='+this.value)">
                            <?php for( $i = 2021; $i <= date( "Y" ); $i++ ) { ?>
                                <option value="<?= $i; ?>" <?php if( $i == $ANO_HOJE ) echo "selected=selected"?> ><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-10 mt-1 mb-1 text-right">
                        <h3 style="color: rgb( 253, 224, 139 );"><i class="icon fas fa-calendar"></i>&nbsp;<?= mostraMes( $MES_HOJE ) . '/' . $ANO_HOJE; ?></h3>
                    </div>
                </div>

                <!-- /.BLOCO ADD/REMOV CAT./MOV. -->
                <div class="mt-1 mb-1">
                    <div style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; display: none;" id="add_cat">
                        <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Categoria</h3>
                        <table class="table" width="100%" style="background-color: rgb( 69, 77, 85 );">
                            <tr>
                                <td valign="top">
                                    <form method="POST" action="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
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
                                        $QR = mysqli_query( $conn, " SELECT CAT_ID, CAT_NOME FROM ORC_CAT ");
                                        while( $ROW = mysqli_fetch_array( $QR ) ) {
                                    ?>
                                    <div id="editar2_cat_<?= $ROW[ 'CAT_ID' ]; ?>">
                                        <?= $ROW[ 'CAT_NOME' ]; ?>
                                        <a style="font-size: 1.0em; color: rgb( 227, 164, 164 )" onclick="return confirm('Tem certeza que deseja remover esta categoria?\nAtenção: Apenas categorias sem movimentos associados poderão ser removidas.')" href="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar_cat&id=<?= $ROW[ 'CAT_ID' ]; ?>" title="Remover">[remover]</a>
                                        <a href="javascript:;" style="font-size: 1.0em; color: rgb( 119, 230, 189 )" onclick="document.getElementById('editar_cat_<?= $ROW[ 'CAT_ID' ]; ?>').style.display=''; document.getElementById('editar2_cat_<?= $ROW[ 'CAT_ID' ]; ?>').style.display='none'" title="Editar">[editar]</a>
                                    </div>
                                    <div style="display: none" id="editar_cat_<?= $ROW[ 'CAT_ID' ]; ?>">
                                        <form method="POST" action="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                            <input type="hidden" name="acao" value="editar_cat" />
                                            <input type="hidden" name="id" value="<?= $ROW[ 'CAT_ID' ]; ?>" />
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" value="<?= $ROW[ 'CAT_NOME' ]; ?>" size="20" maxlength="50" />
                                            <input type="submit" class="input" value="Alterar" />
                                        </form>
                                    </div>
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-1" style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; display: none;" id="add_movimento">
                        <form method="POST" action="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                            <h3  style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Movimento</h3>
                            <?php
                                $QR = mysqli_query( $conn, " SELECT * FROM ORC_CAT ");
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
                                                <option class="form-control" value="<?= $ROW[ 'CAT_ID' ]; ?>"><?= $ROW[ 'CAT_NOME' ]; ?></option>
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
                            <legend class="scheduler-border">&nbsp; Entradas/Saídas no mês</legend>
                            <div class="card-body alert alert-secondary mb-0" style="background-color: rgb( 240, 240, 240 );">
                                <?php
                                    $QR = mysqli_query( $conn, "SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 1 && MOV_MES = '$MES_HOJE' && MOV_ANO = '$ANO_HOJE' ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS = $ROW[ 'TOTAL' ];

                                    $QR =mysqli_query( $conn, "SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 0 && MOV_MES = '$MES_HOJE' && MOV_ANO = '$ANO_HOJE' ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS = $ROW[ 'TOTAL' ];

                                    $RESULTADO_MES = $ENTRADAS - $SAIDAS ;
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 63, 103, 145 ); font-size: 1.2em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 63, 103, 145 ); font-size: 1.2em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 131, 55, 60 ); font-size: 1.2em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 131, 55, 60 ); font-size: 1.2em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="font-size: 1.3em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0) echo "rgb( 33, 37, 41);"; else echo "#030" ?>">Resultado:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="font-size: 1.3em; font-weight: 600; color:<?php if( $RESULTADO_MES < 0) echo "rgb( 131, 55, 60 );"; else echo "#030" ?>"><?= formata_dinheiro( $RESULTADO_MES ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">&nbsp; Balanço Geral</legend>
                            <div class="card-body alert alert-secondary mb-0" style="background-color:rgb( 240, 240, 240 );">
                                <?php
                                    $QR = mysqli_query( $conn, "SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 1 ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS = $ROW[ 'TOTAL' ];

                                    $QR = mysqli_query( $conn, "SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 0 ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS = $ROW[ 'TOTAL' ];

                                    $RESULTADO_GERAL = $ENTRADAS - $SAIDAS ;
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 63, 103, 145); font-size: 1.2em; font-weight: 600;"><i class="fas fa-arrow-right"></i>&nbsp;Entradas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 63, 103, 145); font-size: 1.2em; font-weight: 600;"><?= formata_dinheiro( $ENTRADAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="color: rgb( 131, 55, 60); font-size: 1.2em; font-weight: 600;"><i class="fas fa-arrow-left"></i>&nbsp;Saídas:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="color: rgb( 131, 55, 60); font-size: 1.2em; font-weight: 600;"><?= formata_dinheiro( $SAIDAS ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span style="font-size: 1.3em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 33, 37, 41);"; else echo "#030"?>">Resultado:</span>
                                        </div>
                                        <div class="col text-right">
                                            <span style="font-size: 1.3em; font-weight: 600; color:<?php if( $RESULTADO_GERAL < 0 ) echo "rgb( 131, 55, 60);"; else echo "#030"?>"><?= formata_dinheiro( $RESULTADO_GERAL ); ?></span>
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
                                                LPAD(MOV_MES, 2, '0') AS Mes,
                                                MOV_ANO AS Ano,
                                                SUM(MOV_VALOR) AS TotalGastos
                                            FROM
                                                ORC_MOVIMENTO
                                            WHERE
                                                MOV_TIPO = 0 -- Gastos (tipo 0)
                                                AND CONCAT(MOV_ANO, '-', LPAD(MOV_MES, 2, '0'), '-01') >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                                            GROUP BY
                                                MOV_MES, MOV_ANO
                                        ),
                                        RendaPorMes AS (
                                            SELECT
                                                LPAD(MOV_MES, 2, '0') AS Mes,
                                                MOV_ANO AS Ano,
                                                SUM(MOV_VALOR) AS TotalRenda
                                            FROM
                                                ORC_MOVIMENTO
                                            WHERE
                                                MOV_TIPO = 1 -- Renda (tipo 1)
                                                AND CONCAT(MOV_ANO, '-', LPAD(MOV_MES, 2, '0'), '-01') >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                                            GROUP BY
                                                MOV_MES, MOV_ANO
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
                                    $result = $conn->query($sql);

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

                <!-- /.BLOCO RESUMO -->
                <div class="row mb-1" style="background-color: rgb( 64, 71, 78 );">
                    <div class="card-body mt-0 mb-0 p-2">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-resumo-tab" data-toggle="pill" href="#custom-content-below-resumo" role="tab" aria-controls="custom-content-below-resumo" aria-selected="true">Resumo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-metas-tab" data-toggle="pill" href="#custom-content-below-metas" role="tab" aria-controls="custom-content-below-metas" aria-selected="false">Metas</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-resumo" role="tabpanel" aria-labelledby="custom-content-below-resumo-tab">
                                    <!-- Resumo -->
                                    <div class="card-body alert mb-0">
                                        <div class="row">
                                            <div class="col text-center" style="border: 0px solid rgb( 255, 89, 195 );">
                                                <legend class="scheduler-border" style="color:rgb( 211, 211, 213 );">&nbsp;Gastos</legend>
                                                <?php
                                                    $sql = "SELECT CAT.CAT_NOME, SUM(MOV.MOV_VALOR) AS TotalGasto
                                                            FROM ORC_CAT CAT
                                                            LEFT JOIN ORC_MOVIMENTO MOV ON CAT.CAT_ID = MOV.MOV_CAT
                                                            WHERE MOV.MOV_TIPO = 0 AND MOV.MOV_MES = '$MES_HOJE' AND MOV.MOV_ANO = '$ANO_HOJE'
                                                            GROUP BY CAT.CAT_NOME";

                                                    $result = $conn->query($sql);

                                                    $gastos = [];
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $gastos[$row["CAT_NOME"]] = $row["TotalGasto"];
                                                        }
                                                    }

                                                    // Calcula o total de gastos
                                                    $totalGastos = array_sum($gastos);

                                                    // Prepara os dados para o Chart.js
                                                    $categorias = array_keys($gastos);
                                                    $valores = array_values($gastos);
                                                    $percentuais = array_map(function($valor) use ($totalGastos) {
                                                        return round(($valor / $totalGastos) * 100, 2);
                                                    }, $valores);

                                                    // Converte os dados para JSON (para usar no JavaScript)
                                                    $categoriasJSON = json_encode($categorias);
                                                    $valoresJSON = json_encode($valores);
                                                    $percentuaisJSON = json_encode($percentuais);
                                                ?>

                                                <div style="width: 300px; margin: 0 auto;">
                                                    <canvas id="graficoGastos"></canvas>
                                                </div>

                                                <script>
                                                    // Dados do PHP (convertidos para JSON)
                                                    var categorias = <?php echo json_encode($categorias); ?>;
                                                    var valores = <?php echo json_encode(array_values($gastos)); ?>;
                                                    var percentuais = <?php echo json_encode(array_map(function($valor) use ($totalGastos) {
                                                        return round(($valor / $totalGastos) * 100, 2);
                                                    }, array_values($gastos))); ?>;
                                                    var totalGastos = <?php echo $totalGastos; ?>;

                                                    // Função para gerar cores escuras dinamicamente
                                                    function gerarCoresEscuras(numCores) {
                                                        var cores = [];
                                                        var hueStep = 360 / numCores; // Divide o espectro de cores em partes iguais
                                                        var saturation = 70; // Saturação fixa para cores vibrantes
                                                        var lightness = 40; // Luminosidade fixa para cores escuras

                                                        for (var i = 0; i < numCores; i++) {
                                                            var hue = i * hueStep; // Calcula o tom com base no índice
                                                            cores.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`); // Gera a cor no formato HSL
                                                        }
                                                        return cores;
                                                    }

                                                    // Cria o gráfico
                                                    var ctx = document.getElementById('graficoGastos').getContext('2d');
                                                    var grafico = new Chart(ctx, {
                                                        type: 'doughnut', // Gráfico de pizza (doughnut)
                                                        data: {
                                                            labels: categorias,
                                                            datasets: [{
                                                                data: valores,
                                                                backgroundColor: gerarCoresEscuras(categorias.length), // Cores escuras dinâmicas
                                                                borderColor: '#FFFFFF', // Define a cor do contorno (branco)
                                                                borderWidth: 2 // Define a largura da borda
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: true,
                                                            cutout: '60%',
                                                            layout: {
                                                                padding: {
                                                                    bottom: 0 // Espaço abaixo do gráfico para a legenda
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: false // Remove a legenda padrão
                                                                },
                                                                datalabels: {
                                                                    color: '#FFFFFF', // Cor do texto
                                                                    font: {
                                                                        size: 12, // Tamanho da fonte
                                                                        weight: 'bold' // Negrito
                                                                    },
                                                                    formatter: function (value, context) {
                                                                        // Exibe apenas o percentual dentro do gráfico
                                                                        return percentuais[context.dataIndex] + '%';
                                                                    },
                                                                    anchor: 'center', // Centraliza o texto no segmento
                                                                    align: 'center', // Alinha o texto no centro
                                                                    clamp: true // Impede que o texto ultrapasse os limites do segmento
                                                                },
                                                                tooltip: {
                                                                    callbacks: {
                                                                        label: function (context) {
                                                                            // Exibe apenas o valor formatado no tooltip
                                                                            return 'R$ ' + context.parsed.toLocaleString('pt-BR', {
                                                                                minimumFractionDigits: 2,
                                                                                maximumFractionDigits: 2
                                                                            });
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        },
                                                        plugins: [ChartDataLabels] // Habilita o plugin datalabels
                                                    });

                                                    // Adiciona o total de gastos no centro do gráfico
                                                    var totalLabel = document.createElement('div');
                                                    totalLabel.style.position = 'absolute';
                                                    totalLabel.style.top = '45%';
                                                    totalLabel.style.left = '50%';
                                                    totalLabel.style.transform = 'translate(-50%, -50%)';
                                                    totalLabel.style.textAlign = 'center'; // Centraliza o texto

                                                    // Cria um elemento para a legenda "Gastos"
                                                    var legenda = document.createElement('div');
                                                    legenda.innerHTML = 'Gastos';
                                                    legenda.style.fontSize = '16px'; // Tamanho da fonte da legenda
                                                    legenda.style.marginBottom = '5px'; // Espaçamento entre a legenda e o valor

                                                    // Adiciona o valor formatado
                                                    var valor = document.createElement('div');
                                                    valor.innerHTML = 'R$ ' + totalGastos.toLocaleString('pt-BR', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    });
                                                    valor.style.fontSize = '20px'; // Tamanho da fonte do valor

                                                    // Adiciona a legenda e o valor ao totalLabel
                                                    totalLabel.appendChild(legenda);
                                                    totalLabel.appendChild(valor);

                                                    // Adiciona o totalLabel ao gráfico
                                                    document.getElementById('graficoGastos').parentNode.appendChild(totalLabel);

                                                    // Cria uma legenda personalizada abaixo do gráfico
                                                    //                                                         var legendContainer = document.createElement('div');
                                                    //                                                         legendContainer.style.position = 'absolute';
                                                    //                                                         legendContainer.style.bottom = '20px'; // Posiciona abaixo do gráfico
                                                    //                                                         legendContainer.style.left = '50%';
                                                    //                                                         legendContainer.style.transform = 'translateX(-50%)';
                                                    //                                                         legendContainer.style.display = 'flex';
                                                    //                                                         legendContainer.style.flexWrap = 'wrap'; // Permite que os itens da legenda quebrem linha
                                                    //                                                         legendContainer.style.justifyContent = 'center';
                                                    //                                                         legendContainer.style.gap = '10px';
                                                    //
                                                    //                                                         categorias.forEach(function (categoria, index) {
                                                    //                                                             var legendItem = document.createElement('div');
                                                    //                                                             legendItem.style.display = 'flex';
                                                    //                                                             legendItem.style.alignItems = 'center';
                                                    //                                                             legendItem.style.gap = '10px';
                                                    //
                                                    //                                                             // Cria um quadrado com a cor correspondente
                                                    //                                                             var colorBox = document.createElement('div');
                                                    //                                                             colorBox.style.width = '20px';
                                                    //                                                             colorBox.style.height = '20px';
                                                    //                                                             colorBox.style.backgroundColor = grafico.data.datasets[0].backgroundColor[index];
                                                    //                                                             colorBox.style.border = '2px solid #FFFFFF';
                                                    //
                                                    //                                                             // Cria o texto da legenda
                                                    //                                                             var legendText = document.createElement('div');
                                                    //                                                             legendText.innerHTML = categoria;
                                                    //
                                                    //                                                             // Adiciona os elementos ao item da legenda
                                                    //                                                             legendItem.appendChild(colorBox);
                                                    //                                                             legendItem.appendChild(legendText);
                                                    //
                                                    //                                                             // Adiciona o item da legenda ao container
                                                    //                                                             legendContainer.appendChild(legendItem);
                                                    //                                                         });

                                                    // Adiciona a legenda personalizada ao gráfico
                                                    document.getElementById('graficoGastos').parentNode.appendChild(legendContainer);
                                                </script>
                                            </div><!-- col -->

                                            <div class="col-6 text-center" style="border: 0px solid rgb( 255, 156, 51 );">
                                                <legend class="scheduler-border" style="color:rgb( 211, 211, 213 );">&nbsp;Panorama</legend>
                                                <?php
                                                    /**
                                                     * Consulta SQL para alimentar:
                                                     * Cálculo detalhado de orçamento em Gastos, Panorama e Metas Definidas
                                                     */
                                                    $sql = "WITH
                                                    Renda AS (
                                                        SELECT SUM(MOV_VALOR) AS TotalRenda
                                                        FROM ORC_MOVIMENTO
                                                        WHERE MOV_CAT = 8 AND MOV_MES = '$MES_HOJE' AND MOV_ANO = '$ANO_HOJE'
                                                    ),
                                                    CategoriaGastos AS (
                                                        SELECT
                                                            CAT.CAT_ID,
                                                            CAT.CAT_NOME AS Descricao,
                                                            CAT.CAT_PERCENTUAL AS PercentualOriginal,
                                                            (SELECT TotalRenda FROM Renda) * (CAT.CAT_PERCENTUAL / 100) AS ValorDisponivel,
                                                            COALESCE(SUM(MOV.MOV_VALOR), 0) AS ValorGasto,
                                                            ROUND(
                                                                (SELECT TotalRenda FROM Renda) * (CAT.CAT_PERCENTUAL / 100),
                                                                2
                                                            ) AS DevoGastar,
                                                            ROUND(
                                                                ((SELECT TotalRenda FROM Renda) * (CAT.CAT_PERCENTUAL / 100)) -
                                                                COALESCE(SUM(MOV.MOV_VALOR), 0),
                                                                2
                                                            ) AS Saldo,
                                                            ROUND(
                                                                (COALESCE(SUM(MOV.MOV_VALOR), 0) /
                                                                ((SELECT TotalRenda FROM Renda) * (CAT.CAT_PERCENTUAL / 100))) * 100,
                                                                2
                                                            ) AS Utilizado,
                                                            ROUND(
                                                                (COALESCE(SUM(MOV.MOV_VALOR), 0) /
                                                                ((SELECT TotalRenda FROM Renda) * (CAT.CAT_PERCENTUAL / 100)) *
                                                                CAT.CAT_PERCENTUAL),
                                                                2
                                                            ) AS Total
                                                        FROM
                                                            ORC_CAT CAT
                                                        LEFT JOIN
                                                            ORC_MOVIMENTO MOV ON MOV.MOV_CAT = CAT.CAT_ID AND MOV.MOV_TIPO = 0
                                                        WHERE
                                                            CAT.CAT_ID != 8 AND CAT.CAT_PERCENTUAL > 0
                                                            AND MOV.MOV_MES = '$MES_HOJE' AND MOV.MOV_ANO = '$ANO_HOJE'
                                                        GROUP BY
                                                            CAT.CAT_ID, CAT.CAT_NOME, CAT.CAT_PERCENTUAL
                                                    )
                                                    SELECT
                                                        Descricao,
                                                        ValorGasto,
                                                        DevoGastar,
                                                        Saldo,
                                                        Utilizado,
                                                        Total
                                                    FROM
                                                        CategoriaGastos
                                                    ORDER BY
                                                        ValorGasto DESC";

                                                    try {
                                                        // Executar a consulta com tratamento de erro
                                                        $result = $conn->query($sql);

                                                        // Verificar se a consulta retornou resultados
                                                        if ($result->num_rows > 0) {
                                                            // Exibir os resultados em uma tabela
                                                            echo "<table border='0' class='card-header table table-striped table-hover'>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Descrição</th>
                                                                            <th>Valor Gasto</th>
                                                                            <th>Devo Gastar</th>
                                                                            <th>Saldo</th>
                                                                            <th>Utilizado</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>";

                                                            $totalValorGasto = 0;
                                                            $totalDevoGastar = 0;
                                                            $totalUtilizado = 0;

                                                            while($row = $result->fetch_assoc()) {
                                                                // Acumula os totais
                                                                $totalValorGasto += $row["ValorGasto"];
                                                                $totalDevoGastar += $row["DevoGastar"];
                                                                $totalUtilizado += $row["Total"];

                                                                // Exibe cada linha da tabela
                                                                $cor = $cores[$row["Descricao"]]; // Usa a cor correspondente
                                                                echo "<tr style=\"font-size: 0.9em; border-bottom: 1px dashed rgb( 109, 117, 125 );\">
                                                                        <td>
                                                                            <div style=\"display: flex; align-items: center;\">
                                                                                <div style=\"width: 20px; height: 20px; background-color: $cor; border: 2px solid #FFFFFF; margin-right: 10px;\"></div>
                                                                                {$row["Descricao"]}
                                                                            </div>
                                                                        </td>
                                                                        <td>R$ ".number_format($row["ValorGasto"], 2, ',', '.')."</td>
                                                                        <td>R$ ".number_format($row["DevoGastar"], 2, ',', '.')."</td>
                                                                        <td>R$ ".number_format($row["Saldo"], 2, ',', '.')."</td>
                                                                        <td>".number_format($row["Utilizado"], 2, ',', '.')."%</td>
                                                                        <td>".number_format($row["Total"], 2, ',', '.')."%</td>
                                                                    </tr>";
                                                            }
                                                            echo "</tbody></table>";
                                                        } else {
                                                            echo "<div class='alert alert-warning'>Nenhum resultado encontrado.</div>";
                                                        }
                                                    } catch (mysqli_sql_exception $e) {
                                                        // Tratamento de erro mais detalhado
                                                        $_SESSION[ 'msg2' ] = "Erro na consulta: " . htmlspecialchars($e->getMessage());
                                                    }
                                                ?>
                                                <div class="card-footer">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col">
                                                                <span style="color:rgb( 211, 211, 213 );">Total de gastos</span>
                                                                <br>
                                                                <span style="color:rgb( 211, 211, 213 ); font-weight: bold;">
                                                                    R$ <?= number_format($totalValorGasto, 2, ',', '.') ?>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <span style="color:rgb( 211, 211, 213 );">Total da renda no mês</span>
                                                                <br>
                                                                <span style="color:rgb( 211, 211, 213 ); font-weight: bold;">
                                                                    R$ <?= number_format($totalDevoGastar, 2, ',', '.') ?>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <span style="color:rgb( 211, 211, 213 );">Utilizado</span>
                                                                <br>
                                                                <span style="color:rgb( 211, 211, 213 ); font-weight: bold;">
                                                                    <?= number_format($totalUtilizado, 2, ',', '.') ?>%
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <span style="color:rgb( 211, 211, 213 );">Diferença</span>
                                                                <br>
                                                                <span style="color:rgb( 211, 211, 213 ); font-weight: bold;">
                                                                    <?php
                                                                        $diferenca = $totalValorGasto - $totalDevoGastar;
                                                                        echo formata_dinheiro( $diferenca );
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- col -->

                                            <div class="col text-center" style="border: 0px solid rgb( 37, 232, 111 );">
                                                <legend class="scheduler-border" style="color:rgb( 211, 211, 213 );">&nbsp;Metas Definidas</legend>
                                                <?php
                                                // Consulta SQL para obter os dados
                                                $sql = "SELECT CAT_NOME, CAT_PERCENTUAL FROM ORC_CAT WHERE CAT_PERCENTUAL > 0";
                                                $result = $conn->query($sql);

                                                // Exibir os dados
                                                if ($result->num_rows > 0) {
                                                    echo "<div class=\"div-pai\">"; // Adicione uma DIV pai, se necessário
                                                    echo "<table class=\"text-center centralizado\">"; // Adicione a classe "centralizado"
                                                    echo "<tr><th style=\"border: 0px solid #FFFFFF;\">Categoria</th><th style=\"border: 0px solid #FFFFFF;\">%</th></tr>";
                                                    while ($row = $result->fetch_assoc()) {
                                                        $cor = $cores[$row['CAT_NOME']]; // Usa a cor correspondente
                                                        echo "<tr>
                                                                <td class=\"text-left\" style=\"width: 60%; border: 0px solid rgb( 231, 64, 50 );\">
                                                                    <div style=\"display: flex; align-items: center;\">
                                                                        <div style=\"width: 20px; height: 20px; background-color: $cor; border: 2px solid #FFFFFF; margin-right: 10px;\"></div>
                                                                        {$row['CAT_NOME']}
                                                                    </div>
                                                                </td>
                                                                <td class=\"text-center\" style=\"width: 40%; border: 0px solid rgb( 66, 133, 244 );\">{$row['CAT_PERCENTUAL']}%</td>
                                                            </tr>";
                                                    }
                                                    echo "</table>";
                                                    echo "</div>"; // Feche a DIV pai, se usada
                                                } else {
                                                    echo "Nenhum resultado encontrado.";
                                                }
                                                ?>
                                                <div class="mt-4">
                                                    <a class="btn bg-dark" id="custom-content-below-metas-tab" data-toggle="pill" title="Editar Metas" href="#custom-content-below-metas" role="tab" aria-controls="custom-content-below-metas" aria-selected="false" style="color: rgb( 255, 255, 255); text-decoration: none;"><i class="fas fa-edit"></i> Editar</a>
                                                </div>
                                            </div><!-- col -->
                                        </div><!-- row -->
                                    </div><!-- card-body -->
                                </div><!-- tab-pane fade show active -->

                                <div class="tab-pane fade" id="custom-content-below-metas" role="tabpanel" aria-labelledby="custom-content-below-metas-tab">
                                    <!-- Metas -->
                                    <?php
                                        // Consulta as categorias
                                        $sql = "SELECT CAT_ID, CAT_NOME, CAT_PERCENTUAL, CAT_DEFAULT FROM ORC_CAT";
                                        $result = $conn->query($sql);
                                    ?>
                                    <div class="container mt-2">
                                        <h3>Alterar Percentual das Categorias</h3>
                                        <small class="mb-2">Edite os itens abaixo para ajustar suas metas.</small>
                                        <form action="" method="POST">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Categoria</th>
                                                        <th>Percentual Atual (%)</th>
                                                        <th>Percentual Padrão (%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['CAT_NOME']) ?></td>
                                                            <td class="text-center">
                                                                <input type="range"
                                                                    class="slider form-control"
                                                                    name="percentual[<?= $row['CAT_ID'] ?>]"
                                                                    min="0"
                                                                    max="100"
                                                                    step="1"
                                                                    value="<?= $row['CAT_PERCENTUAL'] ?>"
                                                                    oninput="updateValue(this)">
                                                                <span id="value_<?= $row['CAT_ID'] ?>"><?= $row['CAT_PERCENTUAL'] ?>%</span>
                                                            </td>
                                                            <td class="text-center"><?= $row['CAT_DEFAULT'] ?>%</td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                            <div class="mt-3 mb-3 text-center">
                                                <strong>Soma Total:</strong>
                                                <span id="totalPercentual">0%</span>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-dark" title="Salvar Metas" ><i class="fas fa-save"></i> Salvar</button>&nbsp;&nbsp;
                                                <button type="submit" class="btn bg-danger" name="resetar" title="Resetar Valores" onclick="return confirm('Confirma o Reset de Valores?')"><i class="fa fa-refresh"></i> Resetar valores</button>
                                            </div>
                                            <script>
                                                // Função para atualizar o valor exibido ao lado do range e verificar a soma
                                                function updateValue(input) {
                                                    const catId = input.name.match(/\[(\d+)\]/)[1]; // Extrai o ID da categoria
                                                    document.getElementById(`value_${catId}`).textContent = `${input.value}%`;

                                                    // Atualiza a soma total
                                                    verifyTotal();
                                                }

                                                // Função para verificar a soma total dos percentuais
                                                function verifyTotal() {
                                                    const ranges = document.querySelectorAll('input[type="range"]');
                                                    let total = 0;

                                                    ranges.forEach(range => {
                                                        total += parseFloat(range.value);
                                                    });

                                                    // Exibe a soma total
                                                    document.getElementById('totalPercentual').textContent = `${total.toFixed(1)}%`;

                                                    const submitButton = document.querySelector('button[type="submit"]');
                                                    if (total > 100) {
                                                        submitButton.disabled = true;
                                                        alert('A soma dos percentuais não pode ultrapassar 100%.');
                                                    } else {
                                                        submitButton.disabled = false;
                                                    }
                                                }

                                                // Adiciona o evento oninput a todos os ranges
                                                document.querySelectorAll('input[type="range"]').forEach(range => {
                                                    range.addEventListener('input', function() {
                                                        updateValue(this);
                                                    });
                                                });

                                                // Verifica a soma ao carregar a página
                                                window.onload = verifyTotal;
                                            </script>
                                        </form>
                                    </div><!-- container -->
                                </div><!-- tab-pane fade -->
                            </div><!-- tab-content -->
                            <div class="tab-custom-content">
                                <p class="lead mb-0">Composição das despesas</p>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card-body mt-0 mb-0 p-2 -->
                </div><!-- row mb-1 -->

                <!-- /.BLOCO MOVIMENTO DESTE MES -->
                <div class="table-borderless">
                    <div class="row mt-0" style="background-color: rgb( 63, 71, 78 );">
                        <div class="col-10 mt-2 mb-0">
                            <h4 style="letter-spacing: .2rem; text-transform: uppercase; font-weight: 500; color: rgb( 254, 214, 122 );">Movimentos do mês</h4>
                        </div>
                        <div class="col-2 mt-1 mb-1 text-right">
                            <form name="form_filtro_cat" action="" method="GET">
                                <input type="hidden" name="pg" value="orcamento/main" />
                                <input type="hidden" name="mes" value="<?= $MES_HOJE; ?>" />
                                <input type="hidden" name="ano" value="<?= $ANO_HOJE; ?>" />
                                <select class="form-control" class="mt-1 mb-1" name="filtro_cat" onchange="form_filtro_cat.submit()">
                                <option value="">TODOS</option>
                                <?php
                                    $QR = mysqli_query( $conn, " SELECT DISTINCT C.CAT_ID, C.CAT_NOME FROM ORC_CAT C, ORC_MOVIMENTO M WHERE M.MOV_CAT = C.CAT_ID && M.MOV_MES = '$MES_HOJE' && M.MOV_ANO = '$ANO_HOJE' ");
                                    while( $ROW = mysqli_fetch_array( $QR ) ) {
                                ?>
                                <option <?php if( isset( $_GET[ 'filtro_cat' ] ) && $_GET[ 'filtro_cat' ] == $ROW[ 'CAT_ID' ] ) echo "selected=selected" ?> value="<?= $ROW[ 'CAT_ID' ]; ?>"><?= $ROW[ 'CAT_NOME' ]; ?></option>
                                <?php }?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <table class="table table-dark table-striped table-hover table-sm">
                            <thead>
                                <tr class="extrato lead">
                                    <th class="text-center" scope="col">DIA</th>
                                    <th class="text-left" scope="col">MOVIMENTO</th>
                                    <th class="text-right" scope="col">VALOR</th>
                                </tr>
                            </thead>
                            <?php
                                $filtros="";
                                if( isset( $_GET[ 'filtro_cat' ] ) && $_GET[ 'filtro_cat' ] != '' ) {
                                    $filtros="&& MOV_CAT = '".$_GET[ 'filtro_cat' ]."' ";

                                    $QR =mysqli_query( $conn, " SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 1 && MOV_MES = '$MES_HOJE' && MOV_ANO = '$ANO_HOJE' $filtros ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $ENTRADAS =$ROW[ 'TOTAL' ];

                                    $QR =mysqli_query( $conn, " SELECT SUM( MOV_VALOR ) AS TOTAL FROM ORC_MOVIMENTO WHERE MOV_TIPO = 0 && MOV_MES = '$MES_HOJE' && MOV_ANO = '$ANO_HOJE' $filtros ");
                                    $ROW = mysqli_fetch_array( $QR );
                                    $SAIDAS =$ROW[ 'TOTAL' ];

                                    $RESULTADO_MES = $ENTRADAS - $SAIDAS;
                                }

                                $QR = mysqli_query( $conn, " SELECT * FROM ORC_MOVIMENTO WHERE MOV_MES = '$MES_HOJE' && MOV_ANO = '$ANO_HOJE' $filtros ORDER By MOV_DIA DESC, MOV_ID DESC ");
                                $CONT = 0;
                                while( $ROW = mysqli_fetch_array( $QR ) ) {
                                $CONT++;

                                $CAT = $ROW[ 'MOV_CAT' ];
                                $QR2 = mysqli_query( $conn, " SELECT CAT_NOME FROM ORC_CAT WHERE CAT_ID = '$CAT' ");
                                $ROW2 = mysqli_fetch_array( $QR2 );
                                $CATEGORIA = $ROW2[ 'CAT_NOME' ];
                            ?>
                            <tbody>
                                <tr style="background-color:<?php if( $CONT%2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" >
                                    <td class="lead" align="center" width="5%"><strong style="color: rgb( 197, 237, 255); font-weight: 600;"><?= $ROW[ 'MOV_DIA' ]; ?></strong></td>
                                    <td class="lead" width="80%" style="color: rgb( 255, 255, 255 );">
                                        <?php
                                            if(  $_SESSION[ 'US_FK_ACCESS_LEVEL' ] >= 1 ) { ?>
                                                <a href="javascript:;" onclick="abreFecha('editar_mov_<?= $ROW[ 'MOV_ID' ]; ?>')" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    style="color: rgb( 255, 255, 255 ); font-size: 1.0em; position: relative; text-decoration: none;"
                                                    onmouseover="this.style.color='rgb( 250, 202, 98 )'; this.querySelector('.edit-text').style.display='inline';"
                                                    onmouseout="this.style.color='rgb( 255, 255, 255 )'; this.querySelector('.edit-text').style.display='none';"
                                                    title="Editar"><?= $ROW[ 'MOV_DESCRICAO' ]; ?>
                                                    <span class="edit-text" style="display: none; margin-left: 5px; font-size: 0.9em;"><i class="fa fa-edit"></i>&nbsp;&nbsp;Editar</span>
                                                </a>
                                        <?php
                                            } else {
                                                echo $ROW[ 'MOV_DESCRICAO' ];
                                            }
                                            if( $CAT > 0 ) {
                                                echo '&nbsp;&nbsp;<em><span class="badge badge-pill lead" style="background-color: ' . $cores[$CATEGORIA] . '; color: rgb( 244, 244, 244 ); font-weight: 500; font-size: 1em;"><small>' . $CATEGORIA . '</small></span></em>&nbsp;&nbsp;&nbsp;';
                                            }
                                        ?>
                                    </td>
                                    <td align="right" width="15%">
                                        <strong class="lead" style="font-weight: 500; color: <?= ($ROW['MOV_TIPO'] == 0) ? "rgb(231, 185, 184)" : "rgb(197, 237, 255)"; ?>">
                                            <?= ($ROW['MOV_TIPO'] == 0) ? "-" : "+"; ?><?= formata_dinheiro($ROW['MOV_VALOR']); ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr style="display:none; background-color:<?php if( $CONT % 2 == 0 ) echo "rgb( 44, 48, 52 );"; else echo "rgb( 33, 37, 41 );"?>" id="editar_mov_<?= $ROW[ 'MOV_ID' ]; ?>">
                                    <form method="POST" action="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>">
                                        <input type="hidden" name="acao" value="editar_mov" />
                                        <input type="hidden" name="id" value="<?= $ROW[ 'MOV_ID' ]; ?>" />
                                        <td  colspan="3" style="background-color: rgb( 52, 58, 64 );">
                                            <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb(  108, 117, 125 ); background: rgb(  108, 117, 125, 20% );" />
                                            <div class="container">
                                                <div class="row justify-content-md-center">
                                                    <div class="form-group col-auto border-right">
                                                        <label for="tipo_receita<?= $ROW[ 'MOV_ID' ]; ?>" style="color: rgb( 0, 117, 255 );">
                                                        <input class="form-control" <?php if( $ROW[ 'MOV_TIPO' ] == 1 ) echo "checked=checked"?> type="radio" name="tipo" value="1" id="tipo_receita<?= $ROW[ 'MOV_ID' ]; ?>" /> Receita</label>&nbsp;
                                                        <label for="tipo_despesa<?= $ROW[ 'MOV_ID' ]; ?>" style="color: rgb( 228, 60, 48 );">
                                                        <input class="form-control" <?php if( $ROW[ 'MOV_TIPO' ] == 0 ) echo "checked=checked"?> type="radio" name="tipo" value="0" id="tipo_despesa<?= $ROW[ 'MOV_ID' ]; ?>" /> Despesa</label>&nbsp;
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="cat">Categoria</label>
                                                        <select class="form-control" name="cat">
                                                            <?php
                                                                $QR2 = mysqli_query( $conn, " SELECT * FROM ORC_CAT ");
                                                                while( $ROW2 = mysqli_fetch_array( $QR2 ) ) {
                                                                    ?>
                                                                <option class="form-control" <?php if( $ROW2[ 'CAT_ID' ] == $ROW[ 'MOV_CAT' ] ) echo "selected"?> value="<?= $ROW2[ 'CAT_ID' ]; ?>"><?= $ROW2[ 'CAT_NOME' ]; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col text-center">
                                                        <label for="dia">Dia</label>
                                                        <input class="form-control text-center" type="text" name="dia" size="3" maxlength="2" value="<?= $ROW[ 'MOV_DIA' ]; ?>" />
                                                    </div>
                                                    <div class="form-group col-auto">
                                                        <label for="descricao">Descrição</label>
                                                        <input class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();" name="descricao" value="<?= $ROW[ 'MOV_DESCRICAO' ]; ?>" size="70" maxlength="255" />
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="valor">Valor</label>
                                                        <input class="form-control" type="text" id="valor" value="<?= $ROW[ 'MOV_VALOR' ]; ?>" name="valor" size="10" onfocus="manterMascara(this)" onblur="formatarMoeda(this)" oninput="formatarMoeda(this)" />
                                                    </div>
                                                    <div class="form-group col text-left">
                                                        <label for="submit" style="color: rgb( 52, 58, 64 );">.</label><br />
                                                        <button type="submit" class="btn btn-primary" name="submit" title="Alterar"><i class="fas fa-database"></i>&nbsp;Salvar</button>
                                                    </div>
                                                    <div class="form-group col text-right">
                                                        <label for="delete" style="color: rgb( 52, 58, 64 );">.</label>
                                                        <a class="btn btn-danger" name="delete" style="color: rgb( 254, 254, 254 ); font-size: 1.0em; font-weight: 600; letter-spacing: 0.1em;" onclick="return confirm('Tem certeza que deseja apagar?')" href="index.php?pg=orcamento/main&mes=<?= $MES_HOJE; ?>&ano=<?= $ANO_HOJE; ?>&acao=apagar&id=<?= $ROW[ 'MOV_ID' ]; ?>" title="Remover"><i class="fas fa-trash"></i>&nbsp;Remover</a>
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
        $conn->close();
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