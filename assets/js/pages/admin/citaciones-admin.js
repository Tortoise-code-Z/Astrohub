/* IMPORTACIONES */

import { Filter } from "../../modules/Filter/Filter.js";

/* VARIABLES */

const input = document.querySelector("#search");
const usersItem = Array.from(document.querySelectorAll(".user-item"));
const parentElement = document.querySelector(".users-container");

const usernameTitle = document.querySelector(".us-name");
const citasContainer = document.querySelector(".appointments-user-container");

/* INSTANCIAS */

const filterUsers = new Filter(input, usersItem, parentElement, false);

/* EVENTOS */

// Evento de click a cada usuario
usersItem.forEach((user) => {
    user.addEventListener("click", () => {
        usersHandleClickEvent(user);
    });
});

// Recoger los datos de las citas e introducirlos en el DOM
const usersHandleClickEvent = (user) => {
    const username = user.querySelector(".name-user");
    innerText(usernameTitle, username.textContent);
    fetchCitasUser(parseInt(user.id));
};

/* FUNCIONES */

// Función asincrona que recoge los datos de las citas del usuario y las introduce en el dom
async function fetchCitasUser(idUser) {
    try {
        const response = await fetch(
            `./api/get-citas-admin.php?idUser=${idUser}`
        );

        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }

        const data = await response.json();

        deleteCitas();

        if (data.length > 0) {
            data.forEach((item) => {
                const itemData = createCita(item);
                innerHTML(itemData, citasContainer);
            });
        }
    } catch (error) {
        console.error("Hubo un problema con la solicitud:", error);
    }
}

// Crea el item de la noticia y la retorna con los datos correspondientes
const createCita = (data) => {
    const cita = `
                    <div class="auc-item" id="${data.idCita}">
                        <div class="auci-reason-date-container">
                            <div class="auci-reason">
                                <h3 class="txt-primary-color aucir-title">Motivo</h3>
                                <p class="txt-secondary-color aucir-desc">${data.motivo_cita}</p>
                            </div>
                            <div class="auci-date">
                                <h3 class="txt-primary-color aucid-title">Fecha</h3>
                                <p class="txt-secondary-color aucid-desc">${data.fecha_cita}</p>
                            </div>
                        </div>

                        <div class="auci-buttons">
                            <a href="./index.php?controller=adminEditCita&id=${data.idCita}" class="btn btn-primary">Editar</a>
                            <a href="./index.php?controller=adminDeleteCita&id=${data.idCita}" class="btn btn-trash aucib-delete">Borrar</a>
                        </div>
                    </div>`;
    return cita;
};

// Elimina las citas en el Dom
const deleteCitas = () => {
    const appointments = Array.from(document.querySelectorAll(".auc-item"));
    appointments.forEach((item) => item.remove());
};

// Funciones de apoyo
const innerText = (element, text) => {
    element.innerText = text;
};

const innerHTML = (element, parentElement) => {
    parentElement.innerHTML += element;
};
