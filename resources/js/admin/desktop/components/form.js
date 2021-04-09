const { default: axios } = require("axios");
const { isError } = require("lodash");

import {renderizarTabla} from "./table";
import { renderizarCkeditor } from "../ckeditor";

const tabla = document.getElementById("tabla");
//const formulario = document.getElementById("formulario");


export let renderizarFormulario = () => {

    let formularios = document.querySelectorAll(".admin-formulario");
    let botonGuardar = document.getElementById("boton-guardar-desktop");
    let errorTitulo = document.getElementById("error-titulo");
    let errorDescripcion = document.getElementById("error-descripcion");
    let errorNombre = document.getElementById("error-nombre");

    botonGuardar.addEventListener("click", (event) => {

        formularios.forEach(formulario => {

            let datosFormulario = new FormData(formulario);

            if( ckeditors != 'null'){

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
                        errorTitulo.textContent = error.response.data.errors.titulo;

                        errorDescripcion.textContent = error.response.data.errors.description;

                        //errorNombre.textContent = error.response.data.errors.nombre;
                    }
                }
            }
            enviarPeticionPost();

        });

    });

    botonGuardar.addEventListener("mousedown", () => {
        // botonGuardar.parentNode.cccontains("")
        // classList.add("mousedown");
        // pendiente
    });

    botonGuardar.addEventListener("mouseup", () => {
        botonGuardar.classList.remove("mousedown");
    });

};

renderizarFormulario();
renderizarCkeditor();