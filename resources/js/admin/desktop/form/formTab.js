export let renderizarFormTab = () => {
    let botonesTab = document.querySelectorAll(".formulario-tab-item-panelselector");
    let panelesTab = document.querySelectorAll('*');

    botonesTab.forEach(botonTab => {
        botonTab.addEventListener("click", () => {

            botonesTab.forEach(botonTab => {
                if (botonTab.classList.contains("active")) {
                    botonTab.classList.remove("active");
                }
            })

            botonTab.classList.add("active");

            panelesTab.forEach(panelTab => {
                if (panelTab.dataset.tab == botonTab.dataset.tab) {
                    panelTab.classList.add("active");

                } else if (panelTab.classList.contains("active")) {
                    panelTab.classList.remove("active");
                }

            })
        });

    });
}