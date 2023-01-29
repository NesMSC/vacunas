<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Datos de la vacuna
            </h5>
            <div class="row g-2">
                <?php require viewPath('alerts.success') ?>
                <div class="col-md-6">
                    <strong>Nombre: </strong>
                    <p>
                        <?php echo $vacuna->nombre ?>
                        
                        <?php if($vacuna->getEstado()): ?>
                            <span class="badge bg-success">Segura</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Caducada</span>
                        <?php endif ?>
                    </p>
                </div>
                <div class="col-md-10">
                    <strong>Descripción: </strong>
                    <p><?php echo $vacuna->descripcion ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Fecha de ingreso: </strong>
                    <p><?php echo $vacuna->fecha ?></p>
                </div>
                <div class="col-md-4">
                    <strong>Fecha de vencimiento: </strong>
                    <p><?php echo $vacuna->fecha_vencimiento ?></p>
                </div>
            </div>
        </div>
    </div>
</div>