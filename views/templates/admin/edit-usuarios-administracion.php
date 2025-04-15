<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['email', 'name', 'surname', 'tel', 'date', 'sex', 'rol', 'dir'];
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
    <link rel="stylesheet" href="./assets/css/pages/admin/edit-admin.css">
    <title>Astrohub-Admin-editar-usuario</title>
</head>

<body>

    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>
    <main>
        <section class="s-edit-admin">
            <div class="container">
                <h1>Administración: Editar Usuario</h1>
                <!-- Introducir el nombre del usuario a editar -->
                <h2><?php echo $userLogin['usuario']; ?></h2>

                <!-- El envío recoge el id del usuario a actualizar que se recoge por GET-->
                <form method="POST" action="./index.php?controller=adminUserEditCheck&id=<?php echo $_GET['id'] ?>">

                    <!-- 
                        En cada input se establece en su 'value' su correspondiente dato. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <!-- input -->

                    <div class="form-item">
                        <label for="email">Correo electrónico</label>
                        <div class="input-err">
                            <input type="text" name="email" id="email" placeholder="astrohub@protonmail.com" value="<?php echo $userData['email'] ?>" class="<?php echo $classes['email'] ?>">
                            <span class="err" id="email-error"><?php echo $errors['email'] ?></span>
                        </div>
                    </div>

                    <!-- input -->
                    <div class="form-item">
                        <label for="name">Nombre</label>
                        <div class="input-err">
                            <input type="text" name="name" id="name" placeholder="Tu nombre..." value="<?php echo $userData['nombre'] ?>" class="<?php echo $classes['name'] ?>">
                            <span class="err" id="name-error"><?php echo $errors['name'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="surname">Apellidos</label>
                        <div class="input-err">
                            <input type="text" name="surname" id="surname" placeholder="Tu Apellido..." value="<?php echo $userData['apellidos'] ?>" class="<?php echo $classes['surname'] ?>">
                            <span class="err" id="surname-error"><?php echo $errors['surname'] ?></span>
                        </div>
                    </div>



                    <!-- input -->

                    <div class="form-item">
                        <label for="tel">Teléfono</label>
                        <div class="input-err">
                            <input type="text" name="tel" id="tel" placeholder="666554422" value="<?php echo $userData['telefono'] ?>" class="<?php echo $classes['tel'] ?>">
                            <span class="err" id="tel-error"><?php echo $errors['tel'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="dateBirth">Fecha de nacimiento</label>
                        <div class="input-err">
                            <input type="tetx" name="dateBirth" id="dateBirth" placeholder="YYYY-MM-DD" value="<?php echo $userData['fecha_nacimiento'] ?>" class="<?php echo $classes['date'] ?>">
                            <span class="err" id="dateBirth-error"><?php echo $errors['date'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="dir">Dirección</label>
                        <div class="input-err">
                            <input type="text" name="dir" id="dir" value="<?php echo $userData['direccion'] ?>" placeholder="Localidad, calle..." class="<?php echo $errors['dir'] ?>">
                            <span class="err" id="dir-error"><?php echo $errors['dir'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="sex">Sexo</label>
                        <div class="input-err">
                            <select name="sex" id="sex" class="<?php echo $classes['sex'] ?>">
                                <option value="Masculino" <?php echo $userData['sexo'] === 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                <option value="Femenino" <?php echo $userData['sexo'] === 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                                <option value="Sin definir" <?php echo $userData['sexo'] === 'Sin definir' ? 'selected' : ''; ?>>Prefiero no decirlo</option>
                            </select>
                            <span class="err" id="sex-error"><?php echo $errors['sex'] ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="rol">Rol</label>
                        <div class="input-err">
                            <select name="rol" id="rol" class="<?php echo $classes['rol'] ?>">
                                <option value="user" <?php echo $userLogin['rol'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                                <option value="admin" <?php echo $userLogin['rol'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                            <span class="err" id="rol-error"><?php echo $errors['rol'] ?></span>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="submit btn-primary">Guardar cambios</button>
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

    <script type="module" src="./assets/js/pages/admin/edit-usuarios-admin.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>