<!-- Sign In Start -->
<form class="container-fluid needs-validation" novalidate action="/login/signin" method="POST">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <h3>Iniciar sesión</h3>
                </div>
                <div class="form-floating mb-3">
                    <input required name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Correo electrónico</label>
                    <div class="invalid-feedback">
                        El correo es requerido
                    </div>
                </div>
                <div class="form-floating mb-4">
                    <input required name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Contraseña</label>
                    <div class="invalid-feedback">
                        Contraseña requerida
                    </div>
                </div>

                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php endif ?>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                    </div>
                    <a href="">Olvidé mi contraseña</a>
                </div>
                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">
                    Ingresar
                </button>
            </div>
        </div>
    </div>
</form>
<!-- Sign In End -->