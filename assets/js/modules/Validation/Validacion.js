/**
 * @fileoverview Clase que representa la validación general de los elementos
 * de un formulario.
 * @package Validación Inputs
 * @subpackage Base
 * @author Víctor Pérez
 */

export class Validation {
    /**
     * @param {HTMLInputElement} input - Campo a validar.
     * @param {HTMLSpanElement} spanError - Mensaje de error del campo.
     * @param {String} regExp - Regla de validación del campo.
     * @param {String} msgErr - Mensaje de validación del campo.
     * @param {boolean} isEmptyValid - True: El campo puede estar vacío.
     * @param {String} defaultInputValue - El valor por defecto del campo.
     * @param {Boolean} isValid - Variable de control que indica si el campo es válido.
     */
    constructor(input, spanError, regExp, msgErr, isEmptyValid) {
        this.input = input;
        this.spanError = spanError;
        this.regExp = regExp;
        this.msgErr = msgErr;
        this.isEmptyValid = isEmptyValid;

        this.defaultInputValue = this.input.value;
        this.isValid = false;
    }

    /**
     * Revisa si el campo está vacío.
     * @return {Boolean} - True: Si el campo está vacío.
     */
    empty() {
        return this.input.value === "" || this.input.value === null;
    }

    /**
     * Revisa si la expresión regular es correcta.
     * @return {Boolean} - True: Si la validación es correcta.
     */
    regExpCorrect() {
        return this.regExp.test(this.input.value);
    }

    /**
     * Establece que el campo no es válido.
     * @return {void}
     */
    isError(msgErr) {
        this.error(msgErr);
        this.isValid = false;
    }

    /**
     * Muestra el mensaje y clases de error.
     * @return {void}
     */
    error(msgErr) {
        this.input.classList.add("err-inp");
        this.spanError.innerText = msgErr;
    }

    /**
     * Elimina el mensaje y las clases de error.
     * @return {void}
     */
    valid() {
        this.input.classList.remove("err-inp");
        this.spanError.innerText = "";
    }

    /**
     * Determina si el campo tipo checkbox está marcado.
     * @return {Boolean} - True: Si el campo está marcado.
     */
    isCheckboxChecked() {
        return this.input.checked;
    }

    /**
     * Devuelve el valor por defecto del campo.
     * @return {String} - Valor por defecto del campo.
     */
    getDefaultValue() {
        return this.defaultInputValue;
    }
}
