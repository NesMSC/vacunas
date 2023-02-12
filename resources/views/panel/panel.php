<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php include_once viewPath('templates.navbar') ?>
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Vacunas del día</p>
                        <h6 class="mb-0"><?php echo count(App\Models\Dosis::today()) ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Vacunas</p>
                        <h6 class="mb-0"><?php echo count(App\Models\Vacuna::all()) ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Dosis totales</p>
                        <h6 class="mb-0"><?php echo count(App\Models\Dosis::all()) ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-2">
                        <p class="mb-2">Pacientes totales</p>
                        <h6 class="mb-0"><?php echo count(App\Models\Paciente::all()) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
</div>
