import { EMPTY_ERR } from "../Constantes/constantes.js";
import { Validation } from "./Validacion.js";

/**
 * @fileoverview Clase que representa la validación de un campo
 * de tipo contraseña.
 * @package Validación Inputs
 * @subpackage Password
 * @extends Validation
 * @author Víctor Pérez
 */

export class PasswordValidation extends Validation {
    /**
     * @param {HTMLInputElement} input - Campo a validar.
     * @param {HTMLSpanElement} spanError - Mensaje de error del campo.
     * @param {String} regExp - Regla de validación del campo.
     * @param {String} msgErr - Mensaje de validación del campo.
     * @param {boolean} isEmptyValid - True: El campo puede estar vacío.
     * @param {HTMLInputElement} confirmInput - Campo para repetir la contraseña.
     * @param {Object} seePasswordMode - Modo para poder ver la contraseña.
     */
    constructor(
        input,
        spanError,
        regExp,
        msgErr,
        isEmptyValid,
        confirmInput,
        seePasswordMode
    ) {
        super(input, spanError, regExp, msgErr, isEmptyValid);

        this.confirmInput = confirmInput;
        this.seePasswordMode = seePasswordMode;

        if (this.seePasswordMode) {
            this.initEventSeeMode();
        }
    }

    /**
     * Inicializa el evento de click del modo para ver la contraseña (seePasswordMode).
     *
     * @emits click
     */
    initEventSeeMode() {
        this.seePasswordMode.btn.addEventListener("click", () => {
            this.handleClickEventSeePassword();
        });
    }

    /**
     * Ejecuta la lógica para ver la contraseña del campo.
     *
     * @return {void}
     */
    handleClickEventSeePassword() {
        const inputType =
            this.input.getAttribute("type") === "password"
                ? "text"
                : "password";
        this.input.setAttribute("type", inputType);
        this.seePasswordMode.btn.innerHTML =
            inputType === "password"
                ? this.seePasswordMode.svgSee
                : this.seePasswordMode.svgNotSee;
    }

    /**
     * Valida el campo y muestra errores en caso de que existan.
     * @return {void}
     */
    validate() {
        const isEmpty = this.empty();
        if (isEmpty) return this.isError(EMPTY_ERR);

        if (this.regExp) {
            const isRegExpCorrect = this.regExpCorrect();
            if (!isRegExpCorrect) return this.isError(this.msgErr);
        }

        if (this.confirmInput) {
            const isSame = this.isSamePassword();
            if (!isSame) return this.isError(this.msgErr);
        }

        this.valid();
        this.isValid = true;
    }

    /**
     * Revisa si la contraseña del campo de confirmación es igual al campo de contraseña.
     * @return {Boolean} - True: Si los campos son iguales.
     */
    isSamePassword() {
        return this.input.value === this.confirmInput.value;
    }
}
