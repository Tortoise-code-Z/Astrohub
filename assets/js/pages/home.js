/* IMPORTACIONES */

import { Slider } from "../modules/Slider/Slider.js";

/* VARIABLES */

const slides = Array.from(document.querySelectorAll(".rating-item"));

/* INSTANCIAS */

const ratingSlide = new Slider(slides, null, null, null, null);

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
