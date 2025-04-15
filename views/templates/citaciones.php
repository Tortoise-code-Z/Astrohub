<?php

include_once './utils/Utils.php';

//Crear variables de error y valores enviados en los inputs
$fields = ['appointment_reason', 'appointment_date', 'h-appointment_reason', 'h-appointment_date'];
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
    <link rel="stylesheet" href="./assets/css/pages/citaciones.css">
    <title>Astrohub-citaciones</title>
</head>

<body>
    <header>
        <!-- Incuir la barra de navegación -->
        <?php include_once './includes/navBar.php'; ?>
    </header>

    <main>
        <h1 class="txt-primary-color">Citaciones</h1>
        <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
        <?php if ($errors['h-appointment_date'] || $errors['h-appointment_reason']): ?>

            <div class="err-change-cita txt-primary-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
                <p>Ha habido un error con la cita. Inténtelo de nuevo. Si el error persiste, póngase en contacto con nuestro equipo técnico.</p>
            </div>

        <?php endif ?>

        <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
        <?php if (isset($_SESSION['success-edit'])): ?>

            <div class="success-data txt-primary-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
                <p>La cita se ha cambiado correctamente.</p>
            </div>

        <?php endif ?>

        <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
        <?php if (isset($_SESSION['success-delete'])): ?>

            <div class="success-data txt-primary-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
                <p>La cita se ha borrado correctamente.</p>
            </div>

        <?php endif ?>

        <!-- Si ha habido algun error con el cambio de contraseña, avisarlo al usuario -->
        <?php if (isset($_SESSION['success-create'])): ?>

            <div class="success-data txt-primary-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m-1-4h2V7h-2zm1 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
                <p>La cita se ha creado correctamente.</p>
            </div>

        <?php endif ?>

        <section class="create-appointment">
            <div class="container">
                <h2 class="txt-primary-color">Pedir nueva cita</h2>
                <form action="./index.php?controller=createAppointment" method="POST" class="create-form">

                    <!-- item -->
                    <div class="form-item">
                        <label for="reason">Motivo *</label>
                        <div class="input-err">
                            <textarea rows="4" name="appointment_reason" id="reason" placeholder="Tu motivo..." class="<?php echo $classes['appointment_reason'] ?>"><?php echo $oldValues['appointment_reason'] ?></textarea>
                            <span class="err" id="appointment_reason-error"><?php echo $errors['appointment_reason'] ?></span>
                        </div>
                    </div>

                    <!-- item -->
                    <div class="form-item">
                        <label for="date">Fecha *</label>
                        <div class="input-err">
                            <input type="text" name="appointment_date" id="date" placeholder="YYYY-MM-DD" value="<?php echo $oldValues['appointment_date'] ?>" class="<?php echo $classes['appointment_date'] ?>">
                            <span class="err" id="date-error"><?php echo $errors['appointment_date'] ?></span>
                        </div>
                    </div>
                    <div class="btn-form">
                        <button type="submit" class="btn-primary submit">Enviar</button>
                        <button type="button" class="btn-secondary reset">Reiniciar</button>
                    </div>
                </form>
            </div>

        </section>

        <section class="s-citas">
            <div class="container">
                <h2 class="txt-primary-color">Historial de citas </h2>
                <!-- Tabla de citas del usuario -->
                <div class="c-table">
                    <div class="table-row">
                        <div class="txt-primary-color table-column table-head">Motivo</div>
                        <div class="txt-primary-color table-column table-head">Fecha</div>
                        <div class="txt-primary-color table-column table-head">Acciones</div>
                    </div>

                    <!-- Mostrar las citas del usuario en una tabla -->
                    <?php foreach ($citas as $key => $value): ?>

                        <!-- Se revisa si la fecha es anterior al día actual. Si no lo, es se pone la clas 'editable' para recoger estos formularios en el javascript y validarlos -->
                        <form action="./index.php?controller=editAppointment&id=<?php echo $value['idCita']; ?>" method="post" class="table-row edit-form <?php if (strtotime($value['fecha_cita']) > strtotime(date("Y-m-d"))) {
                                                                                                                                                                echo "editable";
                                                                                                                                                            } ?>">

                            <!-- 
                                En cada input se establece en su 'value' su correspondiente dato. 
                                Se le establece en las clases y en los spans de error las variables correspondientes para mostrar posibles errores
                            -->

                            <!-- item -->
                            <div class="txt-primary-color table-column">
                                <div class="input-err">
                                    <input type="text" name="h-reason" id="h-reason-<?php echo $value['idCita']; ?>" placeholder="Escriba un motivo..." value="<?php echo $value['motivo_cita'] ?>" class="no-editable h-reason">
                                    <span class="err h-reason-error" id="h-reason-<?php echo $value['idCita']; ?>-error"></span>
                                </div>
                            </div>

                            <!-- item -->
                            <div class="txt-primary-color table-column">
                                <div class="input-err">
                                    <input type="text" name="h-date" id="h-date-<?php echo $value['idCita']; ?>" placeholder="Escriba un motivo..." value="<?php echo $value['fecha_cita'] ?>" class="no-editable h-date">
                                    <span class="err h-date-error" id="h-date-<?php echo $value['idCita']; ?>-error"></span>
                                </div>
                            </div>

                            <!-- item -->
                            <div class="table-column">
                                <div class="c-buttons-actions">
                                    <!-- Si la fecha de la cita es anterior a la actual, no se permite editar ni borrar la cita -->
                                    <?php if (strtotime($value['fecha_cita']) > strtotime(date("Y-m-d"))): ?>

                                        <button type="button" class="btn-primary edit">Editar</button>
                                        <button type="submit" class="btn-primary submit ">Enviar</button>
                                        <button type="button" class="btn-trash cancel">
                                            Cancelar
                                        </button>

                                        <!-- Borrar cita -->
                                        <a href="./index.php?controller=deleteCita&id=<?php echo $value['idCita']; ?>" class="btn btn-trash delete">
                                            Borrar
                                        </a>
                                    <?php else: ?>
                                        <p class="txt-terciary-color">N/A</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </form>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>


    <footer>
        <!-- Incluir los terminos y condiciones -->
        <?php include_once './includes/footerTerms.php'; ?>
    </footer>

    <!-- Eliminar las variables de sesión de errores y valores de inputs enviados -->
    <?php
    unset($_SESSION['errors']);
    unset($_SESSION['old_values']);
    unset($_SESSION['success-edit']);
    unset($_SESSION['success-delete']);
    unset($_SESSION['success-create']);
    ?>

    <script type="module" src="./assets/js/components/navBar.js"></script>
    <script type="module" src="./assets/js/pages/citaciones.js"></script>

</body>

</html>