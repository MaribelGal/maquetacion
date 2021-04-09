const { default: axios } = require("axios");

const botonesEliminar = document.querySelectorAll(".boton-eliminar");
const botonesEditar = document.querySelectorAll(".boton-editar");

const formulario = document.getElementById("formulario");

const panelFormulario = document.getElementById("formulario");
const panelTabla = document.getElementById("tabla");
const botonSelectorPanelFormulario = document.getElementById("boton-selectorpanel-formulario");
const botonSelectorPanelTabla = document.getElementById("boton-selectorpanel-tabla");


botonesEditar.forEach(botonEditar => {
    botonEditar.addEventListener("click", () => {

        panelFormulario.classList.remove("disable");
        panelTabla.classList.add("disable");
        botonSelectorPanelTabla.classList.add("disable");
        botonSelectorPanelFormulario.classList.remove("disable");

        let url = botonEditar.dataset.url;

        console.log("EDITAR");
        console.log(botonEditar.dataset.url);

        let enviarPeticionGet = async () => {

            try {
                await axios.get(url).then(respuesta => {
                    console.log(respuesta.data.form);
                    formulario.innerHTML = respuesta.data.form;
                });
            } catch (error) {
                console.log(error)
            }
        }

        enviarPeticionGet();

    });
});

botonesEliminar.forEach(botonEliminar => {
    botonEliminar.addEventListener("click", () => {


        let url = botonEliminar.dataset.url;

        console.log("ELIMINAR");
        console.log(botonEliminar.dataset.url);

        let enviarPeticionGet = async () => {

            try {
                await axios.delete(url).then(respuesta => {
                    console.log(respuesta.data.form);
                    tabla.innerHTML = respuesta.data.table;
                    formulario.innerHTML = respuesta.data.form;
                });
            } catch (error) {
                console.log(error)
            }
        }

        enviarPeticionGet();
    });
});