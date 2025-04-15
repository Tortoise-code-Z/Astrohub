<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['username', 'new_title', 'date', 'image', 'new_desc'];
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
    <title>Astrohub-admin-crear-noticia</title>
</head>

<body>

    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>
    <main>
        <section class="s-create-admin">
            <div class="container">
                <h1>Administración: Crear Noticia</h1>
                <form method="POST" action="./index.php?controller=adminTryCreateNew">

                    <!-- input -->

                    <!-- 
                        En cada usuario se establece su 'value' como su valor enviado anteriormente en caso de que haya habido algún error. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <div class="form-item">
                        <label for="username">Usuario</label>
                        <div class="input-err">
                            <input type="text" name="username" id="username" placeholder="Escriba un titulo..." value="<?php echo $oldValues['username']
                                                                                                                        ?>" class="<?php echo $classes['username']                                                                                          ?>">
                            <div class="usersDropdown">

                                <!-- Crear los seleccionables de los usuarios -->

                                <?php foreach ($users as $key => $value): ?>
                                    <div class="user-item">
                                        <!-- Nombre de cada usuario -->
                                        <p class="name-user"><?php echo $value['usuario'] ?></p>
                                    </div>
                                <?php endforeach ?>

                            </div>

                            <span class="err" id="username-error"><?php echo $errors['username']
                                                                    ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="title">Título</label>
                        <div class="input-err">
                            <input type="text" name="title" id="title" placeholder="Escriba un titulo..." value="<?php echo $oldValues['new_title']
                                                                                                                    ?>" class="<?php echo $classes['new_title']
                                                                                                                                ?>">
                            <span class="err" id="title-error"><?php echo $errors['new_title']
                                                                ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="date">Fecha</label>
                        <div class="input-err">
                            <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" value="<?php echo $oldValues['date']
                                                                                                        ?>" class="<?php echo $classes['date']
                                                                                                                    ?>">
                            <span class="err" id="date-error"><?php echo $errors['date']
                                                                ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="image">Imagen</label>
                        <div class="input-err">
                            <input type="text" name="image" id="image" placeholder="imagen.url" value="<?php echo $oldValues['image']
                                                                                                        ?>" class="<?php echo $classes['image']
                                                                                                                    ?>">
                            <span class="err" id="image-error"><?php echo $errors['image']
                                                                ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="description">Descripción</label>
                        <div class="input-err">
                            <textarea rows="10" name="description" id="description" placeholder="Escriba una descripción..." class="<?php echo $classes['new_desc']
                                                                                                                                    ?>"><?php echo $oldValues['new_desc']
                                                                                                                                        ?></textarea>

                            <span class="err" id="description-error"><?php echo $errors['new_desc']
                                                                        ?></span>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="submit btn-primary">Crear</button>
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

    <script type="module" src="./assets/js/pages/admin/create-noticias-admin.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>