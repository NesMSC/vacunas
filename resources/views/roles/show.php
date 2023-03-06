<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Rol
            </h5>
            <div class="row g-2">
                <?php require viewPath('alerts.success') ?>
                <div class="col-md-12">
                    <strong>Nombre: </strong>
                    <p><?php echo $rol->nombre ?></p>
                </div>
                <div class="col-md-12">
                    <strong>Descripcion: </strong>
                    <p><?php echo $rol->descripcion ?></p>
                </div>
                <div class="col-md-6">
                    <strong>Permisos: </strong>
                    <ul>
                        <?php foreach($rol->permisos as $permiso): ?>
                        <li>
                            <?php echo $permiso->descripcion ?>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>