<h5 class="card-title mb-4">
    Dosis suministradas
</h5>
<div class="table-responsive mb-4">
    <table id="tabla-dosis" class=" table table-striped" tyle="width: 100%;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de aplicación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($paciente->dosis as $dosis): ?>
                <tr>
                    <td><?php echo $dosis->vacuna->nombre ?></td>
                    <td><?php echo $dosis->vacuna->descripcion ?></td>
                    <td><?php echo $dosis->fecha_aplicacion ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>