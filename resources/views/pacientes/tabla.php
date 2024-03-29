<?php use App\Auth; ?>
<div class="table-responsive">
    <table id="tabla" class="table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
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
                    <td><?php echo $paciente->telefono  ?></td>
                    <td>
                        <a href="pacientes/ver/<?php echo $paciente->id  ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php if(Auth::hasPermission('pacientes.actualizar')): ?>
                            <a href="pacientes/editar/<?php echo $paciente->id  ?>" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                        <?php endif ?>
                        <?php if(Auth::hasPermission('pacientes.eliminar')): ?>
                            <a 
                                onclick="return confirm('¿Dese eliminar a este paciente?')" 
                                href="pacientes/delete/<?php echo $paciente->id  ?>" 
                                class="btn btn-sm btn-danger"
                            >
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>