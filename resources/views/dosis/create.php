<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Añadir dosis
            </h5>
            <?php require viewPath('alerts.error') ?>
            <?php if(!isset($paciente)): ?>
            <form class="row needs-validation" novalidate action="/dosis/buscarPaciente" method="POST">
                <div class="col-md-3">
                    <label for="cedula" class="form-label">Paciente</label>
                    <div class="row g-0">
                        <div class="col-4">
                            <select id="nacionalidad" class="form-select" name="nacionalidad">
                                <option value="V-" selected>V-</option>
                                <option value="E-">E-</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <input required
                                type="text" 
                                class="form-control" 
                                id="cedula" 
                                name="cedula"
                            >
                            <div class="invalid-feedback">
                                *Campo requerido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <?php else: ?>
                <div class="row">
                    <div class="col-6">
                        <p class="fs-6 text-dark">
                            <span class="fw-bolder">Paciente: </span>
                            <?php echo "{$paciente->nombre} {$paciente->apellido} {$paciente->cedula}"  ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                        <div class="table-responsive">
                            <table id="tabla" class=" table table-striped" tyle="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($vacunas as $vacuna): ?>
                                        <?php if(
                                            $vacuna->cantidad > 0 && 
                                            $vacuna->getEstado() &&
                                            !($paciente->verifyDosis($vacuna))): ?>
                                        <tr>
                                            <td><?php echo $vacuna->nombre  ?></td>
                                            <td><?php echo $vacuna->descripcion  ?></td>
                                            <td>
                                                <form action="/dosis/store" method="POST">
                                                    <input type="hidden" name="vacuna" value="<?php echo $vacuna->id ?>">
                                                    <input type="hidden" name="paciente" value="<?php echo $paciente->id ?>">
                                                    <button class="btn btn-sm btn-primary" type="submit">
                                                        Agregar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>