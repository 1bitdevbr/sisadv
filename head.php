    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Bootstrap CSS 4.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Montserrat -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <!-- Fav Ico -->
    <link rel="icon" type="image/png" href="dist/img/icons/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <!-- Schedule -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <!-- Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SummerNote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Graficos Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- PDF -->
    <link rel="stylesheet" href="dist/css/documentosPdf.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- PESQUISA DE PROCESSOS NO SITE DO TRIBUNAL -->
    <script src="dist/js/search.process.js"></script>
    <script type="text/javascript">
        //<![CDATA[

        $(document).ready(function() {

            var mask_par_autorizacaoCaso_autorizacao_numeroProcessoUnificado = '9999999-99.9999.9.99.9999';
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').mask(
                mask_par_autorizacaoCaso_autorizacao_numeroProcessoUnificado);
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').attr('size',
                mask_par_autorizacaoCaso_autorizacao_numeroProcessoUnificado.length);
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').addClass('ui-mask');
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').qtip({
                content: {
                    text: $('#par_1xhw4toslimz91jmb2voa5qnce_tooltip').html()
                },
                position: {
                    at: 'bottom center',
                    my: 'top center',
                    viewport: $(window),
                    adjust: {
                        method: 'flip'
                    }
                },
                style: {
                    width: 280,
                    widget: true
                },
                hide: {
                    event: 'mouseout'
                },
                show: {
                    event: 'mouseover'
                }
            });
            $("#par_3obzrl3jl99o2ussxsslr74e").button({
                icons: {
                    primary: null
                }
            }).attr("autocomplete", "off").click(function() {
                window.location = $("#par_3obzrl3jl99o2ussxsslr74e").attr("value");
            });
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoOutro').qtip({
                content: {
                    text: $('#par_5u1oa9c47lsv13hqralgsodtd_tooltip').html()
                },
                position: {
                    at: 'bottom center',
                    my: 'top center',
                    viewport: $(window),
                    adjust: {
                        method: 'flip'
                    }
                },
                style: {
                    width: 280,
                    widget: true
                },
                hide: {
                    event: 'mouseout'
                },
                show: {
                    event: 'mouseover'
                }
            });
            $('#par_formulario').form({
                name: 'formulario',
                disabled: false,
                url: 'https://sisadv.com.br/index.php?pg=cases/cas_mainSec',
                beforeSubmit: function() {
                    return confirmSubmission();
                }
            });
            $(document).ajaxStart(function() {
                $('.ui-ajax-info-loading').fadeIn('normal');
            }).ajaxStop(function() {
                $('.ui-ajax-info-loading').fadeOut('normal');
            });
        });

        function showNumeroProcessoUnificado() {
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').parent().show();
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoOutro').parent().hide();
        }

        function showNumeroProcessoOutro() {
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoOutro').parent().show();
            $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').parent().hide();
        }

        function showNumeroProcesso() {
            if (true) {
                showNumeroProcessoUnificado();
            } else {
                showNumeroProcessoOutro();
            }
        }

        function consultarProcesso() {
            var numeroDigitoAnoUnificado = $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').val().substring(0,
                15);
            var foroNumeroUnificado = $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').val().substring(21);
            var dePesquisaNuUnificado = $('#par_autorizacaoCaso_autorizacao_numeroProcessoUnificado').val();
            window.open(
                'http://esaj.tjsp.jus.br/cpopg/search.do?conversationId=&dadosConsulta.localPesquisa.cdLocal=-1&cbPesquisa=NUMPROC&dadosConsulta.tipoNuProcesso=UNIFICADO&numeroDigitoAnoUnificado=' +
                numeroDigitoAnoUnificado + '&foroNumeroUnificado=' + foroNumeroUnificado +
                '&dadosConsulta.valorConsultaNuUnificado=' + dePesquisaNuUnificado + '&dadosConsulta.valorConsulta=',
                '_blank');
        }
        //]]>
    </script>