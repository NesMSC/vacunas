<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Asignar pendiente
            </h5>
            <?php require viewPath('alerts.success') ?>
            <p class="fs-6">
                <span class="fw-bolder">Paciente: </span>
                <?php echo "{$paciente->nombre} {$paciente->apellido} {$paciente->cedula}"  ?>
            </p>
            <form class="row g-4 needs-validation" novalidate action="/pendientes/crear" method="POST">
                <div class="col-md-3">
                    <label for="fecha_prevista" class="form-label">Fecha prevista</label>
                    <input required type="date" class="form-control" id="fecha_prevista" name="fecha_prevista">
                </div>
                <div class="table-responsive col-12">
                    <table id="tabla" class=" table table-striped" tyle="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Asignar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vacunas as $vacuna): ?>
                                <?php if(
                                    $vacuna->cantidad > 0 && 
                                    $vacuna->getEstado() &&
                                    !($paciente->verifyDosis($vacuna)) &&
                                    !($paciente->verifyPendiente($vacuna))): 
                                ?>
                                <tr>
                                    <td><?php echo $vacuna->nombre ?></td>
                                    <td><?php echo $vacuna->descripcion ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input required class="form-check-input" type="radio" name="vacuna" value="<?php echo $vacuna->id ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="paciente" value="<?php echo $paciente->id ?>">
                </div>
                <div class="col-12 mb-6">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>