export let renderizarFormTablocale = () => {

    const tabsLocale = document.querySelectorAll(".panel-tab-locale");
    const panelesTab = document.querySelectorAll(".panel-locale-item");


    tabsLocale.forEach(tabLocale => {

        let botonesTab = tabLocale.querySelectorAll(".tab-locale-item");

        botonesTab.forEach(botonTab => {

            botonTab.addEventListener("click", () => {

                botonesTab.forEach(botonTab => {
                    if (botonTab.classList.contains("active")) {
                        botonTab.classList.remove("active");
                    }
                })

                botonTab.classList.add("active");

                panelesTab.forEach(panelTab => {
                    if (panelTab.dataset.locale == botonTab.dataset.locale) {
                        panelTab.classList.add("active");

                    } else if (panelTab.classList.contains("active")) {
                        panelTab.classList.remove("active");
                    }

                });

            });

        });

    });

}