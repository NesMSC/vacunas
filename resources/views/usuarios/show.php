<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Usuario
            </h5>
            <div class="row g-2">
                <?php require viewPath('alerts.success') ?>
                <div class="col-md-4">
                    <strong>Nombres: </strong>
                    <p><?php echo $usuario->persona->nombre ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Apellidos: </strong>
                    <p><?php echo $usuario->persona->apellido ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Cedula: </strong>
                    <p><?php echo $usuario->persona->cedula ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Número de teléfono: </strong>
                    <p><?php echo $usuario->persona->telefono ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Usuario: </strong>
                    <p><?php echo $usuario->nombre_usuario ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Correo electrónico: </strong>
                    <p><?php echo $usuario->correo ?></p>
                </div>
            </div>
        </div>
    </div>
</div>