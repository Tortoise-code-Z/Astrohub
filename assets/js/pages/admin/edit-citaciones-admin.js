/* IMPORTACIONES */

import { TextValidation } from "../../modules/Validation/TextValidation.js";
import { DateValidation } from "../../modules/Validation/DateValidation.js";
import { FormSubmit } from "../../modules/Validation/FormSubmit.js";

import {
    DATEBIRTH_EXPR_REG,
    REASON_EXPR_REG,
} from "../../modules/RegExpresion/regExpresions.js";

import {
    DATEBIRTH_REG_EXPR_ERR,
    REASON_REG_EXPR_ERR,
} from "../../modules/Constantes/constantes.js";

/* VARIABLES */

const reasonInput = document.querySelector("#reason");
const reasonSpanErr = document.querySelector("#reason-error");

const dateInput = document.querySelector("#date");
const dateSpanErr = document.querySelector("#date-error");

const form = document.querySelector("form");
const btnForm = document.querySelector(".submit");
const btnReset = document.querySelector(".reset");

/* INSTANCIAS */

const reason = new TextValidation(
    reasonInput,
    reasonSpanErr,
    REASON_EXPR_REG,
    REASON_REG_EXPR_ERR,
    false
);

const date = new DateValidation(
    dateInput,
    dateSpanErr,
    DATEBIRTH_EXPR_REG,
    DATEBIRTH_REG_EXPR_ERR,
    false
);

const inputs = [reason, date];

const formSubmit = new FormSubmit(btnForm, btnReset, form, inputs, true);
