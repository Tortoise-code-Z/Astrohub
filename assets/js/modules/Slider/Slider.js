/**
 * @fileoverview Clase que representa un slider.
 * @package Slider
 * @author Víctor Pérez
 */

export class Slider {
    /**
     * @param {Array} slides - Cada elemento del slider.
     * @param {HTMLButtonElement} rightArrowButton - Botón para pasar al siguiente slide.
     * @param {HTMLButtonElement} leftArrowButton - Botón para pasar al anterior slide.
     * @param {HTMLButtonElement} playButton - Botón para poner en marcha el slider en automático.
     * @param {HTMLButtonElement} pauseButton - Botón para parar el slider automático.
     * @param {Object} interval - Intervalo de tiempo para el paso de slides.
     */
    constructor(
        slides,
        rightArrowButton,
        leftArrowButton,
        playButton,
        pauseButton
    ) {
        this.slides = slides;
        this.rightArrowButton = rightArrowButton;
        this.leftArrowButton = leftArrowButton;
        this.playButton = playButton;
        this.pauseButton = pauseButton;

        this.interval = null;

        this.initDocumentEvent();

        if (this.pauseButton) {
            this.initPuaseEvent();
        }

        if (this.playButton) {
            this.initPlayEvent();
        }

        if (this.rightArrowButton) {
            this.initMoveRightEvent();
        }

        if (this.leftArrowButton) {
            this.initMoveLeftEvent();
        }
    }

    /**
     * Inicializa el evento de carga del documento.
     *
     * @emits DOMContentLoaded
     */
    initDocumentEvent() {
        document.addEventListener("DOMContentLoaded", () => {
            this.handelDocumentEvent();
        });
    }

    /**
     * Inicializa el evento de click de la flecha izquierda.
     *
     * @emits click
     */
    initMoveLeftEvent() {
        this.leftArrowButton.addEventListener("click", () => {
            this.handleClickLeftButton();
        });
    }

    /**
     * Inicializa el evento de click de la flecha derecha.
     *
     * @emits click
     */
    initMoveRightEvent() {
        this.rightArrowButton.addEventListener("click", () => {
            this.handleClickRightButton();
        });
    }

    /**
     * Inicializa el evento de click del botón de pausa.
     *
     * @emits click
     */
    initPuaseEvent() {
        this.pauseButton.addEventListener("click", () => {
            this.handleClickPauseButton();
        });
    }

    /**
     * Inicializa el evento de click del botón de play.
     *
     * @emits click
     */
    initPlayEvent() {
        this.playButton.addEventListener("click", () => {
            this.handleClickPlayButton();
        });
    }

    /**
     * Pasa a la anterior slide.
     * @return {void}
     */
    handleClickLeftButton() {
        this.moveToLeft();
    }

    /**
     * Pone en marcha el slide automático.
     * @return {void}
     */
    handleClickPlayButton() {
        this.play();
    }

    /**
     * Para el slide automático.
     * @return {void}
     */
    handleClickPauseButton() {
        this.stop();
    }

    /**
     * Pone el slider en automático.
     * @return {void}
     */
    handelDocumentEvent() {
        this.auto();
    }

    /**
     * Pasa a la siguiente slide.
     * @return {void}
     */
    handleClickRightButton() {
        this.moveToRight();
    }

    /**
     * Ejecuta la puesta en marcha del modo automático.
     * @return {void}
     */
    auto() {
        if (this.playButton && this.rightArrowButton && this.leftArrowButton) {
            this.buttonsModeAuto();
        }

        this.playInterval();
    }

    /**
     * Ejecuta la detención del slide automático.
     * @return {void}
     */
    stop() {
        this.buttonsModeManual();
        clearInterval(this.interval);
        this.interval = null;
    }

    /**
     * Ejecuta la puesta en marcha del slide automático.
     * @return {void}
     */
    play() {
        this.buttonsModeAuto();
        this.playInterval();
    }

    /**
     *Deshabilita botones.
     * @return {void}
     */
    disabledButtons(buttons, classes) {
        buttons.forEach((item) => {
            if (!item.classList.contains(classes)) {
                item.classList.add(classes);
            }
        });
    }

    /**
     *Habilita botones.
     * @return {void}
     */
    enableButtons(buttons, classes) {
        buttons.forEach((item) => {
            if (item.classList.contains(classes)) {
                item.classList.remove(classes);
            }
        });
    }

    /**
     *Ejecuta la puesta en marcha del intervalo de tiempo para el slider automático.
     * @return {void}
     */
    playInterval() {
        this.interval = setInterval(() => {
            this.moveToRight();
        }, 5000);
    }

    /**
     *Establece los estilos de los botones del slider automático.
     * @return {void}
     */
    buttonsModeAuto() {
        this.disabledButtons(
            [this.playButton, this.rightArrowButton, this.leftArrowButton],
            "isPlayed"
        );
        this.enableButtons([this.pauseButton], "isPaused");
    }

    /**
     *Establece los estilos de los botones del slider manual.
     * @return {void}
     */
    buttonsModeManual() {
        this.disabledButtons([this.pauseButton], "isPaused");
        this.enableButtons(
            [this.playButton, this.rightArrowButton, this.leftArrowButton],
            "isPlayed"
        );
    }

    /**
     *Ejecuta el movimiento hacia la izquierda.
     * @return {void}
     */
    moveToLeft() {
        const slideShowing = this.slides.findIndex((item) =>
            item.classList.contains("showing")
        );

        this.slides[slideShowing].classList.remove("right-in");
        this.slides[slideShowing].classList.remove("left-in");
        this.slides[slideShowing].classList.replace("showing", "right-out");

        // comprobar si la anterior slide tiene o no la clase left-out para saber si se hace un reemplazo o una adición simplemente.
        const slideToShow =
            slideShowing === 0 ? this.slides.length - 1 : slideShowing - 1;

        if (this.slides[slideToShow].classList.contains("left-out"))
            this.slides[slideToShow].classList.remove("left-out");
        if (this.slides[slideToShow].classList.contains("right-out"))
            this.slides[slideToShow].classList.remove("right-out");

        // añadir showing a la slide que se muestra en pantalla
        this.slides[slideToShow].classList.add("right-in", "showing");
    }

    /**
     *Ejecuta el movimiento hacia la derecha.
     * @return {void}
     */
    moveToRight() {
        const slideShowing = this.slides.findIndex((item) =>
            item.classList.contains("showing")
        );

        this.slides[slideShowing].classList.remove("left-in");
        this.slides[slideShowing].classList.remove("right-in");
        this.slides[slideShowing].classList.replace("showing", "left-out");

        // comprobar si la anterior slide tiene o no la clase left-out para saber si se hace un reemplazo o una adición simplemente.
        const slideToShow =
            slideShowing === this.slides.length - 1 ? 0 : slideShowing + 1;

        if (this.slides[slideToShow].classList.contains("left-out"))
            this.slides[slideToShow].classList.remove("left-out");
        if (this.slides[slideToShow].classList.contains("right-out"))
            this.slides[slideToShow].classList.remove("right-out");

        // añadir showing a la slide que se muestra en pantalla
        this.slides[slideToShow].classList.add("left-in", "showing");
    }
}
