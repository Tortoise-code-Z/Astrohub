import { Validation } from "./Validacion.js";

/**
 * @fileoverview Clase que representa la validación de un input tipo
 * checkbox.
 * @package Validación Inputs
 * @subpackage Checkbox
 * @extends Validation
 * @author Víctor Pérez
 */

export class CheckboxValidation extends Validation {
    /**
     * @param {HTMLInputElement} input - Campo a validar.
     * @param {HTMLSpanElement} spanError - Mensaje de error del campo.
     * @param {String} regExp - Regla de validación del campo.
     * @param {String} msgErr - Mensaje de validación del campo.
     */
    constructor(input, spanError, regExp, msgErr) {
        super(input, spanError, regExp, msgErr);

        this.input.addEventListener("change", () => {
            if (this.input.value === "noChecked") {
                this.input.value = "checked";
                return;
            }

            this.input.value = "noChecked";
        });
    }

    /**
     * Valida el campo y muestra errores en caso de que existan.
     * @return {void}
     */
    validate() {
        const isChecked = this.isCheckboxChecked();

        if (!isChecked) return this.isError(this.msgErr);

        this.valid();
        this.isValid = true;
    }
}
