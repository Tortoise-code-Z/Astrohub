/**
 * @fileoverview Clase que representa las acciones de la barra de navegación.
 * @package Navegación
 * @author Víctor Pérez
 */

export class Navigation {
    /**
     * @param {HTMLElement} navbar - La barra de navegación.
     * @param {HTMLButtonElement} openBurguerButton - Botón para abrir el menú hamburguesa.
     * @param {HTMLButtonElement} closeBurguerButton - Botón para cerrar el menú hamburguesa.
     * @param {HTMLElement} burguerMenu - El menú hamburguesa de navegación.
     * @param {Number} actualDistanceToTop - La distancia del scroll de documento hasta el top de este.
     */
    constructor(navbar, openBurguerButton, closeBurguerButton, burguerMenu) {
        this.navbar = navbar;
        this.openBurguerButton = openBurguerButton;
        this.closeBurguerButton = closeBurguerButton;
        this.burguerMenu = burguerMenu;

        this.actualDistanceToTop = 0;

        this.initOpenBurguerClickEvent();
        this.initCloseBurguerClickEvent();
        this.initWindowScrollEvent();
    }

    /**
     * Inicializa el evento de scroll.
     *
     * @emits scroll
     */
    initWindowScrollEvent() {
        window.addEventListener("scroll", () => {
            this.handleWindowScroll();
        });
    }

    /**
     * Inicializa el evento de click para el botón de cerrar del menú hamburguesa.
     *
     * @emits click
     */
    initCloseBurguerClickEvent() {
        this.closeBurguerButton.addEventListener("click", () => {
            this.handleCloseBurguerClick();
        });
    }

    /**
     * Inicializa el evento de click para el botón de abrir del menú hamburguesa.
     *
     * @emits click
     */
    initOpenBurguerClickEvent() {
        this.openBurguerButton.addEventListener("click", () => {
            this.handleOpenBurguerClick();
        });
    }

    /**
     * Ejecuta el cierre del menú hamburguesa.
     * @return {void}
     */
    handleCloseBurguerClick() {
        this.closeBurguerMenu();
        document.querySelector("body").style.overflow = "";
    }

    /**
     * La barra de navegación se esconde cuando se hace scroll hacia abajo, se muestra cuando
     * se hace scroll hacia arriba y se establecen estilos para cuando está en el top del documento.
     * @return {void}
     */
    handleWindowScroll() {
        const distanceToTop = this.getDistanceTop();

        const isMoveDown = this.isMoveDown();
        if (isMoveDown) {
            this.hideNavbar();
            this.setActualDistanceToTop(distanceToTop);
            return;
        }

        this.noTopStyle();
        this.showNavbar();

        const isOnTop = this.isOnTop();
        if (isOnTop) {
            this.topStyle();
            this.setActualDistanceToTop(distanceToTop);
            return;
        }

        this.noTopStyle();
        this.setActualDistanceToTop(distanceToTop);
    }

    /**
     * Ejecuta la apertura del menú hamburguesa.
     * @return {void}
     */
    handleOpenBurguerClick() {
        this.openBurguerMenu();
        document.querySelector("body").style.overflow = "hidden";
    }

    /**
     * Obtener la distancia al top del documento de la barra de navegación.
     * @return {Number} - Distancia al top del documento.
     */
    getActualDistanceToTop() {
        return this.actualDistanceToTop;
    }

    /**
     * Enviar un valor de distancia a la variable de control de la distancia del top.
     * @return {void}
     */
    setActualDistanceToTop(value) {
        this.actualDistanceToTop = value;
    }

    /**
     * Obtener la distancia del scroll al top del documento.
     * @return {Number} - Distancia al top del documento.
     */
    getDistanceTop() {
        return parseInt(window.scrollY);
    }

    /**
     * Abre el menú hamburguesa.
     * @return {void}
     */
    openBurguerMenu() {
        this.burguerMenu.classList.replace("burguer-close", "burguer-open");
    }

    /**
     * Cierra el menú hamburguesa.
     * @return {void}
     */
    closeBurguerMenu() {
        this.burguerMenu.classList.replace("burguer-open", "burguer-close");
    }

    /**
     * Determina si se está moviendo hacia abajo o hacia arriba el scroll del documento.
     * @return {Boolean} - True: Se está moviendo hacia abajo.
     */
    isMoveDown() {
        const distanceToTop = this.getDistanceTop();

        if (distanceToTop > this.actualDistanceToTop) {
            return true;
        }

        return false;
    }

    /**
     * Esconde la barra de navegación.
     * @return {void}
     */
    hideNavbar() {
        this.navbar.classList.replace("navBar-show", "navBar-hide");
    }

    /**
     * Muestra la barra de navegación.
     * @return {void}
     */
    showNavbar() {
        this.navbar.classList.replace("navBar-hide", "navBar-show");
    }

    /**
     * Determina si el scroll de la página está en el top del documento.
     * @return {Boolean} - True: Está en el top del documento.
     */
    isOnTop() {
        return this.getDistanceTop() === 0 ? true : false;
    }

    /**
     * Establece estilos a la barra de navegación si el scroll del documento está en el top.
     * @return {void}
     */
    topStyle() {
        this.navbar.classList.replace("navBar-offTop", "navBar-onTop");
    }

    /**
     * Establece estilos a la barra de navegación si el scroll del documento no está en el top.
     * @return {void}
     */
    noTopStyle() {
        this.navbar.classList.replace("navBar-onTop", "navBar-offTop");
    }
}
