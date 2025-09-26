<?php
// Inicia a sessão
if (!isset($_SESSION)) session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['USR_ID'])) {
    die("Usuário não está logado.");
}

// Dados do usuário logado
$USR_ACCESS = $_SESSION['USR_ID']; // ID do usuário logado
$USR_NAME = $_SESSION['USR_NAME']; // Nome do usuário logado
$USR_MOBILE_PHONE = $_SESSION['USR_MOBILE_PHONE']; // Número de telefone do usuário logado

// Consulta os compromissos agendados para hoje e atribuídos ao usuário logado
$data_atual = date('Y-m-d');
$sql = "
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
        DATE(TAR.TAR_PZ_INICIO) = :data_atual
        AND TAR.TAR_FK_STATUS = 1
        AND TAR.TAR_FK_SITUACAO < 3
        AND (
            (TAR.TAR_TIPO = 0 AND (TAR.TAR_FK_ATRIBUIDO = :usr_access OR TAR.TAR_USER_CREATION = :usr_access))
            OR
            TAR.TAR_TIPO = 1
        )
    ORDER BY
        TAR.TAR_PZ_FIM ASC
";

$stmt = $CONN->prepare($sql);
$stmt->bindParam(':data_atual', $data_atual);
$stmt->bindParam(':usr_access', $USR_ACCESS);
$stmt->execute();
$compromissos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurações da API do WhatsApp Business
$whatsapp_token = 'SEU_TOKEN_DE_ACESSO'; // Token de acesso da API do WhatsApp Business
$whatsapp_phone_id = 'SEU_ID_DO_NUMERO'; // ID do número de telefone do WhatsApp Business
$whatsapp_api_url = 'https://graph.facebook.com/v16.0/' . $whatsapp_phone_id . '/messages';

// Função para enviar mensagem via WhatsApp Business
function enviarWhatsAppBusiness($whatsapp_token, $whatsapp_api_url, $usuario_telefone, $mensagem) {
    $data = [
        'messaging_product' => 'whatsapp',
        'to' => $usuario_telefone,
        'type' => 'text',
        'text' => [
            'body' => $mensagem,
        ],
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\nAuthorization: Bearer $whatsapp_token",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($whatsapp_api_url, false, $context);

    return $response;
}

// Envia notificações via WhatsApp Business
foreach ($compromissos as $compromisso) {
    $descricao = $compromisso['TAR_DESCRICAO'];
    $data_hora = date('d/m/Y H:i', strtotime($compromisso['TAR_PZ_INICIO']));

    // Mensagem a ser enviada
    $mensagem = "Olá, $USR_NAME! Você tem um compromisso agendado para $data_hora. Descrição: $descricao.";

    try {
        // Envia a mensagem via WhatsApp Business
        $response = enviarWhatsAppBusiness($whatsapp_token, $whatsapp_api_url, $USR_MOBILE_PHONE, $mensagem);

        // Verifica se a mensagem foi enviada com sucesso
        $response_data = json_decode($response, true);
        if (isset($response_data['messages'][0]['id'])) {
            echo "WhatsApp Business enviado para $USR_NAME ($USR_MOBILE_PHONE): $mensagem<br>";
        } else {
            echo "Erro ao enviar WhatsApp Business para $USR_NAME ($USR_MOBILE_PHONE): " . json_encode($response_data) . "<br>";
        }
    } catch (Exception $e) {
        echo "Erro ao enviar WhatsApp Business para $USR_NAME ($USR_MOBILE_PHONE): " . $e->getMessage() . "<br>";
    }
}

// Fecha a conexão com o banco de dados
$CONN = null;