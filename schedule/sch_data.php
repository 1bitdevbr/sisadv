<?php
if (!isset($_SESSION)) session_start();
header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$required_level = 1;
require_once(__DIR__ . '/../access/level.php');
require_once(__DIR__ . '/../access/conn.php');
require_once(__DIR__ . '/../dist/func/functions.php');

$USR_ACCESS = (int)$_SESSION['USR_ID'];
// error_log("USR_ACCESS: " . $USR_ACCESS);

try {
    $stmt = $CONN->prepare("
        SELECT
            TAR.*,
            PNA.*,
            CLI.CLI_NOME,
            SIT.*,
            PAS.*
        FROM
            TAR_TAREFAS TAR
            LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID = TAR.TAR_FK_NATUREZA
            LEFT JOIN CLI_CLIENTES CLI ON CLI.CLI_ID = TAR.TAR_FK_CLIENTE
            LEFT JOIN TAR_SITUACAO SIT ON SIT.TAR_ID_SIT = TAR.TAR_FK_SITUACAO
            LEFT JOIN PAS_PROC_PASTA PAS ON PAS.PAS_ID = CLI.CLI_FK_PASTA
        WHERE
            TAR.TAR_FK_STATUS = 1
            AND TAR.TAR_FK_SITUACAO < 3
            AND (
                (TAR.TAR_TIPO = 0 AND (TAR.TAR_FK_ATRIBUIDO = ? OR TAR.TAR_USER_CREATION = ?))
                OR
                TAR.TAR_TIPO = 1
            )
        ORDER BY
            TAR.TAR_PZ_FIM ASC
    ");

    $stmt->bind_param("ii", $USR_ACCESS, $USR_ACCESS);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];

    while ($row = $result->fetch_assoc()) {
        $start = $row['TAR_DIATODO'] == 1 ?
            date('Y-m-d', strtotime($row['TAR_PZ_FIM'])) :
            date('Y-m-d\TH:i:s', strtotime($row['TAR_PZ_INICIO']));

        $end = !empty($row['TAR_PZ_FIM']) ?
            ($row['TAR_DIATODO'] == 1 ?
                date('Y-m-d', strtotime($row['TAR_PZ_FIM'])) :
                date('Y-m-d\TH:i:s', strtotime($row['TAR_PZ_FIM']))) :
            null;

        $url = $row['TAR_TIPO'] == 0 ?
            "?pg=tasks/tsk_main&tar_id=" . $row['TAR_ID'] :
            "?pg=schedule/sch_event&id=" . $row['TAR_ID'];

        $descricao = mb_strlen($row['TAR_DESCRICAO']) > 20 ?
            mb_substr($row['TAR_DESCRICAO'], 0, 20) . "..." :
            $row['TAR_DESCRICAO'];

        $events[] = [
            'id' => $row['TAR_ID'],
            'title' => $descricao,
            'start' => $start,
            'end' => $end,
            'allDay' => $row['TAR_DIATODO'] == 1,
            'backgroundColor' => $row['TAR_BGCOLOR'],
            'borderColor' => $row['TAR_BDCOLOR'],
            'url' => $url
        ];
    }

    $stmt->close();
    $CONN->close();

    echo json_encode($events, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    error_log("Erro no processamento dos eventos: " . $e->getMessage());
    echo json_encode(['error' => 'Erro ao processar eventos']);
}