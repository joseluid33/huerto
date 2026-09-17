<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi Huerto - Gestión de Cultivos</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Estilos propios -->
    <link href="<?= base_url('css/estilos.css') ?>" rel="stylesheet">

</head>

<body>

    <!-- Menú superior -->
    <nav class="navbar navbar-expand-lg nav-huerto">
        <div class="container">

            <a class="navbar-brand" href="<?= base_url() ?>">
                <span class="brand-icon">🍃</span>
                <span>Mi Huerto</span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuHuerto"
                aria-controls="menuHuerto"
                aria-expanded="false"
                aria-label="Abrir menú"
            >
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuHuerto">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Panel</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn-crear" href="<?= base_url('huerto/nuevo') ?>">+ Nuevo cultivo</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- Mensajes flash -->
    <div class="container mt-3">

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success alert-soft" role="alert">
                <?= session()->getFlashdata('mensaje') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-soft" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Contenido de cada página -->
    <?= $this->renderSection('content') ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>