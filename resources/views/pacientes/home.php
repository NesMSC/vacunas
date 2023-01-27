<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Vacunas</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="http://vacunas.test/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="http://vacunas.test/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="http://vacunas.test/assets/styles/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="http://vacunas.test/assets/styles/style.css" rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="http://vacunas.test/assets/lib/DataTables/datatables.min.css"/>

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->

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

        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://vacunas.test/assets/lib/chart/chart.min.js"></script>
        <script src="http://vacunas.test/assets/lib/easing/easing.min.js"></script>
        <script src="http://vacunas.test/assets/lib/waypoints/waypoints.min.js"></script>
        <script src="http://vacunas.test/assets/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="http://vacunas.test/assets/lib/tempusdominus/js/moment.min.js"></script>
        <script src="http://vacunas.test/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="http://vacunas.test/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="http://vacunas.test/assets/lib/DataTables/datatables.js"></script>

        <script>
            $(document).ready(function () {
                $('#tabla').DataTable({
                    language: {
                        lengthMenu: 'Mostrando _MENU_ registros por página',
                        zeroRecords: 'No hay registros',
                        info: 'Página _PAGE_ de _PAGES_',
                        infoEmpty: 'Ningún registro disponible',
                        infoFiltered: '(Filtrado de _MAX_ registros en total)',
                    },
            });
            });
        </script>
        <!-- Template Javascript -->
        <script src="http://vacunas.test/assets/js/main.js"></script>
    </body>

</html>