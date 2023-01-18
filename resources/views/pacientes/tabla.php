<table id="tabla" class=" table table-striped" tyle="width: 100%;">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cédula</th>
            <th>Fecha de nacimiento</th>
            <th>Teléfono</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pacientes as $paciente): ?>
            <tr>
                <td><?php echo $paciente->nombre  ?></td>
                <td><?php echo $paciente->apellido  ?></td>
                <td><?php echo $paciente->cedula ?></td>
                <td><?php echo $paciente->fecha_nacimiento  ?></td>
                <td><?php echo $paciente->telefono  ?></td>
                <td>
                    <a href="pacientes/ver/<?php echo $paciente->id  ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>