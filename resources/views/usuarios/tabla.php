<div class="table-responsive">
    <table id="tabla" class="table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre de usuario</th>
                <th>Correo electrónico</th>
                <th>Rol</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario->nombre_usuario  ?></td>
                    <td><?php echo $usuario->correo  ?></td>
                    <td><?php echo $usuario->roles[0]?->nombre ?></td>
                    <td>
                        <a href="usuarios/ver/<?php echo $usuario->id  ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="usuarios/editar/<?php echo $usuario->id  ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a 
                            onclick="return confirm('¿Dese eliminar a este usuario?')" 
                            href="usuarios/delete/<?php echo $usuario->id  ?>" 
                            class="btn btn-sm btn-danger"
                        >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>