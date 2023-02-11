<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex d-flex p-2 mb-2 justify-content-between align-items-center">
                <h5 class="card-title">
                    Editar paciente
                </h5>
                <a href="/pendientes/asignar/<?php echo $paciente->id ?>" class="btn btn-sm btn-primary">
                    Asignar pendiente
                </a>
            </div>
            <form class="row g-4 needs-validation" novalidate action="/pacientes/update/<?php echo $paciente->id ?>" method="POST">

                <?php require viewPath('pacientes._form') ?>

                <div class="col-12 mb-6">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>