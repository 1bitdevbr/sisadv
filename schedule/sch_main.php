<?php
if (!isset($_SESSION)) session_start();
$required_level = 1;
require(__DIR__ . '/../access/level.php');
require(__DIR__ . '/../access/conn.php');
require(__DIR__ . '/../config.php');
require(__DIR__ . '/sch_proc.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="./plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.css">
    <style>
        /* POPUP "MAIS EVENTOS" EM MOBILE */
        .fc-more-popover {
            background-color: rgba(40, 45, 50, 0.95) !important;
            border: 1px solid rgb(251, 194, 28) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
        }

        .fc-popover-header {
            background-color: rgb(30, 35, 40) !important;
            color: rgb(251, 194, 28) !important;
            border-bottom: 1px solid rgb(251, 194, 28) !important;
        }

        .fc-popover-body {
            background-color: transparent !important;
        }

        .fc-more-popover .fc-event {
            background-color: rgba(251, 194, 28, 0.2) !important;
            border-left: 3px solid rgb(251, 194, 28) !important;
            margin-bottom: 4px !important;
        }

        .fc-more-popover .fc-event-main {
            color: rgb(250, 224, 134) !important;
        }

        /* AJUSTES PARA O BOTÃO DE FECHAR */
        .fc-popover-close {
            color: rgb(250, 224, 134) !important;
            opacity: 0.8;
        }

        .fc-popover-close:hover {
            color: rgb(251, 194, 28) !important;
            opacity: 1;
        }

        /* MELHORIAS ADICIONAIS PARA MOBILE */
        @media (max-width: 768px) {
            .fc-more-popover {
                width: 90vw !important;
                max-width: 320px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
            }

            .fc-popover-header {
                padding: 8px 12px !important;
                font-size: 0.9rem !important;
            }

            .fc-more-popover .fc-event {
                padding: 6px 8px !important;
                font-size: 0.7rem !important;
            }
        }

        /* Container principal - corrige overflow */
        .fc-scrollgrid-section-body {
            overflow: hidden !important;
        }

        /* Célula do dia - contém os eventos */
        .fc-daygrid-day-frame {
            overflow: hidden !important;
            position: relative;
        }

        /* Evento individual - ajuste preciso */
        .fc-daygrid-event {
            max-width: 100% !important;
            margin-right: 2px !important;
            box-sizing: border-box;
        }

        /* Contorno do evento - ajustado para mobile */
        .fc-event {
            border: 0px solid rgb(106, 170, 229) !important;
            box-shadow: none !important;
            overflow: hidden !important;
            text-overflow: ellipsis;
            white-space: nowrap;
            min-height: 24px; /* Garante altura mínima em mobile */
        }

        /* Dia atual - ajustado para mobile */
        .fc-daygrid-day.fc-day-today {
            border: 1px solid rgb(250, 224, 134) !important;
            background-color: rgba(200, 208, 219, 0.1) !important;
            box-shadow: inset 0 0 0 1px rgb(250, 224, 134) !important;
        }

        /* Número do dia atual - ajustado para mobile */
        .fc-daygrid-day-number.fc-day-today {
            color: rgb(251, 194, 28) !important;
            font-weight: 600;
            font-size: 0.9em; /* Reduz tamanho em mobile */
        }

        /* Estilo dos eventos - mobile first */
        .fc-event {
            font-family: "Montserrat", "Source Sans Pro", sans-serif;
            font-size: 0.65rem; /* Tamanho menor para mobile */
            font-weight: 400;
            letter-spacing: 0.03em;
            padding: 2px 4px; /* Padding reduzido */
        }

        /* Texto dos eventos - mobile */
        .fc-event,
        .fc-event a {
            color: rgb(250, 224, 134) !important;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        /* Hover ajustado para touch devices */
        @media (hover: hover) {
            .fc-event:hover,
            .fc-event a:hover {
                color: rgb(30, 30, 30) !important;
                background-color: rgba(251, 194, 28, 0.9) !important;
                transform: translateY(-1px);
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
        }

        /* Media queries para telas pequenas */
        @media (max-width: 768px) {
            .fc-event {
                font-size: 0.6rem; /* Tamanho menor ainda */
                line-height: 1.3; /* Melhora legibilidade */
            }

            .fc-daygrid-day-number {
                font-size: 0.8em;
            }

            .fc-daygrid-day.fc-day-today {
                box-shadow: inset 0 0 0 1px rgb(200, 208, 219) !important;
            }
        }

        /* Ajuste específico para telas muito pequenas */
        @media (max-width: 480px) {
            .fc-event {
                font-size: 0.55rem;
                padding: 1px 2px;
            }

            .fc-daygrid-event {
                margin-right: 1px !important;
            }
        }
    </style>
</head>
<body>
    <a name="topo"></a>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <?php require './menuh.php'; ?>

                <div class="invoice p-3 card-primary card-outline">
                    <div class="row legend">
                        <legend class="title">
                            <i class="fa fa-folder"></i>&nbsp;<?= htmlspecialchars($scheduleTitle); ?>
                            <span class="subtitle"><?= htmlspecialchars($scheduleSubtitle); ?></span>
                        </legend>
                    </div>

                    <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb(108, 117, 125); background: rgba(108, 117, 125, 0.2);" />

                    <!-- Bloco para adicionar evento -->
                    <div class="row justify-content-md-center">
                        <div class="container" style="background-color: rgb(63, 71, 78); padding: 10px; border: 1px solid #999; margin: 5px; display: none" id="add_event">
                            <h3 style="color: rgb(205, 204, 204); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Adicionar Evento</h3>
                            <form id="event-form" class="row g-3" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
                                <input type="hidden" name="ACTION" value="SAVE" />
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="datetime-picker1" name="TAR_PZ_INICIO" placeholder="Data e hora inicial" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="datetime-picker2" name="TAR_PZ_FIM" placeholder="Data e hora final" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <fieldset>
                                                    <legend style="color: rgb(211, 188, 140); text-transform: uppercase;">Descrição</legend>
                                                    <textarea class="form-control" id="text-area" name="TAR_DESCRICAO" rows="5" cols="10" wrap="soft" style="resize: none; text-align: justify;" required></textarea>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salvar">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Salvar
                                        </button>
                                        <a href="#" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fechar" onclick="fecha('add_event')">
                                            <i class="fas fa-close"></i>Fechar
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Calendário -->
                    <div class="row">
                        <div class="col">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require './footerInt.php'; ?>
    </div>

    <a name="fim"></a>
    <?php if (isset($CONN)) mysqli_close($CONN); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/moment/locale/pt-br.js"></script>
    <script src="./plugins/fullcalendar/main.js"></script>
    <script src="./plugins/fullcalendar/locales/pt-br.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuração do Flatpickr
        const dateConfig = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minDate: "today",
            locale: "pt"
        };

        // Inicializa Flatpickr
        flatpickr("#datetime-picker1", dateConfig);
        flatpickr("#datetime-picker2", dateConfig);

        // Configuração e inicialização do FullCalendar
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            locale: 'pt-br',
            themeSystem: 'bootstrap',
            editable: true,
            dayMaxEvents: true,
            events: {
                url: './schedule/sch_data.php',
                failure: function(error) {
                    console.error('Erro ao carregar eventos:', error);
                }
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            loading: function(isLoading) {
                if (isLoading) {
                    // Adicionar indicador de carregamento se necessário
                } else {
                    // Remover indicador de carregamento
                }
            }
        });

        calendar.render();

        // Validação do formulário
        const form = document.getElementById('event-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const inicio = document.getElementById('datetime-picker1').value;
                const fim = document.getElementById('datetime-picker2').value;
                const descricao = document.getElementById('text-area').value;

                if (!inicio || !fim || !descricao) {
                    alert('Por favor, preencha todos os campos obrigatórios.');
                    return false;
                }

                this.submit();
            });
        }
    });

    function fecha(id) {
        document.getElementById(id).style.display = 'none';
    }
    </script>
</body>
</html>