/* IMPORTACIONES */

import { TextValidation } from "../../modules/Validation/TextValidation.js";
import { DateValidation } from "../../modules/Validation/DateValidation.js";
import { FormSubmit } from "../../modules/Validation/FormSubmit.js";

import {
    NAME_EXPR_REG,
    SURNAME_EXPR_REG,
    EMAIL_EXPR_REG,
    TEL_EXPR_REG,
    DATEBIRTH_EXPR_REG,
    DIR_EXPR_REG,
} from "../../modules/RegExpresion/regExpresions.js";

import {
    TEL_REG_EXPR_ERR,
    EMAIL_REG_EXPR_ERR,
    NAME_REG_EXPR_ERR,
    SURNAME_REG_EXPR_ERR,
    DATEBIRTH_REG_EXPR_ERR,
    DIR_REG_EXPR_ERR,
} from "../../modules/Constantes/constantes.js";

/* VARIABLES */

const nameInput = document.querySelector("#name");
const nameSpanErr = document.querySelector("#name-error");

const surnameInput = document.querySelector("#surname");
const surnameSpanErr = document.querySelector("#surname-error");

const emailInput = document.querySelector("#email");
const emailSpanErr = document.querySelector("#email-error");

const telInput = document.querySelector("#tel");
const telSpanErr = document.querySelector("#tel-error");

const dateBirthInput = document.querySelector("#dateBirth");
const dateBirthSpanErr = document.querySelector("#dateBirth-error");

const dirInput = document.querySelector("#dir");
const dirSpanErr = document.querySelector("#dir-error");

const sexInput = document.querySelector("#sex");
const sexSpanErr = document.querySelector("#sex-error");

const rolInput = document.querySelector("#rol");
const rolSpanErr = document.querySelector("#rol-error");

const form = document.querySelector("form");
const btnForm = document.querySelector(".submit");
const btnReset = document.querySelector(".reset");

/* INSTANCIAS */

const tel = new TextValidation(
    telInput,
    telSpanErr,
    TEL_EXPR_REG,
    TEL_REG_EXPR_ERR,
    false
);

const email = new TextValidation(
    emailInput,
    emailSpanErr,
    EMAIL_EXPR_REG,
    EMAIL_REG_EXPR_ERR,
    false
);

const name = new TextValidation(
    nameInput,
    nameSpanErr,
    NAME_EXPR_REG,
    NAME_REG_EXPR_ERR,
    false
);

const surname = new TextValidation(
    surnameInput,
    surnameSpanErr,
    SURNAME_EXPR_REG,
    SURNAME_REG_EXPR_ERR,
    false
);

const dir = new TextValidation(
    dirInput,
    dirSpanErr,
    DIR_EXPR_REG,
    DIR_REG_EXPR_ERR,
    true
);

const dateBirth = new DateValidation(
    dateBirthInput,
    dateBirthSpanErr,
    DATEBIRTH_EXPR_REG,
    DATEBIRTH_REG_EXPR_ERR,
    false
);

const rol = new TextValidation(rolInput, rolSpanErr, null, null, false);

const sex = new TextValidation(sexInput, sexSpanErr, null, null, false);

const inputs = [tel, email, name, surname, dateBirth, rol, sex, dir];

const formSubmit = new FormSubmit(btnForm, btnReset, form, inputs, true);
