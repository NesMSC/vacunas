<div class="table-responsive">
    <table id="tabla" class=" table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Fecha de ingreso</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vacunas as $vacuna): ?>
                <tr>
                    <td><?php echo $vacuna->nombre  ?></td>
                    <td><?php echo $vacuna->cantidad  ?></td>
                    <td><?php echo $vacuna->fecha ?></td>
                    <td>
                        <?php if($vacuna->getEstado()): ?>
                            <span class="badge bg-success">Segura</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Caducada</span>
                        <?php endif ?>
                    </td>
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