<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!-- <script src="dist/js/pages/dashboard2.js"></script> Alterações dos Gráficos no Dashboard -->
<script src="plugins/chart.js/Chart.min.js"></script>

<script src="dist/js/jquery.mask.min.js"></script>

<!-- FORM ADICIONA CAMPOS JUROS -->
<script src="dist/js/interest.js"></script>

<!-- InputMask Forms-->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- DataTables  & Plugins PDF, PRINT, CSV, EXCEL, COPY -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Summernote -->
<script src="./plugins/summernote/summernote-bs4.min.js"></script>

<script>
  $(function() {
      // Summernote
      $('#summernote').summernote()

      // Update Summernote
      $('#updt_summernote').summernote()

      //Initialize Select2 Elements
      $('.select2').select2()
      $('.select3').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })

      // Default
      $("#default").DataTable({
        "responsive": true,
        "ordering": true,
        "order": [
          [0, 'desc']
        ],
        "pageLength": 10,
        "lengthChange": true, // Escolher painel da qdt de itens a exibir
        "autoWidth": false
      }).buttons().container().appendTo('#default_wrapper .col-md-6:eq( 0 ) ');

      // Livro Caixa
      $("#fin").DataTable({
        "responsive": true,
        "ordering": false,
        "order": [
          [0, 'desc']
        ],
        "pageLength": 5,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#fin_wrapper .col-md-6:eq( 0 ) ');

      // Gestão de Tarefas
      $("#tsk_main").DataTable({
        "responsive": true,
        "ordering": false,
        "order": [
          [8, 'asc']
        ],
        "pageLength": 10,
        "lengthChange": true, // Escolher painel da qdt de itens a exibir
        "autoWidth": false
      }).buttons().container().appendTo('#tsk_main_wrapper .col-md-6:eq( 0 ) ');

      // Gestão de Tarefas - Histórico
      $("#tsk_history").DataTable({
        "responsive": true,
        "ordering": true,
        "order": [
          [0, 'desc']
        ],
        "pageLength": 5,
        "lengthChange": true, // Escolher painel da qdt de itens a exibir
        "autoWidth": true
      }).buttons().container().appendTo('#tsk_history_wrapper .col-md-6:eq( 0 ) ');

      // Cadastro de Clientes
      $("#cli").DataTable({
        "responsive": true,
        "ordering": true,
        "order": [
          [0, 'desc']
        ],
        "lengthChange": true, // Escolher painel da qdt de itens a exibir
        "autoWidth": true
      }).buttons().container().appendTo('#cli_wrapper .col-md-6:eq( 0 ) ');

      // Cadastro de Clientes - Histórico
      $("#history").DataTable({
        "responsive": true,
        "ordering": false,
        "lengthChange": true,
        "autoWidth": false
        // "buttons": ["pdf", "print"]
      }).buttons().container().appendTo('#history_wrapper .col-md-6:eq( 0 ) ');

      // Cadastro de Clientes - Financeiro
      $("#finances").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 25, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#finances_wrapper .col-md-6:eq( 0 ) ');

      // Inventário
      $("#inventory").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 10, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#inventory_wrapper .col-md-6:eq( 0 ) ');

      // Inventário History
      $("#inventoryHistory").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 10, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#inventoryHistory_wrapper .col-md-6:eq( 0 ) ');

      // Table -- log_main.php
      $("#table").DataTable({
        "responsive": true,
        "ordering": true,
        "order": [
          [0, 'desc']
        ],
        "lengthChange": true,
        "autoWidth": false
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#table_wrapper .col-md-6:eq( 0 ) ');

      // Gestão de Processos
      $("#cas").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 25, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#cas_wrapper .col-md-6:eq( 0 ) ');

      // Gestão de Cálculos
      $("#calc").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 25, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#calc_wrapper .col-md-6:eq( 0 ) ');

      // Deb
      $("#deb").DataTable({
        "responsive": true,
        "ordering": false,
        "pageLength": 25, //qtd de registros por tabela
        "lengthChange": true,
        "searching": true,
        "paging": true, //paginação
        "autoWidth": false
      }).buttons().container().appendTo('#deb_wrapper .col-md-6:eq( 0 ) ');

      // Order
      $("#order").DataTable({
        "responsive": true,
        "ordering": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "info": false,
        "paging": false
      }).buttons().container().appendTo('#order_wrapper .col-md-6:eq( 0 ) ');
    });
</script>

<!-- JavaScript LC ============================================= -->
<script language="javascript" src="dist/js/financial/fin_scripts.js"></script>

<!-- PDF ======================================================-->
<script>
  function downloadPDF() {
    const item = document.querySelector(".PDF");
    var opt = {
      margin: [5, 20, 5, 20], // top, left, buttom, right
      filename: "sisadv.pdf",
      // enableLinks: true,
      html2canvas: {
        dpi: 96,
        // letterRendering: true,
        // scale: 2
      },
      jdPDF: {
        unit: "mm",
        format: "a4",
        orientation: "portrait",
        compress: true
      },
    };
    html2pdf().set(opt).from(item).save();
  }
</script>

<!--// TOOLTIPS //-->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<!-- Last Bootstrap JS Load -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>