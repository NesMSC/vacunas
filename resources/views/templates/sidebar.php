<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">LOGO</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">
                    <?php
                        use App\Auth;
                        $user = Auth::getUser(); echo "{$user->nombre} {$user->apellido}";
                    ?>
                </h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Panel</a>
            <?php if(Auth::hasPermission('pacientes.consultar')): ?>
            <a href="/pacientes" class="nav-item nav-link">
                <i class="fa fa-users me-2"></i>
                Pacientes
            </a>
            <?php endif ?>
            <?php if(Auth::hasPermission('vacunas.consultar')): ?>
                <a href="/vacunas" class="nav-item nav-link">
                    <i class="fa fa-syringe me-2"></i>
                    Vacunas
                </a>
            <?php endif ?>
            <?php if(Auth::hasPermission('dosis.consultar')): ?>
                <a href="/dosis" class="nav-item nav-link">
                    <i class="fas fa-prescription-bottle-alt me-2"></i>
                    Dosis
                </a>
            <?php endif ?>
            <?php if(Auth::hasPermission('usuarios.consultar')): ?>
                <a href="/usuarios" class="nav-item nav-link">
                    <i class="fa fa-user-cog me-2"></i>
                    Usuarios
                </a>
            <?php endif ?>
            <?php if(Auth::hasPermission('roles.consultar')): ?>
                <a href="/roles" class="nav-item nav-link">
                    <i class="fas fa-id-badge me-2"></i>
                    Roles
                </a>
            <?php endif ?>
        </div>
    </nav>
</div>