<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Añadir paciente
            </h5>
            <form class="row g-4" action="/pacientes/store" method="POST">
                <div class="col-md-4">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres">
                </div>
                <div class="col-md-4">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                </div>
                <div class="col-md-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" class="form-select" name="sexo">
                        <option selected>Femenino</option>
                        <option>Masculino</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cedula" class="form-label">Cédula</label>
                    <div class="row g-0">
                        <div class="col-4">
                            <select id="nacionalidad" class="form-select" name="nacionalidad">
                                <option value="V-" selected>V-</option>
                                <option value="E-">E-</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" id="cedula" name="cedula">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>
                <div class="col-md-4">
                    <label for="telefono" class="form-label">Número de teléfono</label>
                    <div class="row g-0">
                        <div class="col-4">
                            <select id="pre_telefono" class="form-select" name="pre_telefono">
                                <option value="0414-" selected>0414-</option>
                                <option value="0424-">0424-</option>
                                <option value="0416-">0416-</option>
                                <option value="0426-">0426-</option>
                                <option value="0412-">0412-</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="" name="direccion">
                </div>
               
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>