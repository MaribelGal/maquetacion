export let renderizarFormAction = () => {
    let botonCrear = document.getElementById("boton-crear");

    if (botonCrear != null) {
        botonCrear.addEventListener("click", () => {
            let url = botonCrear.dataset.url;
            console.log(url);

            formularios.forEach(formulario => {
                let enviarPeticionGet = async () => {
                    try {
                        await axios.get(url).then(respuesta => {
                            formulario.innerHTML = respuesta.data.form;
                            renderizarFormulario();
                            renderizarDropImage();
                            renderizarCkeditor();
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
                        }
                    }
                }
                enviarPeticionGet();
            });
        });
    }
}