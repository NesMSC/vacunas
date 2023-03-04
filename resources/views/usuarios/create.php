<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex d-flex p-2 mb-2 justify-content-between align-items-center">
                <h5 class="card-title">
                    Agregar usuario
                </h5>
                <a href="/usuarios/registrarNuevo" class="btn btn-sm btn-primary">
                    Crear nuevo
                </a>
            </div>
            <?php require viewPath('alerts.error') ?>
            <?php require viewPath('alerts.message') ?>

            <form class="row needs-validation" novalidate action="/usuarios/buscar" method="POST">
                <div class="col-md-3">
                    <div class="row g-0">
                        <div class="col-4">
                            <select id="nacionalidad" class="form-select" name="nacionalidad">
                                <option value="V-" selected>V-</option>
                                <option value="E-">E-</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <input required
                                type="text" 
                                class="form-control" 
                                id="cedula" 
                                name="cedula"
                            >
                            <div class="invalid-feedback">
                                *Campo requerido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <?php if(isset($persona)): ?>
                <div class="row">
                    <div class="col-6">
                        <p class="fs-6 text-dark">
                            <span class="fw-bolder">Usuario: </span>
                            <?php echo "{$persona->nombre} {$persona->apellido} {$persona->cedula}"  ?>
                        </p>
                    </div>
                </div>
                <form class="row g-4 needs-validation" method="post" action="/usuarios/store/<?php echo $persona->id ?>">
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
            <?php endif ?>
            <?php if(isset($nueva) && $nueva): ?>
                <?php require viewPath('usuarios._form') ?>
            <?php endif ?>
        </div>
    </div>
</div>