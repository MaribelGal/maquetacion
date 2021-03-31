const { forEach } = require("lodash");

const botonesDesplegable = document.querySelectorAll(".desplegable-boton");
const desplegableDescripciones = document.querySelectorAll(".desplegable-descripcion");


botonesDesplegable.forEach(botonDesplegable => {
    
    botonDesplegable.addEventListener("click", () => {

        desplegableDescripciones.forEach(desplegableDescripcion => {

            if (desplegableDescripcion.id == botonDesplegable.value) {

                if (desplegableDescripcion.classList.contains("activo")) {

                    desplegableDescripcion.classList.remove("activo");

                    botonDesplegable.querySelector(".desplegable-icono").classList.remove("activo");

                } else {
                    document.querySelectorAll(".activo").forEach(elementoActivo => {
                        elementoActivo.classList.remove("activo");
                    }); 

                    desplegableDescripcion.classList.add("activo");

                    botonDesplegable.querySelector(".desplegable-icono").classList.add("activo");
                }
            }
        });



    });
});