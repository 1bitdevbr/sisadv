<?php
  if( !isset( $_SESSION ) ) session_start();
  $required_level = 2;
  require_once(__DIR__ . '/../access/level.php');
  require_once(__DIR__ . '/../access/conn.php');
  require_once(__DIR__ . '/../config.php');
  require_once(__DIR__ . '/../dist/func/functions.php');
  require_once(__DIR__ . '/not_proc.php');
?>

    <div class="container-fluid">

      <!-- // NEW -->
      <span><a href="javascript:;" onclick="abreFecha('new')" class="btn btn-outline-info" title="Novo" style="text-decoration: none;" style="color: rgb( 255, 255, 255);"><i class="fas fa-note"></i>Novo</a></span><br />
      <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
      <div class="card card-outline card-info" style="display: none;" id="new">
        <div class="card-header"><h3 class="card-title">Nota:</h3></div>
        <form name="form_save" action="?pg=clients/clien_view" method="POST">
          <div class="card-body">
            <input type="hidden" name="ACTION" value="SAVE" />
            <input type="hidden" name="NOT_FK_CLIENT" value="<?= $NOT_FK_CLIENT; ?>" />
            <textarea id="summernote" class="form-control" name="NOT_NOTE" rows="10" wrap="soft" style="overflow: hidden; resize: none; text-align: justify;" placeholder="Texto..."></textarea>
          </div>
          <div class="card-footer">
            <div class="form-group" style="text-align: center;">
              <button class="btn input btn-default" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" onmouseover="this.style.color='#F89420'" onmouseout="this.style.color='rgb( 255, 255, 255 )'">
                <i class="fas fa-database"></i>&nbsp;&nbsp;Salvar
              </button>
            </div>
          </div>
        </form>
        <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
      </div>

      <!-- // LIST -->
      <table id="history" class="table table-dark table-striped table-hover table-sm">
        <thead>
          <tr>
            <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Notas</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Criado em</th>
            <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if( $VERIFICA > 0 ) {
              while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) { ?>
          <tr>
            <th scope="row">
              <div>
                <?= $DADOS[ 'NOT_NOTE' ]; ?>
              </div>
              <!-- // UPDT -->
              <div class="card card-outline card-info d-print-none" style="display: none;" id="updt_<?= $DADOS[ 'NOT_ID' ]; ?>">
                <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
                <form name="form_save" action="?pg=clients/clien_view" method="POST">
                  <div class="card-body d-print-none">
                    <input type="hidden" name="ACTION" value="UPDT" />
                    <input type="hidden" name="NOT_FK_CLIENT" value="<?= $NOT_FK_CLIENT; ?>" />
                    <input type="hidden" name="NOT_ID" value="<?= $DADOS[ 'NOT_ID' ]; ?>" />
                    <textarea id="updt_summernote" class="form-control" name="NOT_NOTE" rows="5" wrap="soft" style="overflow: hidden; resize: none; text-align: justify;"><?= $DADOS[ 'NOT_NOTE' ]; ?></textarea>
                  </div>
                  <div class="card-footer d-print-none">
                    <div class="form-group d-print-none" style="text-align: center;">
                      <button class="btn input btn-info" type="submit" name="btn-submit" id="btn-submit" value="btn-submit" onmouseover="this.style.color='rgb( 255, 255, 255 )'" onmouseout="this.style.color='rgb( 255, 255, 255 )'"><i class="fas fa-database"></i>&nbsp;&nbsp;Salvar</button>
                      <a href="?pg=clients/clien_view&ACTION=DEL&NOT_FK_CLIENT=<?= $NOT_FK_CLIENT; ?>&NOT_ID=<?= $DADOS[ 'NOT_ID' ]; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este registro?')"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Excluir</a>
                    </div>
                  </div>
                </form>
                <hr class="mt-1 mb-1" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
              </div>
            </th>
            <td class="text-center" style="width: 10px;">
            <?php
                $NOT_DT_CREATION = date( "d/m/Y", strtotime( $DADOS[ 'NOT_DT_CREATION' ] ) );
                echo $NOT_DT_CREATION;
            ?>
            </td>
            <td class="text-center d-print-none" style="width: 10px;">
              <a href="javascript:;" class="btn btn-outline-info" style="text-decoration: none; color: rgb( 255, 255, 255);" onclick="abreFecha('updt_<?= $DADOS[ 'NOT_ID' ]; ?>')" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;
              <a href="?pg=notes/not_print&ACTION=PRINT&NOT_FK_CLIENT=<?= $NOT_FK_CLIENT; ?>&NOT_ID=<?= $DADOS[ 'NOT_ID' ]; ?>" class="btn btn-outline-info" style="text-decoration: none; color: rgb( 255, 255, 255);" title="Gerar Arquivo"><i class="fas fa-file" style="color: rgb( 223, 165, 151 );"></i></a>
            </td>
          </tr>
          <?php }
            }
          ?>
        </tbody>
      </table>
    </div>

<!-- Summernote -->
<script src="./plugins/summernote/summernote-bs4.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // Update Summernote
    $('#updt_summernote').summernote()
  })
</script>