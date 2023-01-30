<div class="col-md-4">
    <label for="nombres" class="form-label">Nombres</label>
    <input
        required
        type="text" 
        class="form-control" 
        id="nombres" 
        name="nombres"
        value="<?php echo isset($paciente) ? $paciente->nombre : ""; ?>"
    >
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-md-4">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input required
        type="text" 
        class="form-control" 
        id="apellidos" 
        name="apellidos"
        value="<?php echo isset($paciente) ? $paciente->apellido : ""; ?>"
    >
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-md-2">
    <label for="sexo" class="form-label">Sexo</label>
    <select 
        id="sexo" 
        class="form-select" 
        name="sexo"
    >
        <option 
            value="Femenino"
            <?php echo isset($paciente) && $paciente->sexo == "Femenino" ? "selected" : ""; ?>
        >
            Femenino
        </option>
        <option 
            value="Masculino"
            <?php echo isset($paciente) && $paciente->sexo == "Masculino" ? "selected" : ""; ?>
        >
            Masculino
        </option>
    </select>
</div>
<div class="col-md-4">
    <label for="cedula" class="form-label">Cédula</label>
    <div class="row g-0">
        <div class="col-4">
            <select id="nacionalidad" class="form-select" name="nacionalidad">
                <option 
                    value="V-"
                    <?php echo isset($paciente) && substr($paciente->cedula, 0, 2) == "V-" ? "selected" : ""; ?>
                >
                    V-
                </option>
                <option 
                    value="E-"
                    <?php echo isset($paciente) && substr($paciente->cedula, 0, 2) == "E-" ? "selected" : ""; ?>
                >
                    E-
                </option>
            </select>
        </div>
        <div class="col-8">
            <input required
                type="text" 
                class="form-control" 
                id="cedula" 
                name="cedula"
                value="<?php echo isset($paciente) ? substr($paciente->cedula, 2) : "" ?>"
            >
            <div class="invalid-feedback">
                *Campo requerido
            </div>
        </div>
    </div>
</div>
<div class="col-md-2">
    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
    <input required type="date" value="<?php echo isset($paciente) ? $paciente->fecha_nacimiento : "" ?>" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
</div>
<div class="col-md-4">
    <label for="telefono" class="form-label">Número de teléfono</label>
    <div class="row g-0">
        <div class="col-4">
            <select id="pre_telefono" class="form-select" name="pre_telefono">
                <option value="0414-" <?php echo isset($paciente) && substr($paciente->telefono, 0, 5) == "0414-" ? "selected" : "" ?> >
                    0414-
                </option>
                <option value="0424-" <?php echo isset($paciente) && substr($paciente->telefono, 0, 5) == "0424-" ? "selected" : "" ?> >
                    0424-
                </option>
                <option value="0416-" <?php echo isset($paciente) && substr($paciente->telefono, 0, 5) == "0416-" ? "selected" : "" ?> >
                    0416-
                </option>
                <option value="0426-" <?php echo isset($paciente) && substr($paciente->telefono, 0, 5) == "0426-" ? "selected" : "" ?> >
                    0426-
                </option>
                <option value="0412-" <?php echo isset($paciente) && substr($paciente->telefono, 0, 5) == "0412-" ? "selected" : "" ?> >
                    0412-
                </option>
            </select>
        </div>
        <div class="col-8">
            <input required type="text" class="form-control" value="<?php echo isset($paciente) ? substr($paciente->telefono, 5) : "" ?>" name="telefono">
            <div class="invalid-feedback">
                *Campo requerido
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <label for="email" class="form-label">Correo electrónico</label>
    <input required type="email" class="form-control" id="email" value="<?php echo isset($paciente) ? $paciente->usuario->correo : "" ?>" name="email">
    <div class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-6">
    <label for="inputAddress" class="form-label">Dirección</label>
    <input required type="text" class="form-control" id="inputAddress" value="<?php echo isset($paciente) ? $paciente->direccion : "" ?>" name="direccion">
    <di class="invalid-feedback">
        *Campo requerido
    </div>
</div>
<div class="col-12 m-6">
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>