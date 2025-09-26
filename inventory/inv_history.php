                    <!-- INÍCIO DO HISTÓRICO -->
                    <table id="inventoryHistory" class="table table-dark table-striped table-hover table-sm">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 style="color: rgb( 248, 152, 152 );">HISTÓRICO | Patrimônios baixados</h4>
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data aquisição</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Data baixa</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Objeto</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Qtd</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Descrição</th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;"></th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;"></th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;"></th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;"></th>
                                <th scope="col" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 700;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // CONSULTA
                                $SQL = "SELECT I.*, S.STA_NAME, P.PAS_NOME
                                          FROM INV_INVENTARIO I
                                          JOIN STA_STATUS S ON S.STA_ID = I.INV_FK_STATUS
                                          JOIN PAS_PROC_PASTA P ON P.PAS_ID = I.INV_FK_LOCALIZACAO
                                         WHERE I.INV_FK_STATUS = 2
                                      ORDER By I.INV_ID DESC ";

                                $RESULTADO = mysqli_query( $CONN, $SQL );
                                $VERIFICA = mysqli_num_rows( $RESULTADO );

                                if( $VERIFICA > 0 ) {
                                while( $DADOS = mysqli_fetch_array( $RESULTADO ) ) {
                            ?>
                                <tr>
                                    <th scope="row" style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $INV_DT_AQUISICAO = date("d/m/Y", strtotime( $DADOS[ 'INV_DT_AQUISICAO' ] ) ); ?></th>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $INV_DT_BAIXA = date("d/m/Y", strtotime( $DADOS[ 'INV_DT_BAIXA' ] ) ); ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 143, 185, 205 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'INV_OBJETO' ]; ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'INV_QTD' ]; ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><?= $DADOS[ 'INV_DESCRICAO' ]; ?></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"></td>
                                    <td style="justify-content: center; align-items: center; text-align: left; display: table-cell; vertical-align: middle; color: rgb( 248, 248, 242 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"></td>
                                    <td style="justify-content: center; align-items: center; text-align: center; display: table-cell; vertical-align: middle; color: rgb( 205, 204, 204 ); text-transform: uppercase; font-size: 1.0em; font-weight: 600;"><a href="?pg=inventory/inv_view&id=<?= $DADOS[ 'INV_ID' ]; ?>" class="btn btn-outline-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a></td>
                                </tr>
                                <?php
                                    }
                                }
                        ?>
                        </tbody>
                    </table>
                    <!-- FIM DO HISTÓRICO -->