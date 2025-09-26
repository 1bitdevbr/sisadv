			<div class="container col-12">
				<div class="row callout callout-danger user-panel" style="justify-content: center; align-items: center; display: flex; vertical-align: middle;">
					<div class="col-sm">
                        <h4 style="color: rgb( 211, 211, 213 );"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Menu</h4>
					</div><!-- /.callout -->
                    <div class="col-sm">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <form name="form_search" action="?pg=funds/fun_search" method="POST">
                                            <div class="input-group">
                                                <input type="search" name="SEARCH" class="form-control form-control-lg" placeholder="Pesquisar">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-lg btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-sm" style="text-align: right;">
                        <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="javascript:;" onclick="abreFecha('add_movimento')" class="btn btn-app" title="Adicionar Movimento" style="text-decoration: none;" style="color: rgb( 255, 255, 255);"><i class="fas fa-plus"></i>Movimento</a><?php } ?>
                        <?php if(  $_SESSION[ 'USR_FK_LEVEL' ] >= 2 ) { ?><a href="javascript:;" onclick="abreFecha('add_cat')" class="btn btn-app" title="Adicionar Categoria" style="text-decoration: none;"style="color:rgb( 255, 255, 255);"><i class="fas fa-plus"></i>Categoria</a><?php } ?>
                        <a href="?pg=funds/fun_main" class="btn btn-app" title="Menu" style="text-decoration: none;"><i class="fa fa-bars"></i>Menu</a>
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