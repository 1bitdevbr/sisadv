            <div class="container col-12">
				<div class="row callout callout-danger user-panel" style="justify-content: center; align-items: center; display: flex; vertical-align: middle;">
					<div class="col-sm">
                        <h4 style="color: rgb( 211, 211, 213 );"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Menu</h4>
					</div><!-- /.callout -->
                    <div class="col-sm" style="text-align: right;">
                        <?php if( strpos( $_SERVER[ 'REQUEST_URI' ], 'cli_view' ) ) { ?><a href="?pg=setup/clients/cli_edit&id=<?= $DADOS[ 'CLI_ID' ]; ?>" class="btn btn-app" title="Editar Cliente" style="text-decoration: none;"><i class="fas fa-edit"></i>Editar</a><?php } ?>
                        <a href="?pg=setup/clients/cli_main" class="btn btn-app" title="Listar Clientes" style="text-decoration: none;"><i class="fa fa-search"></i>Listar</a>
                        <a href="?pg=setup/clients/cli_register" class="btn btn-app" title="Cadastrar Cliente" style="text-decoration: none;"><i class="fas fa-plus"></i>Cadastrar</a>
                        <a href="?pg=setup/clients/cli_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fa fa-bars"></i>Menu</a>
                        <a href="#fim" class="btn btn-app" title="Fim da página" style="text-decoration: none;"><i class="fas fa-arrow-circle-down"></i>Fim</a>
                    </div>
				</div><!-- /.col-12 -->
			</div><!-- /.row -->