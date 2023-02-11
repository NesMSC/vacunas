<h5 class="card-title mb-4">
    Dosis pendientes
</h5>
<div class="table-responsive mb-4">
    <table id="tabla-pendientes" class=" table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha prevista</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($paciente->pendientes as $pendiente): ?>
                <tr>
                    <td><?php echo $pendiente->vacuna->nombre ?></td>
                    <td><?php echo $pendiente->vacuna->descripcion ?></td>
                    <td><?php echo $pendiente->fecha_prevista ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>