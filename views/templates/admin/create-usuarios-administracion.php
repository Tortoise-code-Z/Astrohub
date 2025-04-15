<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['email', 'name', 'surname', 'tel', 'date', 'sex', 'rol', 'dir', 'username', 'password'];
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
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" href="./assets/css/pages/admin/create-admin.css">
    <title>Astrohub-admin-crear-usuario</title>
</head>

<body>

    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>
    <main>
        <section class="s-create-admin">
            <div class="container">
                <h1>Administración: Crear Usuario</h1>
                <form method="POST" action="./index.php?controller=adminTryCreateUser">

                    <!-- 
                        En cada usuario se establece su 'value' como su valor enviado anteriormente en caso de que haya habido algún error. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <!-- input -->

                    <div class="form-item">
                        <label for="username">Nombre de usuario *</label>
                        <div class="input-err">
                            <div class="inp-structure">
                                <div class="svg-inp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                    </svg>
                                </div>
                                <input type="text" name="username" id="username" placeholder="Nombre de usuario..." value="<?php echo $oldValues['username'] ?>" class="<?php echo $classes['username'] ?>">
                            </div>
                            <span class="err" id="username-error"><?php echo $errors['username'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="password">Contraseña *</label>
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
                        <label for="email">Correo electrónico *</label>
                        <div class="input-err">
                            <input type="text" name="email" id="email" placeholder="astrohub@protonmail.com" value="<?php echo $oldValues['email'] ?>" class="<?php echo $classes['email'] ?>">
                            <span class="err" id="email-error"><?php echo $errors['email'] ?></span>
                        </div>
                    </div>

                    <!-- input -->
                    <div class="form-item">
                        <label for="name">Nombre *</label>
                        <div class="input-err">
                            <input type="text" name="name" id="name" placeholder="Tu nombre..." value="<?php echo $oldValues['name'] ?>" class="<?php echo $classes['name'] ?>">
                            <span class="err" id="name-error"><?php echo $errors['name'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="surname">Apellidos *</label>
                        <div class="input-err">
                            <input type="text" name="surname" id="surname" placeholder="Tu Apellido..." value="<?php echo $oldValues['surname'] ?>" class="<?php echo $classes['surname'] ?>">
                            <span class="err" id="surname-error"><?php echo $errors['surname'] ?></span>
                        </div>
                    </div>



                    <!-- input -->

                    <div class="form-item">
                        <label for="tel">Teléfono *</label>
                        <div class="input-err">
                            <input type="text" name="tel" id="tel" placeholder="666554422" value="<?php echo $oldValues['tel'] ?>" class="<?php echo $classes['tel'] ?>">
                            <span class="err" id="tel-error"><?php echo $errors['tel'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="dateBirth">Fecha de nacimiento *</label>
                        <div class="input-err">
                            <input type="tetx" name="dateBirth" id="dateBirth" placeholder="YYYY-MM-DD" value="<?php echo $oldValues['date'] ?>" class="<?php echo $classes['date'] ?>">
                            <span class="err" id="dateBirth-error"><?php echo $errors['date'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="dir">Dirección</label>
                        <div class="input-err">
                            <input type="text" name="dir" id="dir" value="<?php echo $oldValues['dir'] ?>" placeholder="Localidad, calle..." class="<?php echo $classes['dir'] ?>">
                            <span class="err" id="dir-error"><?php echo $errors['dir'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="sex">Sexo</label>
                        <div class="input-err">
                            <select name="sex" id="sex" class="<?php echo $classes['sex'] ?>">
                                <option value="Masculino" <?php echo $oldValues['sex'] === 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                <option value="Femenino" <?php echo $oldValues['sex'] === 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                                <option value="Sin definir" <?php echo $oldValues['sex'] === 'Sin definir' ? 'selected' : ''; ?>>Prefiero no decirlo</option>
                            </select>
                            <span class="err" id="sex-error"><?php echo $errors['sex'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="rol">Rol</label>
                        <div class="input-err">
                            <select name="rol" id="rol" class="<?php echo $classes['rol'] ?>">
                                <option value="user" <?php echo $oldValues['rol'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                                <option value="admin" <?php echo $oldValues['rol'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                            <span class="err" id="rol-error"><?php echo $errors['rol'] ?></span>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="submit btn-primary">
                            Crear
                        </button>
                        <button type="button" class="reset btn-secondary">Reiniciar</button>
                    </div>


                </form>
            </div>


        </section>
    </main>

    <footer>
        <!-- Incluir los terminos y condiciones -->
        <?php include_once './includes/footerTerms.php' ?>
    </footer>

    <!-- Eliminar las variables de sesión de errores y valores de inputs enviados -->
    <?php
    unset($_SESSION['errors']);
    unset($_SESSION['old_values']);
    ?>

    <script type="module" src="./assets/js/pages/admin/create-usuarios-admin.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>