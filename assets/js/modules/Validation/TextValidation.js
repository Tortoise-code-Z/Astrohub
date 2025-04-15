import { EMPTY_ERR } from "../Constantes/constantes.js";
import { Validation } from "./Validacion.js";

/**
 * @fileoverview Clase que representa la validación de un campo
 * de tipo texto.
 * @package Validación Inputs
 * @subpackage Text
 * @extends Validation
 * @author Víctor Pérez
 */

export class TextValidation extends Validation {
    /**
     * @param {HTMLInputElement} input - Campo a validar.
     * @param {HTMLSpanElement} spanError - Mensaje de error del campo.
     * @param {String} regExp - Regla de validación del campo.
     * @param {String} msgErr - Mensaje de validación del campo.
     * @param {boolean} isEmptyValid - True: El campo puede estar vacío.
     */
    constructor(input, spanError, regExp, msgErr, isEmptyValid) {
        super(input, spanError, regExp, msgErr, isEmptyValid);
    }

    /**
     * Valida el campo y muestra errores en caso de que existan.
     * @return {void}
     */
    validate() {
        if (!this.isEmptyValid) {
            const isEmpty = this.empty();
            if (isEmpty) return this.isError(EMPTY_ERR);
        }

        if (this.regExp) {
            const isRegExpCorrect = this.regExpCorrect();
            if (!isRegExpCorrect) return this.isError(this.msgErr);
        }

        this.valid();
        this.isValid = true;
    }
}
