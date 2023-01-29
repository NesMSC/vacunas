<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <!-- vacunas Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="card text-dark">
                        <div class="card-body">
                            <div class="d-flex p-2 mb-2 justify-content-between align-items-center">
                                <h5 class="card-title">VACUNAS</h5>
                                <a href="/vacunas/crear" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Nuevo
                                </a>
                            </div>
                            <?php require viewPath('alerts.message') ?>
                            <?php require viewPath('vacunas.tabla') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- vacunas End -->
</div>
