let currentState = 1;
export let getCurrentState =  () => {return currentState;}

const prueba = document.getElementById("tabla-filtro");


prueba.addEventListener("click", () => {
    console.log("bb")
    currentState += 1;
    // console.log("aa");
    console.log(currentState);

});

