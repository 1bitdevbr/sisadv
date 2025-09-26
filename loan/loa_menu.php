			<div class="container col-12">
				<div class="row callout callout-danger user-panel" style="justify-content: center; align-items: center; display: flex; vertical-align: middle;">
					<div class="col-sm">
                        <h4 style="color: rgb( 211, 211, 213 );"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Menu</h4>
					</div><!-- /.callout -->
                    <div class="col-sm">
                        <?php
                            if( strpos( $_SERVER[ 'REQUEST_URI' ], 'clien_search' ) ) {
                                include_once(__DIR__ . '/../searchBar.php');
                            } else { ?>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; margin: auto;">
                                                <form name="form_search" action="?pg=loan/loa_main" method="POST">
                                                    <div class="input-group">
                                                        <input type="search" name="SEARCH" class="form-control form-control-lg" placeholder="Pesquisar" onkeyup="this.value = this.value.toUpperCase();" autofocus />
                                                        <div class="input-group-append">
                                                            <button type="submit" name="btnSearch" class="btn btn-lg btn-default"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                        <?php } ?>
                    </div>
                    <div class="col-sm" style="text-align: right;">
                        <a href="?pg=loan/loa_register" class="btn btn-app" title="Cadastrar Assunto" style="text-decoration: none;"><i class="fas fa-plus"></i>Cadastrar</a>
                        <a href="?pg=loan/loa_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fa fa-bars"></i>Menu</a>
                        <a href="#fim" class="btn btn-app" title="Fim da página" style="text-decoration: none;"><i class="fas fa-arrow-circle-down"></i>Fim</a>
                    </div>
				</div><!-- /.col-12 -->
			</div><!-- /.row -->

            <!--
                strpos(): A função strpos() é usada para encontrar a primeira ocorrência de uma string secundária em uma string.
                Se a string secundária existir, a função retornará o índice inicial da string secundária, caso contrário, retornará False se a string secundária não for encontrada na string (URL).

                Sintaxe:
                int strpos( $String, $Substring )
                Fonte: https://acervolima.com/como-verificar-se-o-url-contem-determinada-string-usando-php/
            -->