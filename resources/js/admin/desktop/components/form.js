const { default: axios } = require("axios");
const { isError } = require("lodash");

import { renderizarTabla } from "./table";
import { renderizarCkeditor } from "../ckeditor";

const tabla = document.getElementById("tabla");
//const formulario = document.getElementById("formulario");


export let renderizarFormulario = () => {

    let formularios = document.querySelectorAll(".admin-formulario");
    let botonGuardar = document.getElementById("boton-guardar-desktop");

    botonGuardar.addEventListener("click", (event) => {

        formularios.forEach(formulario => {

            let datosFormulario = new FormData(formulario);

            if (ckeditors != 'null') {

                Object.entries(ckeditors).forEach(([key, value]) => {
                    datosFormulario.append(key, value.getData());
                });
            }

            for (var entrada of datosFormulario.entries()) {
                console.log(datosFormulario);
                console.log(entrada[0] + ": " + entrada[1]);
            }

            let url = formulario.action;

            let enviarPeticionPost = async () => {
                try {

                    await axios.post(url, datosFormulario).then(respuesta => {
                        formulario.id.value = respuesta.data.id;
                        tabla.innerHTML = respuesta.data.table;
                        renderizarFormulario();
                        renderizarTabla();

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




};
    // let botonAgregarFormulario = document.getElementById("item-agregarformulario");
    // let formularioExtra = document.getElementById("formulario-direcciones");

    // botonAgregarFormulario.addEventListener("click", () => {
    //     console.log("click");
    //     formularioExtra.classList.toggle("disable");
    // })

    
renderizarFormulario();
renderizarCkeditor();