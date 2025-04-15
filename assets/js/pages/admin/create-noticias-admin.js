/* IMPORTACIONES */

import { TextValidation } from "../../modules/Validation/TextValidation.js";
import { DateValidation } from "../../modules/Validation/DateValidation.js";
import { FormSubmit } from "../../modules/Validation/FormSubmit.js";

import {
    DESC_NEW_EXPR_REG,
    TITLE_NEW_EXPR_REG,
    IMAGE_NEW_URL_EXPR_REG,
    DATEBIRTH_EXPR_REG,
    USERNAME_EXPR_REG,
} from "../../modules/RegExpresion/regExpresions.js";

import {
    TITLE_NEW_REG_EXPR_ERR,
    IMAGE_NEW_URL_REG_EXPR_ERR,
    DESC_NEW_REG_EXPR_ERR,
    DATEBIRTH_REG_EXPR_ERR,
    USERNAME_REG_EXPR_ERR,
} from "../../modules/Constantes/constantes.js";

import { Filter } from "../../modules/Filter/Filter.js";

/* VARIABLES */

const userItems = Array.from(document.querySelectorAll(".user-item"));
const userParentElement = document.querySelector(".usersDropdown");

const userInput = document.querySelector("#username");
const userSpanErr = document.querySelector("#username-error");

const titleInput = document.querySelector("#title");
const titleSpanErr = document.querySelector("#title-error");

const dateInput = document.querySelector("#date");
const dateSpanErr = document.querySelector("#date-error");

const descInput = document.querySelector("#description");
const descSpanErr = document.querySelector("#description-error");

const imageInput = document.querySelector("#image");
const imageSpanErr = document.querySelector("#image-error");

const form = document.querySelector("form");
const btnForm = document.querySelector(".submit");
const btnReset = document.querySelector(".reset");

/* INSTANCIAS */

const user = new TextValidation(
    userInput,
    userSpanErr,
    USERNAME_EXPR_REG,
    USERNAME_REG_EXPR_ERR,
    false
);

const title = new TextValidation(
    titleInput,
    titleSpanErr,
    TITLE_NEW_EXPR_REG,
    TITLE_NEW_REG_EXPR_ERR,
    false
);

const description = new TextValidation(
    descInput,
    descSpanErr,
    DESC_NEW_EXPR_REG,
    DESC_NEW_REG_EXPR_ERR,
    false
);

const date = new DateValidation(
    dateInput,
    dateSpanErr,
    DATEBIRTH_EXPR_REG,
    DATEBIRTH_REG_EXPR_ERR,
    false
);

const image = new TextValidation(
    imageInput,
    imageSpanErr,
    IMAGE_NEW_URL_EXPR_REG,
    IMAGE_NEW_URL_REG_EXPR_ERR,
    false
);

const inputs = [title, description, image, date, user];

const formSubmit = new FormSubmit(btnForm, btnReset, form, inputs, true);

const filter = new Filter(userInput, userItems, userParentElement, true);
