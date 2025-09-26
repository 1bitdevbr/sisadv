<?php
// Inicia a sessão
if (!isset($_SESSION)) session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['USR_ID'])) {
    die("Usuário não está logado.");
}

// ID do usuário logado
$USR_ACCESS = $_SESSION['USR_ID'];

// Consulta os compromissos agendados para hoje e atribuídos ao usuário logado
$data_atual = date('Y-m-d');

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
    ");

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':data_atual', $data_atual);
    $stmt->bindParam(':usr_access', $USR_ACCESS);
    $stmt->execute();
    $compromissos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Configurações do Textbelt
    $textbelt_key = 'SUA_CHAVE_API'; // Substitua pela sua chave de API do Textbelt

    // Envia notificações via SMS
    foreach ($compromissos as $compromisso) {
        $descricao = $compromisso['TAR_DESCRICAO'];
        $data_hora = date('d/m/Y H:i', strtotime($compromisso['TAR_PZ_INICIO']));
        $usuario_nome = $compromisso['USR_NOME'];
        $usuario_telefone = $compromisso['USR_TELEFONE'];

        // Mensagem a ser enviada
        $mensagem = "Olá, $usuario_nome! Você tem um compromisso agendado para $data_hora. Descrição: $descricao.";

        // URL da API do Textbelt
        $url = "https://textbelt.com/text";
        $data = [
            'phone' => $usuario_telefone,
            'message' => $mensagem,
            'key' => $textbelt_key,
        ];

        // Envia a requisição
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        // Verifica se a mensagem foi enviada com sucesso
        $response_data = json_decode($response, true);
        if ($response_data['success']) {
            echo "SMS enviado para $usuario_nome ($usuario_telefone): $mensagem<br>";
        } else {
            echo "Erro ao enviar SMS para $usuario_nome ($usuario_telefone): " . $response_data['error'] . "<br>";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn = null;

} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}