const { default: axios } = require("axios");

const formularios = document.querySelectorAll(".admin-formulario");
const botonGuardar = document.getElementById("boton-guardar");
//const tablas = document.querySelectorAll(".");
const tabla = document.getElementById("tabla");

botonGuardar.addEventListener("click", (event) => {

    event.preventDefault();

    formularios.forEach(formulario => {

        const datosFormulario = new FormData(formulario);

        /*
        for (var entrada of datosFormulario.entries()) {
            console.log(datosFormulario);
            console.log(entrada[0] + ": " + entrada[1]);
        }*/

        let url = formulario.action;

        let enviarPeticionPost = async () => {
            try {
                await axios.post(url, datosFormulario).then(respuesta => {
                    console.log(tabla);
                    formulario.id.value = respuesta.data.id;
                    tabla.innerHTML = respuesta.data.table;
                });

            } catch (error) {
                console.log(error);
            }
        }

        enviarPeticionPost();

    });

});