/* IMPORTACIONES */

import { Slider } from "../modules/Slider/Slider.js";

/* VARIABLES */

const slides = Array.from(document.querySelectorAll(".slide-item"));
const rightArrowButton = document.querySelector(".sb-right-button");
const leftArrowButton = document.querySelector(".sb-left-button");
const playButton = document.querySelector(".sb-play-button");
const pauseButton = document.querySelector(".sb-pause-button");

/* INSTANCIAS */

const headerSlide = new Slider(
    slides,
    rightArrowButton,
    leftArrowButton,
    playButton,
    pauseButton
);

// Movimiento de las secciones
const sections = Array.from(document.querySelectorAll(".off"));
const documentHeight = window.innerHeight;

window.addEventListener("scroll", () => {
    sections.forEach((item) => {
        if (window.scrollY + (documentHeight - 200) > item.offsetTop) {
            if (item.classList.contains("off")) {
                item.classList.replace("off", "on");
            }
        }
    });
});
