<?php

// Errores de saneamiento y validación
const ERR_EMPTY = 'Este campo no puede estar vacío.';
const ERR_USERNAME_SAN = "Solo se permiten letras, números y los símbolos '._'. Use entre 3 y 20 caracteres.";
const ERR_PASSWORD_SAN = 'La contraseña debe tener al menos 6 caracteres.';
const ERR_REPEAT_PASSWORD_SAN = 'La contraseña debe ser la misma.';
const ERR_EMAIL_SAN = "Debe seguir el formato indicado, pe: 'hola@gmail.com'. ";
const ERR_NAME_SAN = "Debe contener entre 2 y 50 caracteres. Solo se permiten letras.";
const ERR_SURNAME_SAN = "Debe contener entre 2 y 50 caracteres. Solo se permiten letras.";
const ERR_DIR_SAN = "Debe contener cómo máximo 100 caracteres.";
const ERR_TEL_SAN = 'Debe contener únicamente números. Use entre 7 y 15 dígitos.';
const ERR_DATE_SAN = 'Use el formato YYYYY-MM-DD. Introduzca una fecha correcta.';
const ERR_SEX_SAN = 'Ha habido un error con la selección del sexo.';
const ERR_ROL_SAN = 'Ha habido un error con la selección del rol.';
const ERR_MOTIVO_CITA_SAN = "Debe contener entre 3 y 170 caracteres.";
const ERR_TITULO_NOTICIA_SAN = "Debe contener entre 3 y 70 caracteres.";
const ERR_DESC_NOTICIA_SAN = "Debe contener entre 3 y 170 caracteres.";
const ERR_IMAGE_SAN = "Introduzca un formato de imagen válido: .jpg, .jpeg, .png.";

// Inicio de sesión
const ERR_USERNAME = 'Este nombre de usuario no existe.';
const ERR_PASSWORD = 'La contraseña es incorrecta.';

// Registro
const ERR_USERNAME_REG = 'Este nombre de usuario ya existe.';
const ERR_EMAIL = 'Este email ya existe.';

const ERR_TERMS = 'Debe aceptar los términos y condiciones.';
