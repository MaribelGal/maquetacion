const { default: axios } = require("axios");
const { isError } = require("lodash");

const formularios = document.querySelectorAll(".admin-formulario");
const botonGuardar = document.getElementById("boton-guardar");
//const tablas = document.querySelectorAll(".");
const tabla = document.getElementById("tabla");

const errorTitulo = document.getElementById("error-titulo");
const errorDescripcion = document.getElementById("error-descripcion");

botonGuardar.addEventListener("click", (event) => {
    console.log(event);

    formularios.forEach(formulario => {

        const datosFormulario = new FormData(formulario);

        /*
        for (var entrada of datosFormulario.entries()) {
            console.log(datosFormulario);
            console.log(entrada[0] + ": " + entrada[1]);
        }*/

        let url = formulario.action;
        console.log(formulario.action);

        let enviarPeticionPost = async () => {
            try {
                await axios.post(url, datosFormulario).then(respuesta => {
                    formulario.id.value = respuesta.data.id;
                    tabla.innerHTML = respuesta.data.table;

                });

            } catch (error) {
                if (error.response.status == '422') {
                    errorTitulo.textContent = error.response.data.errors.titulo;

                    errorDescripcion.textContent = error.response.data.errors.description;
                }
            }
        }
        enviarPeticionPost();

    });

});