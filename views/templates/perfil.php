<?php

include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['username', 'email', 'dir', 'name', 'sex', 'surname', 'tel', 'date', 'password', 'repeatPassword'];
$errors = $classes = [];

foreach ($fields as $field) {
    $errors[$field] = '';
    $classes[$field] = '';
}

if (isset($_SESSION['errors'])) {
    foreach ($fields as $field) {
        $errors[$field] = Utils::getError($field);
        $classes[$field] = Utils::getErrClass($errors[$field]);
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
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" href="./assets/css/pages/perfil.css">
    <title>Astrohub-perfil</title>
</head>

<body>
    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>

    <main>

        <!-- modal contraseña -->
        <div class="modal m-password modal-hide">
            <div class="modal-container">
                <h2 class="txt-primary-color">Cambiar contraseña</h2>
                <form action="./index.php?controller=changePassword" method="post" class="change-password">
                    <!-- input -->

                    <div class="form-item">
                        <label for="password">Nueva contraseña *</label>
                        <div class="input-err">
                            <div class="inp-structure">
                                <button type="button" class="seePassword" id="seePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                </button>
                                <input type="password" name="password" id="password" class="<?php echo $classes['password'] ?>">
                            </div>
                            <span class="err" id="password-error"><?php echo $errors['password'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="repeatPassword">Repetir contraseña *</label>
                        <div class="input-err">
                            <div class="inp-structure">
                                <button type="button" class="seePassword" id="seeRepeatPassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                </button>

                                <input type="password" name="repeatPassword" id="repeatPassword" class="<?php echo $classes['repeatPassword'] ?>">
                            </div>
                            <span class="err" id="repeatPassword-error"><?php echo $errors['repeatPassword'] ?></span>
                        </div>
                    </div>

                    <div class="mp-buttons">
                        <button type="submit" class="btn-primary btn-send-password">Cambiar</button>
                        <button type="button" class="btn-secondary btn-close-m-password">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>

        <h1 class="txt-primary-color">Perfil</h1>
        <section class="s-userlogin">
            <div class="container">
                <h2 class="txt-primary-color">Datos de usuario</h2>

                <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
                <?php if (isset($_SESSION['error-data'])): ?>

                    <div class="err-data txt-primary-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                        </svg>
                        <p>Ha habido un problema al intentar cambiar tus datos de perfil.</p>
                    </div>

                <?php endif ?>

                <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
                <?php if (isset($_SESSION['success-data'])): ?>

                    <div class="success-data txt-primary-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                        </svg>
                        <p>Tus datos han sido guardados correctamente.</p>
                    </div>

                <?php endif ?>

                <div class="login-data">
                    <div class="ld-item">
                        <div class="ldi-data">
                            <h3 class="txt-primary-color">
                                Nombre de usuario
                            </h3>
                            <p class="txt-secondary-color ldid-username"><?php echo $_SESSION['user']['usuario']  ?></p>
                        </div>
                    </div>

                    <div class="ld-item">
                        <div class="ldi-data">
                            <h3 class="txt-primary-color">
                                Cambiar contraseña
                            </h3>
                        </div>
                        <button type="button" class="btn-primary btn-open-m-password">Cambiar</button>
                    </div>

                    <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
                    <?php if (isset($_SESSION['error-password'])): ?>

                        <div class="err-data txt-primary-color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                            </svg>
                            <p>Ha habido un error al cambiar la contraseña</p>
                        </div>

                    <?php endif ?>

                    <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
                    <?php if (isset($_SESSION['success-password'])): ?>

                        <div class="success-data txt-primary-color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                            </svg>
                            <p>La contraseña se ha cambiado correctamente.</p>
                        </div>

                    <?php endif ?>
                </div>
            </div>
        </section>

        <section class="s-userdata">
            <div class="container">
                <h2 class="txt-primary-color">Otros datos</h2>
                <form id="form-userdata" action="./index.php?controller=changeUserdata" method="post">

                    <!-- 
                        En cada input se establece en su 'value' su correspondiente dato. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <!-- item -->
                    <div class="form-item">
                        <label for="name">Nombre</label>
                        <div class="input-err">
                            <input type="text" name="name" value="<?php echo $nombre ?>" id="name" placeholder="Nombre..." class="<?php echo $classes['name'] ?>">
                            <span class="err" id="name-error"><?php echo $errors['name'] ?></span>
                        </div>
                    </div>

                    <!-- item -->
                    <div class="form-item">
                        <label for="surname">Apellidos</label>
                        <div class="input-err">
                            <input type="text" name="surname" value="<?php echo $apellidos ?>" id="surname" placeholder="Apellido..." class="<?php echo $classes['surname'] ?>">
                            <span class="err" id="surname-error"><?php echo $errors['surname'] ?></span>
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="email">Email</label>
                        <div class="input-err">
                            <input type="text" name="email" value="<?php echo $email ?>" id="email" placeholder="astrohub@gmail.com..." class="<?php echo $classes['email'] ?>">
                            <span class="err" id="email-error"><?php echo $errors['email'] ?></span>
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="dir">Dirección</label>
                        <div class="input-err">
                            <input type="text" name="dir" value="<?php echo $direccion ?>" id="dir" placeholder="Su dirección..." class="<?php echo $classes['dir'] ?>">
                            <span class="err" id="dir-error"><?php echo $errors['dir'] ?></span>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="sex">Sexo</label>
                        <div class="input-err">
                            <select name="sex" id="sex" class="<?php echo $classes['sex'] ?>">
                                <option value="Masculino" <?php echo $sexo === 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                <option value="Femenino" <?php echo $sexo === 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                                <option value="Sin definir" <?php echo ($sexo !== 'Masculino' && $sexo !== 'Femenino') ? 'selected' : ''; ?>>Prefiero no decirlo</option>
                            </select>
                            <span class="err" id="sex-error"><?php echo $errors['sex'] ?></span>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="tel">Teléfono</label>
                        <div class="input-err">
                            <input type="text" name="tel" value="<?php echo $telefono ?>" id="tel" placeholder="666554433" class="<?php echo $classes['tel'] ?>">
                            <span class="err" id="tel-error"><?php echo $errors['tel'] ?></span>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="dateBirth">Fecha de nacimiento</label>
                        <div class="input-err">
                            <input type="text" name="dateBirth" value="<?php echo $fecha_nacimiento ?>" id="dateBirth" placeholder="YYYY-MM-DD" class="<?php echo $classes['date'] ?>">
                            <span class="err" id="dateBirth-error"><?php echo $errors['date'] ?></span>
                        </div>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn-primary" id="data-submit">Guardar cambios</button>
                        <button type="button" class="btn-secondary " id="data-reset">Reiniciar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <!-- Incluir los términos del footer -->
        <?php include_once './includes/footerTerms.php'; ?>
    </footer>

    <?php
    // Borrar variables de sesion
    unset($_SESSION['errors']);
    unset($_SESSION['old_values']);
    unset($_SESSION['success-data']);
    unset($_SESSION['error-data']);
    unset($_SESSION['success-password']);
    unset($_SESSION['error-password']);
    ?>

    <script type="module" src="./assets/js/components/navBar.js"></script>
    <script type="module" src="./assets/js/pages/perfil.js"></script>

</body>

</html>