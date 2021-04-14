let botonGuardar = document.getElementById("item-guardar");

botonGuardar.addEventListener("mousedown", () => {
    botonGuardar.classList.add("mousedown");
});

botonGuardar.addEventListener("mouseup", () => {
    botonGuardar.classList.remove("mousedown");
});