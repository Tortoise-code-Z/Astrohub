<?php
include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['appointment_reason', 'appointment_date'];
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
    <title>Astrohub-Admin-editar-citas</title>
</head>

<body>

    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>
    <main>
        <section class="s-edit-admin">
            <div class="container">
                <h1>Administración: Editar cita</h1>
                <!-- Introducir el nombre del usuario al que pertenece la cita a editar -->
                <h2><?php echo $user['usuario'] ?></h2>

                <!-- El envío recoge el id de la cita a actualizar que se recoge por GET-->
                <form method="POST" action="./index.php?controller=adminCitasEditCheck&id=<?php echo $_GET['id'] ?>">

                    <!-- 
                        En cada input se establece en su 'value' su correspondiente dato. 
                        Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                    -->

                    <!-- input -->

                    <div class="form-item">
                        <label for="reason">Motivo</label>
                        <div class="input-err">
                            <input type="text" name="reason" id="reason" placeholder="Escriba un motivo..." value="<?php echo $cita['motivo_cita']
                                                                                                                    ?>" class="<?php echo $classes['appointment_reason']
                                                                                                                                ?>">
                            <span class="err" id="reason-error"><?php echo $errors['appointment_reason']
                                                                ?></span>
                        </div>
                    </div>

                    <!-- input -->

                    <div class="form-item">
                        <label for="date">Fecha</label>
                        <div class="input-err">
                            <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" value="<?php echo $cita['fecha_cita']
                                                                                                        ?>" class="<?php echo $classes['appointment_date']
                                                                                                                    ?>">
                            <span class="err" id="date-error"><?php echo $errors['appointment_date']
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

    <script type="module" src="./assets/js/pages/admin/edit-citaciones-admin.js"></script>
    <script type="module" src="./assets/js/components/navBar.js"></script>
</body>

</html>