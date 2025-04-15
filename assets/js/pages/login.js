/* IMPORTACIONES */

import { TextValidation } from "../modules/Validation/TextValidation.js";
import { PasswordValidation } from "../modules/Validation/PasswordValidation.js";
import { FormSubmit } from "../modules/Validation/FormSubmit.js";

import {
    PASSWORD_EXPR_REG,
    USERNAME_EXPR_REG,
} from "../modules/RegExpresion/regExpresions.js";

import {
    USERNAME_REG_EXPR_ERR,
    PASSWORD_REG_EXPR_ERR,
} from "../modules/Constantes/constantes.js";

/* VARIABLES */

const usernameInput = document.querySelector("#username");
const usernameSpanErr = document.querySelector("#username-error");

const passwordInput = document.querySelector("#password");
const passwordSpanErr = document.querySelector("#password-error");

const btnForm = document.querySelector(".submit");
const form = document.querySelector("form");

const seePasswordBtn = document.querySelector(".seePassword");

const svgSeePassword = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>`;
const svgNotSeePassword = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 5l16 16M11.148 9.123a3 3 0 0 1 3.722 3.752M8.41 6.878C12.674 4.762 17.267 6.47 21 12c-1.027 1.521-2.119 2.753-3.251 3.696m-2.509 1.59C11.076 19.142 6.631 17.38 3 12c1.01-1.496 2.083-2.713 3.196-3.65"/></svg>`;

/* INSTANCIAS */

const username = new TextValidation(
    usernameInput,
    usernameSpanErr,
    USERNAME_EXPR_REG,
    USERNAME_REG_EXPR_ERR
);

const password = new PasswordValidation(
    passwordInput,
    passwordSpanErr,
    PASSWORD_EXPR_REG,
    PASSWORD_REG_EXPR_ERR,
    false,
    null,
    {
        btn: seePasswordBtn,
        svgSee: svgSeePassword,
        svgNotSee: svgNotSeePassword,
    }
);

const inputs = [username, password];
const formSubmit = new FormSubmit(btnForm, null, form, inputs);
