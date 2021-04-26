const { default: axios } = require("axios");

import { renderizarTabla } from "./tableSwipe";
import { renderizarCkeditor } from "../ckeditor";

const tabla = document.getElementById("tabla");


export let renderizarFormulario = () => {

    let formularios = document.querySelectorAll(".admin-formulario");
    let botonGuardar = document.getElementById("boton-guardar-mobile");

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



    
};


renderizarFormulario();
renderizarCkeditor();