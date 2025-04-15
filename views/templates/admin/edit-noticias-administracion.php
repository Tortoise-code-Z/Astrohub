<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['new_title', 'date', 'image', 'new_desc'];
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
    <title>Astrohub-Admin-editar-noticias</title>
</head>

<body>

    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>
    <main>
        <section class="s-edit-admin">
            <div class="container">
                <h1>Administración: Editar Noticia</h1>
                <!-- Introducir el nombre del usuario al que pertenece la noticia a editar -->
                <h2><?php echo $user['usuario'] ?></h2>

                <!-- El envío recoge el id de la noticia a actualizar que se recoge por GET-->
                <form method="POST" action="./index.php?controller=adminNewsEditCheck&id=<?php echo $_GET['id'] ?>">

                    <!-- 
                        En cada input se establece en su 'value' su correspondiente dato. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->


                    <!-- input -->

                    <div class="form-item">
                        <label for="title">Título</label>
                        <div class="input-err">
                            <input type="text" name="title" id="title" placeholder="Escriba un titulo..." value="<?php echo $new['titulo']
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
                            <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" value="<?php echo $new['fecha']
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
                            <input type="text" name="image" id="image" placeholder="imagen.url" value="<?php echo $new['imagen']
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
                                                                                                                                    ?>"><?php echo $new['texto']
                                                                                                                                        ?></textarea>

                            <span class="err" id="description-error"><?php echo $errors['new_desc']
                                                                        ?></span>
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

    <script type="module" src="./assets/js/pages/admin/edit-noticias-admin.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>