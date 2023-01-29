<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">
                    <?php $user = App\Auth::getUser(); echo "{$user->nombre} {$user->apellido}";?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                <a href="/login/logout" class="dropdown-item">Salir</a>
            </div>
        </div>
    </div>
</nav>