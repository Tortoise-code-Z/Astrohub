<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/components/navBar.css">
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" href="./assets/css/pages/home.css" />
    <title>Astrohub</title>
</head>

<body>
    <header class="header">
        <!-- Incluir la barra de navegación -->
        <?php include_once './includes/navBar.php' ?>

        <div class="banner">
            <img src="./assets/images/home/banner-home.webp" alt="Imagen banner home">
            <h1 class="txt-primary-color">Explora el universo</h1>
            <p class="desc-banner txt-primary-color">
                Busca, informate y fascínate del universo con las mejores noticias, información y eventos únicos.
            </p>
            <div class="h-search">
                <form action="#" method="post">
                    <div class="form-item">
                        <div class="inp-structure">
                            <div class="svg-inp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" placeholder="Buscar..." value="" class="">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </header>

    <!-- MAIN -->

    <main class="main">

        <!-- Explore section -->

        <section class="section s-explore off">
            <div class="container">
                <div class="title-section">
                    <h2 class="txt-primary-color">Explora objetos celestiales</h2>
                    <a href="#" class="btn txt-primary-color btn-primary">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M12.75 17.5a.75.75 0 0 0 0-1.5H6.5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6.25a.75.75 0 0 0 0-1.5H6.5A3.5 3.5 0 0 0 3 6v8a3.5 3.5 0 0 0 3.5 3.5zm.991-11.301a.75.75 0 0 1 1.06.042l3 3.25a.75.75 0 0 1 0 1.018l-3 3.25A.75.75 0 1 1 13.7 12.74l1.838-1.991H7.75a.75.75 0 0 1 0-1.5h7.787l-1.838-1.991a.75.75 0 0 1 .042-1.06" />
                        </svg>
                    </a>
                </div>
                <div class="explore-container">

                    <!-- Item -->
                    <a href="#" class="explore-item target">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M245.11 60.68c-7.65-13.19-27.84-16.16-58.5-8.66A95.93 95.93 0 0 0 32 128a98 98 0 0 0 .78 12.31C5.09 169 5.49 186 10.9 195.32C16 204.16 26.64 208 40.64 208a124 124 0 0 0 28.79-4A95.93 95.93 0 0 0 224 128a97 97 0 0 0-.77-12.25c12.5-13 20.82-25.35 23.65-35.92c1.95-7.32 1.36-13.76-1.77-19.15M128 48a80.11 80.11 0 0 1 78 62.2c-17.06 16.06-40.15 32.53-62.07 45.13c-27.55 15.81-51.45 25.67-70.51 31.07A79.94 79.94 0 0 1 128 48M24.74 187.29c-1.46-2.51-.65-7.24 2.22-13a79 79 0 0 1 10.29-15.05a96 96 0 0 0 18 31.32c-17.25 2.9-28.01 1.05-30.51-3.27M128 208a79.45 79.45 0 0 1-38.56-9.94a370 370 0 0 0 62.43-28.86c21.58-12.39 40.68-25.82 56.07-39.08A80.07 80.07 0 0 1 128 208M231.42 75.69c-1.7 6.31-6.19 13.53-12.63 21.13a95.7 95.7 0 0 0-18-31.35c14.21-2.35 27.37-2.17 30.5 3.24c.9 1.57.95 3.92.13 6.98" />
                        </svg>
                        <div class="ei-title-desc">
                            <h3 class="ei-title txt-primary-color">Planetas</h3>
                            <p class="ei-desc txt-secondary-color">
                                Descubre los secretos más impresinantes sobre los planetas. ¿Existe vida allá afuera?
                            </p>
                        </div>
                    </a>

                    <!-- Item -->
                    <a href="#" class="explore-item target">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                <path
                                    d="M5.367 10.242C4.29 8.422 3.752 7.512 4.11 6.788c.36-.724 1.379-.783 3.418-.9l.527-.03c.58-.034.869-.05 1.122-.185c.252-.135.439-.372.813-.848l.34-.432c1.316-1.673 1.974-2.509 2.73-2.38s1.11 1.137 1.817 3.154M5.805 13.51c-.553 2.09-.83 3.134-.295 3.71s1.524.303 3.505-.245l.976-.474m7.057-8.99c1.89.786 2.835 1.18 2.942 1.983c.092.686-.477 1.283-1.64 2.29" />
                                <path
                                    d="M16.239 19.57c1.485.386 2.228.58 2.629.173s.193-1.144-.221-2.62l-.108-.38c-.117-.42-.176-.63-.147-.837c.03-.208.145-.39.374-.756l.21-.332c.807-1.285 1.21-1.927.94-2.438c-.269-.511-1.033-.553-2.562-.635l-.396-.022c-.434-.023-.652-.035-.841-.13c-.19-.095-.33-.263-.61-.599l-.255-.305c-.987-1.18-1.48-1.77-2.048-1.68c-.567.091-.832.803-1.362 2.227l-.138.368c-.15.405-.226.607-.373.756c-.146.149-.348.228-.75.386l-.367.143c-1.417.555-2.126.833-2.207 1.4s.52 1.049 1.721 2.011l.31.25c.342.273.513.41.611.597c.1.187.115.404.146.837l.029.394c.11 1.523.166 2.285.683 2.545s1.154-.155 2.427-.983" />
                            </g>
                        </svg>
                        <div class="ei-title-desc">
                            <h3 class="ei-title txt-primary-color">Estrellas</h3>
                            <p class="ei-desc txt-secondary-color">
                                No te pierdas los mejores apuntes sobre estrellas. Aquí encontrarás todo lo que buscas sobre ellas.
                            </p>
                        </div>
                    </a>

                    <!-- Item -->
                    <a href="#" class="explore-item target">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M7.558.198a.75.75 0 1 0-.75 1.3c1.249.72 1.888 1.977 1.917 3.346c-1.714-2.18-4.668-3.269-7.337-1.728a.75.75 0 0 0 .75 1.3c1.251-.723 2.661-.647 3.863.015C3.26 4.83.83 6.84.83 9.918a.75.75 0 1 0 1.5 0c0-1.434.769-2.613 1.939-3.324c-1.016 2.57-.489 5.672 2.172 7.208a.75.75 0 1 0 .75-1.3c-1.242-.716-1.878-1.972-1.909-3.34C7 11.326 9.95 12.42 12.611 10.884a.75.75 0 0 0-.75-1.3c-1.24.717-2.644.641-3.844-.014c2.74-.399 5.151-2.412 5.151-5.488a.75.75 0 0 0-1.5 0c0 1.442-.768 2.624-1.94 3.334c1.032-2.575.497-5.677-2.171-7.218ZM7 8.001A1.001 1.001 0 1 0 7 6a1.001 1.001 0 0 0 0 2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ei-title-desc">
                            <h3 class="ei-title txt-primary-color">Galaxias</h3>
                            <p class="ei-desc txt-secondary-color">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Possimus
                            </p>
                        </div>
                    </a>

                    <!-- Item -->
                    <a href="#" class="explore-item target">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="2" />
                                <path stroke-linecap="round" d="M12 10c5 0 4.6 12-3 12" />
                                <path stroke-linecap="round" d="M12.312 14c-5 0-4.6-12 3-12" />
                                <path stroke-dasharray="2 2" stroke-linecap="round"
                                    d="M10.631 10.696c3.536-3.535 11.738 5.233 6.364 10.607" />
                                <path stroke-dasharray="2 2" stroke-linecap="round"
                                    d="M13.68 13.304C10.145 16.84 1.942 8.07 7.316 2.697" />
                                <path stroke-dasharray="2 2" stroke-linecap="round"
                                    d="M10.852 13.524C7.316 9.99 16.084 1.786 21.458 7.16" />
                                <path stroke-dasharray="2 2" stroke-linecap="round"
                                    d="M13.46 10.476c3.535 3.535-5.233 11.738-10.607 6.364" />
                                <path stroke-linecap="round" d="M10 12.312c0-5 12-4.6 12 3" />
                                <path stroke-linecap="round" d="M14 12c0 5-12 4.6-12-3" />
                            </g>
                        </svg>
                        <div class="ei-title-desc">
                            <h3 class="ei-title txt-primary-color">Agujeros negros</h3>
                            <p class="ei-desc txt-secondary-color">
                                Un apasionante objeto espacial, el cual ha tenido a los científicos en vela durante cientos de años.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- News section -->
        <section class="section s-news off">
            <div class="container">
                <div class="title-section">
                    <h2 class="txt-primary-color">Noticias más recientes</h2>
                    <a href="#" class="btn txt-primary-color btn-primary">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M12.75 17.5a.75.75 0 0 0 0-1.5H6.5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6.25a.75.75 0 0 0 0-1.5H6.5A3.5 3.5 0 0 0 3 6v8a3.5 3.5 0 0 0 3.5 3.5zm.991-11.301a.75.75 0 0 1 1.06.042l3 3.25a.75.75 0 0 1 0 1.018l-3 3.25A.75.75 0 1 1 13.7 12.74l1.838-1.991H7.75a.75.75 0 0 1 0-1.5h7.787l-1.838-1.991a.75.75 0 0 1 .042-1.06" />
                        </svg>
                    </a>
                </div>
                <div class="news-container">

                    <!-- Generar cada noticia introduciendo en cada una de ellas sus datos correspondientes -->
                    <?php foreach ($news as $noticia): ?>

                        <!-- item -->
                        <a href="#" class="news-item" title="<?php echo $noticia['titulo']; ?>">
                            <article>
                                <div class="ni-info">
                                    <div class="ni-title-desc">
                                        <h3 class="ni-title txt-primary-color">
                                            <?php
                                            echo $noticia['titulo'];
                                            ?>
                                        </h3>
                                        <p class="ni-desc txt-secondary-color">
                                            <?php
                                            echo $noticia['texto'];
                                            ?>
                                        </p>
                                    </div>

                                    <div class="ni-date-username">
                                        <div class="ni-username-container">
                                            <div class="ni-username-indicator"></div>
                                            <p class="ni-username txt-primary-color">
                                                <?php
                                                echo $noticia['usuario'];
                                                ?>
                                            </p>
                                        </div>
                                        <p class="ni-date txt-terciary-color">
                                            <?php
                                            echo date('d-m-Y', strtotime($noticia['fecha']));
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <img src="./assets/images/noticias/<?php echo $noticia['imagen']; ?>" alt="<?php echo $noticia['titulo']; ?>" class="ni-image">
                            </article>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Events section -->

        <section class="section s-events off">
            <div class="container">
                <div class="title-section">
                    <h2 class="txt-primary-color">Próximos eventos</h2>
                    <a href="#" class="btn txt-primary-color btn-primary">
                        <svg class="txt-primary-color" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M12.75 17.5a.75.75 0 0 0 0-1.5H6.5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6.25a.75.75 0 0 0 0-1.5H6.5A3.5 3.5 0 0 0 3 6v8a3.5 3.5 0 0 0 3.5 3.5zm.991-11.301a.75.75 0 0 1 1.06.042l3 3.25a.75.75 0 0 1 0 1.018l-3 3.25A.75.75 0 1 1 13.7 12.74l1.838-1.991H7.75a.75.75 0 0 1 0-1.5h7.787l-1.838-1.991a.75.75 0 0 1 .042-1.06" />
                        </svg>
                    </a>
                </div>
                <div class="events-container">
                    <!-- Item -->
                    <a href="#" class="events-item">
                        <figure>
                            <img src="./assets/images/home/Events/events-image-3.webp" alt="Imagen evento" title="Taller de Fotografía Astronómica" />
                            <figcaption>
                                <div class="evi-title-date">
                                    <h3 class="evi-title txt-primary-color">Taller de Fotografía Astronómica</h3>
                                    <p class="evi-date txt-terciary-color">27/08/2024</p>
                                </div>
                                <p class="evi-desc txt-secondary-color">
                                    Aprende las técnicas básicas para capturar la belleza del cielo nocturno.
                                </p>
                            </figcaption>
                        </figure>
                    </a>

                    <!-- Item -->
                    <a href="#" class="events-item">
                        <figure>
                            <img src="./assets/images/home/Events/events-image-1.webp" alt="Imagen evento" title="Noche de Estrellas Fugaces" />
                            <figcaption>
                                <div class="evi-title-date">
                                    <h3 class="evi-title txt-primary-color">Noche de Estrellas Fugaces</h3>
                                    <p class="evi-date txt-terciary-color">27/08/2024</p>
                                </div>
                                <p class="evi-desc txt-secondary-color">
                                    Únete a nosotros para una noche mágica bajo las estrellas.
                                </p>
                            </figcaption>
                        </figure>
                    </a>

                    <!-- Item -->
                    <a href="#" class="events-item">
                        <figure>
                            <img src="./assets/images/home/Events/events-image-2.webp" alt="Imagen evento" title="Viaje Virtual por los Planetas" />
                            <figcaption>
                                <div class="evi-title-date">
                                    <h3 class="evi-title txt-primary-color">Viaje Virtual por los Planetas</h3>
                                    <p class="evi-date txt-terciary-color">27/08/2024</p>
                                </div>
                                <p class="evi-desc txt-secondary-color">
                                    Explora los planetas de nuestro sistema solar desde la comodidad de tu hogar.
                                </p>
                            </figcaption>
                        </figure>
                    </a>

                    <!-- Item -->
                    <a href="#" class="events-item">
                        <figure>
                            <img src="./assets/images/home/Events/events-image-4.webp" alt="Imagen evento" title="Expedición NASA" />
                            <figcaption>
                                <div class="evi-title-date">
                                    <h3 class="evi-title txt-primary-color">Expedición NASA</h3>
                                    <p class="evi-date txt-terciary-color">27/08/2024</p>
                                </div>
                                <p class="evi-desc txt-secondary-color">
                                    ¿Te gustaría conocer mas a fondo como trabaja la NASA?
                                </p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
        </section>

        <!-- Valoraciones -->
        <section class="section s-ratings off">

            <div class="ratings-container">

                <!-- item -->
                <div class="rating-item showing">
                    <p class="ri-desc">"Información detallada y precisa, imprescindible para los amantes de la astronomía."</p>
                    <p class="ri-name txt-terciary-color">Esteban Morales, astrónomo amateur</p>
                </div>

                <!-- item -->
                <div class="rating-item">
                    <p class="ri-desc">"Visualmente atractiva y educativa, ideal para aprender sobre el cosmos."</p>
                    <p class="ri-name txt-terciary-color">Ana Rodríguez, estudiante de física</p>
                </div>

                <!-- item -->
                <div class="rating-item">
                    <p class="ri-desc">"Excelente recurso educativo para profesores de ciencias."</p>
                    <p class="ri-name txt-terciary-color">Javier Pérez, profesor de ciencias</p>
                </div>

                <!-- item -->
                <div class="rating-item">
                    <p class="ri-desc">"Noticias y descubrimientos siempre actualizados, muy confiable."</p>
                    <p class="ri-name txt-terciary-color">Laura Gutiérrez, periodista científica</p>
                </div>

                <!-- item -->
                <div class="rating-item">
                    <p class="ri-desc">"Ideal para despertar la curiosidad de los niños sobre el espacio."</p>
                    <p class="ri-name txt-terciary-color">Carlos Fernández, padre de familia</p>
                </div>
            </div>

        </section>
    </main>

    <!-- FOOTER -->

    <footer class="footer off">
        <div class="container">
            <!-- Incluir el footer -->
            <?php include_once './includes/footerBody.php' ?>
            <?php include_once './includes/footerTerms.php' ?>
        </div>
    </footer>

    <script type="module" src="./assets/js/components/navBar.js"></script>
    <script type="module" src="./assets/js/pages/home.js"></script>
</body>

</html>