/* IMPORTACIONES */

import { Filter } from "../../modules/Filter/Filter.js";

/* VARIABLES */

const input = document.querySelector("#search");
const usersItem = Array.from(document.querySelectorAll(".user-item"));
const parentElement = document.querySelector(".users-container");

const usernameTitle = document.querySelector(".us-name");
const noticiaContainer = document.querySelector(".news-user-container");

/* EVENTOS */

usersItem.forEach((user) => {
    user.addEventListener("click", () => {
        usersHandleClickEvent(user);
    });
});

// Recoger los datos de las citas e introducirlos en el DOM
const usersHandleClickEvent = (user) => {
    const username = user.querySelector(".name-user");
    innerText(usernameTitle, username.textContent);
    fetchNewsUser(parseInt(user.id));
};

/* INSTANCIAS */

// Creacion de la instancia del filtrado de usuarios
const filterUsers = new Filter(input, usersItem, parentElement, false);

/* FUNCIONES */

// Función asincrona que recoge los datos de las noticias del usuario y las introduce en el dom
async function fetchNewsUser(idUser) {
    try {
        const response = await fetch(
            `./api/get-news-admin.php?idUser=${idUser}`
        );

        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }

        const data = await response.json();

        deleteNews();

        if (data.length > 0) {
            data.forEach((data) => {
                const itemData = createNoticia(data);
                innerHTML(itemData, noticiaContainer);
            });
        }
    } catch (error) {
        console.error("Hubo un problema con la solicitud:", error);
    }
}

// Crea el item de la noticia y la retorna con los datos correspondientes
const createNoticia = (data) => {
    const noticia = `
                    <div class="nuc-item" id="new-${data.idNoticia}">
                        <div class="nuci-reason-date-container">
                            <div class="nuci-title">
                                <h3 class="txt-primary-color nucir-title">Título</h3>
                                <p class="txt-secondary-color nucir-desc">${data.titulo}</p>
                            </div>
                            <div class="nuci-desc">
                                <h3 class="txt-primary-color nucide-title">Descripción</h3>
                                <p class="txt-secondary-color nucide-desc">${data.texto}</p>
                            </div>
                            <div class="nuci-date">
                                <h3 class="txt-primary-color nucida-title">Fecha</h3>
                                <p class="txt-secondary-color nucida-desc">${data.fecha}</p>
                            </div>
                        </div>

                        <div class="nuci-buttons">
                            <a href="./index.php?controller=adminEditNews&id=${data.idNoticia}" class="btn btn-primary">Editar</a>
                            <a href="./index.php?controller=deleteNew&id=${data.idNoticia}" class="btn btn-trash nucib-delete">Borrar</a>
                        </div>
                    </div>
                </div>`;

    return noticia;
};

// Elimina las noticias en el Dom
const deleteNews = () => {
    const news = Array.from(document.querySelectorAll(".nuc-item"));
    news.forEach((item) => item.remove());
};

// Funciones de apoyo
const innerText = (element, text) => {
    element.innerText = text;
};

const innerHTML = (element, parentElement) => {
    parentElement.innerHTML += element;
};
