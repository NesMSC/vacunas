<div class="table-responsive">
    <table id="tabla" class=" table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de ingreso</th>
                <th>Fecha de vencimiento</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vacunas as $vacuna): ?>
                <tr>
                    <td><?php echo $vacuna->nombre  ?></td>
                    <td><?php echo $vacuna->descripcion  ?></td>
                    <td><?php echo $vacuna->fecha ?></td>
                    <td><?php echo $vacuna->fecha_vencimiento  ?></td>
                    <td>
                        <a href="vacunas/ver/<?php echo $vacuna->id  ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="vacunas/editar/<?php echo $vacuna->id  ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a 
                            onclick="return confirm('¿Dese eliminar a esta vacuna?')" 
                            href="vacunas/delete/<?php echo $vacuna->id  ?>" 
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