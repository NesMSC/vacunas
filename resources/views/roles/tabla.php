<div class="table-responsive">
    <table id="tabla" class="table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($roles as $rol): ?>
                <tr>
                    <td><?php echo $rol->nombre  ?></td>
                    <td><?php echo $rol->descripcion ?></td>
                    <td>
                        <a href="roles/ver/<?php echo $rol->id  ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>