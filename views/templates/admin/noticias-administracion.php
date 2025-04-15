<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/components/navBar.css">
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" href="./assets/css/pages/admin/noticias-admin.css">
    <title>Astrohub-admin-noticias</title>
</head>

<body>
    <header>
        <!-- Incluir la barra de navegación -->
        <?php include_once './includes/navBar.php' ?>
    </header>
    <main>
        <h1 class="txt-primary-color">Administración de Noticias</h1>
        <section class="a-section">

            <div class="container">
                <h2 class="txt-primary-color">Búsqueda de usuario</h2>
                <div class="inp-filter-container">
                    <input type="text" id="search" placeholder="Buscar usuario...">
                    <a href="./index.php?controller=adminCreateNew" class="btn btn-primary create">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                        </svg>
                        Crear noticia
                    </a>
                </div>

                <div class="users-container">

                    <!-- Mostrar todos los usuarios -->
                    <?php foreach ($users as $value): ?>

                        <!-- item -->
                        <a class="user-item" id="<?php echo $value['idUser'] ?>" href="#news-results">
                            <svg class="user-svg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                    <path fill="currentColor" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2M8.5 9.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0m9.758 7.484A7.99 7.99 0 0 1 12 20a7.99 7.99 0 0 1-6.258-3.016C7.363 15.821 9.575 15 12 15s4.637.821 6.258 1.984" />
                                </g>
                            </svg>

                            <!-- Nombre de cada usuario -->
                            <p class="name-user"><?php echo $value['usuario'] ?></p>
                        </a>

                    <?php endforeach; ?>
                </div>

            </div>
        </section>

        <section class="a-newsResult" id="news-results">
            <div class="container">
                <h2 class="txt-primary-color">Noticias usuario</h2>
                <div class="user-selected">
                    <h3 class="us-name">Ningún usuario seleccionado...</h3>
                </div>
                <div class="news-user-container">

                </div>
        </section>
    </main>

    <footer>
        <!-- Incluir los términos y condiciones -->
        <?php include_once './includes/footerTerms.php'; ?>
    </footer>
    <script type="module" src="./assets/js/components/navBar.js"></script>
    <script type="module" src="./assets/js/pages/admin/noticias-admin.js"></script>
</body>

</html>