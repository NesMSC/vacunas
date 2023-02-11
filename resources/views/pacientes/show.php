<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Datos del paciente
            </h5>
            <div class="row g-2">
                <?php if(isset($success)): ?>
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <?php echo $success ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-md-4">
                    <strong>Nombres: </strong>
                    <p><?php echo $paciente->nombre ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Apellidos: </strong>
                    <p><?php echo $paciente->apellido ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Cédula: </strong>
                    <p><?php echo $paciente->cedula ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Sexo: </strong>
                    <p><?php echo $paciente->sexo ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Fecha de nacimiento: </strong>
                    <p><?php echo $paciente->fecha_nacimiento ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Número de teléfono: </strong>
                    <p><?php echo $paciente->telefono ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Correo electrónico: </strong>
                    <p><?php echo $paciente->usuario->correo ?></p>
                </div>
                <div class="col-6">
                    <strong>Dirección: </strong>
                    <p><?php echo $paciente->direccion ?></p>
                </div>
            </div>
            <div class="row g-0 mt-4 mb-4">
                <div class="col-md-12">
                    <?php require viewPath('pacientes.tabla_dosis') ?>
                </div>
                <div class="col-md-12">
                    <?php require viewPath('pacientes.tabla_pendientes') ?>
                </div>
            </div>
        </div>
    </div>
</div>
