<div class="modal fade" id="modalPeso">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 style="padding: 0px;margin: 5px;">Modificar Peso</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <br>
                        <form action="pacientes.php" method="POST">
                            <input type='number' style="display:none" name='id' value=<?php echo $mascota['id_mascota'] ?>>
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="number" name="peso" placeholder="Peso">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success mt-4" name="modificarPeso" value="Modificar">
                        </form>
                        <?php if (!empty($message)) : ?>
                            <p><?= $message ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>