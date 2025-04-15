import { EMPTY_ERR } from "../Constantes/constantes.js";
import { Validation } from "./Validacion.js";

/**
 * @fileoverview Clase que representa la validación de un campo
 * de tipo fecha.
 * @package Validación Inputs
 * @subpackage Date
 * @extends Validation
 * @author Víctor Pérez
 */

export class DateValidation extends Validation {
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

        const isValidDate = this.isCorrectDate();

        if (!isValidDate) return this.isError(this.msgErr);

        this.valid();
        this.isValid = true;
    }

    /**
     * Revisa si una fecha es correcta y existe.
     * @return {Boolean} - True: Si la fecha existe y es correcta.
     */
    isCorrectDate() {
        const isCorerctYear = this.year();

        const isCorerctMonth = this.month();

        const isCorrectDay = this.day();

        return isCorerctYear && isCorerctMonth && isCorrectDay;
    }

    /**
     * Revisa si un año es correcto.
     * @return {Boolean} - True: Si el año cumple con la condición.
     */
    year() {
        const year = this.getYear();
        const actualYear = new Date().getFullYear();

        return year <= actualYear + 20;
    }

    /**
     * Revisa si un mes es correcto.
     * @return {Boolean} - True: Si el mes cumple con la condición.
     */
    month() {
        const month = this.getMonth();

        return month < 13;
    }

    /**
     * Revisa si un día es correcto.
     * @return {Boolean} - True: Si el día cumple con la condición.
     */
    day() {
        const year = this.getYear();
        const month = this.getMonth();
        const day = this.getDay();

        // Verifica si la fecha es válida (considerando meses y años bisiestos)
        let isLeapYear = this.getLeapYear(year);

        let dayPerMonth = {
            1: 31,
            2: isLeapYear ? 29 : 28,
            3: 31,
            4: 30,
            5: 31,
            6: 30,
            7: 31,
            8: 31,
            9: 30,
            10: 31,
            11: 30,
            12: 31,
        };

        return day <= 31 && day <= parseInt(dayPerMonth[month]);
    }

    /**
     * Revisa si un año es bisiesto.
     * @return {Boolean} - True: Si el año es bisiesto.
     */
    getLeapYear(year) {
        return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
    }

    /**
     * Obtiene el año del campo.
     * @return {Number} - El año introducido.
     */
    getYear() {
        return parseInt(this.input.value.split("-")[0]);
    }

    /**
     * Obtiene el mes del campo.
     * @return {Number} - El mes introducido.
     */
    getMonth() {
        return parseInt(this.input.value.split("-")[1]);
    }

    /**
     * Obtiene el día del campo.
     * @return {Number} - El día introducido.
     */
    getDay() {
        return parseInt(this.input.value.split("-")[2]);
    }
}
