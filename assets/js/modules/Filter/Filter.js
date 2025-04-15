/**
 * @fileoverview Clase que representa un filtro de campo.
 * @package Filtro
 * @author Víctor Pérez
 */

export class Filter {
    /**
     * @param {HTMLElement} input - El input de filtro.
     * @param {Array} elements - Los elementos a filtrar.
     * @param {HTMLElement} parentElement - La caja padre de los elementos.
     * @param {Boolean} hideMode - Modo para que parentElement no se muestre de primeras.
     */
    constructor(input, elements, parentElement, hideMode) {
        this.input = input;
        this.elements = elements;
        this.parentElement = parentElement;
        this.hideMode = hideMode;

        this.initInputEvent();
        this.initialDisplay();

        if (this.hideMode) {
            this.initClickInputEvent();
            this.initClickElementsEvent();
            this.initClickDocumentEvent();
        }
    }

    /**
     * Inicializa el evento de input del campo.
     *
     * @emits input
     */
    initInputEvent() {
        this.input.addEventListener("input", () => {
            this.handleInputEvent();
        });
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
     * Inicializa el evento de click del campo.
     *
     * @emits click
     */
    initClickInputEvent() {
        this.input.addEventListener("click", () => {
            this.handleInputClick();
        });
    }

    /**
     * Inicializa el evento de click de los elementos.
     *
     * @emits click
     */
    initClickElementsEvent() {
        this.elements.forEach((element) => {
            element.addEventListener("click", () => {
                this.handleElementsClick(element);
            });
        });
    }

    /**
     * Inicializa el display de parentElement
     *
     * @emits void
     */
    initialDisplay() {
        if (this.hideMode) {
            this.parentElement.style.display = "none";
            return;
        }

        this.parentElement.style.display = "flex";
    }

    /**
     * Esconde los filtros cuando se hace click en el documento.
     * @return {void}
     */
    handleDocumentClick(event) {
        if (event.target !== this.input) {
            this.parentElement.style.display = "none";
        }
    }

    /**
     * Introduce el valor del elemento en el campo.
     * @return {void}
     */
    handleElementsClick(element) {
        this.input.value = element.querySelector(".name-user").textContent;
    }

    /**
     * Muestra los filtros.
     * @return {void}
     */
    handleInputClick() {
        this.parentElement.style.display = "flex";
    }

    /**
     * Filtra los elementos seguún lo que se escriba en el campo.
     * @return {void}
     */
    handleInputEvent() {
        this.elements.forEach((element) => {
            if (element.style.display === "none") {
                element.style.display = "flex";
            }

            const text = element.querySelector(".name-user").textContent;

            if (!text.toLowerCase().startsWith(this.input.value)) {
                element.style.display = "none";
            }
        });
    }
}
