<?php
  if (!isset($_SESSION)) session_start();
  $required_level = 1;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/sch_proc.php');
?>

<a name="topo"></a>
<div class="content-wrapper">

  <section class="content">
      <div class="container-fluid">

        <?php require './menuh.php'; ?>

        <div class="invoice p-3 card-primary card-outline">

          <div class="row legend">
              <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $scheduleTitle; ?><span class="subtitle"><?= $scheduleSubtitle; ?></span></legend>
          </div>

          <hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />

          <!-- /.BLOCO UPDT/EVENT -->
           <?php
            if( isset( $_GET[ 'id' ] ) ) {
                $ID = $_GET['id'];

                // Consulta para buscar eventos
                $SQL = " SELECT * FROM(
                                        SELECT TAR.*, PNA.*, CLI.*, SIT.*, PAS.*
                                          FROM TAR_TAREFAS TAR
                                     LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID = TAR.TAR_FK_NATUREZA
                                     LEFT JOIN CLI_CLIENTES CLI      ON CLI.CLI_ID = TAR.TAR_FK_CLIENTE
                                     LEFT JOIN TAR_SITUACAO SIT      ON SIT.TAR_ID_SIT = TAR.TAR_FK_SITUACAO
                                     LEFT JOIN PAS_PROC_PASTA PAS    ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                                         WHERE TAR.TAR_FK_STATUS     = 1
                                           AND TAR.TAR_FK_SITUACAO   < 3
                                           AND (TAR.TAR_FK_ATRIBUIDO = '$USR_ACCESS' OR TAR.TAR_USER_CREATION = '$USR_ACCESS')

                                         UNION

                                        SELECT TAR.*, PNA.*, CLI.*, SIT.*, PAS.*
                                          FROM TAR_TAREFAS TAR
                                     LEFT JOIN PNA_PROC_NATUREZA PNA ON PNA.PNA_ID = TAR.TAR_FK_NATUREZA
                                     LEFT JOIN CLI_CLIENTES CLI      ON CLI.CLI_ID = TAR.TAR_FK_CLIENTE
                                     LEFT JOIN TAR_SITUACAO SIT      ON SIT.TAR_ID_SIT = TAR.TAR_FK_SITUACAO
                                     LEFT JOIN PAS_PROC_PASTA PAS    ON PAS.PAS_ID = CLI.CLI_FK_PASTA
                                         WHERE TAR.TAR_TIPO          = 1
                                      ORDER BY TAR_PZ_FIM ASC
                                       ) AS RESULT
                                         WHERE TAR_ID	 		     = '$ID'
                       ";

                $RESULTADO     = mysqli_query( $CONN, $SQL );

                // Verifique se há dados retornados
                if (mysqli_num_rows($RESULTADO) > 0) {
                    $DADOS = mysqli_fetch_array($RESULTADO);

                    // Certifique-se de que as colunas existem nos resultados
                    if (isset($DADOS['TAR_ID'])) {
                        $TAR_ID = $DADOS['TAR_ID'];
                    }
                    if (isset($DADOS['TAR_PZ_INICIO'])) {
                        // $TAR_PZ_INICIO = $DADOS['TAR_PZ_INICIO'];
                        // $TAR_PZ_INICIO = DateTime::createFromFormat('Y-m-d H:i:s', $DADOS['TAR_PZ_INICIO']);
                        $TAR_PZ_INICIO = date("d/m/Y H:i:s", strtotime( $DADOS[ 'TAR_PZ_INICIO' ] ) );
                    }
                    if (isset($DADOS['TAR_PZ_FIM'])) {
                        // $TAR_PZ_FIM = $DADOS['TAR_PZ_FIM'];
                        // $TAR_PZ_FIM = DateTime::createFromFormat('Y-m-d H:i:s', $DADOS['TAR_PZ_FIM']);
                        $TAR_PZ_FIM = date("d/m/Y H:i:s", strtotime( $DADOS[ 'TAR_PZ_FIM' ] ) );
                    }
                    if (isset($DADOS['TAR_DESCRICAO'])) {
                        $TAR_DESCRICAO = $DADOS['TAR_DESCRICAO'];
                    }
                } else {
                    echo "Nenhum dado encontrado para TAR_FK_CLIENTE = $ID";
                }

            }
            ?>
            <div class="row justify-content-md-center">

                <div class="container" style="background-color: rgb( 63, 71, 78 ); padding: 10px; border: 1px solid #999; margin: 5px;" id="updt_event">
                <h3 style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Editar Evento</h3>

                <form id="form-validation" class="row g-3" action="?pg=schedule/sch_proc" method="POST">
                    <input type="hidden" name="ACTION" value="UPDT" />
                    <input type="hidden" name="TAR_ID" value="<?= $TAR_ID; ?>" />
                    <div class="card-body">

                    <div class="row">
                        <!-- EVENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="datetime-picker1" name="TAR_PZ_INICIO" value="<?= $TAR_PZ_INICIO; ?>" placeholder="Data e hora inicial">
                                <span id="error-datetime-picker1" class="error-message" style="color:red; display:none;">
                                    Por favor, preencha a data e hora inicial.
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <input type="text" class="form-control" id="datetime-picker2" name="TAR_PZ_FIM" value="<?= $TAR_PZ_FIM; ?>" placeholder="Data e hora final"/>
                                <span id="error-datetime-picker2" class="error-message" style="color:red; display:none;">
                                    Por favor, preencha a data e hora final.
                                </span>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
                            <legend style="color: rgb( 211, 188, 140 ); text-transform: uppercase;">Descrição</legend>
                            <textarea class="form-control" id="text-area" name="TAR_DESCRICAO" rows="5" cols="10" wrap="soft" style="resize: none; text-align: justify;" onkeyup="this.value = this.value.toUpperCase();"><?= $TAR_DESCRICAO; ?></textarea>
                            <span id="error-text-area" class="error-message" style="color:red; display:none;">
                                Por favor, insira seu texto.
                            </span>
                            </fieldset>
                        </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" value="Enviar" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salvar" onmouseover="this.style.color='rgb( 117, 255, 89 )'" onmouseout="this.style.color='rgb( 228, 242, 252 )'">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Salvar
                        </button>
                        <a href="?pg=schedule/sch_main" class="btn btn-app" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fechar" onmouseover="this.style.color='rgb( 29, 166, 243 )'" onmouseout="this.style.color='rgb( 228, 242, 252 )'"><i class="fas fa-close"></i>Fechar</a>
                        <a href="?pg=schedule/sch_proc&action=delete&id=<?= $TAR_ID; ?>" class="btn btn-app" style="color: rgb( 103, 103, 103 );" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Excluir" onmouseover="this.style.color='rgb( 230, 62, 49 )'" onmouseout="this.style.color='rgb( 103, 103, 103 )'" onclick="return confirm('Tem certeza que deseja excluir este evento?')"><i class="fa fa-trash"></i>Excluir</a>
                    </div>

                    </div><!-- /.card-body -->
                </form>
                </div>

            </div>

        </div><!-- /.Invoice -->

      </div><!-- /.End Container-fluid -->
  </section><!-- /.End Section -->

  <?php require './footerInt.php'; ?>

</div><!-- /.End Content-wrapper -->

<a name="fim"></a>
<?php mysqli_close($CONN); ?>

<!-- Campos de Data e Hora iniciais e finais -->
<script>
    // Configuração comum para flatpickr
    const commonConfig = {
        enableTime: true,
        dateFormat: "d-m-Y H:i",
        minDate: "today",
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
                longhand: ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"],
            },
            months: {
                shorthand: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                longhand: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            },
        },
    };

    // Inicializar flatpickr
    flatpickr("#datetime-picker1", commonConfig);
    flatpickr("#datetime-picker2", commonConfig);

    // Converter data para o formato Y-m-d H:i
    const convertDateToDatabaseFormat = (dateStr) => {
        const [day, month, yearAndTime] = dateStr.split("-");
        const [year, time] = yearAndTime.split(" ");
        return `${year}-${month}-${day} ${time}`;
    };

    // Validação do formulário
    const form = document.getElementById("form-validation");
    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const datetime1 = document.getElementById("datetime-picker1");
        const datetime2 = document.getElementById("datetime-picker2");
        const textArea = document.getElementById("text-area");

        let isValid = true;

        // Função para validar campos
        const validateField = (field, errorElement) => {
            if (!field.value) {
                errorElement.style.display = "block";
                field.classList.remove("valid");
                field.classList.add("invalid");
                isValid = false;
            } else {
                errorElement.style.display = "none";
                field.classList.remove("invalid");
                field.classList.add("valid");
            }
        };

        // Validar data e hora inicial
        validateField(datetime1, document.getElementById("error-datetime-picker1"));

        // Validar data e hora final
        validateField(datetime2, document.getElementById("error-datetime-picker2"));

        // Validar texto
        validateField(textArea, document.getElementById("error-text-area"));

        // Se todos os campos estiverem preenchidos, converter data e enviar o formulário
        if (isValid) {
            datetime1.value = convertDateToDatabaseFormat(datetime1.value);
            datetime2.value = convertDateToDatabaseFormat(datetime2.value);
            form.submit();  // Envia o formulário ao servidor
        }
    });

    // Adicionar evento de input para validação em tempo real
    const fields = [datetime1, datetime2, textArea];
    fields.forEach(field => {
        field.addEventListener("input", () => {
            const errorElement = document.getElementById(`error-${field.id}`);
            if (field.value) {
                errorElement.style.display = "none";
                field.classList.remove("invalid");
                field.classList.add("valid");
            } else {
                errorElement.style.display = "block";
                field.classList.remove("valid");
                field.classList.add("invalid");
            }
        });
    });
</script>

<!-- fullCalendar 2.2.5 -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/moment/locale/pt-br.js"></script>
<script src="./plugins/fullcalendar/main.js"></script>
<script src="./plugins/fullcalendar/locales/pt-br.js"></script>

<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText,
                backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
            };
        }
    });

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },

        //Random default events
        //events: 'https://sisadv.com.br/index.php?pg=schedule/sch_proc&_=' + new Date().getTime(),
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: './schedule/sch_data.php',
                method: 'GET',
                success: function(data) {
                    successCallback(data); // Passa o JSON como array de objetos
                },
                error: function() {
                    failureCallback();
                }
            });
        },
        eventTimeFormat: { // Configurar formato da hora do evento
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
        // eventColor: '#378006',
        // eventBackgroundColor: '#378006',
        // eventBorderColor: '#378006',
        // eventTextColor: 'rgb( 37, 211, 102 )'

    });

    calendar.render();
    // $('#calendar').fullCalendar()

    calendar.setOption('locale', 'pt-br');

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color'    : currColor
        })
    })
    $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
            return
        }

        // Create events
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color'    : currColor,
            'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
    })
  })
</script>