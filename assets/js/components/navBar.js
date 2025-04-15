/**
 * IMPORTACIONES
 */

import { Navigation } from "../modules/Navigation/Navigation.js";
import { Dropdown } from "../modules/Dropdown/Dropdown.js";

/**
 * VARIABLES
 */

const adminDropdownBtn = document.querySelector(".admin-btn");
const adminDropdownMenu = document.querySelector("#admin-dropdown-menu");

const perfilDropdownBtn = document.querySelector(".perfil-btn");
const perfilDropdownMenu = document.querySelector("#perfil-dropdown-menu");

const openBurguerButton = document.querySelector(".burguer-btn");
const closeBurguerButton = document.querySelector(".close-menu");
const burguerMenu = document.querySelector(".burguer-navList");
const navBar = document.querySelector(".navBar");

/**
 * INSTANCIAS
 */

const navigation = new Navigation(
    navBar,
    openBurguerButton,
    closeBurguerButton,
    burguerMenu
);

if (adminDropdownBtn) {
    const dropdownAdmin = new Dropdown(adminDropdownBtn, adminDropdownMenu);
}

if (perfilDropdownBtn) {
    const dropdownPerfil = new Dropdown(perfilDropdownBtn, perfilDropdownMenu);
}
