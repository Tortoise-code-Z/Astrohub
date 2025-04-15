<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/components/navBar.css">
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" href="./assets/css/pages/noticias.css">
    <title>Astrohub-Noticias</title>
</head>

<body>

    <header>
        <!-- Incluir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>

        <div class="banner-news">
            <div class="slides-btns-h1">
                <h1>Noticias destacadas</h1>
                <div class="slider-buttons">
                    <button type="button" class="sb-left-button">
                        <svg class="sbtn-left" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                            <path fill="currentColor" fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                        </svg>
                    </button>
                    <button type="button" class="sb-play-button isPlayed">
                        <svg class="sbtn-play" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M8 5.14v14l11-7z" />
                        </svg>
                    </button>

                    <button type="button" class="sb-pause-button">
                        <svg class="sbtn-pause" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M14 19V5h4v14zm-8 0V5h4v14z" />
                        </svg>
                    </button>

                    <button type="button" class="sb-right-button">
                        <svg class="sbtn-right" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                            <path fill="currentColor" fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8L4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="slides-container">

                <!-- Mostrar las noticias destacadas -->
                <?php foreach ($destNews as $noticia): ?>

                    <!-- slide -->
                    <div class="slide-item showing">
                        <img src="./assets/images/noticias/<?php echo $noticia['imagen']; ?>" alt="<?php echo $noticia['titulo']; ?>" title="<?php echo $noticia['titulo']; ?>" class="si-image">
                        <div class="si-info">
                            <h2 class="txt-primary-color si-title"><?php echo $noticia['titulo']; ?></h2>
                            <p class="txt-primary-color si-desc"><?php echo $noticia['texto']; ?></p>
                            <div class="si-link-date-user">
                                <a href="#" class="btn btn-primary new-link">Ver noticia</a>
                                <p class="si-username txt-primary-color">Por: <?php echo $noticia['usuario']; ?></p>
                                <p class="si-date txt-primary-color"><?php echo date('d-m-Y', strtotime($noticia['fecha'])); ?></p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </header>

    <main>
        <section class="s-news off">
            <div class="container">
                <h2>Noticias más recientes</h2>
                <div class="n-search">
                    <form action="#">
                        <div class="form-item">
                            <div class="inp-structure">
                                <div class="svg-inp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" placeholder="Nombre de usuario..." value="" class="">
                            </div>
                        </div>
                        <button type="submit" class="btn-primary">Buscar</button>
                    </form>

                    <div class="filters">
                        <!-- filter -->
                        <button type="button" class="ns-filter btn-secondary">Actualidad</button>
                        <button type="button" class="ns-filter btn-secondary">Recientes</button>
                        <button type="button" class="ns-filter btn-secondary">Universo</button>
                        <button type="button" class="ns-filter btn-secondary">Más buscadas</button>
                        <button type="button" class="ns-filter btn-secondary">Todas</button>
                    </div>
                </div>
                <div class="news-container">

                    <!-- Mostrar todas las noticias -->
                    <?php foreach ($news as $noticia): ?>

                        <!-- item -->
                        <a href="#" class="news-item" title="<?php echo $noticia['titulo']; ?>">
                            <article class="">
                                <div class="ni-info">
                                    <div class="ni-title-desc">
                                        <h3 class="ni-title txt-primary-color"><?php echo $noticia['titulo']; ?></h3>
                                        <p class="ni-desc txt-secondary-color"><?php echo $noticia['texto']; ?></p>
                                    </div>
                                    <div class="ni-date-username">
                                        <div class="ni-username-container">
                                            <div class="ni-username-indicator"></div>
                                            <p class="ni-username txt-primary-color"><?php echo $noticia['usuario']; ?></p>
                                        </div>
                                        <p class="ni-date txt-terciary-color"><?php echo date('d-m-Y', strtotime($noticia['fecha'])); ?></p>
                                    </div>
                                </div>
                                <img src="./assets/images/noticias/<?php echo $noticia['imagen']; ?>" alt="<?php echo $noticia['titulo']; ?>" class="ni-image">
                            </article>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>


    <footer class="off">
        <div class="container">
            <!-- Incluir el footer -->
            <?php include_once './includes/footerBody.php'; ?>
            <?php include_once './includes/footerTerms.php'; ?>
        </div>
    </footer>

    <script type="module" src="./assets/js/pages/noticias.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>