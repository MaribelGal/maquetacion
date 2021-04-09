const botonSelectorPanelFormulario = document.getElementById("boton-selectorpanel-formulario");
const botonSelectorPanelTabla = document.getElementById("boton-selectorpanel-tabla");
const panelFormulario = document.getElementById("formulario");
const panelTabla = document.getElementById("tabla");

botonSelectorPanelFormulario.addEventListener("click", (event) => {
    botonSelectorPanelTabla.classList.remove("disable");
    botonSelectorPanelFormulario.classList.add("disable");
    panelTabla.classList.remove("disable");
    panelFormulario.classList.add("disable");

});

botonSelectorPanelTabla.addEventListener("click", (event) => {
    botonSelectorPanelTabla.classList.add("disable");
    botonSelectorPanelFormulario.classList.remove("disable");
    panelFormulario.classList.remove("disable");
    panelTabla.classList.add("disable");

});