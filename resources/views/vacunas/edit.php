<?php require viewPath('templates.sidebar') ?>
<div class="content">
    <?php require viewPath('templates.navbar') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                Editar vacunas
            </h5>
            <form class="row g-4" action="/vacunas/update/<?php echo $vacuna->id ?>" method="POST">
                <?php require viewPath('vacunas._form') ?>
            </form>
        </div>
    </div>
</div>