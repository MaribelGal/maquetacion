const { default: axios } = require("axios");



const tabla = document.getElementById("tabla");
const formulario = document.getElementById("formulario");
const sideBar = document.getElementById("sidebar");
const sidebarItems = document.querySelectorAll(".sidebar-item");

import { renderizarFormulario } from "./form";
import {renderizarTabla} from "./table";
import { renderizarCkeditor } from "../ckeditor";

sidebarItems.forEach(sidebarItem => {
    sidebarItem.addEventListener("click", () => {
        let url = sidebarItem.dataset.url;

        console.log(sidebarItem);
        console.log(url);

        let enviarPeticionGet = async () => {
            try {
                await axios.get(url).then(respuesta =>{
                    formulario.innerHTML = respuesta.data.form;
                    tabla.innerHTML = respuesta.data.table;
                    renderizarTabla();
                    renderizarFormulario();
                    renderizarCkeditor();
                });

                    
            } catch (error) {
                console.log(error);
            }
        }

        sideBar.classList.toggle('active');
        enviarPeticionGet();
        window.history.pushState('','',url);
        });
});