<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card p-4">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Añadir paciente
            </h5>
            <form class="row g-4 needs-validation" novalidate action="/pacientes/store" method="POST">
                <?php require viewPath('pacientes._form') ?>
                
                <div class="col-12 m-6">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>