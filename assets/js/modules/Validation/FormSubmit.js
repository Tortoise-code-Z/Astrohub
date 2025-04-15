/**
 * @fileoverview Clase que representa la validación de un formulario.
 * @package Validación Formulario
 * @subpackage Base
 * @author Víctor Pérez
 */

export class FormSubmit {
    /**
     * @param {HTMLButtonElement} submitButton - Botón de envío del formulario.
     * @param {HTMLButtonElement} resetButton - Botón de reseteo del forumlario.
     * @param {HTMLFormElement} form - Elemento del formulario.
     * @param {Array.<Object>} inputs - Instancias de los inputs del forumalario.
     * @param {boolean} isChangedMode - True: si el formulario necesita cambiar sus valores para poder ser enviado.
     */
    constructor(submitButton, resetButton, form, inputs, isChangedMode) {
        this.submitButton = submitButton;
        this.resetButton = resetButton;
        this.form = form;
        this.inputs = inputs;
        this.isChangedMode = isChangedMode;

        this.initSubmitEvent();

        if (this.resetButton) {
            this.initResetEvent();
        }
        if (this.isChangedMode) {
            this.initChangeModeEvent();
        }
    }

    /**
     * Inicializa el evento de envío.
     *
     * @emits submit
     */

    initSubmitEvent() {
        this.form.addEventListener("submit", (event) =>
            this.handleSubmit(event)
        );
    }

    /**
     * Inicializa el evento de reset.
     *
     * @emits click
     */

    initResetEvent() {
        this.resetButton.addEventListener("click", (event) =>
            this.handleReset(event)
        );
    }

    /**
     * Inicializa los eventos relacionados con el modo cambio (isChangeMode).
     *
     * @emits input
     */

    initChangeModeEvent() {
        this.inputs.forEach((item) => {
            item.input.addEventListener("input", () => this.handleChangeMode());
        });
    }

    /**
     * Ejecuta la validación del formulario
     * @param {Event} event - Representa los datos del evento.
     * @return {void}
     */

    handleSubmit(event) {
        this.checkIsValidForm(event);
    }

    /**
     * Ejecuta el reset del formulario
     * @return {void}
     */

    handleReset() {
        this.innerDefault();
        // this.cantSaveData();
    }

    /**
     * Ejecuta la lógica del modo cambio (isChangeMode).
     * @return {void}
     */

    handleChangeMode() {
        const areChanges = this.areChanged();
        if (areChanges) {
            this.canSaveData();
            return;
        }

        this.cantSaveData();
    }

    /**
     * Introduce los valores por defecto de los inputs.
     * @return {void}
     */

    innerDefault() {
        this.inputs.forEach((item) => {
            item.input.value = item.defaultInputValue;
        });
    }

    /**
     * Revisa si el formulario es válido para el envío.
     * @return {void}
     */

    checkIsValidForm(event) {
        this.prevent(event);
        this.validateAll();

        const canSubmit = this.canSubmit();

        if (!canSubmit) {
            return;
        }

        this.send();
    }

    /**
     * Revisa si el valor de algún input ha cambiado.
     * @return {boolean} - True: Si ha cambiado el valor de un input.
     */

    areChanged() {
        const areChanged = this.inputs.some(
            (item) => item.input.value !== item.defaultInputValue
        );

        return areChanged;
    }

    /**
     * Desbloquea el botón de enviar del formulario.
     * @return {void}
     */

    canSaveData() {
        this.submitButton.classList.remove("cant-submit");
    }

    /**
     * Bloquea el botón de enviar del formulario.
     * @return {void}
     */

    cantSaveData() {
        this.submitButton.classList.add("cant-submit");
    }

    /**
     * Valida todos los inputs del formulario
     * @return {void}
     */

    validateAll() {
        this.inputs.forEach((item) => {
            item.validate();
        });
    }

    /**
     * Revisa si todos los inputs son válidos
     * @return {boolean} - True: si todos los inputs son válidos
     */

    canSubmit() {
        const areValid = this.inputs.every((item) => {
            return item.isValid === true;
        });

        return areValid ? true : false;
    }

    /**
     * Previene el envío por defecto del formulario
     * @return {void}
     */

    prevent(event) {
        event.preventDefault();
    }

    /**
     * Envía el formulario
     * @return {void}
     */

    send() {
        this.form.submit();
    }
}
