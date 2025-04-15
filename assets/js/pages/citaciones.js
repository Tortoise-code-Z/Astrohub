/* IMPORTACIONES */

import { TextValidation } from "../modules/Validation/TextValidation.js";
import { DateValidation } from "../modules/Validation/DateValidation.js";
import { FormSubmit } from "../modules/Validation/FormSubmit.js";
import { EditModeFormSubmit } from "../modules/Validation/EditModeFormSubmit.js";

import {
    DATEBIRTH_EXPR_REG,
    REASON_EXPR_REG,
} from "../modules/RegExpresion/regExpresions.js";

import {
    DATEBIRTH_REG_EXPR_ERR,
    REASON_REG_EXPR_ERR,
} from "../modules/Constantes/constantes.js";

/* VARIABLES */

const reasonInput = document.querySelector("#reason");
const reasonSpanErr = document.querySelector("#appointment_reason-error");

const dateInput = document.querySelector("#date");
const dateSpanErr = document.querySelector("#date-error");

const form = document.querySelector(".create-form");
const btnForm = document.querySelector(".create-form .submit");
const btnReset = document.querySelector(".create-form .reset");

const historyAppointmentsForms = Array.from(
    document.querySelectorAll(".s-citas form.editable")
);

historyAppointmentsForms.forEach((form) => {
    /* VARIABLES */

    const btnForm = form.querySelector(".submit");
    const btnCancel = form.querySelector(".cancel");
    const btnEdit = form.querySelector(".edit");

    const reasonInput = form.querySelector(".h-reason");
    const reasonSpanErr = form.querySelector(".h-reason-error");

    const dateInput = form.querySelector(".h-date");
    const dateSpanErr = form.querySelector(".h-date-error");

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

    const formSubmit = new EditModeFormSubmit(
        btnForm,
        null,
        form,
        inputs,
        true,
        btnEdit,
        btnCancel
    );
});

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

const formSubmit = new FormSubmit(btnForm, btnReset, form, inputs, false);
