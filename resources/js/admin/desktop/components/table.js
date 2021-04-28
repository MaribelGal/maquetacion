import { renderizarFormulario } from "./form";
import { renderizarCkeditor } from "../ckeditor";

const tabla = document.getElementById("tabla");
const formulario = document.getElementById("formulario");

export let renderizarTabla = () => {

    let botonesEliminar = document.querySelectorAll(".boton-eliminar");
    let botonesEditar = document.querySelectorAll(".boton-editar");
    let paginationButtons = document.querySelectorAll('.paginacion-tabla-boton');

    botonesEditar.forEach(botonEditar => {
        botonEditar.addEventListener("click", () => {


            let url = botonEditar.dataset.url;
            console.log(url);

            let enviarPeticionGet = async () => {
                try {
                    await axios.get(url).then(respuesta => {
                        formulario.innerHTML = respuesta.data.form;
                        console.log(respuesta.data.form);
                        renderizarFormulario();
                        renderizarCkeditor();
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

            let enviarPeticionGet = async () => {

                try {
                    await axios.delete(url).then(respuesta => {
                        tabla.innerHTML = respuesta.data.table;
                        renderizarTabla();
                        // formulario.innerHTML = respuesta.data.form;
                        // renderizarFormulario();
                    });
                } catch (error) {
                    console.log(error)
                }
            }

            enviarPeticionGet();
        });
    });

    paginationButtons.forEach(paginationButton => {

        paginationButton.addEventListener("click", () => {

            let url = paginationButton.dataset.page;

            let enviarPeticionGet = async () => {

                try {
                    await axios.get(url).then(respuesta => {
                        tabla.innerHTML = respuesta.data.table;
                        renderizarTabla();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            enviarPeticionGet();
            
        });
    });
    
};

renderizarTabla();
