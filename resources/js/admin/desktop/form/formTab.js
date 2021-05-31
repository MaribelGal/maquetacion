export let renderizarFormTab = () => {
    let botonesTab = document.querySelectorAll(".formulario-tab-item-panelselector");
    let panelesTab = document.querySelectorAll('*');

    botonesTab.forEach(botonTab => {
        botonTab.addEventListener("click", () => {

            botonesTab.forEach(botonTab => {
                if (botonTab.classList.contains("tab-active")) {
                    botonTab.classList.remove("tab-active");
                }
            })

            botonTab.classList.add("tab-active");

            panelesTab.forEach(panelTab => {
                if (panelTab.dataset.tab == botonTab.dataset.tab) {
                    panelTab.classList.add("tab-active");

                } else if (panelTab.classList.contains("tab-active")) {
                    panelTab.classList.remove("tab-active");
                }

            })
        });

    });
}