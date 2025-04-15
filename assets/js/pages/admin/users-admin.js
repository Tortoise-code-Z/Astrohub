/* IMPORTACIONES */

import { Filter } from "../../modules/Filter/Filter.js";

/* VARIABLES */

const input = document.querySelector("#search");
const usersItem = Array.from(document.querySelectorAll(".user-item"));
const parentElement = document.querySelector(".users-container");

/* INSTANCIAS */

const filterUsers = new Filter(input, usersItem, parentElement, false);
