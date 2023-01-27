<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Añadir paciente
            </h5>
            <form class="row g-4" action="/pacientes/store" method="POST">
                <?php require viewPath('pacientes._form') ?>
            </form>
        </div>
    </div>
</div>