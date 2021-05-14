const botonesDesplegable = document.querySelectorAll(".desplegable-boton");
const desplegableDescripciones = document.querySelectorAll(".desplegable-descripcion");
const desplegableIconos = document.querySelectorAll(".desplegable-icono");


botonesDesplegable.forEach(botonDesplegable => {
    
    botonDesplegable.addEventListener("click", () => {

        desplegableDescripciones.forEach(desplegableDescripcion => {

            if (desplegableDescripcion.dataset.faq_id == botonDesplegable.dataset.faq_id) {
                
                if (desplegableDescripcion.classList.contains("activo")) {
                    
                    desplegableDescripcion.classList.remove("activo");
                    
                    botonDesplegable.querySelector(".desplegable-icono").classList.remove("activo");

                } else {
                    desplegableDescripcion.classList.add("activo");
                    botonDesplegable.querySelector(".desplegable-icono").classList.add("activo");
                }
            }
        });

        // desplegableIconos.forEach(desplegableIcono => {
        //     if (desplegableIcono.id == botonDesplegable.value) {

        //         if (desplegableIcono.classList.contains("activo")) {

        //             desplegableIcono.classList.remove("activo");
        //             console.log(desplegableIcono.classList);

        //         } else {

        //             desplegableIcono.classList.add("activo");
        //             console.log(desplegableIcono.classList);
        //         }
        //     }
        // });


    });
});