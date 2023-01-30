<div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input 
        required 
        type="text" 
        name="nombre" 
        id="nombre" 
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->nombre : ""; ?>"
    >
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-md-10">
    <label for="descripcion" class="form-label">Descripcion (opcional)</label>
    <textarea class="form-control" name="descripcion" id="descripcion" cols="20" rows="6">
        <?php echo isset($vacuna) ? $vacuna->descripcion : "" ?>
    </textarea>
</div>
<div class="col-md-4">
    <label for="fecha" class="form-label">Fecha de ingreso</label>
    <input 
        required 
        type="date" 
        name="fecha" 
        id="fecha"
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->fecha : "" ?>"
    >
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-md-4">
    <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
    <input 
        required 
        type="date" 
        name="fecha_vencimiento" 
        id="fecha_vencimiento"
        class="form-control"
        value="<?php echo isset($vacuna) ? $vacuna->fecha_vencimiento : "" ?>"
    >
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>

<div class="col-12">
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>