<?php
    // Inicia a sessão se ainda não estiver iniciada
    if (!isset($_SESSION)) session_start();

    // Define o tempo de expiração da sessão em segundos (7200 segundos = 2 horas)
    $tempo = 7200;
    // Obtém o tempo atual da requisição do usuário
    $time = $_SERVER['REQUEST_TIME'];

    // Verifica se a variável de sessão LAST_ACTIVITY está definida
    // e se o tempo desde a última atividade excede o limite definido
    if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $tempo) {
        // Se a sessão expirou, remove todas as variáveis de sessão
        session_unset();
        // Destroi a sessão, removendo todos os dados associados
        session_destroy();
        // Redireciona o usuário para a página de bloqueio
        header("Location: /lockscreen.php");
        exit(); // Encerra o script para evitar execução adicional
    } else {
        // Atualiza a última atividade com o tempo atual
        $_SESSION['LAST_ACTIVITY'] = $time;
    }
?>

<!-- CONTADOR DE SESSÃO INÍCIO -->
<script>
    // Converte o tempo de expiração (em segundos) para um número inteiro
    const contador = parseInt("<?php echo $tempo; ?>", 10);

    // Função para iniciar o temporizador
    function startTimer(duration, display) {
        let timer = duration; // Inicializa o timer com a duração especificada
        // Define um intervalo que executa a cada segundo
        const interval = setInterval(function() {
            // Calcula horas, minutos e segundos restantes
            const hours = String(Math.floor(timer / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((timer % 3600) / 60)).padStart(2, '0');
            const seconds = String(timer % 60).padStart(2, '0');

            // Atualiza o conteúdo do elemento de exibição com o tempo formatado
            display.textContent = `${hours}h ${minutes}m ${seconds}s`;

            // Decrementa o timer a cada segundo
            if (--timer < 0) {
                clearInterval(interval); // Interrompe o temporizador quando chega a zero
                // Redireciona o usuário para a página de bloqueio após expiração
                location.href = "/lockscreen.php";
            }
        }, 1000); // Intervalo de 1 segundo
    }

    // Quando a janela é carregada
    window.onload = function() {
        // Seleciona o elemento HTML onde o tempo será exibido
        const display = document.querySelector('#time');
        // Verifica se o elemento existe antes de iniciar o temporizador
        if (display) {
            startTimer(contador, display); // Inicia o temporizador com a contagem definida
        } else {
            // Exibe um erro no console se o elemento não for encontrado
            console.error("Elemento com id 'time' não encontrado.");
        }
    };
</script>
<!-- CONTADOR DE SESSÃO FIM -->