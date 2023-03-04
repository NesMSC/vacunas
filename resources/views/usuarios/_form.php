<form class="row g-4 needs-validation" method="post" action="/usuarios/store">
    <div class="col-md-4">
        <label for="nombres" class="form-label">Nombres</label>
            <input
                required
                type="text" 
                class="form-control" 
                id="nombres" 
                name="nombres"
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
        >
        <div class="invalid-feedback">
            *Campo requerido
        </div>
    </div>
    <div class="col-md-4">
        <label for="sexo" class="form-label">Sexo</label>
        <select 
            id="sexo" 
            class="form-select" 
            name="sexo"
        >
            <option  value="Femenino">
                Femenino
            </option>
            <option 
                value="Masculino">
                Masculino
            </option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="cedula" class="form-label">Cédula</label>
        <div class="row g-0">
            <div class="col-4">
                <select id="nacionalidad" class="form-select" name="nacionalidad">
                    <option value="V-">
                        V-
                    </option>
                    <option value="E-">
                        E-
                    </option>
                </select>
            </div>
            <div class="col-8">
                <input required
                    type="text" 
                    class="form-control" 
                    id="cedula" 
                    name="cedula">
                <div class="invalid-feedback">
                    *Campo requerido
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input required type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
    </div>
    <div class="col-md-4">
        <label for="telefono" class="form-label">Número de teléfono</label>
        <div class="row g-0">
            <div class="col-4">
                <select id="pre_telefono" class="form-select" name="pre_telefono">
                    <option value="0414-">
                        0414-
                    </option>
                    <option value="0424-">
                        0424-
                    </option>
                    <option value="0416-">
                        0416-
                    </option>
                    <option value="0426-">
                        0426-
                    </option>
                    <option value="0412-">
                        0412-
                    </option>
                </select>
            </div>
            <div class="col-8">
                <input required type="text" class="form-control" name="telefono">
                <div class="invalid-feedback">
                    *Campo requerido
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">Correo electrónico</label>
        <input required type="email" class="form-control" id="email" name="email">
        <div class="invalid-feedback">
            *Campo requerido
        </div>
    </div>
    <div class="col-md-6">
        <label for="direccion" class="form-label">Dirección</label>
        <input required type="text" class="form-control" id="direccion" name="direccion">
        <div class="invalid-feedback">
            *Campo requerido
        </div>
    </div>
    <div class="col-md-4">
        <label for="usuario" class="form-label">Nombre de usuario</label>
        <input type="text" required class="form-control" id="usuario" name="nombre_usuario">
    </div>
    <div class="col-md-4">
        <label for="rol" class="form-label">Rol</label>
        <select 
            id="rol" 
            class="form-select" 
            name="rol"
        >
            <?php foreach($roles as $rol): ?>
                <option value="<?php echo $rol->id ?>"><?php echo $rol->nombre ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="col-12 m-6">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>