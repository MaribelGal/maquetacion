const botonMenu = document.getElementById("boton-menu");
const sideBar = document.getElementById("sidebar");


botonMenu.addEventListener("click", (event) => {

    console.log(sideBar);
    sideBar.classList.toggle('active');

});