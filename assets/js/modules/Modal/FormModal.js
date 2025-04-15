import { Modal } from "./Modal.js";

/**
 * @fileoverview Clase que representa un modal.
 * @package Modal
 * @subpackage Modal formulario
 * @extends Modal
 * @author Víctor Pérez
 */

export class FormModal extends Modal {
    /**
     * @param {HTMLButtonElement} btnOpenModal - Botón para abrir el modal.
     * @param {HTMLButtonElement} btnCloseModal - Botón para cerrar el modal.
     * @param {HTMLElement} modal - El modal.
     * @param {HTMLElement} form - El formulario.
     */
    constructor(btnOpenModal, btnCloseModal, modal, form) {
        super(btnOpenModal, btnCloseModal, modal);
        this.form = form;

        this.initCloseClickEvent();
    }

    /**
     * Inicializa el evento de click del botón de cerrar.
     *
     * @emits click
     */
    initCloseClickEvent() {
        this.btnCloseModal.addEventListener("click", () => {
            this.handleCloseClickEvent();
        });
    }

    /**
     * Ejecuta el cierre del modal.
     * @return {void}
     */
    handleCloseClickEvent() {
        this.resetForm();
        this.close();
    }

    resetForm() {
        this.form.innerDefault();
        this.form.inputs.forEach((item) => {
            item.valid();
        });
    }
}
