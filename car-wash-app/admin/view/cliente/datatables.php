
<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Cliente Nombre</th>
                                            <th>Item Servicio</th>
                                            <th>Costo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            // var_dump($mat);
                                            for($i=0;$i<sizeof($mat);$i++) { ?>
                                                <tr>
                                                    <td><?php echo $mat[$i][0] ?></td>
                                                    <td><?php echo $mat[$i][1] ?></td>
                                                    <td><?php echo $mat[$i][2] ?></td>
                                                    <td><?php echo $mat[$i][3] ?></td>
                                                    <td><?php echo '$' . number_format($mat[$i][4], 0, ',', '.'); ?></td>
                                                    <td>
                                                    <form id="<?php echo 'form-'.$i ?>" action="index.php" method="post" class="user w-100">
                                                        <input type="hidden" name="txtid" value="<?php echo $mat[$i][5]; ?>">
                                                        <button id="<?php echo 'btn-'.$i ?>" class="btn btn-danger btn-user ml-2 w-100" type="submit" name="btn" onclick="confirmDelete(event,'<?php echo 'btn-'.$i ?>')"><i class="fas fa-trash"></i> Eliminar</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>