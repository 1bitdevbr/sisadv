                <div class="col-md-8 offset-md-2" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; margin: auto;">
                    <form class="form-inline" name="SEARCH" action="<?= $_SERVER[ 'REQUEST_URI' ]; ?>" method="POST">
                        <div class="input-group">
                            <input type="search" name="SEARCH" class="form-control form-control-lg" placeholder="Pesquisar" aria-label="SEARCH" onkeyup="this.value = this.value.toUpperCase();" autofocus />
                            <div class="input-group-append">
                                <button type="submit" name="btnSearch" class="btn btn-lg btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>