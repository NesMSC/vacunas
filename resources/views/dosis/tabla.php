<div class="table-responsive">
    <table id="tabla" class="table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Cedula</th>
                <th>Vacuna</th>
                <th>Descripcion</th>
                <th>Fecha de aplicación</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dosis as $value): ?>
                <tr>
                    <td><?php echo $value->paciente->nombre . ' ' . $value->paciente->apellido ?></td>
                    <td><?php echo $value->paciente->cedula ?></td>
                    <td><?php echo $value->vacuna->nombre  ?></td>
                    <td><?php echo $value->vacuna->descripcion  ?></td>
                    <td><?php echo $value->fecha_aplicación  ?></td>
                    <td>
                        <a 
                            onclick="return confirm('¿Dese eliminar a esta dosis?')" 
                            href="dosis/delete/<?php echo $value->id  ?>" 
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