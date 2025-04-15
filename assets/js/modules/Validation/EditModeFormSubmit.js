import { FormSubmit } from "./FormSubmit.js";

/**
 * @fileoverview Clase que representa la validación de un formulario.
 * @package Validación Formulario
 * @subpackage Modo edición
 * @extends FormSubmit
 * @author Víctor Pérez
 */

export class EditModeFormSubmit extends FormSubmit {
    /**
     * @param {HTMLButtonElement} submitButton - Botón de envío del formulario.
     * @param {HTMLButtonElement} resetButton - Botón de reseteo del forumlario.
     * @param {HTMLFormElement} form - Elemento del formulario.
     * @param {Array.<Object>} inputs - Instancias de los inputs del forumalario.
     * @param {boolean} isChangedMode - True: si el formulario necesita cambiar sus valores para poder ser enviado.
     * @param {HTMLButtonElement} editButton - Botón de edición del formulario.
     * @param {HTMLButtonElement} cancelButton - Botón de cancelar del formulario.
     */
    constructor(
        submitButton,
        resetButton,
        form,
        inputs,
        isChangedMode,
        editButton,
        cancelButton
    ) {
        super(submitButton, resetButton, form, inputs, isChangedMode);

        this.editButton = editButton;
        this.cancelButton = cancelButton;

        // this.initSubmitEvent();
        this.initClickEditEvent();
        this.initClickCancelEvent();
    }

    /**
     * Inicializa el evento de edición del formulario.
     *
     * @emits click
     */
    initClickEditEvent() {
        this.editButton.addEventListener("click", () => {
            this.handleClickEditButton();
        });
    }

    /**
     * Inicializa el evento de cancelar del formulario.
     *
     * @emits click
     */
    initClickCancelEvent() {
        this.cancelButton.addEventListener("click", () => {
            this.handleClickCancelButton();
        });
    }

    /**
     * Ejecuta la lógica de edición del formulario.
     * @return {void}
     */
    handleClickEditButton() {
        this.editButton.style.display = "none";

        this.submitButton.style.display = "flex";
        this.cancelButton.style.display = "flex";

        this.inputs.forEach((input) => {
            input.input.classList.remove("no-editable");
        });
    }

    /**
     * Ejecuta la lógica de cancelar del formulario.
     * @return {void}
     */
    handleClickCancelButton() {
        this.editButton.style.display = "flex";

        this.submitButton.style.display = "none";
        this.cancelButton.style.display = "none";

        if (!this.submitButton.classList.contains("cant-submit")) {
            this.submitButton.classList.add("cant-submit");
        }

        this.inputs.forEach((item) => {
            item.input.classList.add("no-editable");
            item.input.value = item.defaultInputValue;

            if (item.input.classList.contains("err-inp")) {
                item.input.classList.remove("err-inp");
            }

            item.spanError.textContent = "";
        });
    }
}
