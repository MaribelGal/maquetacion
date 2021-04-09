import { renderizarFormulario } from "./form";
import { renderizarCkeditor } from "../ckeditor";

const tabla = document.getElementById("tabla");
const formulario = document.getElementById("formulario");

export let renderizarTabla = () => {

    let botonesEliminar = document.querySelectorAll(".boton-eliminar");
    let botonesEditar = document.querySelectorAll(".boton-editar");
    

    botonesEditar.forEach(botonEditar => {
        botonEditar.addEventListener("click", () => {

            console.log("boton editar")

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

    console.log("tabla renderizada");
};

renderizarTabla();
