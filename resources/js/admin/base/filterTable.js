import { renderizarTabla } from "../desktop/components/table";

const tabla = document.getElementById("tabla");
const campoInput = document.getElementById("campo-input-text");
const campoDateStart = document.getElementById("campo-date-start");
const campoDateEnd = document.getElementById("campo-date-end");
const selectorOrder = document.getElementById("selector-order");
const selectorCategoria = document.getElementById("selector-categoria");
const selectorParent = document.getElementById("selector-parent");
const checkOrderDesAsc = document.getElementById("my-checkbox");
const formularioFiltro = document.getElementById("filtro-formulario");

export let renderizarFiltroTabla = () => {

    let filtrar = () => {
        let url = formularioFiltro.action;
        let data = new FormData(formularioFiltro);
        if (data.get('order_asc_desc') == null) {
            data.set('order_asc_desc', 'desc')
        }

        for (var pair of data.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        let filters = {};
        data.forEach(function (value, key) {
            filters[key] = value;
        });
        
        let json = JSON.stringify(filters);

        let sendGetRequest = async () => {
            try {
                await axios.get(url, {
                    params: {
                        filters: json
                    }
                }).then(response => {
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };
        sendGetRequest();
    }

    if (selectorParent != null) {
        selectorParent.addEventListener('change', () => {
            filtrar();
        });
    };

    if (selectorCategoria != null) {
        selectorCategoria.addEventListener('change', () => {
            filtrar();
        });
    };

    if (campoInput != null) {
        campoInput.addEventListener('keyup', (event) => {
            filtrar();
        });
    };

    if (campoDateStart != null) {
        campoDateStart.addEventListener('change', () => {
            filtrar();
        });
    };

    if (campoDateEnd != null) {
        campoDateEnd.addEventListener('change', () => {
            filtrar();
        });
    };

    if (selectorOrder != null) {
        selectorOrder.addEventListener('change', () => {
            filtrar();
        });
    };

    if (checkOrderDesAsc != null) {
        checkOrderDesAsc.addEventListener('click', () => {
            filtrar();
        });
    };
};

renderizarFiltroTabla();