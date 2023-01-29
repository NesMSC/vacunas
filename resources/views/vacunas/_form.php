<div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input 
        type="text" 
        name="nombre" 
        id="nombre" 
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->nombre : ""; ?>"
    >
</div>
<div class="col-md-10">
    <label for="descripcion" class="form-label">Descripcion</label>
    <textarea class="form-control" name="descripcion" id="descripcion" cols="20" rows="6">
        <?php echo isset($vacuna) ? $vacuna->descripcion : "" ?>
    </textarea>
</div>
<div class="col-md-4">
    <label for="fecha" class="form-label">Fecha de ingreso</label>
    <input 
        type="date" 
        name="fecha" 
        id="fecha"
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->fecha : "" ?>"
    >
</div>
<div class="col-md-4">
    <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
    <input 
        type="date" 
        name="fecha_vencimiento" 
        id="fecha_vencimiento"
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->fecha_vencimiento : "" ?>"
    >
</div>

<div class="col-12">
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>