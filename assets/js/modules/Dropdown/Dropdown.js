/**
 * @fileoverview Clase que representa dropdowns.
 * @package Dropdowns
 * @author Víctor Pérez
 */

export class Dropdown {
    /**
     * @param {HTMLButtonElement} dropdownButton - Botón del dropdown.
     * @param {HTMLElement} dropdownMenu - El elemento del dropdown.
     */
    constructor(dropdownButton, dropdownMenu) {
        this.dropdownButton = dropdownButton;
        this.dropdownMenu = dropdownMenu;

        this.initClickDropdownBtnEvent();
        this.initClickDocumentEvent();
    }

    /**
     * Inicializa el evento de click del documento.
     *
     * @emits click
     */
    initClickDocumentEvent() {
        document.addEventListener("click", (event) => {
            this.handleDocumentClick(event);
        });
    }

    /**
     * Inicializa el evento de click del botón del dropdown.
     *
     * @emits click
     */
    initClickDropdownBtnEvent() {
        this.dropdownButton.addEventListener("click", () => {
            this.handleDropdownBtnClick();
        });
    }

    /**
     * Cierra el menú si se hace click en el documento.
     * @return {void}
     */
    handleDocumentClick(event) {
        if (!this.dropdownButton.contains(event.target)) {
            this.closeMenu();
        }
    }

    /**
     * Abre o cierra el menú según el estado de este.
     * @return {void}
     */
    handleDropdownBtnClick() {
        if (this.isOpen()) {
            return this.closeMenu();
        }

        this.openMenu();
    }

    /**
     * Pone y quita la clase para abrir y cerrar el dropdown.
     * @return {void}
     */
    toggleMenu() {
        this.dropdownMenu.classList.toggle("dropdown-open");
    }

    /**
     * Abre el menu del dropdown.
     * @return {void}
     */
    openMenu() {
        if (this.dropdownMenu.classList.contains("dropdown-close")) {
            this.dropdownMenu.classList.replace(
                "dropdown-close",
                "dropdown-open"
            );
            this.dropdownButton
                .querySelector(".dropdown-arrow")
                .classList.toggle("rotate");
            this.dropdownButton.style.backgroundColor = "rgba(255,255,255, .1)";
        }
    }

    /**
     * Cierra el menu del dropdown.
     * @return {void}
     */
    closeMenu() {
        if (this.dropdownMenu.classList.contains("dropdown-open")) {
            this.dropdownMenu.classList.replace(
                "dropdown-open",
                "dropdown-close"
            );
            this.dropdownButton
                .querySelector(".dropdown-arrow")
                .classList.toggle("rotate");
            this.dropdownButton.style.backgroundColor = "";
        }
    }

    /**
     * Revisa si el menu del dropdown está abierto.
     * @return {Boolean} - True: Está abierto.
     */
    isOpen() {
        return this.dropdownMenu.classList.contains("dropdown-open")
            ? true
            : false;
    }
}
