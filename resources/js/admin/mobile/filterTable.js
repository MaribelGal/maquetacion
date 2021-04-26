import { renderizarTabla } from "./components/tableSwipe";

const tabla = document.getElementById("tabla");
const campoInput = document.getElementById("campo-input-text");
const campoDateStart = document.getElementById("campo-date-start");
const campoDateEnd = document.getElementById("campo-date-end");
const selectorOrderDesc = document.getElementById("selector-order-desc");
const selectorCategoria = document.getElementById("selector-categoria");
const PRUEBA = document.getElementById("my-checkbox");

const camposRadioAscDesc = document.querySelectorAll(".order_asc_desc");

const formularioFiltro = document.getElementById("filtro-formulario");

export let renderizarFiltroTabla = () => {
    selectorCategoria.addEventListener('change', () => {
        let data = new FormData(formularioFiltro);
        let url = formularioFiltro.action;

        for (var pair of data.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }


        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    console.log("selector")
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });

    campoInput.addEventListener('keyup', (event) => {
        console.log("tecla" + event);

        let data = new FormData(formularioFiltro);
        console.log(formularioFiltro);

        let url = formularioFiltro.action;
        console.log(formularioFiltro.action);

        let sendPostRequest = async () => {
            try {
                await axios.post(url, data).then(response => {
                    console.log(response.data);
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });

    campoDateStart.addEventListener('change', () => {
        let data = new FormData(formularioFiltro);
        let url = formularioFiltro.action;

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    console.log("selector date start")
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });

    campoDateEnd.addEventListener('change', () => {
        let data = new FormData(formularioFiltro);
        let url = formularioFiltro.action;

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    console.log("selector date end")
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });

    selectorOrderDesc.addEventListener('change', () => {
        let data = new FormData(formularioFiltro);
        let url = formularioFiltro.action;

        for (var pair of data.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    // console.log(data)
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                    // console.log(response.data.table)
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });


    // camposRadioAscDesc.forEach(campoRadioAscDesc => {
    //     campoRadioAscDesc.addEventListener('change',()=>{
    //         let data = new FormData(formularioFiltro);
    //         let url = formularioFiltro.action;

    //         for (var pair of data.entries()) {
    //             console.log(pair[0]+ ', ' + pair[1]); 
    //         }

    //         let sendPostRequest = async () => {

    //             try {
    //                 await axios.post(url, data).then(response => {
    //                     // console.log(data)
    //                     tabla.innerHTML = response.data.table;
    //                     renderizarTabla();
    //                     // console.log(response.data.table)
    //                 });

    //             } catch (error) {

    //             }
    //         };

    //         sendPostRequest();
    //     });
    // });



    PRUEBA.addEventListener('click', () => {
        let valor = PRUEBA.value;
        let nuevoValor = (valor == "desc")? "asc" : "desc";
        
        console.log(nuevoValor);
        PRUEBA.value = nuevoValor;


        let data = new FormData(formularioFiltro);
        let url = formularioFiltro.action;

        // for (var pair of data.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }



        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    tabla.innerHTML = response.data.table;
                    renderizarTabla();
                });

            } catch (error) {

            }
        };

        sendPostRequest();
    });

};

renderizarFiltroTabla();