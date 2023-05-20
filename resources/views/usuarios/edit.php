<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Editar usuario
            </h5>
            <?php require viewPath('alerts.error') ?>
            <?php require viewPath('alerts.message') ?>
                <form class="row g-4 needs-validation" method="post" action="/usuarios/update/<?php echo $usuario->id ?>">
                    <div class="col-md-4">
                        <label for="usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" required class="form-control" id="usuario" name="nombre_usuario" value="<?php echo $usuario->nombre_usuario ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Correo</label>
                        <input required class="form-control" value="<?php echo $usuario->correo ?>" type="email" name="correo" id="email">
                    </div>
                    <div class="col-md-4">
                        <label for="rol" class="form-label">Rol</label>
                        <select 
                            id="rol" 
                            class="form-select" 
                            name="rol"
                        >
                            <?php foreach($roles as $rol): ?>
                                <option 
                                    <?php if($usuario->hasRol($rol->nombre)){
                                        echo "selected";
                                    } ?> 
                                    value="<?php echo $rol->id ?>"
                                >
                                    <?php echo $rol->nombre ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12 m-6">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>