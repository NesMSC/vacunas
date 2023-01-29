<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <!-- pacientes Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="card text-dark">
                        <div class="card-body">
                            <div class="d-flex p-2 mb-2 justify-content-between align-items-center">
                                <h5 class="card-title">PACIENTES</h5>
                                <a href="/pacientes/create" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Nuevo
                                </a>
                            </div>
                            <?php if(isset($message)): ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-primary" role="alert">
                                            <?php echo $message?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php require viewPath('pacientes.tabla') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- pacientes End -->
</div>