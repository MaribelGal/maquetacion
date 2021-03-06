import { renderizarTabla } from "../components/table";
import { renderizarCkeditor } from "../ckeditor";
import { showNotification } from "../components/notifications";
import { startWait, stopWait } from "../components/wait";

import { appendInputFiles } from "../components/dropImage_collection";
import { renderizarDropImage } from "../components/dropImage_collection";
import { resetDropImage } from "../components/dropImage_collection";

import { renderizarDropImage_single } from "../components/dropImage_single";
import { renderizarLocaleTags } from "../components/localeTags";
import { renderizarLocaleSeo } from "../components/localeSeo";

import { renderizarUpdatedImage } from "../components/updatedImage";
import { renderizarFormTab } from "./formTab";
import { renderizarFormAction } from "./formAction";
import { renderizarFormTablocale } from "./formTabLocale";
import { renderizarFormSave } from "./formSave";
import { renderizarFormVariant } from "./formVariant";

import { renderBlockParameters } from "../components/blockParameters";
import { renderGoogleBot } from "../components/googleBot";
import { renderSitemap } from "../components/sitemap";

import { renderNestedSortables } from '../components/sortable';
import { renderMenuItems } from '../components/menuItems';
import { renderSelects } from '../components/selects';


const tabla = document.getElementById("tabla");
//const formulario = document.getElementById("formulario");

export let renderizarFormulario = () => {
    let formularios = document.querySelectorAll(".admin-formulario");
    let formularios_dependientes = document.querySelectorAll(
        ".admin-formulario-dependiente"
    );
    let botonGuardar = document.getElementById("boton-guardar-desktop");

    if (botonGuardar) {
        botonGuardar.addEventListener("click", () => {
            formularios.forEach((standalone_element) => {
                console.log(standalone_element);


                if (formularios_dependientes.length > 0) {
                    formularios_dependientes.forEach((dependant_element) => {
                        console.log(dependant_element);
                        saveAction(null, dependant_element, standalone_element);
                    });
                } else {
                    console.log('no dependant');
                    saveAction(null, null, standalone_element);
                }

                console.log(formularios_dependientes);
            });
        });

        botonGuardar.addEventListener("mousedown", () => {
            botonGuardar.parentElement.classList.add("mousedown");
            console.log("pulsado");
        });

        botonGuardar.addEventListener("mouseup", () => {
            botonGuardar.parentElement.classList.remove("mousedown");
            console.log("levantado");
        });
    }

    renderizarFormTab();
    renderizarFormVariant();
    renderizarFormAction();
    renderizarFormTablocale();
    renderizarCkeditor();
    renderizarLocaleTags();
    renderizarLocaleSeo();
    renderBlockParameters();
    renderGoogleBot();
    renderSitemap();
    renderMenuItems();
    renderSelects(); 
    renderNestedSortables();
};

renderizarFormulario();
renderizarDropImage();
renderizarDropImage_single();
renderizarUpdatedImage();

let showDataForm = (datosFormulario) => {
    for (var entrada of datosFormulario.entries()) {
        console.log(entrada[0] + ": " + entrada[1]);
    }
};

let saveAction = (id, dependant_element, standalone_element) => {
    console.log("Formularios por enviar");
    console.log(dependant_element);
    console.log(standalone_element);

    let datosFormulario = new FormData(standalone_element);

    if (datosFormulario.get("visible") == null) {
        datosFormulario.set("visible", 0);
    }

    if (ckeditors != "null") {
        Object.entries(ckeditors).forEach(([key, value]) => {
            datosFormulario.append(key, value.getData());
        });
    }

    if (id) {
        datosFormulario.set("id-parent", id);
    }

    datosFormulario = appendInputFiles(datosFormulario);

    showDataForm(datosFormulario);

    let url = standalone_element.action;

    let enviarPeticionPost = async () => {
        startWait();

        try {
            await axios.post(url, datosFormulario).then((respuesta) => {
                if (standalone_element.classList.contains("admin-formulario")) {
                    if (dependant_element) {
                        saveAction(
                            respuesta.data.product_id,
                            null,
                            dependant_element
                        );
                    }

                    standalone_element.parentElement.innerHTML =
                        respuesta.data.form;
                    tabla.innerHTML = respuesta.data.table;

                    showNotification("success", respuesta.data.message, 7000);

                    renderizarFormulario();
                    resetDropImage();
                    renderizarTabla();
                    renderizarUpdatedImage();
                }

                // if (standalone_element.classList.contains('admin-formulario-dependiente')) {
                //     standalone_element.remove();
                // };

                stopWait();
            });
        } catch (error) {
            console.log(error);
            stopWait();
            if (error.response.status == "422") {
                let errors = error.response.data.errors;
                let errorMessage = "";

                Object.keys(errors).forEach(function (key) {
                    errorMessage += "<div>" + errors[key] + "</div>";
                });

                console.log(errorMessage);

                // document.getElementById('item-error').innerHTML = errorMessage;

                showNotification("error", errorMessage, 7000);

                // document.getElementById('error-container').classList.add('active');
                // document.getElementById('errors').innerHTML = errorMessage;
            }
        }
    };
    enviarPeticionPost();
};
