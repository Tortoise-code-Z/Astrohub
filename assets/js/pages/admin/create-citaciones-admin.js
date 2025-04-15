/* IMPORTACIONES */

import { TextValidation } from "../../modules/Validation/TextValidation.js";
import { DateValidation } from "../../modules/Validation/DateValidation.js";
import { FormSubmit } from "../../modules/Validation/FormSubmit.js";

import {
    DATEBIRTH_EXPR_REG,
    REASON_EXPR_REG,
    USERNAME_EXPR_REG,
} from "../../modules/RegExpresion/regExpresions.js";

import {
    DATEBIRTH_REG_EXPR_ERR,
    REASON_REG_EXPR_ERR,
    USERNAME_REG_EXPR_ERR,
} from "../../modules/Constantes/constantes.js";

import { Filter } from "../../modules/Filter/Filter.js";

/* VARIABLES */

const userItems = Array.from(document.querySelectorAll(".user-item"));
const parentElement = document.querySelector(".usersDropdown");

const userInput = document.querySelector("#username");
const userSpanErr = document.querySelector("#username-error");

const reasonInput = document.querySelector("#reason");
const reasonSpanErr = document.querySelector("#reason-error");

const dateInput = document.querySelector("#date");
const dateSpanErr = document.querySelector("#date-error");

const form = document.querySelector("form");
const btnForm = document.querySelector(".submit");
const btnReset = document.querySelector(".reset");

/* INSTANCIAS */

const username = new TextValidation(
    userInput,
    userSpanErr,
    USERNAME_EXPR_REG,
    USERNAME_REG_EXPR_ERR,
    false
);

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

const inputs = [reason, date, username];

const formSubmit = new FormSubmit(btnForm, btnReset, form, inputs, true);

const filter = new Filter(userInput, userItems, parentElement, true);
