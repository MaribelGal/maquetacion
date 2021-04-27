const { default: axios } = require("axios");
const { isError } = require("lodash");

import { renderizarTabla } from "./table";
import { renderizarCkeditor } from "../ckeditor";
import { showNotification } from "./notifications";
import {startWait, stopWait} from './wait';

const tabla = document.getElementById("tabla");
//const formulario = document.getElementById("formulario");


export let renderizarFormulario = () => {

    let formularios = document.querySelectorAll(".admin-formulario");
    let botonGuardar = document.getElementById("boton-guardar-desktop");

    botonGuardar.addEventListener("click", (event) => {

        document.getElementById('item-error').innerHTML = ''; 
        
        formularios.forEach(formulario => {

            let datosFormulario = new FormData(formulario);

            if (datosFormulario.get('visible') == null) {
                datosFormulario.set('visible',0);
            }

            if (ckeditors != 'null') {

                Object.entries(ckeditors).forEach(([key, value]) => {
                    datosFormulario.append(key, value.getData());
                });
            }

            for (var entrada of datosFormulario.entries()) {
                console.log(entrada[0] + ": " + entrada[1]);
            }

            let url = formulario.action;

            let enviarPeticionPost = async () => {

                startWait();

                try {
                    await axios.post(url, datosFormulario).then(respuesta => {
                        formulario.id.value = respuesta.data.id;
                        tabla.innerHTML = respuesta.data.table;

                        stopWait();
                        showNotification("success", respuesta.data.message, 7000);

                        renderizarFormulario();
                        renderizarTabla();
                        
                    });

                } catch (error) {
                    stopWait();
                    if (error.response.status == '422') {

                        let errors = error.response.data.errors;
                        let errorMessage = '';

                        Object.keys(errors).forEach(function (key) {
                            errorMessage += '<div>' + errors[key] + '</div>';
                        })

                        console.log(errorMessage);

                        // document.getElementById('item-error').innerHTML = errorMessage;

                        showNotification("error", errorMessage, 7000);

                        // document.getElementById('error-container').classList.add('active');
                        // document.getElementById('errors').innerHTML = errorMessage;
                    }
                }
            }
            enviarPeticionPost();

        });

    });


    botonGuardar.addEventListener("mousedown", () => {
        botonGuardar.parentElement.classList.add("mousedown");
        console.log("pulsado");
    });

    botonGuardar.addEventListener("mouseup", () => {
        botonGuardar.parentElement.classList.remove("mousedown");
        console.log("levantado");
    });


    let botonesTab = document.querySelectorAll(".formulario-tab-item");
    let panelesTab = document.querySelectorAll(".formulario-contenido-panel");

    botonesTab.forEach(botonTab => {
        botonTab.addEventListener("click", (event) => {

            panelesTab.forEach(panelTab => {
                if (panelTab.dataset.tab == botonTab.dataset.tab) {
                    panelTab.classList.toggle("active");
                    botonTab.classList.toggle("active");
                } else {
                    panelTab.classList.toggle("active");
                    botonTab.classList.toggle("active");
                }
            });

        });
    });


    let botonCrear = document.getElementById("boton-crear");
    console.log(botonCrear);

    botonCrear.addEventListener("click", () => {
        let url = botonCrear.dataset.url;
        console.log(url);

        formularios.forEach(formulario => {
            let enviarPeticionGet = async () => {
                try {
                    await axios.get(url).then(respuesta => {
                        formulario.innerHTML = respuesta.data.form;
                        renderizarFormulario();
                        renderizarCkeditor();
                    });

                } catch (error) {
                    if (error.response.status == '422') {

                        let errors = error.response.data.errors;
                        let errorMessage = '';

                        Object.keys(errors).forEach(function (key) {
                            errorMessage += '<div>' + errors[key] + '</div>';
                        })

                        console.log(errorMessage);

                        document.getElementById('item-error').innerHTML = errorMessage;
                    }
                }
            }
            enviarPeticionGet();
        });

    });

};
// let botonAgregarFormulario = document.getElementById("item-agregarformulario");
// let formularioExtra = document.getElementById("formulario-direcciones");

// botonAgregarFormulario.addEventListener("click", () => {
//     console.log("click");
//     formularioExtra.classList.toggle("disable");
// })


renderizarFormulario();
renderizarCkeditor();