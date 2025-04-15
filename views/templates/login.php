<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['username', 'password',];
$errors = $classes = $oldValues = [];

foreach ($fields as $field) {
    $errors[$field] = '';
    $classes[$field] = '';
    $oldValues[$field] = '';
}

if (isset($_SESSION['errors'])) {
    foreach ($fields as $field) {
        $errors[$field] = Utils::getError($field);
        $classes[$field] = Utils::getErrClass($errors[$field]);
    }

    if (isset($_SESSION['old_values'])) {
        foreach ($fields as $field) {
            $oldValues[$field] = Utils::getErrorValues($field);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/components/navBar.css">
    <link rel="stylesheet" href="./assets/css/pages/login.css">
    <title>Astrohub-login</title>
</head>

<body>
    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>

    <main>
        <section class="s-login">

            <div class="form-container">
                <h1>
                    Inicia sesión
                </h1>

                <form action="./index.php?controller=loginCheck" method="post">

                    <!-- 
                        En cada input del formulario se establece su 'value' como su valor enviado anteriormente en caso de que haya habido algún error. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <!-- item -->
                    <div class="form-item">
                        <label for="username">Nombre de usuario</label>
                        <div class="input-err">
                            <div class="inp-structure">
                                <div class="svg-inp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                    </svg>
                                </div>
                                <input type="text" name="username" id="username" placeholder="Nombre de usuario..." value="<?php echo $oldValues['username']; ?>" class="<?php echo $classes['username'] ?>">
                            </div>
                            <span class="err" id="username-error"><?php echo $errors['username']; ?></span>
                        </div>
                    </div>

                    <!-- item -->
                    <div class="form-item">
                        <label for="password">Contraseña</label>
                        <div class="input-err">

                            <div class="inp-structure">
                                <button type="button" class="seePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                </button>

                                <input type="password" name="password" id="password" class="<?php echo $classes['password'] ?>">
                            </div>
                            <span class="err" id="password-error"><?php echo $errors['password']; ?></span>
                        </div>
                    </div>

                    <button type="submit" class="submit btn-primary">Enviar</button>
                    <a href="./index.php?controller=renderRegistro" class="have-acount txt-terciary-color">¿No te has registrado? Hazlo aquí</a>
                </form>
            </div>
            <div class="banner-login">
                <img src="./assets/images/Login/login.webp" alt="" class="bl-image">
            </div>
        </section>
    </main>

    <!-- Eliminar las variables de sesión de errores y valores de inputs enviados -->
    <?php
    unset($_SESSION['errors']);
    unset($_SESSION['old_values']);
    ?>

    <script type="module" src="./assets/js/pages/login.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>