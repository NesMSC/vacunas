<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Vacunas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/styles/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/styles/style.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/DataTables/datatables.min.css"/>

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

        <?php echo $content ?>

    </div>

    <!-- JavaScript Libraries -->
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/jquery/jquery-3.4.1.min.js"></script>
    <script>
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/chart/chart.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/easing/easing.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/lib/DataTables/datatables.js"></script>

    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                    language: {
                        lengthMenu: 'Mostrando _MENU_ registros por página',
                        zeroRecords: 'No hay registros',
                        info: 'Página _PAGE_ de _PAGES_',
                        infoEmpty: 'Ningún registro disponible',
                        infoFiltered: '(Filtrado de _MAX_ registros en total)',
                        search: "Buscar: "
                    },
            });

            $('#tabla-dosis').DataTable({
                    language: {
                        lengthMenu: 'Mostrando _MENU_ registros por página',
                        zeroRecords: 'El paciente no tiene dosis suministradas',
                        info: 'Página _PAGE_ de _PAGES_',
                        infoEmpty: 'No hay registros',
                        infoFiltered: '(Filtrado de _MAX_ registros en total)',
                        search: "Buscar: "
                    },
            });

            $('#tabla-pendientes').DataTable({
                    language: {
                        lengthMenu: 'Mostrando _MENU_ registros por página',
                        zeroRecords: 'Sin vacunas pendientes',
                        info: 'Página _PAGE_ de _PAGES_',
                        infoEmpty: 'Ningún registro disponible',
                        infoFiltered: '(Filtrado de _MAX_ registros en total)',
                        search: "Buscar: "
                    },
            });
        });
    </script>
    <!-- Template Javascript -->
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/js/main.js"></script>
</body>

</html>