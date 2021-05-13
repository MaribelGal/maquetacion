

export let renderizarFormulario = () => {

    let formularios = document.querySelectorAll(".admin-formulario");
    let botonGuardar = document.getElementById("boton-guardar-desktop");

    botonGuardar.addEventListener("click", (event) => {

        // document.getElementById('item-error').innerHTML = ''; 

        formularios.forEach(formulario => {

            let datosFormulario = new FormData(formulario);

            if (datosFormulario.get('visible') == null) {
                datosFormulario.set('visible', 0);
            }

            if (ckeditors != 'null') {
                Object.entries(ckeditors).forEach(([key, value]) => {
                    // console.log(key);
                    // console.log(value);
                    datosFormulario.append(key, value.getData());
                });
            }

            for (var entrada of datosFormulario.entries()) {
                console.log(entrada[0] + ": " + entrada[1]);
            }

            let url = formulario.action;

            let enviarPeticionPost = async () => {

                startWait();

                try {
                    await axios.post(url, datosFormulario).then(respuesta => {
                        formulario.id.value = respuesta.data.id;
                        tabla.innerHTML = respuesta.data.table;

                        stopWait();
                        showNotification("success", respuesta.data.message, 7000);

                        renderizarFormulario();
                        renderizarDropImage();
                        renderizarTabla();

                    });

                } catch (error) {
                    stopWait();
                    if (error.response.status == '422') {

                        let errors = error.response.data.errors;
                        let errorMessage = '';

                        Object.keys(errors).forEach(function (key) {
                            errorMessage += '<div>' + errors[key] + '</div>';
                        })

                        console.log(errorMessage);

                        // document.getElementById('item-error').innerHTML = errorMessage;

                        showNotification("error", errorMessage, 7000);

                        // document.getElementById('error-container').classList.add('active');
                        // document.getElementById('errors').innerHTML = errorMessage;
                    }
                }
            }
            enviarPeticionPost();

        });

    });




};

let buttonSaveAnimation = () => {
    botonGuardar.addEventListener("mousedown", () => {
        botonGuardar.parentElement.classList.add("mousedown");
        console.log("pulsado");
    });

    botonGuardar.addEventListener("mouseup", () => {
        botonGuardar.parentElement.classList.remove("mousedown");
        console.log("levantado");
    });
}