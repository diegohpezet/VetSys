<!--Modificar Fecha Modal-->
<div class="modal fade" id="modalModificar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 style="padding: 0px;margin: 5px;">Solicitar Cambio de Fecha</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <br>
                        <form action="medsys.php" method="POST">
                            <div class="row">
                                <div class="col-sm-5">
                                    <select class="form-select" name="nro_Turno" required>
                                        <option disabled selected value>N° de turno</option>
                                        <?php foreach ($id as $row) : ?>
                                            <option value="<?php echo $row['nro_Turno'] ?>"><?php echo $row['nro_Turno'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input name="fecha" class="form-control mt-3" type="date" required />
                                </div>
                            </div>
                            <input type="submit" style="margin: 2px;margin-top: 10px;" class="btn btn-success" name="modificarFecha" value="Modificar">
                        </form>
                        <br>
                        <hr>
                        <?php if (!empty($message)) : ?>
                            <p><?= $message ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>