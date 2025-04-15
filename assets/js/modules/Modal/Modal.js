/**
 * @fileoverview Clase que representa un modal.
 * @package Modal
 * @author Víctor Pérez
 */

export class Modal {
    /**
     * @param {HTMLButtonElement} btnOpenModal - Botón para abrir el modal.
     * @param {HTMLButtonElement} btnCloseModal - Botón para cerrar el modal.
     * @param {HTMLElement} modal - El modal.
     */
    constructor(btnOpenModal, btnCloseModal, modal) {
        this.btnOpenModal = btnOpenModal;
        this.btnCloseModal = btnCloseModal;
        this.modal = modal;

        this.initOpenClickEvent();
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
     * Inicializa el evento de click del botón de abrir.
     *
     * @emits click
     */
    initOpenClickEvent() {
        this.btnOpenModal.addEventListener("click", () => {
            this.handleOpenClickEvent();
        });
    }

    /**
     * Ejecuta el cierre del modal.
     * @return {void}
     */
    handleCloseClickEvent() {
        this.close();
    }

    /**
     * Ejecuta la apertura del modal.
     * @return {void}
     */
    handleOpenClickEvent() {
        this.open();
    }

    /**
     * Abre el modal.
     * @return {void}
     */
    open() {
        this.modal.classList.replace("modal-hide", "modal-show");
        document.querySelector("body").style.overflow = "hidden";
    }

    /**
     * Cierra el modal.
     * @return {void}
     */
    close() {
        this.modal.classList.replace("modal-show", "modal-hide");
        document.querySelector("body").style.overflow = "";
    }
}
